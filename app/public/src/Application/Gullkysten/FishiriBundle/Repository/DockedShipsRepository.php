<?php

namespace Application\Gullkysten\FishiriBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Class DockedShipsRepository
 * @package Application\Gullkysten\FishiriBundle\Repository
 */
class DockedShipsRepository extends DocumentRepository
{
    /**
     * @param $searchParams
     * @param array $sorting
     * @return mixed
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function findBySearchParams($searchParams, $sorting = [])
    {
        $qb = $this->createQueryBuilder();

        $qb->hydrate(true)
            ->field('owner')
            ->prime(true)
            ->field('media')
            ->prime(true);

        $search = !empty($searchParams['search']) ? $searchParams['search'] : '';
        $qb->field('name')->equals(new \MongoRegex('/.*'.strtolower($search).'.*/i'));

        if (!empty($searchParams['status'])) {
            $qb->addAnd(
                $qb->expr()->field('status')->equals($searchParams['status'])
            );
        }

        if (!empty($searchParams['typeSkip'])) {
            $qb->addAnd(
                $qb->expr()->field('typeSkip')->equals($searchParams['typeSkip'])
            );
        }

        if (!empty($searchParams['ownerId'])) {
            $qb->addAnd(
                $qb->expr()->field('owner.id')->equals($searchParams['ownerId'])
            );
        }

        if (!empty($sorting['sortby'])) {
            $sortBy = empty($sorting['sortby']) ? 'name' : $sorting['sortby'];
            $sortDir = empty($sorting['sortdir']) ? 'asc' : $sorting['sortdir'];
            $qb->sort($sortBy, $sortDir);
        }

        return $qb->getQuery()->execute()->toArray();
    }
}