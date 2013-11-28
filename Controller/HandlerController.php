<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 13.10.13
 * Time: 17:24
  */

namespace Itfrogs\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Itfrogs\SiteBundle\Entity;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HandlerController extends Controller
{
    public $queries;
    public $functions;

    public function __construct() {
    }

    public function setEnvironment()
    {
        $this->queries = $this->get('itfrogs.site.helpers.queries');
        $this->functions = $this->get('itfrogs.site.helpers.functions');
    }

    /**
     * @Route("/dictionary/add/", name="itfrogs_site_handler_add_dictionary_row")
     * @Template()
     */
    public function dictionaryAddAction(Request $request)
    {
        $this ->setEnvironment();


        if ($request->getMethod() == 'POST') {

            $dictionary = new Entity\Dictionary();

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

            $form->submit($request);
//            $form->handleRequest($request);

            if ($form->isValid()) {

                $dictionary = $form->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($dictionary);
                $em->flush();

                return $this->render('ItfrogsSiteBundle:Handler:success_add.html.twig');
            }
            else {
            }

        }
        return $this->redirect($this->generateUrl('itfrogs_site_default'));
    }
}