<?php

namespace Application\Gullkysten\FishiriBundle\Exception;

/**
 * Class JsonExpectedException
 * @package Application\Gullkysten\FishiriBundle\Exception
 */
class JsonExpectedException extends \Exception
{
    /**
     * JsonExpectedException constructor.
     */
    public function __construct()
    {
        $this->message = 'Expected response with type JSON';
    }
}
