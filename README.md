# NigeriaBulkSms Integration
[![Test & Lint](https://github.com/wearesho-team/nigeriabulksms-message-delivery/actions/workflows/php.yml/badge.svg?branch=master)](https://github.com/wearesho-team/nigeriabulksms-message-delivery/actions/workflows/php.yml)
[![Latest Stable Version](https://poser.pugx.org/wearesho-team/nigeriabulksms-message-delivery/v/stable.png)](https://packagist.org/packages/wearesho-team/nigeriabulksms-message-delivery)
[![Total Downloads](https://poser.pugx.org/wearesho-team/nigeriabulksms-message-delivery/downloads.png)](https://packagist.org/packages/wearesho-team/nigeriabulksms-message-delivery)
[![codecov](https://codecov.io/gh/wearesho-team/nigeriabulksms-message-delivery/branch/master/graph/badge.svg)](https://codecov.io/gh/wearesho-team/nigeriabulksms-message-delivery)

[wearesho-team/message-delivery](https://github.com/wearesho-team/message-delivery) implementation of
[Delivery\ServiceInterface](https://github.com/wearesho-team/message-delivery/blob/1.3.4/src/ServiceInterface.php)

[NigeriaBulkSms](https://nigeriabulksms.com/)
[SMS Gateway API](https://nigeriabulksms.com/sms-gateway-api-in-nigeria/)

## Quick Start
- Install to your Project
```bash
composer require wearsho-team/nigeriabulksms-message-delivery:^1.0
```
- Configure environment

| Variable | Required | Description              |
|----------|----------|--------------------------|
| NIGERIABULKSMS_LOGIN | Yes      | Your login to gateway    |
| NIGERIABULKSMS_PASSWORD | Yes      | Your password to gateway |
| NIGERIABULKSMS_SENDER | Yes      | SMS Sender name          |

- Use in your code
```php
<?php
use Wearesho\Delivery\Message;
use Wearesho\Delivery\NigeriaBulkSms;

$service = TurboSms\Service::instance();
$service->send(new Message("Text", "3809700000000"));
```

## Usage
### Configuration
[ConfigInterface](./src/ConfigInterface.php) have to be used to configure requests.
Available implementations:
- [Config](./src/Config.php) - simple implementation using class properties
- [EnvironmentConfig](./src/EnvironmentConfig.php) - loads configuration values from environment using
  [getenv](http://php.net/manual/ru/function.getenv.php)

## TODO
- Implement [Delivery\CheckBalance](https://github.com/wearesho-team/message-delivery/blob/1.7.1/src/CheckBalance.php)
in [Service](./src/Service.php)

## Authors
- [Oleksandr <Horat1us> Letnikow](mailto:reclamme@gmail.com)

## License
[MIT](./LICENSE)
