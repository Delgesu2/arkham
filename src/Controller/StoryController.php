<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 25/03/19
 * Time: 15:45
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class StoryController
 *
 * @package App\Controller
 *
 * @Route("/story", name="story")
 */
class StoryController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * StoryController constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @return Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke()
    {
        return new Response(
            $this->twig->render('story.html.twig')
        );
    }
}