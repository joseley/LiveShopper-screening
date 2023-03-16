<?php

namespace Train\TrainCars;

abstract class TrainCar {

    const MAX_CAPACITY_LB = 50000;

    protected string $carType;
    protected string $id;
    protected float $weight = 0.0;

    public function __construct(string $id) {
        $this->id = $id;

        return $this;
    }

    public function setWeight(float $weight) {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight() : float {
        return (float) $this->weight;
    }

    public function getCarID() {
        $FQCN = explode("\\", get_class($this));
        $className = array_pop($FQCN);
        return $this->id . "[" . $className . "]";
    }

}
