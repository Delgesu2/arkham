<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/03/19
 * Time: 22:50
 */

namespace App\Controller;

use App\Entity\Chara;
use App\Form\Model\Security\Player;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

/**
 * Class HomepageController
 *
 * @package App\Controller
 *
 * @Route("/", name="home")
 */
class HomepageController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * HomepageController constructor.
     *
     * @param Environment $twig
     */
    public function __construct(
        Environment $twig
    )
    {
        $this->twig = $twig;
    }

    /**
     * @param AuthenticationUtils $authenticationUtils
     * @param FormInterface $form
     *
     * @return Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(
        AuthenticationUtils $authenticationUtils,
        FormInterface $form
    ): Response {

        $login = new Player();
        $login->setUsername($authenticationUtils->getLastUsername());

        return new Response($this->twig->render('homepage.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'form'  => $form->createView()
        ]));

    }
}