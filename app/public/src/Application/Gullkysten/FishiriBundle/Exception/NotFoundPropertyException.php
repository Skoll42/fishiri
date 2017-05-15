<?php

namespace Application\Gullkysten\FishiriBundle\Exception;

/**
 * Class NotFoundPropertyException
 * @package Application\Gullkysten\FishiriBundle\Exception
 */
class NotFoundPropertyException extends \Exception
{
    /**
     * NotFoundPropertyException constructor.
     * @param string $propertyName
     */
    public function __construct($propertyName)
    {
        $this->message = "JSON should have property: $propertyName";
    }
}
