<?php

namespace Yandex\Tests\Metrica\Fixtures;

class Analytics
{
    public static $analyticsFixtures = [
        "kind" => "analytics#gaData",
        "id" => "https://api-metrika.yandex.ru/analytics/v3/data/ga",
        "selfLink" => "https://api-metrika.yandex.ru/analytics/v3/data/ga",
        "containsSampledData" => false,
        "sampleSize" => "7617",
        "sampleSpace" => "7617",
        "query" => [
            "ids" => "ga:2138128",
            "dimensions" => ["ga:country"],
            "metrics" => ["ga:pageviews"],
            "sort" => [],
            "filters" => [],
            "start-date" => "2014-07-26",
            "end-date" => "2014-07-28",
            "start-index" => 1,
            "max-results" => 1000
        ],
        "itemsPerPage" => 1000,
        "totalResults" => 50,
        "columnHeaders" => [
            0 => [
                "name" => "ga:country",
                "columnType" => "DIMENSION",
                "dataType" => "STRING"
            ],
            1 => [
                "name" => "ga:pageviews",
                "columnType" => "METRIC",
                "dataType" => "INTEGER"
            ]
        ],
        "totalsForAllResults" => [
            "ga:pageviews" => "13229"
        ],
        "rows" => [
            [
                "Russia",
                "11112"
            ],
            [
                "Ukraine",
                "1132"
            ],
            [
                "Belarus",
                "270"
            ],
            [
                "Kazakhstan",
                "124"
            ],
            [
                "Uzbekistan",
                "104"
            ],
            [
                "Thailand",
                "76"
            ]
        ]
    ];

    public static $paramsFixtures = [
        "ids"           => "ga:2138128",
        "dimensions"    => ["ga:country"],
        "metrics"       => ["ga:pageviews"],
        "sort"          => [],
        "filters"       => [],
        "start-date"    => "2014-07-26",
        "end-date"      => "2014-07-28",
        "start-index"   => 1,
        "max-results"   => 1000,
        'callback'      => null,
        'samplingLevel' => 'DEFAULT'
    ];
}
