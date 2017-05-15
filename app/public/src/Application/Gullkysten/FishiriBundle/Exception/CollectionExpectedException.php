<?php

namespace Application\Gullkysten\FishiriBundle\Exception;

/**
 * Class CollectionExpectedException
 * @package Application\Gullkysten\FishiriBundle\Exception
 */
class CollectionExpectedException extends \Exception
{
    /**
     * CollectionExpectedException constructor.
     */
    public function __construct()
    {
        $this->message = 'Expected response JSON with collection';
    }
}
