<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 18.08.13
 * Time: 22:53
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

class CitationController extends Controller
{
    /**
     * @Route("/random/", name="itfrogs_site_citation_random")
     * @Template()
     */
    public function randomCitationAction(Request $request)
    {
        $template = "";
        if (strlen($request->get('template'))>0) {
            $template = $request->get('template');
        }

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        $query = $em->createQuery('SELECT COUNT(c.id) FROM ItfrogsSiteBundle:Citation c');
        $count = $query->getSingleScalarResult();

        $rand_id = rand(1,$count);

        $citation = $this->getDoctrine()
            ->getRepository('ItfrogsSiteBundle:Citation')
            ->findOneById($rand_id);

        return $this->render('ItfrogsSiteBundle:Citation:randomcitation'.$template.'.html.twig', array(
            'citation' => $citation,
        ));
    }

}