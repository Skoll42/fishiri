<?php

namespace Application\Gullkysten\FishiriBundle\Repository;

/**
 * Interface FishiriRepositoryInterface
 * @package Application\Gullkysten\FishiriBundle\Repository
 */
interface FishiriRepositoryInterface
{
    /**
     * @param $searchParams
     * @param array $sorting
     * @return mixed
     */
    public function findBySearchParams($searchParams, $sorting = []);

    /**
     * @param $field
     * @param $fieldValue
     * @return mixed
     */
    public function findByConnectedField($field, $fieldValue);
}