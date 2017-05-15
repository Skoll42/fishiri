<?php

namespace Application\Gullkysten\FishiriBundle\Exception;

/**
 * Class DuplicatedDocumentException
 * @package Application\Gullkysten\FishiriBundle\Exception
 */
class DuplicatedDocumentException extends \Exception
{
    /**
     * DuplicatedDocumentException constructor.
     * @param string $documentName
     */
    public function __construct($documentName)
    {
        $this->message = "Document '$documentName' with given data exists yet";
    }
}
