<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 19.08.13
 * Time: 13:48
  */

namespace Itfrogs\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="lnd_listGroups")
 */

class ListGroup {

    /**
     * @ORM\OneToMany(targetEntity="Lst", mappedBy="listGroup", cascade={"all"})
     */
    protected $lists;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $template;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lists = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     * @return ListGroup
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ListGroup
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set template
     *
     * @param string $template
     * @return ListGroup
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    
        return $this;
    }

    /**
     * Get template
     *
     * @return string 
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Add lists
     *
     * @param \Itfrogs\SiteBundle\Entity\Lst $lists
     * @return ListGroup
     */
    public function addList(\Itfrogs\SiteBundle\Entity\Lst $lists)
    {
        $this->lists[] = $lists;
    
        return $this;
    }

    /**
     * Remove lists
     *
     * @param \Itfrogs\SiteBundle\Entity\Lst $lists
     */
    public function removeList(\Itfrogs\SiteBundle\Entity\Lst $lists)
    {
        $this->lists->removeElement($lists);
    }

    /**
     * Get lists
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLists()
    {
        return $this->lists;
    }
}