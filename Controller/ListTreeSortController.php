<?php
/**
 * Created by JetBrains PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 13.10.13
 * Time: 22:05
  */

namespace Itfrogs\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;


class ListTreeSortController extends Controller
{
    public $queries;
    public $functions;
    public $postal;

    public function __construct() {
    }

    public function setEnvironment() {
        $this->queries = $this->get('itfrogs.site.helpers.queries');
        $this->functions = $this->get('itfrogs.site.helpers.functions');
    }

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     */
    public function upAction($list_id)
    {
        $this ->setEnvironment();
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('ItfrogsSiteBundle:Lst');
        $list = $repo->findOneById($list_id);
        if ($list->getParent()){
            $repo->moveUp($list);
        }
        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     */
    public function downAction($list_id)
    {
        $this ->setEnvironment();
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('ItfrogsSiteBundle:Lst');
        $list = $repo->findOneById($list_id);
        if ($list->getParent()){
            $repo->moveDown($list);
        }
        return $this->redirect($this->getRequest()->headers->get('referer'));
    }
}