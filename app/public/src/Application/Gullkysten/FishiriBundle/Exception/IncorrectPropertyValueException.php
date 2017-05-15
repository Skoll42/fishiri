<?php

namespace Application\Gullkysten\FishiriBundle\Exception;

/**
 * Class IncorrectPropertyValueException
 * @package Application\Gullkysten\FishiriBundle\Exception
 */
class IncorrectPropertyValueException extends \Exception
{
    /**
     * IncorrectPropertyValueException constructor.
     * @param string $propertyName
     * @param int $propertyExpectedValue
     * @param \Exception $propertyActualValue
     */
    public function __construct($propertyName, $propertyExpectedValue, $propertyActualValue)
    {
        $this->message = "JSON '$propertyName' property should have value: '
            $propertyExpectedValue', actual: '$propertyActualValue'";
    }
}
