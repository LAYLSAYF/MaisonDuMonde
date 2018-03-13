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
	public function queryOneAction(Request $request){
		
		$em = $this->getDoctrine()->getManager();

		$users = $em->getRepository('AppBundle:Visiteurs')
		            ->myFindAll();

		foreach ( $users as $key => $value ){
			var_dump($value); 
		}           
		die ;
		return $users;
	}

	/**
     * @Route(
     *  "/querytwo",
     *  name="_accueil1",
     * )
     */
	public function querytwo(Request $request){
		$em = $this->getDoctrine()->getManager();

		$users = $em->getRepository("AppBundle:User")->find(2);

		$users = $em->getRepository('AppBundle:Visiteurs')
		            ->myFindTwo($users);


	}
}
