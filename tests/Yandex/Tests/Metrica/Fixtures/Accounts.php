<?php

namespace Yandex\Tests\Metrica\Fixtures;

class Accounts
{
    public static $accountsFixtures = [
        "accounts" => [
            0 => [
                "user_login" => "api-metrika2",
                "created_at" => "2010-12-08 19:32:03"
            ]
        ]
    ];

    public static $badRequestFixtures =
        [
            "errors" => [
                [
                    "error_type" => "invalid_parameter",
                    "message"    => "Error message"
                ]
            ],
            "code"    => 400,
            "message" => "Error message"
        ];

}
