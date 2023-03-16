<?php

namespace Train;

include __DIR__ . "/src/Train.php";
include __DIR__ . "/src/TrainCars/TrainCar.php";
include __DIR__ . "/src/TrainCars/EngineCar.php";
include __DIR__ . "/src/TrainCars/CargoCar.php";
include __DIR__ . "/src/TrainCars/PassengerCar.php";
include __DIR__ . "/src/Exceptions/DuplicateCarException.php";
include __DIR__ . "/src/Exceptions/TrainAllowanceExceededException.php";
include __DIR__ . "/src/Exceptions/TrainEmptyException.php";

use Train\TrainCars;

$train = new Train;
$train->setMaxCarAllowance(4); // changing max allowance for testing porposes.

echo "---- INITIAL STATE ----" . PHP_EOL;
echo $train;

// ADDING CARS
echo "---- CREATING CARS ----" . PHP_EOL;
$engine = new TrainCars\EngineCar("main");
$cargo1 = new TrainCars\CargoCar("C1");
$cargo2 = new TrainCars\CargoCar("C2");
$passenger1 = new TrainCars\PassengerCar("P1");
$passenger2 = new TrainCars\PassengerCar("P2");

echo "---- ADDING CARS TO TRAIN ----" . PHP_EOL;
$train->addCar($engine->setWeight(2000));
$train->addCar($cargo1->setWeight(500));
$train->addCar($cargo2->setWeight(600));
$train->addCar($passenger1->setWeight(5000));
echo $train; // Total cars and total weight is implicit in the object output.

echo "---- TOTAL WEIGHT CHECK ----" . PHP_EOL;
$train->fixTotalWeight();
echo $train; // Total cars and total weight is implicit in the object output.

echo "---- EXCEEDING CAR LIMIT ----" . PHP_EOL;
$train->addCar($passenger2);

echo "---- REMOVING ONE SINGLE CAR (DEFAULT) ----" . PHP_EOL;
$train->removeCar();
echo $train;

echo "---- DUPLICATING ENTRY ----" . PHP_EOL;
$train->addCar($cargo1);

echo "---- REMOVING ONE SINGLE CAR (FRONT) ----" . PHP_EOL;
$train->removeCar(Train::POSITION_FRONT);
echo $train;

echo "---- REMOVING ONE SINGLE CAR (BACK) ----" . PHP_EOL;
$train->removeCar(Train::POSITION_BACK);
echo $train;

echo "---- REMOVING FROM EMPTY TRAIN ----" . PHP_EOL;
$train->removeCar(Train::POSITION_BACK);
$train->removeCar(Train::POSITION_BACK);
echo $train;
