<?php

namespace Application\Sonata\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use FOS\UserBundle\Document\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;
use JMS\Serializer\Annotation as Serializer;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\SoftDeleteable;

/**
 * @MongoDB\Document(collection="users")
 * @MongoDBUnique(fields="username")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class User extends BaseUser implements UserInterface, SoftDeleteable
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_ADMIN_DOCKEDSHIPS = 'ROLE_ADMIN_DOCKEDSHIPS';
    const ROLE_ADMIN_FELTDATA = 'ROLE_ADMIN_FELTDATA';
    const ROLE_ADMIN_RIGGDATA = 'ROLE_ADMIN_RIGGDATA';

    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Serializer\Expose
     */
    protected $username;

    /**
     * @MongoDB\String
     */
    protected $defaultPassword;

    /**
     * @MongoDB\String
     */
    protected $fullName;
    
    /**
     * @MongoDB\Boolean
     */
    protected $isDefaultPassword;

    /**
     * @MongoDB\Date(nullable="true")
     */
    protected $deletedAt;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setIsDefaultPassword(false);
        $this->setEnabled(true);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getDefaultPassword()
    {
        return $this->defaultPassword;
    }

    /**
     * @param string $defaultPassword
     */
    public function setDefaultPassword($defaultPassword)
    {
        $this->defaultPassword = $defaultPassword;
    }

    /**
     * @return boolean
     */
    public function getIsDefaultPassword()
    {
        return $this->isDefaultPassword;
    }

    /**
     * @param boolean $isDefaultPassword
     */
    public function setIsDefaultPassword($isDefaultPassword)
    {
        $this->isDefaultPassword = $isDefaultPassword;
    }

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        $classCanonicalName = explode('\\', get_class($this));
        return end($classCanonicalName);
    }

    /**
     * @return bool
     */
    public function hasAdminRights()
    {
        return $this->hasRole(static::ROLE_SUPER_ADMIN) || $this->hasRole(static::ROLE_ADMIN);
    }
}
