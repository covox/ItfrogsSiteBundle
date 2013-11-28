<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 18.08.13
 * Time: 21:08
  */

namespace Itfrogs\SiteBundle\Admin\Model;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

class PagesAdmin extends Admin
{
    /**
     * Конфигурация отображения записи
     *
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id', null, array('label' => 'Идентификатор'))
            ->add('title', null, array('label' => 'Имя страницы'))
            ->add('slug', null, array('label' => 'Адрес страницы'))
            ->add('description', null, array('label' => 'Краткое описание'))
            ->add('template', null, array('label' => 'Шаблон страницы'));
    }

    /**
     * Конфигурация формы редактирования записи
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', null, array('label' => 'Имя страницы'))
            ->add('slug', null, array('label' => 'Адрес страницы'))
            ->add('description', null, array('label' => 'Краткое описание'))
            ->add('template', null, array('label' => 'Шаблон страницы'));
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
            ->add('title', null, array('label' => 'Имя страницы'))
            ->add('slug', null, array('label' => 'Адрес страницы'))
            ->add('description', null, array('label' => 'Краткое описание'))
            ->add('template', null, array('label' => 'Шаблон страницы'));
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
            ->add('title', null, array('label' => 'Имя страницы'))
            ->add('slug', null, array('label' => 'Адрес страницы'))
            ->add('description', null, array('label' => 'Краткое описание'))
            ->add('template', null, array('label' => 'Шаблон страницы'));
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