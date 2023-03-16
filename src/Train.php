<?php

namespace Train;

use Train\TrainCars\TrainCar;

class Train
{
    const POSITION_FRONT = "front";
    const POSITION_BACK = "back";
    const MAX_CARS_ALLOWED = 30;

    private $cars = [];
    private $totalWeight = 0;
    private $maxCarsAllowed = self::MAX_CARS_ALLOWED;

    public function addCar(TrainCar $car, $position = self::POSITION_BACK) : TrainCar|array|null {
        if ($this->isTrainFull()) {
            trigger_error((new \Train\Exceptions\TrainAllowanceExceededException())->getMessage(), E_USER_NOTICE);

            return null;
        }

        if ($this->carExists($car)) {
            trigger_error((new \Train\Exceptions\DuplicateCarException())->getMessage(), E_USER_NOTICE);

            return $car;
        }

        if ($position === self::POSITION_BACK) {
            array_push($this->cars, $car);
        } else {
            array_unshift($this->cars, $car);
        }

        $this->addWeight($car);

        return $this->getCars();
    }

    public function removeCar($position = self::POSITION_BACK) : array {
        if ($this->isTrainEmpty()) {
            trigger_error((new \Train\Exceptions\TrainEmptyException())->getMessage(), E_USER_NOTICE);

            return [];
        }

        if ($position == self::POSITION_BACK) {
            $removedCar = array_pop($this->cars);
        } else {
            $removedCar = array_shift($this->cars);
        }

        $this->removeWeight($removedCar);

        return $this->getCars();
    }

    public function getTotalCars() : int {
        return count($this->getCars());
    }

    public function getTotalWeight() {
        return $this->totalWeight;
    }

    public function fixTotalWeight() : float {
        $this->totalWeight = array_reduce($this->getCars(), [$this, "sumCarWeights"], 0);
        
        return $this->getTotalWeight();
    }

    private function isTrainFull() : bool {
        return $this->getTotalCars() >= $this->maxCarsAllowed;
    }

    private function isTrainEmpty() : bool {
        return empty($this->getCars());
    }

    private function carExists(TrainCar $car) : bool {
        return in_array($car, $this->getCars());
    }

    private function addWeight(TrainCar $car) : float {
        $this->totalWeight += $car->getWeight();
        
        return $this->totalWeight;
    }

    private function removeWeight(TrainCar $removedCar) : float {
        $this->totalWeight -= $removedCar->getWeight();

        return $this->totalWeight;
    }

    private function getCars() : array {
        return $this->cars;
    }

    private function getCarNames() : array {
        return array_map(function($car){
            return $car->getCarID();
        }, $this->getCars());
    }

    private function sumCarWeights($carry, TrainCar $car) : float {
        return ($carry + $car->getWeight());
    }

    public function setMaxCarAllowance(int $maxAllowance) {
        $this->maxCarsAllowed = $maxAllowance;
    }

    public function __toString() {
        $train = new \stdClass();
        $train->totalCars = $this->getTotalCars();
        $train->totalWeight = $this->getTotalWeight();
        $train->carList = $this->getCarNames();
        return json_encode($train) . PHP_EOL;
    }
}
