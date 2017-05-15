<?php

namespace Application\Gullkysten\FishiriBundle\Exception;

/**
 * Class DocumentValidationException
 * @package Application\Gullkysten\FishiriBundle\Exception
 */
class DocumentValidationException extends \Exception
{
    /**
     * DocumentValidationException constructor.
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
}
