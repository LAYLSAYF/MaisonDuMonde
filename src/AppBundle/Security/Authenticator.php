<?php 

namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Authenticator extends AbstractGuardAuthenticator
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

	public function getCredentials(Request $request)
	{
	  return $request->headers->get('X-API-TOKEN');
	}

    public function getUser($credentials, UserProviderInterface $userProvider)
	{
	  $user = $this->em->getRepository('AppBundle:User')
	      ->findOneBy(array('apiToken' => $credentials));

	  return $user;
	}

	public function checkCredentials($credentials, UserInterface $user)
	{
	  if ($user->getPassword() === $credentials['password']) {
	    return true;
	  }

	  throw new MyCustomAuthenticationException('The credentials are wrong!');
	}

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
	{
	  $url = $this->router->generate('homepage');

	  return new RedirectResponse($url);
	}

	public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
	{
	  return new JsonResponse(array('message' => $exception->getMessageKey()), Response::HTTP_FORBIDDEN);
	}

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
	{
	   $url = $this->router->generate('login');
	   //die ;
	 // return new RedirectResponse($url);
	}

    public function supportsRememberMe()
    {
        return false;
    }
}
