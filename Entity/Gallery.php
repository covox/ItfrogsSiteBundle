<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Itfrogs\SiteBundle\Entity;

use Sonata\MediaBundle\Entity\BaseGallery as BaseGallery;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="lnd_gallery")
 */
class Gallery extends BaseGallery
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $galleryHasMedias;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->galleryHasMedias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Add galleryHasMedias
     *
     * @param \Itfrogs\SiteBundle\Entity\GalleryHasMedia $galleryHasMedias
     * @return Gallery
     */
    public function addGalleryHasMedia(\Itfrogs\SiteBundle\Entity\GalleryHasMedia $galleryHasMedias)
    {
        $this->galleryHasMedias[] = $galleryHasMedias;
    
        return $this;
    }

    /**
     * Remove galleryHasMedias
     *
     * @param \Itfrogs\SiteBundle\Entity\GalleryHasMedia $galleryHasMedias
     */
    public function removeGalleryHasMedia(\Itfrogs\SiteBundle\Entity\GalleryHasMedia $galleryHasMedias)
    {
        $this->galleryHasMedias->removeElement($galleryHasMedias);
    }

    /**
     * Get galleryHasMedias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGalleryHasMedias()
    {
        return $this->galleryHasMedias;
    }
}