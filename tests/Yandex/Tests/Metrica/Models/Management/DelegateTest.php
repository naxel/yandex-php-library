<?php
namespace Yandex\Tests\Metrica\Models\Management;

use Yandex\Tests\Metrica\Fixtures\Delegates;
use Yandex\Tests\TestCase;
use Yandex\Metrica\Management\Models;

class DelegateTest extends TestCase
{

    public function testGet()
    {
        $fixtures = Delegates::$delegatesFixtures;

        $delegate = new Models\Delegate();
        $delegate
            ->setComment($fixtures["delegates"][0]["comment"])
            ->setCreatedAt($fixtures["delegates"][0]["created_at"])
            ->setUserLogin($fixtures["delegates"][0]["user_login"]);

        $this->assertEquals($fixtures["delegates"][0]["user_login"], $delegate->getUserLogin());
        $this->assertEquals($fixtures["delegates"][0]["created_at"], $delegate->getCreatedAt());
        $this->assertEquals($fixtures["delegates"][0]["comment"], $delegate->getComment());
    }

    public function testDelegates()
    {
        $fixtures  = Delegates::$delegatesFixtures;
        $delegates = new Models\Delegates();
        $delegates->add(new Models\Delegate($fixtures["delegates"][0]));
        $delegates2 = new Models\Delegates($fixtures["delegates"]);
        $this->assertEquals($delegates->getAll()[0]->toArray(), $delegates2->getAll()[0]->toArray());
    }
}
 