<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use \Datetime;

class QueryController extends Controller
{
	/**
     * @Route(
     *  "/query",
     *  name="_accueil",
     * )
     */
	public function queryOne(Request $request){
		
		$em = $this->getDoctrine()->getManager();

		$users = $em->getRepository('AppBundle:Visiteurs')
		            ->myFindAll();
		return $users;
	}
}
