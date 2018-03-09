<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use Nelmio\ApiDocBundle\Annotation as Doc;
use FOS\RestBundle\Controller\FOSRestController;

class SecurityController extends Controller
{
    /**
     * @Doc\ApiDoc(
     *     description = "Créer une catégorie", 
     *     input="",
     *     section = "Security", 
     *     statusCodes={
     *         201="category is created",
     *         400="violation is raised by validation"
     *     }
     * )
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/login")
     */
    public function createCategoriesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        return new JsonResponse();
    }

}
