<?php

declare(strict_types=1);

namespace Wearesho\Delivery\NigeriaBulkSms;

interface ConfigInterface
{
    public const GATEWAY_BASEURL = 'https://portal.nigeriabulksms.com/api/';

    public function getSenderName(): string;

    public function getUsername(): string;

    public function getPassword(): string;
}
