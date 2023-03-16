<?php

namespace Train\TrainCars;

class EngineCar extends TrainCar {
    
    const MAX_CAPASITY_LB = 10000;
    
    protected string $carType = "Engine";
    
    private Engine $engine;
    private Person $driver;

}