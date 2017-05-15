<?php

namespace Application\Gullkysten\FishiriBundle\Controller;

use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RiggDataController
 * @package Application\Gullkysten\FishiriBundle\Controller
 */
class RiggDataController extends AbstractFishiriRestController
{
    /**
     * Returns collection of RiggData objects including related sub-objects.
     * @QueryParam(
     *     name="rigId",
     *     nullable=true,
     *     default=null,
     *     description="Used to get single riggdata"
     * )
     * @QueryParam(
     *     name="include",
     *     nullable=true,
     *     default=null,
     *     array=true,
     *     description="Which connected entities to include. (i.e. include[] = riggDatas)"
     * )
     * @QueryParam(
     *     name="noPaging",
     *     nullable=true,
     *     default=false,
     *     description="set to true if you want to retrieve all records without paging"
     * )
     * @QueryParam(
     *     name="search",
     *     nullable=true,
     *     default=null,
     *     array=true,
     *     description="Possible fields to search: name. I.E. : search[search]=Mae."
     * )
     * @QueryParam(
     *     name="names",
     *     nullable=true,
     *     default=null,
     *     array=true,
     *     description="Possible fields to search: name."
     * )
     * @QueryParam(name="sortby", nullable=true, default=null, description="Field to sort by.")
     * @QueryParam(name="sortdir", nullable=true, default=null, description="Sorting direction (asc/desc)")
     * @ApiDoc(
     *  resource=true,
     *  description="Returns collection of RiggData objects including related sub-objects",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *     },
     *  parameters={
     *         {"name"="search[search]", "dataType"="string", "description"="String to search by. Searches by name", "required"=false},
     *         {"name"="search[status]", "dataType"="string", "description"="Search by rigg status", "required"=false},
     *         {"name"="search[sector]", "dataType"="string", "description"="Search by rigg sector", "required"=false},
     *         {"name"="search[type]", "dataType"="string", "description"="Search by rigg type", "required"=false},
     *         {"name"="search[ownerId]", "dataType"="string", "description"="Search by owner id", "required"=false},
     *         {"name"="search[operatorId]", "dataType"="string", "description"="Search by operator id", "required"=false},
     *         {"name"="names", "dataType"="array", "description"="Search by multiple names", "required"=false}
     *      }
     * )
     * @param ParamFetcher $paramFetcher
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getRiggdataAction(ParamFetcher $paramFetcher, Request $request)
    {
        $includeProperties = $paramFetcher->get('include');
        $view = $this->createViewWithSerializationContext($includeProperties);
        $searchParams = [
            'search' => $paramFetcher->get('search'),
            'names' => $paramFetcher->get('names')
        ];
        $riggData = $this->get('doctrine_mongodb')
            ->getRepository('ApplicationGullkystenFishiriBundle:RiggData\RiggData')
            ->findBySearchParams($searchParams, [
                'sortby' => $paramFetcher->get('sortby'),
                'sortdir' => $paramFetcher->get('sortdir')
            ]);

        $paginator = $this->get('knp_paginator');

        $riggData = $paginator->paginate(
            $riggData,
            $request->query->getInt('page', 1),
            $paramFetcher->get('noPaging') == true ? PHP_INT_MAX : $this
                ->container
                ->getParameter('api_list_items_per_page')
        );
        $view->setData($riggData);
        return $this->handleView($view);
    }

    /**
     * Returns collection of all RiggData names.
     * @ApiDoc(
     *  resource=true,
     *  description="Returns collection of all RiggData names",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *     }
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getRiggdataNamesAction(Request $request)
    {
        $view = $this->createViewWithSerializationContext([]);

        $doctrine = $this->get('doctrine_mongodb');
        $names = array_values($doctrine
            ->getRepository('ApplicationGullkystenFishiriBundle:RiggData\RiggData')
            ->createQueryBuilder()
            ->distinct('name')
            ->getQuery()
            ->execute()
            ->toArray()
        );

        $view->setData(array_combine($names, $names));
        return $this->handleView($view);
    }

    /**
     * Returns collection of RiggData filters.
     * @ApiDoc(
     *  resource=true,
     *  description="Returns collection of RiggData filters",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *     }
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getRiggdataFiltersAction(Request $request)
    {
        $view = $this->createViewWithSerializationContext([]);

        $doctrine = $this->get('doctrine_mongodb');
        $riggDataRepo = $doctrine
            ->getRepository('ApplicationGullkystenFishiriBundle:RiggData\RiggData');
        $filters = [
            'type' => array_values($riggDataRepo
                ->createQueryBuilder()
                ->distinct('type')
                ->getQuery()
                ->execute()
                ->toArray()
            ),
            'status' => array_values($doctrine
                ->getRepository('ApplicationGullkystenFishiriBundle:RiggData\ContractInformation')
                ->createQueryBuilder()
                ->distinct('status')
                ->getQuery()
                ->execute()
                ->toArray()
            ),
            'owner' => array_values($doctrine
                ->getRepository('ApplicationGullkystenFishiriBundle:Owner')
                ->createQueryBuilder()
                ->field('id')
                ->in(
                    array_values($riggDataRepo
                        ->createQueryBuilder()
                        ->hydrate(true)
                        ->field('owner')
                        ->prime(true)
                        ->distinct('owner.id')
                        ->getQuery()
                        ->execute()
                        ->toArray()
                    ))
                ->distinct('name')
                ->getQuery()
                ->execute()
                ->toArray()
            ),
            'operator' => array_values($doctrine
                ->getRepository('ApplicationGullkystenFishiriBundle:Operator')
                ->createQueryBuilder()
                ->field('id')
                ->in(
                    array_values($riggDataRepo
                        ->createQueryBuilder()
                        ->hydrate(true)
                        ->field('operator')
                        ->prime(true)
                        ->distinct('operator.id')
                        ->getQuery()
                        ->execute()
                        ->toArray()
                    ))
                ->distinct('name')
                ->getQuery()
                ->execute()
                ->toArray()
            ),
            'sector' => array_values($doctrine
                ->getRepository('ApplicationGullkystenFishiriBundle:RiggData\ContractInformation')
                ->createQueryBuilder()
                ->distinct('sector')
                ->getQuery()
                ->execute()
                ->toArray()
            )
        ];

        $view->setData($filters);
        return $this->handleView($view);
    }

    /**
     * @param $riggData
     * @return array
     */
    private function getConnectedRigs($riggData)
    {
        $byOwner = $riggData->getOwner() ? $this->get('doctrine_mongodb')
            ->getRepository('ApplicationGullkystenFishiriBundle:RiggData\RiggData')
            ->findByConnectedField('owner.id', $riggData->getOwner()->getId()) : [];
        $byOperator = $riggData->getOperator() ? $this->get('doctrine_mongodb')
            ->getRepository('ApplicationGullkystenFishiriBundle:RiggData\RiggData')
            ->findByConnectedField('operator.id', $riggData->getOperator()->getId()) : [];
        return [
            'byOwner' => [
                'count' => count($byOwner),
                'items' => $byOwner
            ],
            'byOperator' => [
                'count' => count($byOperator),
                'items' => $byOperator
            ]
        ];
    }

    /**
     * Returns single object of RiggData by given rigId.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Returns single object of RiggData by given rigId.",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *         404="Returned when object of given rigId does not exist"
     *     }
     * )
     * @Get("/riggdata/{rigId}")
     * @param $rigId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getSingleRiggdataAction($rigId)
    {
        $view = $this->createViewWithSerializationContext([]);
        $riggDataObject = $this->get('doctrine_mongodb')
            ->getRepository('ApplicationGullkystenFishiriBundle:RiggData\RiggData')
            ->findOneBy(['rigId' => (int)$rigId]);
        $view->setData([
            'riggData' => $riggDataObject,
            'connectedRigs' => $this->getConnectedRigs($riggDataObject)
        ]);

        return $this->handleView($view);
    }
}
