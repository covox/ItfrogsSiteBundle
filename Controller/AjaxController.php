<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 13.10.13
 * Time: 16:35
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

class AjaxController extends Controller
{
    public $queries;
    public $functions;

    public function setEnvironment()
    {
        $this->queries = $this->get('itfrogs.site.helpers.queries');
        $this->functions = $this->get('itfrogs.site.helpers.functions');
    }

    /**
     * @Route("/dictionary/random/", name="itfrogs_site_ajax_dictionary_random")
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

        $citate = array('kalm' => $citation->getSource(), 'rus' => $citation->getTranslate());

        print "saying(".json_encode($citate).")";
//        print "--";
        die();

    }

    /**
     * @Route("/dictionary/search/", name="itfrogs_site_ajax_dictionary_search")
     * @Template()
     */
    public function dictionarySearchAction(Request $request)
    {
        $this->setEnvironment();
        // если не Аякс запрос, то гаснем
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')) {
//            header("location: " . $this->generateUrl('itfrogs_site_default'));
//            die("Direct access denied");
        }

        $sEcho = (int)$request->get('sEcho');
        $start = $request->get('iDisplayStart') ? intval($request->get('iDisplayStart')) : 0;
        $rows = $request->get('iDisplayLength') ? intval($request->get('iDisplayLength')) : 6;
        //var_dump($rows);
        $sidx = $request->get('sidx') ? 'd.' . strval($request->get('sidx')) : 'd.id';
        $sord = $request->get('sord') ? strval($request->get('sord')) : 'desc';
        $catid = $request->get('catid') ? intval($request->get('catid')) : 1;

        $searchstring = $request->get('sSearch') ? strval($request->get('sSearch')) : "";

        $whereclause = "";

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        $q = $qb
            ->add('select', 'd')
            ->add('from', 'ItfrogsSiteBundle:Dictionary d')
            ->add("where", $qb->expr()->andx(
                $qb->expr()->orx(
                    $qb->expr()->like('d.source', $qb->expr()->literal('%' . $searchstring . '%')),
                    $qb->expr()->like('d.translate', $qb->expr()->literal('%' . $searchstring . '%')),
                    $qb->expr()->like('d.description', $qb->expr()->literal('%' . $searchstring . '%'))
                ),
                $qb->expr()->eq('d.dictGroupId', $catid),
                $qb->expr()->eq('d.active', 1)
            ))
            ->add("orderBy", $sidx . " " . $sord)
        ;

        $all_results = $q->getQuery()->getResult();

        $q
            ->setFirstResult($start)
            ->setMaxResults($rows);

        $results = $q->getQuery()->getResult();

        $responce = array();
        $responce['sEcho'] = $sEcho;
        $responce['iTotalRecords'] = $rows;
        $responce['iTotalDisplayRecords'] = count($all_results);
        $responce['aaData'] = array();


        foreach ($results AS $result) {
            $result->setTranslate(strip_tags(preg_replace('{<h2>(.*)</h2>}siU', '', $result->getTranslate())));
            $responce['aaData'][] = array(
                $this->render('ItfrogsSiteBundle:Ajax:dictionary.datatable.html.twig', array(
                    'result' => $result,
                ))->getContent(),
            );
        }

        print json_encode($responce);
        die;
    }

}