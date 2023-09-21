<?php

namespace App\Traffic;

use App\Traffic\Gateways\GateWayInterface;

interface TrafficSplitterInterface
{
    public function handlePayment(Payment $payment): GateWayInterface;
}