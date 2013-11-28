<?php

namespace Itfrogs\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Itfrogs\PurchasesBundle\Entity;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="itfrogs_site_default")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('ItfrogsSiteBundle:Default:index.html.twig');
    }

    /**
     * @Route("/light/", name="itfrogs_site_default_light")
     * @Template()
     */
    public function indexLightAction()
    {
        return $this->render('ItfrogsSiteBundle:Default:index.light.html.twig');
    }
}
