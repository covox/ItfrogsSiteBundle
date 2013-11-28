<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 13.10.13
 * Time: 15:26
  */

namespace Itfrogs\SiteBundle\Admin\Model;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

use Knp\Menu\ItemInterface as MenuItemInterface;

class DictionariesAdmin extends Admin
{
//    protected $maxPerPage = 2500;
//    protected $maxPageLinks = 2500;

    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by'    => 'id'
    );

/*    public function createQuery($context = 'list')
    {
        $em = $this->modelManager->getEntityManager('Itfrogs\SiteBundle\Entity\Dictionary');

        $queryBuilder = $em
            ->createQueryBuilder('d')
            ->select('d')
            ->from('ItfrogsSiteBundle:Dictionary', 'd')
//            ->where('l.lvl > 0')
            ->orderBy('d.id', 'ASC');

        $query = new ProxyQuery($queryBuilder);
        return $query;
    } */


    /**
     * Конфигурация отображения записи
     *
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $subject = $this->getSubject();
        $id = $subject->getId();

        $showMapper
            ->add('id', null, array('label' => 'Идентификатор'))
            ->add('dictGroup', null, array('label' => 'Группа'
            , 'required'=>true
            , 'query_builder' => function($er) use ($id) {
                    $qb = $er->createQueryBuilder('g');
                    if ($id){
                        $qb
                            ->where('g.id <> :id')
                            ->setParameter('id', $id);
                    }
                    $qb
                        ->orderBy('g.id', 'ASC');
                    return $qb;
                }
            ))
            ->add('source', null, array('label' => 'На калмыцком'))
            ->add('translate', null, array('label' => 'На русском'))
            ->add('description', null, array('label' => 'Описание', 'required'=>false))
            ->add('active', null, array('label' => 'Подтверждено', 'required'=>false));

    }

    /**
     * Конфигурация формы редактирования записи
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();
        $id = $subject->getId();

        $formMapper
            ->add('dictGroup', null, array('label' => 'Группа'
            , 'required'=>true
            , 'query_builder' => function($er) use ($id) {
                    $qb = $er->createQueryBuilder('g');
                    if ($id){
                        $qb
                            ->where('g.id <> :id')
                            ->setParameter('id', $id);
                    }
                    $qb
                        ->orderBy('g.id', 'ASC');
                    return $qb;
                }
            ))
            ->add('source', null, array('label' => 'Источник'))
            ->add('translate', null, array('label' => 'Перевод'))
            ->add('description', null, array('label' => 'Описание', 'required'=>false))
            ->add('active', null, array('label' => 'Подтверждено', 'required'=>false));
    }

    /**
     * Конфигурация списка записей
     *
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('dictGroup', null, array('label' => 'Группа'))
            ->add('source', null, array('label' => 'Источник'))
            ->add('translate', null, array('label' => 'Перевод'))
            ->add('description', null, array('label' => 'Описание', 'required'=>false))
            ->add('active', null, array('label' => 'Подтверждено', 'required'=>false));
    }

    /**
     * Поля, по которым производится поиск в списке записей
     *
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('dictGroup', null, array('label' => 'Группа'))
            ->add('source', null, array('label' => 'Источник'))
            ->add('translate', null, array('label' => 'Перевод'))
            ->add('description', null, array('label' => 'Описание', 'required'=>false))
            ->add('active', null, array('label' => 'Подтверждено', 'required'=>false));

    }

    /**
     * Конфигурация левого меню при отображении и редатировании записи
     *
     * @param \Knp\Menu\ItemInterface $menu
     * @param $action
     * @param null|\Sonata\AdminBundle\Admin\Admin $childAdmin
     *
     * @return void
     */
    /*    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
        {
            if ($this->getRequest()->get('id') > 0) {
                $menu->addChild(
                    $action == 'edit' ? 'Просмотр страницы' : 'Редактирование страницы',
                    array('uri' => $this->generateUrl(
                        $action == 'edit' ? 'show' : 'edit', array('id' => $this->getRequest()->get('id'))))
                );
            }

        } */
}