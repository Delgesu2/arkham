<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 27/03/19
 * Time: 12:16
 */

namespace App\Security;

use App\Entity\Chara;
use App\Form\Type\CharacterType;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;


class CharaAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var CharacterRepository
     */
    private $repository;

    /**
     * CharaAuthenticator constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     * @param RouterInterface $router
     * @param CharacterRepository $repository
     */
    public function __construct(
        FormFactoryInterface    $formFactory,
        EntityManagerInterface  $entityManager,
        RouterInterface         $router,
        CharacterRepository     $repository
    ) {
        $this->formFactory =    $formFactory;
        $this->entityManager =  $entityManager;
        $this->router =         $router;
        $this->repository    =  $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(Request $request)
    {
         return $this->router->generate('home') == $request->getPathInfo() && $request->isMethod('POST');
    }

    /**
     * {@inheritdoc}
     */
    public function getCredentials(Request $request)
    {
        $form = $this->formFactory->create(CharacterType::class);
        $form->handleRequest($request);

        /** @var Player $data */
        $data = $form->getData();
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data->getNom()
        );

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $user = $this->entityManager->getRepository(Chara::class)->findOneByNom($credentials->getNom());
        if (null === $user) {
          //  $this->repository->save($credentials);
            throw new CustomUserMessageAuthenticationException("Vos codes d'accès sont invalides.");
            // condition inutile
        }
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        // TODO: Implement checkCredentials() method.

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // TODO: Implement onAuthenticationFailure() method.

    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }



    /**
     * {@inheritdoc}
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        //return new RedirectResponse($this->router->generate('home'));
    }

    /**
     * {@inheritdoc}
     */
    public function supportsRememberMe()
    {
        return false;
    }

}