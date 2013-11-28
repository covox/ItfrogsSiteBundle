<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 13.10.13
 * Time: 16:51
  */

namespace Itfrogs\SiteBundle\Helpers;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Itfrogs\PurchasesBundle\Entity\Conversations;
use Doctrine\ORM\EntityManager;


// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class Queries
{
    /**
     * @var EntityManager
     */
    protected $em;
    protected $qb;
    protected  $container;

    /**
     * {@inheritDoc}
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $this->qb = $this->em->createQueryBuilder();
    }

    public function getRandomDictionaryRow($group_id) {
        $amount = 1;

        do {
            $query = $this->em->createQuery('SELECT COUNT(d.id) FROM ItfrogsSiteBundle:Dictionary d');
            $count = $query->getSingleScalarResult();

            $offset = max(0, rand(0, $count - $amount - 1));

            $dictGroup = $this->findOneById($group_id, 'DictionaryGroup');

            $q = $this->qb
                ->add('select', 'd')
                ->add('from', 'ItfrogsSiteBundle:Dictionary d')
                ->where(
                    $this->qb->expr()->andx(
                        $this->qb->expr()->eq('d.active', 1),
                        $this->qb->expr()->eq('d.dictGroup', $group_id)
                    )
                )
                ->setMaxResults($amount)
                ->setFirstResult($offset)
                ->getQuery();


            $results = $q->getResult();

        }
        while (count($results) == 0);

        return $results[0];
    }

    public function findOneBySlug($slug, $entity) {

        $result = $this->em->getRepository
            ('ItfrogsSiteBundle:'.$entity)
            ->findOneBySlug($slug);

        return $result;
    }

    public function findOneByHash($hash, $entity) {

        $result = $this->em->getRepository
            ('ItfrogsSiteBundle:'.$entity)
            ->findOneByHash($hash);

        return $result;
    }

    public function findOneById($id, $entity) {

        $result = $this->em->getRepository
            ('ItfrogsSiteBundle:'.$entity)
            ->findOneById(intval($id));

        return $result;
    }

    public function findOneBy($value, $entity, $name) {

        $finder = "findOneBy".$name;

        $result = $this->em->getRepository
            ('ItfrogsSiteBundle:'.$entity)
            ->$finder($value);

        return $result;
    }

    public function getAll($entity) {

        $result = $this->em->getRepository
            ('ItfrogsSiteBundle:'.$entity)
            ->findAll();

        return $result;
    }

    public function getSetting($value) {

        $result = $this->findOneBy($value, 'Settings', 'Name');

        return $result;
    }


}