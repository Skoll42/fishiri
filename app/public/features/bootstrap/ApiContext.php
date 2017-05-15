<?php

use Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB as DataFixtures;
use Application\Gullkysten\FishiriBundle\DataFixtures\WnttExecutor;
use Application\Gullkysten\FishiriBundle\Exception as Exception;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Codifico\ParameterBagExtension\Context\ParameterBagDictionary;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\MongoDBPurger;
use OAuth2\OAuth2;

class ApiContext extends MinkContext implements Context, SnippetAcceptingContext
{
    use ParameterBagDictionary;
    use KernelDictionary;

    protected $headers = [];

    public function __construct()
    {
    }

    /**
     * @When I load :fixturesName fixtures
     */
    public function loadDataFixtures($fixturesName)
    {
        $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();

        $loader = new Loader();
        $loader->addFixture(new DataFixtures\OperatorFixtures());
        $loader->addFixture(new DataFixtures\OwnerFixtures());

        switch($fixturesName) {
            case 'DockedShips':
                $loader->addFixture(new DataFixtures\DockedShips\LocationFixtures());
                $loader->addFixture(new DataFixtures\DockedShips\ImageFixtures());
                $loader->addFixture(new DataFixtures\DockedShips\DockedShipsFixtures());
                break;
            case 'RiggData':
                $loader->addFixture(new DataFixtures\RiggData\BopAndBopControlDataFixtures());
                $loader->addFixture(new DataFixtures\RiggData\ContractInformationFixtures());
                $loader->addFixture(new DataFixtures\RiggData\DrillingEquipmentFixtures());
                $loader->addFixture(new DataFixtures\RiggData\ImageFixtures());
                $loader->addFixture(new DataFixtures\RiggData\LandingFacilitiesFixtures());
                $loader->addFixture(new DataFixtures\RiggData\LiftingEquipmentFixtures());
                $loader->addFixture(new DataFixtures\RiggData\MudSystemsFixtures());
                $loader->addFixture(new DataFixtures\RiggData\RigInformationFixtures());
                $loader->addFixture(new DataFixtures\RiggData\RigRatingsFixtures());
                $loader->addFixture(new DataFixtures\RiggData\RiserAndRiserTensionerDataFixtures());
                $loader->addFixture(new DataFixtures\RiggData\VesselParticularsContinuedFixtures());
                $loader->addFixture(new DataFixtures\RiggData\VesselParticularsFixtures());
                $loader->addFixture(new DataFixtures\RiggData\RiggDataFixtures());
                break;
            case 'FeltData':
                $loader->addFixture(new DataFixtures\FeltData\ImageFixtures());
                $loader->addFixture(new DataFixtures\FeltData\InvestmentsFixtures());
                $loader->addFixture(new DataFixtures\FeltData\FrameAgreementFixtures());
                $loader->addFixture(new DataFixtures\FeltData\MainDevelopmentFixtures());
                $loader->addFixture(new DataFixtures\FeltData\SubseaDevelopmentFixtures());
                $loader->addFixture(new DataFixtures\FeltData\DrillingWellsFixtures());
                $loader->addFixture(new DataFixtures\FeltData\RemainingReservesFixtures());
                $loader->addFixture(new DataFixtures\FeltData\TotalReservesEstimateFixtures());
                $loader->addFixture(new DataFixtures\FeltData\ExportTechnologyFixtures());
                $loader->addFixture(new DataFixtures\FeltData\DestinationFixtures());
                $loader->addFixture(new DataFixtures\FeltData\HelicopterFixtures());
                $loader->addFixture(new DataFixtures\FeltData\StatisticsFixtures());
                $loader->addFixture(new DataFixtures\FeltData\NpdidFixtures());
                $loader->addFixture(new DataFixtures\FeltData\FeltDataFixtures());
                break;
        }

        $purger = new MongoDBPurger($dm);
        $executor = new WnttExecutor($dm, $purger);
        $executor->execute($loader->getFixtures());
        $createdObjects = $executor->getCreatedObjects();
        $this->setFixturesInParameterBag($createdObjects);
    }

    /**
     * @When I make request :method :uri
     */
    public function iMakeRequest($method, $uri)
    {
        $uri = '/app_dev.php'.$uri;
        $uri = $this->extractFromParameterBag($uri);
        $this->request($method, $uri);
    }

    /**
     * @When I make request :method :uri with params:
     */
    public function iMakeRequestWithParams($method, $uri, TableNode $table)
    {
        $uri = '/app_dev.php'.$uri;
        $uri = $this->extractFromParameterBag($uri);
        $this->request($method, $uri, $table->getRowsHash());
    }

    /**
     * @When I make request :method :uri with parameter-bag params:
     */
    public function iMakeRequestWithParameterBagParams($method, $uri, TableNode $table)
    {
        $uri = '/app_dev.php'.$uri;
        $uri = $this->extractFromParameterBag($uri);
        $params = [];
        foreach($table->getRowsHash() as $field => $value) {
            $params[$field] = $this->getParameterBag()->replace($value);;
        }
        $this->request($method, $uri, $params);
    }

    /**
     * @Given client is created
     */
    public function clientIsCreated()
    {
        $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');

        $client = $clientManager->createClient();
        $client->setName('test-client-name');
        $client->setAllowedGrantTypes([
            OAuth2::GRANT_TYPE_CLIENT_CREDENTIALS,
            OAuth2::GRANT_TYPE_USER_CREDENTIALS
        ]);
        $clientManager->updateClient($client);

        $this->getParameterBag()->set('CLIENT_PUBLIC_ID', $client->getPublicId());
        $this->getParameterBag()->set('CLIENT_SECRET', $client->getSecret());
    }

    /**
     * @Given I am authorized client
     */
    public function iAmAuthorizedClient()
    {
        $this->clientIsCreated();
        $this->request('POST', '/app_dev.php/oauth/v2/token', [
            'client_id' => $this->getParameterBag()->get('CLIENT_PUBLIC_ID'),
            'client_secret' => $this->getParameterBag()->get('CLIENT_SECRET'),
            'response_type' => 'code',
            'grant_type' => 'client_credentials'
        ]);

        $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->findClientByPublicId($this->getParameterBag()->get('CLIENT_PUBLIC_ID'));

        $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();

        $accessToken = $dm->getRepository('SyslaFishiriOAuthBundle:AccessToken')
            ->findOneBy(array('client.id' => $client->getId()));

        $this->getParameterBag()->set('ACCESS_TOKEN', $accessToken->getToken());
        $this->iSetHeaderWithValue('Authorization', 'Bearer ' . $this->getParameterBag()->get('ACCESS_TOKEN'));
    }

    /**
     * @Given I am authorized client with username :login and password :password
     */
    public function iAmAuthorizedClientWithUsernameAndPassword($login, $password)
    {
        $this->clientIsCreated();
        $this->request('POST', '/app_dev.php/oauth/v2/token', [
            'client_id' => $this->getParameterBag()->get('CLIENT_PUBLIC_ID'),
            'client_secret' => $this->getParameterBag()->get('CLIENT_SECRET'),
            'response_type' => 'code',
            'grant_type' => 'password',
            'username' => $login,
            'password' => $password
        ]);

        $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->findClientByPublicId($this->getParameterBag()->get('CLIENT_PUBLIC_ID'));

        $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();

        $accessToken = $dm->getRepository('SyslaFishiriOAuthBundle:AccessToken')
            ->findOneBy(array('client.id' => $client->getId()));

        $this->getParameterBag()->set('ACCESS_TOKEN', $accessToken->getToken());
        $this->iSetHeaderWithValue('Authorization', 'Bearer ' . $this->getParameterBag()->get('ACCESS_TOKEN'));
    }

    /**
     * @Given /^I set header "([^"]*)" with value "([^"]*)"$/
     */
    public function iSetHeaderWithValue($name, $value)
    {
        $this->headers[$name] = $value;
    }

    /**
     * @Then the response should be JSON
     */
    public function theResponseShouldBeJson()
    {
        $response = $this->getClient()->getResponse()->getContent();
        if(json_decode($response) === null) {
            throw new Exception\JsonExpectedException();
        }
    }

    /**
     * @Then the response JSON should be a collection
     */
    public function theResponseJsonShouldBeACollection()
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        if(!is_array($response)) {
            throw new Exception\CollectionExpectedException();
        }
        return;
    }

    /**
     * @Then the response JSON should be a single object
     */
    public function theResponseJsonShouldBeASingleObject()
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        if(!is_object($response)) {
            throw new Exception\SingleObjectExpectedException();
        }
        return;
    }

    /**
     * @Then the repsonse JSON should have :property field
     */
    public function theRepsonseJsonShouldHaveField($property)
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        $this->assertDocumentHasProperty($response, $property);
        return;
    }

    /**
     * @Then the repsonse JSON should have :property field with value :expectedValue
     */
    public function theRepsonseJsonShouldHaveFieldWithValue($property, $expectedValue)
    {
        $expectedValue = $this->extractFromParameterBag($expectedValue);
        $response = json_decode($this->getClient()->getResponse()->getContent());
        $this->assertDocumentHasPropertyWithValue($response, $property, $expectedValue);
        return;
    }

    /**
     * @Then the repsonse JSON should have :property field set to :expectedValue
     */
    public function theRepsonseJsonShouldHaveFieldSetTo($property, $expectedValue)
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        $this->assertDocumentHasPropertyWithBooleanValue($response, $property, $expectedValue);
        return;
    }

    /**
     * @Then all response collection items should have :property field
     */
    public function allResponseCollectionItemsShouldHaveField($property)
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        foreach($response as $document) {
            $this->assertDocumentHasProperty($document, $property);
        }
        return;
    }

    /**
     * @Then all response collection items should have :property field with value :expectedValue
     */
    public function allResponseCollectionItemsShouldHaveFieldWithValue($property, $expectedValue)
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        foreach($response as $document) {
            $this->assertDocumentHasPropertyWithValue($document, $property, $expectedValue);
        }
        return;
    }

    /**
     * @Then all response collection items should have nested field :property with value :expectedValue
     */
    public function allResponseCollectionItemsShouldHaveNestedFieldWithValue($property, $expectedValue)
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        foreach($response as $document) {
            $this->assertDocumentHasNestedPropertyWithValue($document, $property, $expectedValue);
        }
        return;
    }

    /**
     * @Then all response collection items should have :property field set to :expectedBoolean
     */
    public function allResponseCollectionItemsShouldHaveFieldSetTo($property, $expectedBoolean)
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        if(empty($response)) {
            throw new Exception\EmptyCollectionException();
        }
        foreach($response as $document) {
            $this->assertDocumentHasPropertyWithBooleanValue($document, $property, $expectedBoolean);
        }
        return;
    }

    /**
     * @Then the response JSON :fieldName field should be a collection
     */
    public function theResponseJsonFieldShouldBeACollection($fieldName)
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        if(!is_array($response->$fieldName)) {
            throw new Exception\CollectionExpectedException();
        }
        return;
    }

    /**
     * @Then all nested :collectionFieldName collection items should have :nestedFieldName field
     */
    public function allNestedCollectionItemsShouldHaveField($collectionFieldName, $nestedFieldName)
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        if(empty($response->$collectionFieldName)) {
            throw new Exception\EmptyCollectionException($collectionFieldName);
        }
        foreach($response->$collectionFieldName as $document) {
            $this->assertDocumentHasProperty($document, $nestedFieldName);
        }
        return;
    }

    /**
     * @Then all nested :collectionFieldName collection items should have :nestedFieldName field set to :expectedValue
     */
    public function allNestedCollectionItemsShouldHaveFieldSetTo($collectionFieldName, $nestedFieldName, $expectedValue)
    {
        $expectedBoolean = ($expectedValue == 'true' ? true : false);
        $response = json_decode($this->getClient()->getResponse()->getContent());
        if(empty($response->$collectionFieldName)) {
            throw new Exception\EmptyCollectionException($collectionFieldName);
        }
        foreach($response->$collectionFieldName as $document) {
            $this->assertDocumentHasPropertyWithBooleanValue($document, $nestedFieldName, $expectedBoolean);
        }
        return;
    }

    /**
     * @Then all nested :collectionFieldName collection items should have :nestedFieldName field with value :expectedValue
     */
    public function allNestedCollectionItemsShouldHaveFieldWithValue($collectionFieldName, $nestedFieldName, $expectedValue)
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        if(empty($response->$collectionFieldName)) {
            throw new Exception\EmptyCollectionException($collectionFieldName);
        }
        foreach($response->$collectionFieldName as $document) {
            $this->assertDocumentHasPropertyWithValue($document, $nestedFieldName, $expectedValue);
        }
        return;
    }

    /**
     * @Then all nested :collectionFieldName collection items should have nested :nestedFieldName field with value :expectedValue
     */
    public function allNestedCollectionItemsShouldHaveNestedFieldWithValue($collectionFieldName, $nestedFieldName, $expectedValue)
    {
        $response = json_decode($this->getClient()->getResponse()->getContent());
        if(empty($response->$collectionFieldName)) {
            throw new Exception\EmptyCollectionException($collectionFieldName);
        }
        foreach($response->$collectionFieldName as $document) {
            $this->assertDocumentHasNestedPropertyWithValue($document, $nestedFieldName, $expectedValue);
        }
        return;
    }

    protected function request($method, $uri, array $params = array(), array $headers = array())
    {
        $headers = array_merge($headers, $this->headers);
        $server = $this->createServerArray($headers);
        $this->getClient()->request($method, $this->locatePath($uri), $params, array(), $server);
    }

    protected function createServerArray(array $headers = array())
    {
        $server = array();
        $nonPrefixed = array('CONTENT_TYPE');
        foreach ($headers as $name => $value) {
            $headerName = strtoupper(str_replace('-', '_', $name));
            $headerName = in_array($headerName, $nonPrefixed) ? $headerName : 'HTTP_'.$headerName;
            $server[$headerName] = $value;
        }
        return $server;
    }

    protected function getClient()
    {
        $driver = $this->getSession()->getDriver();
        return $driver->getClient();
    }

    protected function extractFromParameterBag($string)
    {
        $string = $this->getParameterBag()->replace($string);
        $string = str_replace(['{', '}'], '', $string);
        return $string;
    }

    protected function assertDocumentHasProperty($document, $property)
    {
        if(!isset($document->$property)) {
            throw new Exception\NotFoundPropertyException($property);
        }
    }

    protected function assertDocumentHasPropertyWithValue($document, $property, $expectedValue)
    {
        $this->assertDocumentHasProperty($document, $property);
        if($document->$property != $expectedValue) {
            throw new Exception\IncorrectPropertyValueException($property, $expectedValue, $document->$property);
        }
    }

    protected function assertDocumentHasNestedPropertyWithValue($document, $property, $expectedValue)
    {
        $nestedNode = explode('->', $property);
        $documentAsArray = (array) $document;
        foreach($nestedNode as $node) {
            if(!isset($documentAsArray[$node])) {
                throw new Exception\NotFoundPropertyException($property);
            }
            $documentAsArray = (array) $documentAsArray[$node];
        }
        $documentAsArray = reset($documentAsArray);
        $expectedValue = $this->extractFromParameterBag($expectedValue);

        if($documentAsArray !== $expectedValue) {
            throw new Exception\IncorrectPropertyValueException($property, $expectedValue, $documentAsArray);
        }
    }

    protected function assertDocumentHasPropertyWithBooleanValue($document, $property, $expectedValue)
    {
        $expectedBoolean = ($expectedValue == 'true' ? true : false);
        $this->assertDocumentHasProperty($document, $property);
        if($document->$property !== $expectedBoolean) {
            throw new Exception\IncorrectPropertyValueException($property, $expectedValue, $document->$property === true ? 'true' : 'false');
        }
    }

    protected function setFixturesInParameterBag($createdObjects)
    {
        foreach($createdObjects as $objectType => $objectIds) {
            $index = 0;
            foreach($objectIds as $objectId) {
                $this->getParameterBag()->set($objectType.'_'.++$index, $objectId);
            }
        }
    }

}
