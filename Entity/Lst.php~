<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 19.08.13
 * Time: 13:47
  */

namespace Itfrogs\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="lnd_lists")
 * use repository for handy tree functions
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */

class Lst {

    /**
     * @ORM\ManyToOne(targetEntity="ListGroup", inversedBy="lists")
     * @ORM\JoinColumn(name="listGroupId", referencedColumnName="id")
     */
    protected $listGroup;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $href;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="integer")
     */
    protected $listGroupId;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Lst", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Lst", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;


    public function __toString()
    {
        $prefix = "";
        for ($i=2; $i<= $this->lvl; $i++){
            $prefix .= "|—";
        }
        return $prefix . $this->title;
    }

    public function getLaveledTitle()
    {
        return (string)$this;
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
     * Set title
     *
     * @param string $title
     * @return Lst
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set href
     *
     * @param string $href
     * @return Lst
     */
    public function setHref($href)
    {
        $this->href = $href;
    
        return $this;
    }

    /**
     * Get href
     *
     * @return string 
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Lst
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set listGroupId
     *
     * @param integer $listGroupId
     * @return Lst
     */
    public function setListGroupId($listGroupId)
    {
        $this->listGroupId = $listGroupId;
    
        return $this;
    }

    /**
     * Get listGroupId
     *
     * @return integer 
     */
    public function getListGroupId()
    {
        return $this->listGroupId;
    }

    /**
     * Set listGroup
     *
     * @param \Itfrogs\SiteBundle\Entity\ListGroup $listGroup
     * @return Lst
     */
    public function setListGroup(\Itfrogs\SiteBundle\Entity\ListGroup $listGroup = null)
    {
        $this->listGroup = $listGroup;
    
        return $this;
    }

    /**
     * Get listGroup
     *
     * @return \Itfrogs\SiteBundle\Entity\ListGroup 
     */
    public function getListGroup()
    {
        return $this->listGroup;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set lft
     *
     * @param integer $lft
     * @return Lst
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
    
        return $this;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Lst
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
    
        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Lst
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
    
        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer 
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Lst
     */
    public function setRoot($root)
    {
        $this->root = $root;
    
        return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set parent
     *
     * @param \Itfrogs\SiteBundle\Entity\Lst $parent
     * @return Lst
     */
    public function setParent(\Itfrogs\SiteBundle\Entity\Lst $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Itfrogs\SiteBundle\Entity\Lst 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Itfrogs\SiteBundle\Entity\Lst $children
     * @return Lst
     */
    public function addChildren(\Itfrogs\SiteBundle\Entity\Lst $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Itfrogs\SiteBundle\Entity\Lst $children
     */
    public function removeChildren(\Itfrogs\SiteBundle\Entity\Lst $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }
}