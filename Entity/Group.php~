<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 26.08.13
 * Time: 19:06
  */

namespace Itfrogs\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Sonata\UserBundle\Entity\BaseGroup as BaseGroup;

/**
 * @ORM\Entity
 * @ORM\Table(name="lnd_groups")
 */
class Group extends BaseGroup
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
}