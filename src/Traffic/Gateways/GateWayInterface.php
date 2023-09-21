<?php

namespace App\Traffic\Gateways;

interface GateWayInterface
{
    /**
     * @return int
     */
    public function getWeight(): int;

    /**
     * @return string
     */
    public function getName(): string;
}