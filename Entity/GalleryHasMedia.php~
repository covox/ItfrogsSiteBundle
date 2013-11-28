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

use Sonata\MediaBundle\Entity\BaseGalleryHasMedia as BaseGalleryHasMedia;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="lnd_gallerymedia")
 */
class GalleryHasMedia extends BaseGalleryHasMedia
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
     * @var \Itfrogs\SiteBundle\Entity\Gallery
     */
    protected  $gallery;

    /**
     * @var \Itfrogs\SiteBundle\Entity\Media
     */
    protected  $media;


    /**
     * Get gallery
     *
     * @return \Itfrogs\SiteBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Get media
     *
     * @return \Itfrogs\SiteBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }


}