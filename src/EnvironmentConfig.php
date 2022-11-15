<?php

declare(strict_types=1);

namespace Wearesho\Delivery\NigeriaBulkSms;

use Horat1us\Environment;

/**
 * Class EnvironmentConfig
 * @package Wearesho\Delivery\TurboSms
 */
class EnvironmentConfig extends Environment\Config implements ConfigInterface
{
    public const DEFAULT_KEY_PREFIX = 'NIGERIABULKSMS_';

    public function __construct(string $keyPrefix = self::DEFAULT_KEY_PREFIX)
    {
        parent::__construct($keyPrefix);
    }

    public function getUsername(): string
    {
        return $this->getEnv('USERNAME');
    }

    public function getPassword(): string
    {
        return $this->getEnv('PASSWORD');
    }

    public function getSenderName(): string
    {
        return $this->getEnv('SENDER');
    }
}
