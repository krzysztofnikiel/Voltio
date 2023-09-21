<?php

namespace App\Traffic\TrafficSplitters;

use App\Traffic\Gateways\GateWayInterface;
use App\Traffic\Payment;
use App\Traffic\TrafficSplitterInterface;

class TrafficSplitter implements TrafficSplitterInterface
{
    const MAX_PERCENT_VALUE = 100;

    /** @var GateWayInterface[] */
    private array $gateWays = [];

    /** @var int */
    private int $maxWeight = 0;

    /**
     * @param GateWayInterface[] $gateWays
     * @throws TrafficSplitterException
     */
    public function __construct(array $gateWays)
    {
        foreach ($gateWays as $gateWay) {
            $this->addGateWay($gateWay);
        }

        if ($this->maxWeight > static::MAX_PERCENT_VALUE) {
            throw new TrafficSplitterException('Total percent weight is more than ' . static::MAX_PERCENT_VALUE . '%.');
        }
    }

    /**
     * @param GateWayInterface $gateWay
     * @return void
     */
    private function addGateWay(GateWayInterface $gateWay): void
    {
        $this->gateWays[] = $gateWay;
        $this->maxWeight += $gateWay->getWeight();
    }

    /**
     * @param Payment $payment
     * @return GateWayInterface
     */
    public function handlePayment(Payment $payment): GateWayInterface
    {
        $rand = rand(1, $this->maxWeight);
        $maxWeight = 0;
        foreach ($this->gateWays as $item) {
            $minWeight = $maxWeight + 1;
            $maxWeight += $item->getWeight();
            if ($rand <= $maxWeight && $rand >= $minWeight) {
                return $item;
            }
        }

        return $this->gateWays[0];
    }
}