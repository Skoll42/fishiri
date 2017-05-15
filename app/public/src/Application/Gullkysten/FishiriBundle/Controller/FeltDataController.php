<?php

namespace Application\Gullkysten\FishiriBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FeltDataController
 * @package Application\Gullkysten\FishiriBundle\Controller
 */
class FeltDataController extends AbstractFishiriRestController
{
    /**
     * Returns collection of FeltData objects including related sub-objects.
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
     *     description="Possible fields to search: name. I.E. : search[search]=Mae. Search by other fields: search[location]=location name. Other fields: search[status], search[operator.id]."
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
     *  description="Returns collection of FeltData objects including related sub-objects",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *     },
     *  parameters={
     *         {"name"="search[search]", "dataType"="string", "description"="String to search by. Searches by name", "required"=false},
     *         {"name"="search[status]", "dataType"="string", "description"="Search by felt status", "required"=false},
     *         {"name"="search[location]", "dataType"="string", "description"="Search by felt location", "required"=false},
     *         {"name"="search[operatorId]", "dataType"="string", "description"="Search by operator id", "required"=false},
     *         {"name"="names", "dataType"="array", "description"="Search by multiple names", "required"=false}
     *      }
     * )
     * @param ParamFetcher $paramFetcher
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFeltdataAction(ParamFetcher $paramFetcher, Request $request)
    {
        $includeProperties = $paramFetcher->get('include');
        $view = $this->createViewWithSerializationContext($includeProperties);

        $searchParams = [
            'search' => $paramFetcher->get('search'),
            'names' => $paramFetcher->get('names')
        ];
        $feltData = $this->get('doctrine_mongodb')
            ->getRepository('ApplicationGullkystenFishiriBundle:FeltData\FeltData')
            ->findBySearchParams($searchParams, [
                'sortby' => $paramFetcher->get('sortby'),
                'sortdir' => $paramFetcher->get('sortdir')
            ]);

        $paginator  = $this->get('knp_paginator');
        $paginatedFeltData = $paginator->paginate(
            $feltData,
            $request->query->getInt('page', 1),
            $paramFetcher->get('noPaging') == true ? PHP_INT_MAX : $this
                ->container
                ->getParameter('api_list_items_per_page')
        );

        $view->setData($paginatedFeltData);
        return $this->handleView($view);
    }


    /**
     * Returns collection of all FeltData names.
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
    public function getFeltdataNamesAction(Request $request)
    {
        $view = $this->createViewWithSerializationContext([]);

        $doctrine = $this->get('doctrine_mongodb');
        $names = array_values($doctrine
            ->getRepository('ApplicationGullkystenFishiriBundle:FeltData\FeltData')
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
     * Returns collection of FeltData filters.
     * @ApiDoc(
     *  resource=true,
     *  description="Returns collection of FeltData filters",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *     }
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFeltdataFiltersAction(Request $request)
    {
        $view = $this->createViewWithSerializationContext([]);

        $doctrine = $this->get('doctrine_mongodb');
        $feltDataRepo = $doctrine
            ->getRepository('ApplicationGullkystenFishiriBundle:FeltData\FeltData');
        $filters = [
            'location' => array_values($feltDataRepo
                ->createQueryBuilder()
                ->distinct('location')
                ->getQuery()
                ->execute()
                ->toArray()
            ),
            'status' => array_values($feltDataRepo
                ->createQueryBuilder()
                ->distinct('status')
                ->getQuery()
                ->execute()
                ->toArray()
            ),
            'operator' => array_values($doctrine
                ->getRepository('ApplicationGullkystenFishiriBundle:Operator')
                ->createQueryBuilder()
                ->field('id')
                ->in(
                    array_values($feltDataRepo
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
        ];

        $view->setData($filters);
        return $this->handleView($view);
    }

    /**
     * Returns single object of FeltData by given rigId.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Returns single object of FeltData by given rigId.",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *         404="Returned when object of given rigId does not exist"
     *     }
     * )
     * @Get("/feltdata/{feltName}")
     * @param $feltName
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getSingleFeltdataAction($feltName)
    {
        $view = $this->createViewWithSerializationContext([]);
        $feltDataObject = $this->get('doctrine_mongodb')
            ->getRepository('ApplicationGullkystenFishiriBundle:FeltData\FeltData')
            ->findOneBy(['name' => $feltName]);
        $view->setData(['feltData' => $feltDataObject]);

        return $this->handleView($view);
    }
}
