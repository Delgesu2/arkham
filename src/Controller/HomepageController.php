<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/03/19
 * Time: 22:50
 */

namespace App\Controller;

use App\Entity\Chara;
use App\Form\Handler\CharacterHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * HomepageController constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @param CharacterHandler $handler
     * @param FormInterface|null $form
     *
     * @return RedirectResponse|Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(
        CharacterHandler $handler,
        FormInterface $form = null
    )
    {
        if($handler->handle(new Chara())) {

            $redirectResponse = new RedirectResponse($this->urlGenerator->generate('story'));
            return $redirectResponse;
        }

        $response = new Response($this->twig->render('homepage.html.twig', [
            'form' => $handler->getView()
            ])
        );

            return $response;

    }
}