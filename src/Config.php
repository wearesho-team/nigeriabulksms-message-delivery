<?php

declare(strict_types=1);

namespace Wearesho\Delivery\NigeriaBulkSms;

class Config implements ConfigInterface
{
    public string $username;

    public string $password;

    public string $senderName;

    public function __construct(
        string $username,
        string $password,
        string $senderName
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->senderName = $senderName;
    }

    public function getSenderName(): string
    {
        return $this->senderName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
