<?php

namespace Application\Gullkysten\FishiriBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class AbstractFishiriRestController
 * @package Application\Gullkysten\FishiriBundle\Controller
 */
abstract class AbstractFishiriRestController extends FOSRestController
{
    /**
     * @param $includeProperties
     * @return \FOS\RestBundle\View\View
     */
    protected function createViewWithSerializationContext($includeProperties)
    {
        $view = $this->view();
        $serializerGroups = ['Default'];

        if (!empty($includeProperties)) {
            foreach ($includeProperties as $property) {
                $serializerGroups[] = 'incl'.ucfirst($property);
            }
        }
        $view->setSerializationContext(SerializationContext::create()->setGroups($serializerGroups));

        return $view;
    }

    /**
     * @param $documentId
     * @param $documentName
     * @param string $bundleName
     * @return mixed
     */
    protected function verifyDocumentExists($documentId, $documentName, $bundleName = 'ApplicationGullkystenFishiriBundle')
    {
        $document = $this->get('doctrine_mongodb')
            ->getRepository($bundleName.':'.$documentName)
            ->find($documentId);

        if (empty($document)) {
            throw $this->createNotFoundException('No '.$documentName.' found for id '.$documentId);
        }

        return $document;
    }

    /**
     * @param HttpException $exception
     * @return Response
     */
    protected function respondWithException(HttpException $exception)
    {
        $httpStatus =  $exception->getStatusCode();
        return new Response(
            json_encode(
                [
                    'error' => [
                        'code' => $httpStatus,
                        'message' => $exception->getMessage()
                    ]
                ],
                true
            ),
            $httpStatus
        );
    }
}
