<?php

namespace Yandex\Tests\Metrica\Models\Management;

use Yandex\Metrica\Management\Models;
use Yandex\Tests\TestCase;
use Yandex\Tests\Metrica\Fixtures\Accounts;

class AccountsResponseTest extends TestCase
{
    public function testGetAccountsResponse()
    {
        $fixtures = Accounts::$accountsFixtures;
        $response = new Models\GetAccountsResponse();
        $accounts  = new Models\Accounts($fixtures['accounts']);
        $response->setAccounts($accounts);
        $this->assertTrue($response->getAccounts() instanceof Models\Accounts);
    }

    public function testUpdateAccountResponse()
    {
        $fixtures = Accounts::$accountsFixtures;
        $response = new Models\UpdateAccountResponse();
        $accounts  = new Models\Accounts($fixtures['accounts']);
        $response->setAccounts($accounts);
        $this->assertTrue($response->getAccounts() instanceof Models\Accounts);
    }
}
