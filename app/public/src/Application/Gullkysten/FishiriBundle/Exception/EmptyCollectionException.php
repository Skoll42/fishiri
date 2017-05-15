<?php

namespace Application\Gullkysten\FishiriBundle\Exception;

/**
 * Class EmptyCollectionException
 * @package Application\Gullkysten\FishiriBundle\Exception
 */
class EmptyCollectionException extends \Exception
{
    /**
     * EmptyCollectionException constructor.
     * @param null $collectionName
     */
    public function __construct($collectionName = null)
    {
        if (!empty($collectionName)) {
            $this->message = "JSON '$collectionName' collection is empty";
        } else {
            $this->message = "JSON collection is empty";
        }
    }
}
