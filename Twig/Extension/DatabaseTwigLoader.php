<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 20.08.13
 * Time: 21:49
 */

namespace Itfrogs\SiteBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;
use CG\Core\ClassUtils;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DatabaseTwigLoader implements \Twig_LoaderInterface
{
    protected $container;
    protected $em;
    public $enlity;
    public $column;

    /*
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container, $entity, $column)
    {
        $this->container = $container;
        $this->enlity = $entity;
        $this->column = $column;
        $this->em = $this->container->get('doctrine.orm.entity_manager');
    }

    public function getSource($name)
    {
        if (false === $source = $this->getValue('source', $name)) {
            throw new Twig_Error_Loader(sprintf('Template "%s" does not exist.', $name));
        }

        return $source;
    }

    // Twig_ExistsLoaderInterface as of Twig 1.11
    public function exists($name)
    {
        return $name === $this->getValue('name', $name);
    }

    public function getCacheKey($name)
    {
        return $name;
    }

    public function isFresh($name, $time)
    {
        if (false === $lastModified = $this->getValue('last_modified', $name)) {
            return false;
        }

        return $lastModified <= $time;
    }

    protected function getValue($column, $name)
    {
//        $sth = $this->dbh->prepare('SELECT '.$column.' FROM templates WHERE name = :name');
//        $sth->execute(array(':name' => (string) $name));
//        return $sth->fetchColumn();

//        $metod = "findOneBy".$this->column;
//        $getter = "get".$this->column;

        $result = $this->em
            ->getRepository ('ItfrogsSiteBundle:'.$this->enlity)->
            findOneBy(
                array(strtolower($this->column) => $name,)
            );

//        var_dump($result);
//        exit;

        return $result->getTemplate();
    }
}