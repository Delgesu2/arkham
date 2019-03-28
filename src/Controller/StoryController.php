<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 25/03/19
 * Time: 15:45
 */

namespace App\Controller;

use App\Repository\CharacterRepository;
use App\Repository\MonsterRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Session\Session;

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
     * @var CharacterRepository
     */
    private $characterRepository;

    /**
     * @var MonsterRepository
     */
    private $monsterRepository;

    /**
     * @var Security
     */
    private $security;

    /**
     * StoryController constructor.
     *
     * @param Environment $twig
     * @param CharacterRepository $characterRepository
     * @param MonsterRepository $monsterRepository
     * @param Security $security
     */
    public function __construct(
        Environment         $twig,
        CharacterRepository $characterRepository,
        MonsterRepository   $monsterRepository,
        Security            $security
    )
    {
        $this->twig                = $twig;
        $this->characterRepository = $characterRepository;
        $this->monsterRepository   = $monsterRepository;
        $this->security            = $security;
    }

    /**
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke()
    {
        $perso = $this->characterRepository->find('7');

        //$perso = $this->security->getUser();

        $monsters = $this->monsterRepository->findAll();

        return new Response(
            $this->twig->render('story.html.twig', [
                'perso' => $perso,
                'monsters' => $monsters
            ])
        );
    }
}