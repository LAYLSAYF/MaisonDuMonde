<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CredentialsType;
use AppBundle\Entity\AuthToken;
use AppBundle\Entity\Credentials;
use Nelmio\ApiDocBundle\Annotation as Doc;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use FOS\RestBundle\Controller\FOSRestController;


class AuthTokenController extends Controller
{
    /**
     * @Doc\ApiDoc(
     *     description = "Créer une catégorie", 
     *     input="AppBundle\Form\CredentialsType",
     *     section = "Categories", 
     *     statusCodes={
     *         201="category is created",
     *         400="violation is raised by validation"
     *     }
     * )
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/auth-tokens/")
     */
    public function postAuthTokensAction(Request $request)
    {
        $credentials = new Credentials();
        $form = $this->createForm(CredentialsType::class, $credentials);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        $em = $this->get('doctrine.orm.entity_manager');

        //var_dump($credentials); die ;
        $user = $em->getRepository('AppBundle:User')
            ->findOneByEmail('test@gmail.com');
        // var_dump($user); die ;   

        if (!$user) { // L'utilisateur n'existe pas
            //return $this->invalidCredentials();
        }

        $encoder = $this->get('security.password_encoder');
        //$isPasswordValid = $encoder->isPasswordValid($user, 'test');

        //if (!$isPasswordValid) { // Le mot de passe n'est pas correct
          //  return $this->invalidCredentials();
        //}

        $authToken = new AuthToken();
        $authToken->setValue(base64_encode(random_bytes(50)));
        $authToken->setCreatedAt(new \DateTime('now'));
        $authToken->setUser($user);

        $em->persist($authToken);
        $em->flush();

        return new JsonResponse($authToken);
    }

/*    private function invalidCredentials()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Invalid credentials'], Response::HTTP_BAD_REQUEST);
    }*/
}
