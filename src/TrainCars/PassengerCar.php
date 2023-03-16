<?php

namespace Train\TrainCars;

class PassengerCar extends TrainCar {
    
    const MAX_CAPASITY_LB = 10000;
    const PASSENGER_MAX_CAPACITY = 40;
    
    protected string $carType = "Passenger";
    private $passengers = [];
    private $totalPassengers = 0;

}
