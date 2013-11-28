<?php

namespace Itfrogs\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Event\PreFlushEventArgs;
use FOS\UserBundle\Model\GroupableInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Mapping as ORM;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="lnd_users")
 */
class User extends BaseUser
{

    /**
     * @ORM\OneToOne(targetEntity="Media", cascade={"all"})
     * @ORM\JoinColumn(name="avatarId", referencedColumnName="id")
     */
    protected $avatar;

    /**
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="groupId", referencedColumnName="id")
     */
//    protected $groups;



    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $groups;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $avatarId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $openidName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $provider;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $identify;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $adressString;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $lat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $lon;


    protected $captha;

    public function getCaptcha() {
        return $this->captha;
    }

    public function setCaptcha($captha) {
        $this->captha = $captha;
        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = array();
//        $this->groups = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->username;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        //$this->salt = md5(time());
        $this->salt = '';
        $this->locked = false;
        $this->credentialsExpired = false;
        $this->expired = false;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->enabled = true;

        return $this;
    }

    /**
     * @ORM\PreFlush
     */
    public function preFlush()
    {
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }


    /**
     * @ORM\PostLoad
     */
    public function postLoad()
    {
    }



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set avatarId
     *
     * @param integer $avatarId
     * @return User
     */
    public function setAvatarId($avatarId)
    {
        $this->avatarId = $avatarId;
    
        return $this;
    }

    /**
     * Get avatarId
     *
     * @return integer 
     */
    public function getAvatarId()
    {
        return $this->avatarId;
    }

    /**
     * Set openidName
     *
     * @param string $openidName
     * @return User
     */
    public function setOpenidName($openidName)
    {
        $this->openidName = $openidName;
    
        return $this;
    }

    /**
     * Get openidName
     *
     * @return string 
     */
    public function getOpenidName()
    {
        return $this->openidName;
    }

    /**
     * Set provider
     *
     * @param string $provider
     * @return User
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    
        return $this;
    }

    /**
     * Get provider
     *
     * @return string 
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set identify
     *
     * @param string $identify
     * @return User
     */
    public function setIdentify($identify)
    {
        $this->identify = $identify;
    
        return $this;
    }

    /**
     * Get identify
     *
     * @return string 
     */
    public function getIdentify()
    {
        return $this->identify;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set adressString
     *
     * @param string $adressString
     * @return User
     */
    public function setAdressString($adressString)
    {
        $this->adressString = $adressString;
    
        return $this;
    }

    /**
     * Get adressString
     *
     * @return string 
     */
    public function getAdressString()
    {
        return $this->adressString;
    }

    /**
     * Set lat
     *
     * @param float $lat
     * @return User
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    
        return $this;
    }

    /**
     * Get lat
     *
     * @return float 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lon
     *
     * @param float $lon
     * @return User
     */
    public function setLon($lon)
    {
        $this->lon = $lon;
    
        return $this;
    }

    /**
     * Get lon
     *
     * @return float 
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Set avatar
     *
     * @param \Itfrogs\SiteBundle\Entity\Media $avatar
     * @return User
     */
    public function setAvatar(\Itfrogs\SiteBundle\Entity\Media $avatar = null)
    {
        $this->avatar = $avatar;
    
        return $this;
    }

    /**
     * Get avatar
     *
     * @return \Itfrogs\SiteBundle\Entity\Media 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }

}