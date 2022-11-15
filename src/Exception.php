<?php

declare(strict_types=1);

namespace Wearesho\Delivery\NigeriaBulkSms;

use Wearesho\Delivery;

/**
 * For business errors (valid response body with error).
 * Otherwise, Delivery\Exception with code <=0 will be used.
 */
class Exception extends Delivery\Exception
{
}
