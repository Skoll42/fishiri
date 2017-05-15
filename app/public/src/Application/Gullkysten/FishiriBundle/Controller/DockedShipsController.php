<?php

namespace Application\Gullkysten\FishiriBundle\Controller;

use Application\Gullkysten\FishiriBundle\Document\DockedShips\DockedShips;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Gedmo\Tool\Wrapper\MongoDocumentWrapper;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DockedShipsController
 * @package Application\Gullkysten\FishiriBundle\Controller
 */
class DockedShipsController extends AbstractFishiriRestController
{
    /**
     * Returns collection of DockedShips objects including related sub-objects.
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
     * @QueryParam(name="sortby", nullable=true, default=null, description="Field to sort by.")
     * @QueryParam(name="sortdir", nullable=true, default=null, description="Sorting direction (asc/desc)")
     * @ApiDoc(
     *  resource=true,
     *  description="Returns collection of DockedShips objects including related sub-objects",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *     },
     *  parameters={
     *         {"name"="search[search]", "dataType"="string", "description"="String to search by. Searches by name", "required"=false},
     *         {"name"="search[status]", "dataType"="string", "description"="Search by ship status", "required"=false},
     *         {"name"="search[typeSkip]", "dataType"="string", "description"="Search by ship type", "required"=false},
     *         {"name"="search[ownerId]", "dataType"="string", "description"="Search by owner id", "required"=false}
     *      }
     * )
     * @param ParamFetcher $paramFetcher
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDockedshipsAction(ParamFetcher $paramFetcher, Request $request)
    {
        $includeProperties = $paramFetcher->get('include');
        $view = $this->createViewWithSerializationContext($includeProperties);

        $doctrine = $this->get('doctrine_mongodb');
        $searchParams = $paramFetcher->get('search');
        $dockedShipsRepo = $doctrine
            ->getRepository('ApplicationGullkystenFishiriBundle:DockedShips\DockedShips');
        $dockedShips = $dockedShipsRepo
            ->findBySearchParams($searchParams, [
                'sortby' => $paramFetcher->get('sortby'),
                'sortdir' => $paramFetcher->get('sortdir')
            ]);
        $lastRecord = array_values($dockedShipsRepo
            ->createQueryBuilder()
            ->sort('lastEdited', 'desc')
            ->limit(1)
            ->getQuery()
            ->execute()
            ->toArray()
        )[0];
        $paginator  = $this->get('knp_paginator');
        $paginatedDockedShips = $paginator->paginate(
            $dockedShips,
            $request->query->getInt('page', 1),
            $paramFetcher->get('noPaging') == true ? PHP_INT_MAX : $this
                ->container
                ->getParameter('api_list_items_per_page')
        );
        
        $dockedShipsData = [
            'dockedShips' => $paginatedDockedShips,
            'shipTypesAmount' => $this->getShipTypesAmount($dockedShips),
            'lastUpdated' => $lastRecord->getLastEdited()
        ];
        $view->setData($dockedShipsData);
        return $this->handleView($view);
    }

    /**
     * Returns collection of DockedShips filters.
     * @ApiDoc(
     *  resource=true,
     *  description="Returns collection of DockedShips filters",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *     }
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDockedshipsFiltersAction(Request $request)
    {
        $view = $this->createViewWithSerializationContext([]);

        $doctrine = $this->get('doctrine_mongodb');
        $dockedShipsRepo = $doctrine
            ->getRepository('ApplicationGullkystenFishiriBundle:DockedShips\DockedShips');
        $filters = [
            'types' => array_values($dockedShipsRepo
                ->createQueryBuilder()
                ->distinct('typeSkip')
                ->getQuery()
                ->execute()
                ->toArray()
            ),
            'statuses' => array_values($dockedShipsRepo
                ->createQueryBuilder()
                ->distinct('status')
                ->getQuery()
                ->execute()
                ->toArray()
            ),
            'owners' => array_values($doctrine
                ->getRepository('ApplicationGullkystenFishiriBundle:Owner')
                ->createQueryBuilder()
                ->field('id')
                ->in(
                    array_values($dockedShipsRepo
                        ->createQueryBuilder()
                        ->hydrate(true)
                        ->field('owner')
                        ->prime(true)
                        ->distinct('owner.id')
                        ->getQuery()
                        ->execute()
                        ->toArray()
                    ))
                ->getQuery()
                ->execute()
                ->toArray()
            )
        ];

        $view->setData($filters);
        return $this->handleView($view);
    }

    /**
     * Returns collection of all DockedShips names.
     * @ApiDoc(
     *  resource=true,
     *  description="Returns collection of all DockedShips names",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *     }
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDockedshipsNamesAction(Request $request)
    {
        $view = $this->createViewWithSerializationContext([]);

        $doctrine = $this->get('doctrine_mongodb');
        $names = array_values($doctrine
            ->getRepository('ApplicationGullkystenFishiriBundle:DockedShips\DockedShips')
            ->createQueryBuilder()
            ->distinct('name')
            ->getQuery()
            ->execute()
            ->toArray()
        );

        $view->setData($names);
        return $this->handleView($view);
    }

    /**
     * Returns DockedShips widget data.
     * @ApiDoc(
     *  resource=true,
     *  description="Returns DockedShips widget data",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *     }
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDockedshipsWidgetAction(Request $request)
    {
        $doctrine = $this->get('doctrine_mongodb');
        $view = $this->createViewWithSerializationContext([]);
        $now = new \DateTime();
        $yesterday = $now->modify('-24 hours');

        $dockedShipsRepo = $doctrine
            ->getRepository('ApplicationGullkystenFishiriBundle:DockedShips\DockedShips');
        $dockedShips = array_values($dockedShipsRepo
            ->createQueryBuilder()
            ->field('status')
            ->equals('I opplag')
            ->getQuery()
            ->execute()
            ->toArray()
        );
        $lastRecord = array_values($dockedShipsRepo
            ->createQueryBuilder()
            ->sort('lastEdited', 'desc')
            ->limit(1)
            ->getQuery()
            ->execute()
            ->toArray()
        )[0];

        $latestDockedShipsTypesAmount = $this->getShipTypesAmount($dockedShips);
        $latestDockedShipsTypesAmount['Totalt'] = count($dockedShips);
        $last24DockedShipsTypesAmount = $latestDockedShipsTypesAmount;
        if ($lastRecord->getLastEdited() >= $yesterday)  {
            $historyRepo = $doctrine->getRepository('Gedmo\Loggable\Document\LogEntry');
            $wrapped = new MongoDocumentWrapper(new DockedShips(), $doctrine->getManager());
            $historyRepoQb = $historyRepo->createQueryBuilder();
            $sortedHistoryDockedShips = array_values($historyRepoQb
                ->hydrate(true)
                ->field('objectClass')
                ->equals($wrapped->getMetadata()->name)
                ->field('data.status')
                ->equals('I opplag')
                ->field('loggedAt')
                ->gte($yesterday)
                ->sort([
                    'objectId' => 1,
                    'version' => -1
                ])
                ->getQuery()
                ->execute()
                ->toArray()
            );

            $last24DockedShipsTypesAmount = $this->getDockedShipsTypesAmountOfLatestVersion($sortedHistoryDockedShips);
        }

        $shipTypesWithAmountAndOffset = $this->countShipdataOffset($latestDockedShipsTypesAmount, $last24DockedShipsTypesAmount);

        $view->setData(['widgetData' => $shipTypesWithAmountAndOffset, 'lastUpdated' => $lastRecord->getLastEdited()]);
        return $this->handleView($view);
    }

    /**
     * Returns single object of DockedShips by given ID.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Returns single object of DockedShips by given ID.",
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when client is requesting without or with invalid access_token",
     *         404="Returned when object of given ID does not exist"
     *     }
     * )
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDockedshipAction($id)
    {
        $dockedShip = $this->get('doctrine_mongodb')
            ->getRepository('ApplicationGullkystenFishiriBundle:DockedShips\DockedShips')
            ->findOneById($id);

        $view = $this->view($dockedShip, 200);
        return $this->handleView($view);
    }

    /**
     * @param $dockedShips
     * @return array
     */
    private function getShipTypesAmount($dockedShips){
        $types = [];
        foreach ($dockedShips as $item) {
            $currentShipType = $item->getTypeSkip();
            $arrayType = $currentShipType ? $currentShipType : 'Andre';
            if(empty($types[$arrayType])) {
                $types = array_merge($types, [$arrayType => 1]);
                $types[$arrayType] = 1;
            } else {
                $types[$arrayType]++;
            }
        }
        return $types;
    }

    /**
     * @param $array1
     * @param $array2
     * @return mixed
     */
    private function countShipdataOffset ($array1, $array2)
    {
        if($array1 == $array2) {
            foreach ($array1 as $key => &$value) {
                $value = [$value, 0];
            }
        } else {
            foreach ($array1 as $key => &$value) {
                if(!empty($array2[$key])) {
                    $offset = $array1[$key] - $array2[$key];
                } else {
                    $offset = 0;
                }
                $value = [$value, $offset];
            }
        }
        unset($value);

        return $array1;
    }

    /**
     * @param $dockedShips
     * @return array
     */
    private function getDockedShipsTypesAmountOfLatestVersion($dockedShips) {
        $types = [];
        $foundLatest = [];
        foreach($dockedShips as $dockedShip) {
            $dockedShipData = $dockedShip->getData();
            $historyObjectId = $dockedShip->getObjectId();
            if(empty($foundLatest[$historyObjectId])) {
                $foundLatest[$historyObjectId] = 1;
                $currentShipType = $dockedShipData['typeSkip'];
                $arrayType = $currentShipType ? $currentShipType : 'Andre';
                if(empty($types[$arrayType])) {
                    $types = array_merge($types, [$arrayType => 1]);
                    $types[$arrayType] = 1;
                } else {
                    $types[$arrayType]++;
                }
            }
        }
        $types['Totalt'] = count($foundLatest);
        return $types;
    }
}
