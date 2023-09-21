<?php

namespace App\Traffic\Gateways;

class GateWay implements GateWayInterface
{
    /** @var string  */
    private string $name;
    /** @var int  */
    private int $weight;

    /**
     * @param string $name
     * @param int $weight
     */
    public function __construct(string $name, int $weight)
    {
        $this->name = $name;
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }
}