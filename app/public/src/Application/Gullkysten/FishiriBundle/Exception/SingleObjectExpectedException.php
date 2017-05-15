<?php

namespace Application\Gullkysten\FishiriBundle\Exception;

/**
 * Class SingleObjectExpectedException
 * @package Application\Gullkysten\FishiriBundle\Exception
 */
class SingleObjectExpectedException extends \Exception
{
    /**
     * SingleObjectExpectedException constructor.
     */
    public function __construct()
    {
        $this->message = 'Expected response JSON with single object';
    }
}
