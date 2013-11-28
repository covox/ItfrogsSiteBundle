<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 15.10.13
 * Time: 1:53
  */

namespace Itfrogs\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="lnd_dictGroups")
 */

class DictionaryGroup {

    /**
     * @ORM\OneToMany(targetEntity="Dictionary", mappedBy="dictGroup", cascade={"all"})
     */
    protected $dictionaries;

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
        $this->dictionaries = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return DictionaryGroup
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
     * @return DictionaryGroup
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
     * @return DictionaryGroup
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
     * Add dictionaries
     *
     * @param \Itfrogs\SiteBundle\Entity\Dictionary $dictionaries
     * @return DictionaryGroup
     */
    public function addDictionarie(\Itfrogs\SiteBundle\Entity\Dictionary $dictionaries)
    {
        $this->dictionaries[] = $dictionaries;
    
        return $this;
    }

    /**
     * Remove dictionaries
     *
     * @param \Itfrogs\SiteBundle\Entity\Dictionary $dictionaries
     */
    public function removeDictionarie(\Itfrogs\SiteBundle\Entity\Dictionary $dictionaries)
    {
        $this->dictionaries->removeElement($dictionaries);
    }

    /**
     * Get dictionaries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDictionaries()
    {
        return $this->dictionaries;
    }
}