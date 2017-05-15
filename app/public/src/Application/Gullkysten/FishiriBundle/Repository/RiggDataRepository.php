<?php

namespace Application\Gullkysten\FishiriBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Class RiggDataRepository
 * @package Application\Gullkysten\FishiriBundle\Repository
 */
class RiggDataRepository extends DocumentRepository implements FishiriRepositoryInterface
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
            ->field('owner')
            ->prime(true)
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

        if (!empty($searchParams['type'])) {
            $qb->addAnd(
                $qb->expr()->field('type')->equals($searchParams['type'])
            );
        }

        if (!empty($searchParams['sector'])) {
            $qb->addAnd(
                $qb->expr()->field('sector')->equals($searchParams['sector'])
            );
        }

        if (!empty($searchParams['ownerId'])) {
            $qb->addAnd(
                $qb->expr()->field('owner.id')->equals($searchParams['ownerId'])
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
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function findByConnectedField($field, $fieldValue) {
        $qb = $this->createQueryBuilder();
        $qb->hydrate(false);
        $qb ->select('name', 'rigId')
            ->field($field)
            ->equals($fieldValue);
        return $qb->getQuery()->execute()->toArray();
    }
}