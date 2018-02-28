<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use Nelmio\ApiDocBundle\Annotation as Doc;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Form\CategoryType;
use AppBundle\Form\ProductsType;
use AppBundle\Entity\Category;

class DefaultController extends Controller
{
    /**
     * @Doc\ApiDoc(
     *     description = "Créer une catégorie", 
     *     input="AppBundle\Form\CategoryType",
     *     section = "Categories", 
     *     statusCodes={
     *         201="category is created",
     *         400="violation is raised by validation"
     *     }
     * )
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/categories/")
     */
    public function createCategoriesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $nameCategory =$request->get('name');
        if (is_null($nameCategory)) {
            return new JsonResponse(['code' =>Response::HTTP_BAD_REQUEST,  'message' => 'Category not found'], Response::HTTP_BAD_REQUEST);
        }
        $category = $em->getRepository('AppBundle:Category')->addCategory($nameCategory);
        return new JsonResponse($category, Response::HTTP_CREATED);
    }


    /**
     * @Doc\ApiDoc(
     *     description = "Récuperer une catégorie", 
           section = "Categories", 
     *     statusCodes={
     *         200="Returned when success"
     *     }
     * )
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Get("/categories/")
     */
    public function getCategoriesAction()
    {
       $em = $this->getDoctrine()->getManager();
       $tab = $em->getRepository('AppBundle:Category')->getCategories();
       return new JsonResponse($tab);
    }

    /**
     * @Doc\ApiDoc(
     *     description = "Ajouter un produit",
     *     input="AppBundle\Form\ProductsType",
     *     section = "Produits", 
     *     statusCodes={
               200="Returned when success"
     *     }
     * )
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/products/")
     */
    public function createProductAction(Request $request)
    {
        $em   = $this->getDoctrine()->getManager();
        $data = $request->request->all();
        $product = $em->getRepository('AppBundle:Products')->addProduct($data);
        return new JsonResponse($product, Response::HTTP_CREATED);
    }

            /**
     * @Doc\ApiDoc(
     *     description = "Récuperer les produits d'une catégorie",
     *     section = "Produits",
     *     parameters = {
     *         { "name" = "id", "dataType" = "integer", "required" = true, "description" = "identifiant de la catégrie" }
     *     },
     *     statusCodes={
     *     }
     * )
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @Rest\Get("categories/{id}/products/")
     */
    public function getProductsFromCategoriesAction(Request $request)
    {

        $produits=[];
        $results;

        $em   = $this->getDoctrine()->getManager();
        $id = (int)$request->get('id');

        // First solution 
        $categorie = $this->getDoctrine()->getRepository('AppBundle:Category')->find($id);

        //var_dump($categorie); die ;
        $pdts = $categorie->getProducts();
       
        $results['categorie']['nom']=$categorie->getName();

        foreach($pdts as $produit){
            $results['categorie']['produits'][$produit->getId()]=array(

                    'id'=>$produit->getId(),
                    'nom'=>$produit->getNom(), 

            );


           $prices = $produit->getPrices();

            foreach($prices as $price){
                $results['categorie']['produits'][$produit->getId()]['prix'][$price->getId()]=array(
                        'amount'=>$price->getAmount(),
                        'currency'=>$price->getCurrency(),
                );

            }
        }
    
        return new JsonResponse($results);
    }
}
