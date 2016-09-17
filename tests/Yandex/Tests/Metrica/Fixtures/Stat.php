<?php

namespace Yandex\Tests\Metrica\Fixtures;

class Stat
{
    public static $tableFixtures = [
        "query" => [
            "id" => 2138128,
            "dimensions" => [],
            "metrics" => [
                "ym:s:pageviews"
            ],
            "sort" => [],
            "limit" => 100,
            "offset" => 1,
            "date1" => "2014-07-16",
            "date2" => "2014-07-22"
        ],
        "data" => [
            0 => [
                "dimensions" => [],
                "metrics" => [
                    53712
                ]
            ]
        ],
        "total_rows" => 1,
        "sampled" => false,
        "sample_share" => 1,
        "sample_size" => 26530,
        "sample_space" => 26530,
        "data_lag" => 176,
        "totals" => [
            53712
        ],
        "min" => [
            53712
        ],
        "max" => [
            53712
        ]
    ];

    public static $drillDownFixtures = [
        "query" => [
            "id" => 2138128,
            "preset" => "tech_platforms",
            "dimensions" => [
                "ym:s:operatingSystemRoot",
                "ym:s:operatingSystem"
            ],
            "metrics" => [
                "ym:s:visits",
                "ym:s:pageviews",
                "ym:s:bounceRate",
                "ym:s:pageDepth",
                "ym:s:avgVisitDurationSeconds"
            ],
            "sort" => [
                "-ym:s:visits"
            ],
            "limit" => 100,
            "offset" => 1,
            "date1" => "2014-07-16",
            "date2" => "2014-07-22"
        ],
        "data" => [
            0 => [
                "dimension" => [
                    "name" => "Windows",
                    "id" => "windows"
                ],
                "metrics" => [
                    16176,
                    39575,
                    18.6387,
                    2.44653,
                    183.645
                ],
                "expand" => true
            ],
            1 => [
                "dimension" => [
                    "name" => "GNU/Linux",
                    "id" => "gnu_linux"
                ],
                "metrics" => [
                    8124,
                    8807,
                    94.5716,
                    1.08407,
                    14.9344
                ],
                "expand" => true
            ],
            2 => [
                "dimension" => [
                    "name" => "Mac OS",
                    "id" => "macos"
                ],
                "metrics" => [
                    1277,
                    3410,
                    17.8543,
                    2.67032,
                    193.222
                ],
                "expand" => true
            ],
            3 => [
                "dimension" => [
                    "name" => "iOS",
                    "id" => "ios_double"
                ],
                "metrics" => [
                    504,
                    883,
                    49.6032,
                    1.75198,
                    94.3433
                ],
                "expand" => true
            ],
            4 => [
                "dimension" => [
                    "name" => "Google Android",
                    "id" => "android"
                ],
                "metrics" => [
                    453,
                    1005,
                    30.4636,
                    2.21854,
                    125.47
                ],
                "expand" => true
            ],
            5 => [
                "dimension" => [
                    "name" => "Другие с Java ME",
                    "id" => "java_me"
                ],
                "metrics" => [
                    33,
                    52,
                    39.3939,
                    1.57576,
                    48.4545
                ],
                "expand" => true
            ],
            6 => [
                "dimension" => [
                    "name" => "Windows Phone OS",
                    "id" => "windows_phoneos"
                ],
                "metrics" => [
                    26,
                    44,
                    50,
                    1.69231,
                    31.1154
                ],
                "expand" => true
            ],
            7 => [
                "dimension" => [
                    "name" => "Series40",
                    "id" => "series40"
                ],
                "metrics" => [
                    16,
                    17,
                    87.5,
                    1.0625,
                    1.9375
                ],
                "expand" => true
            ],
            8 => [
                "dimension" => [
                    "name" => "Mac OS X Yosemite",
                    "id" => "219"
                ],
                "metrics" => [
                    13,
                    26,
                    15.3846,
                    2,
                    130.615
                ],
                "expand" => true
            ],
            9 => [
                "dimension" => [
                    "name" => "SymbianOS",
                    "id" => "symbianos"
                ],
                "metrics" => [
                    9,
                    20,
                    22.2222,
                    2.22222,
                    185.222
                ],
                "expand" => true
            ],
            10 => [
                "dimension" => [
                    "name" => "Bada OS",
                    "id" => "bada_os"
                ],
                "metrics" => [
                    2,
                    2,
                    0,
                    1,
                    15.5
                ],
                "expand" => true
            ],
            11 => [
                "dimension" => [
                    "name" => "BlackBerry OS",
                    "id" => "blackberry"
                ],
                "metrics" => [
                    1,
                    3,
                    0,
                    3,
                    15
                ],
                "expand" => true
            ]
        ],
        "total_rows" => 12,
        "sampled" => false,
        "sample_share" => 1,
        "sample_size" => 26530,
        "sample_space" => 26530,
        "data_lag" => 135,
        "totals" => [
            26634,
            53844,
            42.6447,
            2.02163,
            129.494
        ],
        "min" => [
            1,
            2,
            0,
            1,
            1.9375
        ],
        "max" => [
            16176,
            39575,
            94.5716,
            3,
            193.222
        ]
    ];

    public static $byTimeFixtures = [
        "query" => [
            "id" => 2138128,
            "dimensions" => [],
            "metrics" => [
                "ym:s:pageviews"
            ],
            "sort" => [],
            "date1" => "2014-07-16",
            "date2" => "2014-07-22"
        ],
        "data" => [
            0 => [
                "dimensions" => [],
                "metrics" => [
                    0 => [
                        10524,
                        10042,
                        8502,
                        4365,
                        4753,
                        10092,
                        5564
                    ]
                ]
            ]
        ],
        "total_rows" => 0,
        "sampled" => false,
        "sample_share" => 1,
        "sample_size" => 0,
        "sample_space" => 0,
        "data_lag" => 165,
        "totals" => [
            0 => [
                10540,
                10000,
                8501,
                4365,
                4752,
                10093,
                5566
            ]
        ]
    ];

    public static $byTimeWithGroupFixtures = [
        "query" => [
            "id" => 2138128,
            "dimensions" => [],
            "metrics" => [
                "ym:s:pageviews"
            ],
            "sort" => [
                "-ym:s:pageviews"
            ],
            "date1" => "2015-09-21",
            "date2" => "2015-09-28",
            "auto_group_size" => 8,
            "group" => "hours",
            "auto_group_type" => "hours"
        ],
        "data" => [
            0 => [
                "dimensions" => [],
                "metrics" => [
                    0 => [
                        0.0,
                        28.0,
                        0.0,
                        0.0,
                        4.0,
                        0.0,
                        0.0,
                        6.0,
                        0.0,
                        0.0,
                        1.0,
                        6.0,
                        0.0,
                        0.0,
                        0.0,
                        0.0,
                        0.0,
                        0.0,
                        0.0,
                        0.0,
                        0.0,
                        0.0,
                        13.0,
                        0.0
                    ]
                ]
            ]
        ],
        "total_rows" => 6,
        "sampled" => false,
        "sample_share" => 1,
        "sample_size" => 6,
        "sample_space" => 6,
        "data_lag" => 114,
        "totals" => [
            0 => [
                58.0
            ]
        ]
    ];

    public static $byTimeWithGroupByDaysFixtures = [
        "query"             => [
            "ids"             => [36066170],
            "dimensions"      => [],
            "metrics"         => ["ym:s:hits"],
            "sort"            => ["-ym:s:hits"],
            "date1"           => "2016-03-29",
            "date2"           => "2016-04-04",
            'filters'         => "ym:s:isMobile!='Yes'",
            "group"           => "day",
            "auto_group_size" => "1",
            "quantile"        => "50",
            "attribution"     => "Last",
            "currency"        => "UAH",
            "auto_group_type" => "day"
        ],
        "data"              => [
            [
                "dimensions" => [],
                "metrics"    => [
                    [
                        4.0,
                        2.0,
                        7.0,
                        5.0,
                        3.0,
                        2.0,
                        0.0
                    ]
                ]
            ]
        ],
        "total_rows"        => 6,
        "sampled"           => false,
        "sample_share"      => 1.0,
        "sample_size"       => 19,
        "sample_space"      => 19,
        "data_lag"          => 62,
        "totals"            => [[23.0]],
        "last_period_index" => 6,
        "time_intervals"    => [
            [
                "2016-03-29",
                "2016-03-29"
            ],
            [
                "2016-03-30",
                "2016-03-30"
            ],
            [
                "2016-03-31",
                "2016-03-31"
            ],
            [
                "2016-04-01",
                "2016-04-01"
            ],
            [
                "2016-04-02",
                "2016-04-02"
            ],
            [
                "2016-04-03",
                "2016-04-03"
            ],
            [
                "2016-04-04",
                "2016-04-04"
            ]
        ]
    ];

    public static $byTimeParamsFixtures = [
        "id"                => 2138128,
        "preset"            => "tech_platforms",
        "dimensions"        => [
            "ym:s:operatingSystemRoot",
            "ym:s:operatingSystem"
        ],
        "metrics"           => [
            "ym:s:visits",
            "ym:s:pageviews",
            "ym:s:bounceRate",
            "ym:s:pageDepth",
            "ym:s:avgVisitDurationSeconds"
        ],
        "sort"              => [
            "-ym:s:visits"
        ],
        "limit"             => 100,
        "offset"            => 1,
        "date1"             => "2014-07-16",
        "date2"             => "2014-07-22",
        'filters'           => "ym:s:isMobile!='Yes'",
        'accuracy'          => 'medium',
        'callback'          => null,
        'include_undefined' => true,
        'lang'              => 'ru',
        'pretty'            => true,
        'group'             => 'all',
        'row_ids'           => null,
        'top_keys'          => 7
    ];

    public static $comparisonParamsFixtures = [
        "id"                => 2138128,
        "preset"            => "tech_platforms",
        "dimensions"        => [
            "ym:s:operatingSystemRoot",
            "ym:s:operatingSystem"
        ],
        "metrics"           => [
            "ym:s:visits",
            "ym:s:pageviews",
            "ym:s:bounceRate",
            "ym:s:pageDepth",
            "ym:s:avgVisitDurationSeconds"
        ],
        "sort"              => [
            "-ym:s:visits"
        ],
        "limit"             => 100,
        "offset"            => 1,
        'filters'           => "ym:s:isMobile!='Yes'",
        'filters_a'         => "ym:s:isMobile!='Yes'",
        'filters_b'         => "ym:s:isMobile=='Yes'",
        "date1_a"           => "2014-07-16",
        "date2_a"           => "2014-07-22",
        "date1_b"           => "2014-07-16",
        "date2_b"           => "2014-07-22",
        'accuracy'          => 'medium',
        'callback'          => null,
        'include_undefined' => true,
        'lang'              => 'ru',
        'pretty'            => true,
        'parent_id'         => null
    ];


    public static $tableParamsFixtures = [
        "id"                => 2138128,
        "preset"            => "tech_platforms",
        "dimensions"        => [
            "ym:s:operatingSystemRoot",
            "ym:s:operatingSystem"
        ],
        "metrics"           => [
            "ym:s:visits",
            "ym:s:pageviews",
            "ym:s:bounceRate",
            "ym:s:pageDepth",
            "ym:s:avgVisitDurationSeconds"
        ],
        "sort"              => [
            "-ym:s:visits"
        ],
        "limit"             => 100,
        "offset"            => 1,
        'filters'           => "ym:s:isMobile!='Yes'",
        "date1"           => "2014-07-16",
        "date2"           => "2014-07-22",
        'accuracy'          => 'medium',
        'callback'          => null,
        'include_undefined' => true,
        'lang'              => 'ru',
        'pretty'            => true
    ];

    public static $comparisonFixtures = [
        "query" => [
            "id" => 2138128,
            "dimensions" => [],
            "metrics" => [
                "ym:s:pageviews"
            ],
            "sort" => [],
            "limit" => 100,
            "offset" => 1,
            "date1_a" => "2014-07-16",
            "date2_a" => "2014-07-22",
            "date1_b" => "2014-07-16",
            "date2_b" => "2014-07-22",
            'filters_a' => "ym:s:isMobile!='Yes'",
            'filters_b' => "ym:s:isMobile=='Yes'"
        ],
        "data" => [
            0 => [
                "dimensions" => [],
                "metrics" => [
                    "a" => [
                        53856
                    ],
                    "b" => [
                        53856
                    ]
                ]
            ]
        ],
        "total_rows" => 1,
        "sampled" => false,
        "sample_share" => 1,
        "sample_size" => 26530,
        "sample_space" => 26530,
        "data_lag" => 118,
        "totals" => [
            "a" => [
                53856
            ],
            "b" => [
                53856
            ]
        ]
    ];

    public static $drillDownComparisonFixtures = [
        "query" => [
            "id" => 2138128,
            "preset" => "tech_platforms",
            "dimensions" => [
                "ym:s:operatingSystemRoot",
                "ym:s:operatingSystem"
            ],
            "metrics" => [
                "ym:s:visits",
                "ym:s:pageviews",
                "ym:s:bounceRate",
                "ym:s:pageDepth",
                "ym:s:avgVisitDurationSeconds"
            ],
            "sort" => [
                "-ym:s:visits"
            ],
            "limit" => 100,
            "offset" => 1,
            "date1_a" => "2014-07-16",
            "date2_a" => "2014-07-22",
            "date1_b" => "2014-07-16",
            "date2_b" => "2014-07-22"
        ],
        "data" => [
            0 => [
                "dimension" => [
                    "name" => "Windows",
                    "id" => "windows"
                ],
                "metrics" => [
                    "a" => [
                        16178,
                        39580,
                        18.6426,
                        2.44653,
                        183.651
                    ],
                    "b" => [
                        16178,
                        39580,
                        18.6426,
                        2.44653,
                        183.651
                    ]
                ],
                "expand" => true
            ],
            1 => [
                "dimension" => [
                    "name" => "GNU/Linux",
                    "id" => "gnu_linux"
                ],
                "metrics" => [
                    "a" => [
                        8124,
                        8807,
                        94.5716,
                        1.08407,
                        14.9344
                    ],
                    "b" => [
                        8124,
                        8807,
                        94.5716,
                        1.08407,
                        14.9344
                    ]
                ],
                "expand" => true
            ]
        ],
        "total_rows" => 12,
        "sampled" => false,
        "sample_share" => 1,
        "sample_size" => 26530,
        "sample_space" => 26530,
        "data_lag" => 76,
        "totals" => [
            "a" => [
                26637,
                53850,
                42.6474,
                2.02162,
                129.497
            ],
            "b" => [
                26637,
                53850,
                42.6474,
                2.02162,
                129.497
            ]
        ]
    ];
}
