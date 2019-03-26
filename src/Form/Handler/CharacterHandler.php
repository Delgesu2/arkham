<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/03/19
 * Time: 22:53
 */

namespace App\Form\Handler;


use App\Entity\Character;
use App\Form\Type\CharacterType;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class CharacterHandler
 *
 * @package App\Form\Handler
 */
class CharacterHandler
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var FormInterface
     */
    private $form;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var CharacterRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var Character
     */
    private $character;

    /**
     * CharacterHandler constructor.
     *
     * @param CharacterRepository $repository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        CharacterRepository $repository,
        EntityManagerInterface $entityManager
    )
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Required
     *
     * @param FormFactoryInterface $formFactory
     */
    public function setFormFactory(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @Required
     *
     * @param RequestStack $requestStack
     */
    public function setRequestStack(RequestStack $requestStack): void
    {
        $this->requestStack = $requestStack;
    }

    /**
     *  Create a form
     */
    public function createForm()
    {
        $this->form = $this->formFactory->create(
            $this->getFormType(),
            $this->data
        );
    }

    /**
     * @return string The type
     */
    public function getFormType(): string
    {
        return CharacterType::class;
    }

    /**
     * @return FormView
     */
    public function getView(): FormView
    {
       return $this->form->createView();
    }

    /**
     * Handle form
     *
     * @param $data
     *
     * @return bool
     */
    public function handle($data): bool
    {
        $this->data = $data;

        $this->createForm();

        $this->form->handleRequest($this->requestStack->getCurrentRequest());

        if ($this->form->isSubmitted() && $this->form->isValid()) {

            $this->entityManager->persist($this->data);

            var_dump($this->data);
            die();


           // $this->entityManager->flush();

            //$this->repository->save($data);

//            $session = new Session();
         //   $session->getFlashBag()->add('success', 'Votre personnage a été créé avec succès.');

            return true;
       }

        return false;

    }
}