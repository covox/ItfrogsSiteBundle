<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 13.10.13
 * Time: 15:32
  */

namespace Itfrogs\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Itfrogs\SiteBundle\Entity;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DictionaryController extends Controller
{
    public $queries;
    public $functions;

    public function setEnvironment()
    {
        $this->queries = $this->get('itfrogs.site.helpers.queries');
        $this->functions = $this->get('itfrogs.site.helpers.functions');
    }

    /**
     * @Route("/random/", name="itfrogs_site_dictionary_random")
     * @Template()
     */
    public function randomDictionaryAction(Request $request)
    {
        $this->setEnvironment();

        $template = "";
        if (strlen($request->get('template'))>0) {
            $template = $request->get('template');
        }

        $citation = $this->queries->getRandomDictionaryRow(1);

        return $this->render('ItfrogsSiteBundle:Dictionary:randomcitation'.$template.'.html.twig', array(
            'citation' => $citation,
        ));
    }

    /**
     * @Route("/add/", name="itfrogs_site_dictionary_add")
     * @Template()
     */
    public function addAction(Request $request)
    {
        $this->setEnvironment();

        $template = "";
        if (strlen($request->get('template'))>0) {
            $template = $request->get('template');
        }

        $form = $this->getAddForm();

        return $this->render('ItfrogsSiteBundle:Dictionary:add'.$template.'.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/add/light/", name="itfrogs_site_dictionary_add_light")
     * @Template()
     */
    public function addLightAction(Request $request)
    {
        $this->setEnvironment();

        $form = $this->getAddForm();

        return $this->render('ItfrogsSiteBundle:Dictionary:add.light.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function getAddForm() {

        $form = $this->createFormBuilder(new Entity\Dictionary())
            ->add('dictGroup', 'genemu_jqueryselect2_entity', array(
                'class' => 'ItfrogsSiteBundle:DictionaryGroup',
                'property' => 'name',
            ))
            ->add('source', 'textarea', array(
                'required' => true,
            ))
            ->add('translate', 'textarea', array(
                'required' => true,
            ))
            ->add('description', 'textarea', array(
                'required' => false,
            ))
            ->add('captcha', 'genemu_captcha', array(
                'required' => true,
            ))
            ->add('save', 'submit',array('label' => 'Отправить'))
            ->getForm();

        return $form;
    }

    /**
     * @Route("/search/", name="itfrogs_site_dictionary_search")
     * @Template()
     */
    public function searchAction(Request $request)
    {
        $this->setEnvironment();

        $template = "";
        if (strlen($request->get('template'))>0) {
            $template = $request->get('template');
        }

        $categories = $this->queries->getAll('DictionaryGroup');

        return $this->render('ItfrogsSiteBundle:Dictionary:search'.$template.'.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * @Route("/search/light/", name="itfrogs_site_dictionary_search_light")
     * @Template()
     */
    public function searchLightAction(Request $request)
    {
        $this->setEnvironment();

        $categories = $this->queries->getAll('DictionaryGroup');

        return $this->render('ItfrogsSiteBundle:Dictionary:search.light.html.twig', array(
            'categories' => $categories,
        ));
    }

}