<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 19.08.13
 * Time: 14:01
  */

namespace Itfrogs\SiteBundle\Admin\Model;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

use Knp\Menu\ItemInterface as MenuItemInterface;

class ListsAdmin extends Admin
{

    protected $maxPerPage = 2500;
    protected $maxPageLinks = 2500;

    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by'    => 'id'
    );

    public function createQuery($context = 'list')
    {
        $em = $this->modelManager->getEntityManager('Itfrogs\SiteBundle\Entity\Lst');

        $queryBuilder = $em
            ->createQueryBuilder('l')
            ->select('l')
            ->from('ItfrogsSiteBundle:Lst', 'l')
//            ->where('l.lvl > 0')
            ->orderBy('l.root, l.lft', 'ASC');


        $query = new ProxyQuery($queryBuilder);
        return $query;
    }


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
            ->add('parent', null, array('label' => 'Родитель'))
            ->add('listGroup', null, array('label' => 'Группа'
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
            ->add('title', null, array('label' => 'Заголовок'))
            ->add('href', null, array('label' => 'Ссылка'))
            ->add('description', null, array('label' => 'Описание'));
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
            ->add('parent', null, array('label' => 'Родитель'
            , 'required'=>false
            , 'query_builder' => function($er) use ($id) {
                    $qb = $er->createQueryBuilder('p');
                    if ($id){
                        $qb
                            ->where('p.id <> :id')
                            ->setParameter('id', $id);
                    }
                    $qb
                        ->orderBy('p.root, p.lft', 'ASC');
                    return $qb;
                }
            ))
            ->add('listGroup', null, array('label' => 'Группа'
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
            ->add('title', null, array('label' => 'Заголовок'))
            ->add('href', null, array('label' => 'Ссылка'))
            ->add('description', null, array('label' => 'Описание'));
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
            ->add('up', 'text', array('template' => 'ItfrogsSiteBundle:Admin:field_tree_up.html.twig', 'label'=>' '))
            ->add('down', 'text', array('template' => 'ItfrogsSiteBundle:Admin:field_tree_down.html.twig', 'label'=>' '))
            ->addIdentifier('id')
            ->add('parent', null, array('label' => 'Родитель'))
            ->add('listGroup', null, array('label' => 'Группа'))
            ->addIdentifier('laveled_title', null, array('sortable'=>false, 'label'=>'Имя'))
//            ->add('title', null, array('label' => 'Заголовок'))
            ->add('href', null, array('label' => 'Ссылка'))
            ->add('description', null, array('label' => 'Описание'));
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
            ->add('listGroup', null, array('label' => 'Группа'))
            ->add('title', null, array('label' => 'Заголовок'))
            ->add('href', null, array('label' => 'Ссылка'))
            ->add('description', null, array('label' => 'Описание'));
    }

    public function postPersist($object)
    {
        $em = $this->modelManager->getEntityManager($object);
        $repo = $em->getRepository("ItfrogsSiteBundle:Lst");
        $repo->verify();
        $repo->recover();
        $em->flush();
    }

    public function postUpdate($object)
    {
        $em = $this->modelManager->getEntityManager($object);
        $repo = $em->getRepository("ItfrogsSiteBundle:Lst");
        $repo->verify();
        $repo->recover();
        $em->flush();
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
                    $action == 'edit' ? 'Просмотр настроек' : 'Редактирование настроек',
                    array('uri' => $this->generateUrl(
                        $action == 'edit' ? 'show' : 'edit', array('id' => $this->getRequest()->get('id'))))
                );
            }

        } */

}