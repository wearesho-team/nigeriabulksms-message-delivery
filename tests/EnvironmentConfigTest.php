<?php

declare(strict_types=1);

namespace Wearesho\Delivery\NigeriaBulkSms\Tests;

use Horat1us\Environment\Exception;
use PHPUnit\Framework\TestCase;
use Wearesho\Delivery\NigeriaBulkSms;

class EnvironmentConfigTest extends TestCase
{
    protected const USERNAME = 'username';
    protected const PASSWORD = 'password';
    protected const SENDER = 'sender';

    protected NigeriaBulkSms\EnvironmentConfig $fakeConfig;

    protected function setUp(): void
    {
        $this->fakeConfig = new NigeriaBulkSms\EnvironmentConfig();
    }

    public function testSuccessGetUSERNAME(): void
    {
        putenv('NIGERIABULKSMS_USERNAME=' . static::USERNAME);

        $this->assertEquals(static::USERNAME, $this->fakeConfig->getUsername());
    }

    public function testFailedGetUSERNAME(): void
    {
        $this->expectException(Exception\Missing::class);

        putenv('NIGERIABULKSMS_USERNAME');

        $this->fakeConfig->getUsername();
    }

    public function testSuccessGetPassword(): void
    {
        putenv('NIGERIABULKSMS_PASSWORD=' . static::PASSWORD);

        $this->assertEquals(static::PASSWORD, $this->fakeConfig->getPassword());
    }

    public function testFailedGetPassword(): void
    {
        $this->expectException(Exception\Missing::class);

        putenv('NIGERIABULKSMS_PASSWORD');

        $this->fakeConfig->getPassword();
    }

    public function testSuccessGetSenderName(): void
    {
        putenv('NIGERIABULKSMS_SENDER=' . static::SENDER);

        $this->assertEquals(static::SENDER, $this->fakeConfig->getSenderName());
    }

    public function testSuccessGetDefaultSenderName(): void
    {
        $this->expectException(Exception\Missing::class);

        putenv('NIGERIABULKSMS_SENDER');

        $this->fakeConfig->getSenderName();
    }
}
