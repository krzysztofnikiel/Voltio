<?php

namespace App\Tests;

use App\Traffic\TrafficSplitters\TrafficSplitter;
use App\Traffic\Gateways\GateWay;
use App\Traffic\Payment;
use PHPUnit\Framework\TestCase;

class TrafficSplitterTest extends TestCase
{
    public function testFirstCase(): void
    {
        $gateWays = [
            new GateWay('gateway1', 75),
            new GateWay('gateway2', 10),
            new GateWay('gateway3', 15),
        ];

        $trafficSplitter = new TrafficSplitter($gateWays);


        $results['gateway1'] = 0;
        $results['gateway2'] = 0;
        $results['gateway3'] = 0;

        for ($i = 0; $i < 100000; $i++) {
            $gate = $trafficSplitter->handlePayment(new Payment());
            $results[$gate->getName()]++;
        }

        $this->assertTrue(round($results['gateway1'] * 100 / 100000) >= 75);
        $this->assertTrue(round($results['gateway2'] * 100 / 100000) >= 10);
        $this->assertTrue(round($results['gateway3'] * 100 / 100000) >= 15);
    }

    public function testSecondCase(): void
    {
        $gateWays = [
            new GateWay('gateway1', 25),
            new GateWay('gateway2', 25),
            new GateWay('gateway3', 25),
            new GateWay('gateway4', 25),
        ];

        $trafficSplitter = new TrafficSplitter($gateWays);


        $results['gateway1'] = 0;
        $results['gateway2'] = 0;
        $results['gateway3'] = 0;
        $results['gateway4'] = 0;

        for ($i = 0; $i < 100000; $i++) {
            $gate = $trafficSplitter->handlePayment(new Payment());
            $results[$gate->getName()]++;
        }

        $this->assertTrue(round($results['gateway1'] * 100 / 100000) >= 24);
        $this->assertTrue(round($results['gateway2'] * 100 / 100000) >= 24);
        $this->assertTrue(round($results['gateway3'] * 100 / 100000) >= 24);
        $this->assertTrue(round($results['gateway4'] * 100 / 100000) >= 24);
    }

    public function testThreeCase(): void
    {
        $gateWays = [
            new GateWay('gateway1', 1),
            new GateWay('gateway2', 1),
            new GateWay('gateway3', 1),
            new GateWay('gateway4', 1),
        ];

        $trafficSplitter = new TrafficSplitter($gateWays);


        $results['gateway1'] = 0;
        $results['gateway2'] = 0;
        $results['gateway3'] = 0;
        $results['gateway4'] = 0;

        for ($i = 0; $i < 100000; $i++) {
            $gate = $trafficSplitter->handlePayment(new Payment());
            $results[$gate->getName()]++;
        }

        $this->assertTrue(round($results['gateway1'] * 100 / 100000) >= 24);
        $this->assertTrue(round($results['gateway2'] * 100 / 100000) >= 24);
        $this->assertTrue(round($results['gateway3'] * 100 / 100000) >= 24);
        $this->assertTrue(round($results['gateway4'] * 100 / 100000) >= 24);
    }
}
