<?php

namespace Train\Exceptions;

class TrainAllowanceExceededException extends \Exception {
    protected $message = "Train allowance exceeded, cant add car to a full train.";
}
