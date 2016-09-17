<?php
/**
 * User: Tanya Kalashnik
 * Date: 21.07.14 13:18
 */

use Yandex\Metrica\Stat\StatClient;

$data = [];
$errorMessage = false;

//Is auth
if (isset($_COOKIE['yaAccessToken']) && isset($_COOKIE['yaClientId'])) {
    $settings = require_once '../../settings.php';

    try {
        $statClient = new StatClient($_COOKIE['yaAccessToken']);

        if (isset($_GET['counter-id']) && $_GET['counter-id']) {
            $counterId = $_GET['counter-id'];

            $paramsModel = new Yandex\Metrica\Stat\Models\ByTimeParams();
            $paramsModel->setMetrics(\Yandex\Metrica\Stat\MetricConst::S_HITS)
                ->setId($counterId)
                ->setDate1('6daysAgo')
                ->setDate2('today')
                ->setGroup('day')
                ->setFilters("ym:s:isMobile!='Yes'");
            $data = $statClient->data()->getByTime($paramsModel);
        }
    } catch (\Exception $ex) {
        $errorMessage = $ex->getMessage();
        if ($errorMessage === 'PlatformNotAllowed') {
            $errorMessage .= '<p>Возможно, у приложения нет прав на доступ к ресурсу. Попробуйте '
                . '<a href="' . rtrim(str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__), "/") . '/../OAuth/' . '">авторизироваться</a> и повторить.</p>';
        }
    }
}
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Yandex.SDK: Metrica Demo</title>

    <link rel="stylesheet" href="//yandex.st/bootstrap/3.0.3/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="/examples/Disk/css/style.css">

</head>
<body>

<div class="container">
    <div class="jumbotron">
        <h2><a href="/examples/Metrica"><span class="glyphicon glyphicon-tasks"></span></a> Пример работы с Яндекс Метрикой</h2>
    </div>
    <ol class="breadcrumb">
        <li><a href="/examples">Examples</a></li>
        <li><a href="/examples/Metrica">Metrica</a></li>
        <li><a href="/examples/Metrica/Stat">Stat</a></li>
        <li class="active">Отображение данных по времени</li>
    </ol>
    <?php
    if (!isset($_COOKIE['yaAccessToken']) || !isset($_COOKIE['yaClientId'])) {
        ?>
        <div class="alert alert-info">
            Для просмотра этой страницы вам необходимо авторизироваться.
            <a id="goToAuth" href="/examples/OAuth" class="alert-link">Перейти на страницу авторизации</a>.
        </div>
    <?php
    } else {
        if ($errorMessage) {
            ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php
        } else {
            ?>
            <div>
                <?php
                if ($data) {
                    ?>
                    <h3>Количество хитов по дням за последние 7 дней:</h3>
                    <table id="accountTable" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <?php
                            $begin = new DateTime($data->getQuery()->getDate1());
                            $end = new DateTime($data->getQuery()->getDate2());
                            $end = $end->modify('+1 day');
                            $interval = new DateInterval('P1D');

                            $dateRange = new DatePeriod($begin, $interval, $end);

                            foreach ($dateRange as $date) { ?>
                                <td><?= $date->format('Y-m-d') ?></td>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!is_null($data->getData())) {
                            foreach ($data->getData() as $dimensions) {
                                $metrics = current($dimensions->getMetrics()); ?>
                                <tr>
                                    <?php for ($i = 0; $i < count($metrics); $i++) { ?>
                                        <td><?= $metrics[$i] ?></td>
                                    <?php } ?>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                <?php
                }
                ?>
            </div>
        <?php
        }
    }
    ?>
</div>

<script src="http://yandex.st/jquery/2.0.3/jquery.min.js"></script>
<script src="http://yandex.st/bootstrap/3.0.3/js/bootstrap.min.js"></script>

</body>
</html>
