<?php

namespace Train\Exceptions;

class TrainEmptyException extends \Exception {
    protected $message = "No train cars in queue, cant remove from empty train.";
}
