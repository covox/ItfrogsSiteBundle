<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 18.08.13
 * Time: 21:33
  */

namespace Itfrogs\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Itfrogs\SiteBundle\Entity;
use Itfrogs\SiteBundle\Twig\Extension\DatabaseTwigLoader;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\PropertyAccess\PropertyPathBuilder;

class PageController extends Controller
{
    private $twig;

    /**
     * @Route("/{slug}", name="itfrogs_site_page_show_slug")
     * @Template()
     */
    public function pageShowAction($slug, Request $request)
    {
        $template = "";
        if (strlen($request->get('template'))>0) {
            $template = $request->get('template');
        }

//        $em = $this->getDoctrine()->getManager();

        $page = $this->getDoctrine()
            ->getRepository('ItfrogsSiteBundle:Page')
            ->findOneBySlug($slug);

        if (!$page) {
            return $this->redirect($this->generateUrl('itfrogs_site_homepage'));
        }

        $loader = new DatabaseTwigLoader($this->container, $entity = "Page", $column = "Slug" );
        $this->twig = new \Twig_Environment($loader);

//        $this->twig->addExtension(new PropertyPathBuilder());
        $form = $this->container->get('fos_user.registration.form');
//        $form
//            ->add('captcha', 'genemu_captcha', array(
//                'required' => true,
//            ));

        $register =  $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));

        $tpl =  $this->twig->render($slug, array(
            'page' => $page,
            'register' => $register->getContent()
        ));

        return $this->render('ItfrogsSiteBundle:Page:showpage'.$template.'.html.twig', array(
            'template' => $tpl,
        ));

//        return $this->render('ItfrogsSiteBundle:Page:showpage'.$template.'.html.twig', array(
//            'page' => $page,
//        ));

    }
}