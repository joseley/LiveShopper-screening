<?php

namespace Train\Exceptions;

class DuplicateCarException extends \Exception {
    protected $message = "Duplicated train car ID, car not added.";
}
