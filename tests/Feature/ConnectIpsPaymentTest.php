<?php

declare(strict_types=1);

namespace Tests\Feature;

use Kbk\NepaliPaymentGateway\Epay\ConnectIps;
use Tests\ConnectIpsTestCase;

class ConnectIpsPaymentTest extends ConnectIpsTestCase
{
    public function test_it_should_be_correct_instance_of_payment_gateway()
    {
        $this->assertInstanceOf(ConnectIps::class, $this->connectIps);
    }
}
