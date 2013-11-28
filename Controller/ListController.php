<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 20.08.13
 * Time: 20:57
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

class ListController extends Controller
{
    private $twig;

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * @Route("/show/{slug}/", name="itfrogs_site_list_show_slug")
     * @Template()
     */
    public function ListShowAction($slug, Request $request)
    {
        $loader = new DatabaseTwigLoader($this->container, $entity = "ListGroup", $column = "Slug" );
        $this->twig = new \Twig_Environment($loader);

        $list = $this->getDoctrine()
            ->getRepository('ItfrogsSiteBundle:ListGroup')
            ->findOneBySlug($slug);

        $records = $list->getLists();

        $template =  $this->twig->render($slug, array(
            'records' => $records));

        return $this->render('ItfrogsSiteBundle:List:showlist.html.twig', array(
            'template' => $template,
        ));

    }

}