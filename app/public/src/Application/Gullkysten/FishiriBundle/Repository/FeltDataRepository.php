<?php

namespace Application\Gullkysten\FishiriBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Class FeltDataRepository
 * @package Application\Gullkysten\FishiriBundle\Repository
 */
class FeltDataRepository extends DocumentRepository implements FishiriRepositoryInterface
{
    /**
     * @param $searchParams
     * @param array $sorting
     * @return mixed
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function findBySearchParams($searchParams, $sorting = [])
    {

        $namesSearch = $searchParams['names'];
        $searchParams = $searchParams['search'];
        $qb = $this->createQueryBuilder();

        $qb->hydrate(true)
            ->field('operator')
            ->prime(true)
            ->field('gallery')
            ->prime(true);

        if (!empty($namesSearch)) {
            $qb->field('name')->in($namesSearch);
        } else {
            $search = !empty($searchParams['search']) ? $searchParams['search'] : '';
            $qb->field('name')->equals(new \MongoRegex('/.*'.strtolower($search).'.*/i'));
        }
        
        if (!empty($searchParams['status'])) {
            $qb->addAnd(
                $qb->expr()->field('status')->equals($searchParams['status'])
            );
        }

        if (!empty($searchParams['location'])) {
            $qb->addAnd(
                $qb->expr()->field('location')->equals($searchParams['location'])
            );
        }

        if (!empty($searchParams['operatorId'])) {
            $qb->addAnd(
                $qb->expr()->field('operator.id')->equals($searchParams['operatorId'])
            );
        }

        if (!empty($sorting['sortby'])) {
            $sortBy = empty($sorting['sortby']) ? 'name' : $sorting['sortby'];
            $sortDir = empty($sorting['sortdir']) ? 'asc' : $sorting['sortdir'];
            $qb->sort($sortBy, $sortDir);
        }

        return $qb->getQuery()->execute()->toArray();
    }

    /**
     * @param $field
     * @param $fieldValue
     * @return mixed
     */
    public function findByConnectedField($field, $fieldValue)
    {
        // TODO: Implement findByConnectedField() method.
    }
}