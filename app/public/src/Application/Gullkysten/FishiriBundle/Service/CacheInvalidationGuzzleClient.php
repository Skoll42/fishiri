<?php
namespace Application\Gullkysten\FishiriBundle\Service;

use Guzzle\Http\Client;

/**
 * Class CacheInvalidationGuzzleClient
 * @package Application\Gullkysten\FishiriBundle\Service
 */
class CacheInvalidationGuzzleClient extends Client

{
    public function __construct($baseUrl, $authKey)
    {
        parent::__construct($baseUrl, array(
            'request.options' => array(
                'headers' => array(
                    'X-Cache-Purge-Auth-Key' => $authKey
                )
            )
        ));
    }
}