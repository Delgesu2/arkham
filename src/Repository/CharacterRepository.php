<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/03/19
 * Time: 22:31
 */

namespace App\Repository;

use App\Entity\Character;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CharacterRepository
 *
 * @method Character|null findOneBy(array $criteria, array $orderBy = null)
 *
 */
class CharacterRepository extends ServiceEntityRepository
{
    /**
     * {@inheritdoc}
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Character::class);
    }

    /**
     * Save Character
     *
     * @param $character
     */
    public function save($character)
    {
        $this->_em->persist($character);
        $this->_em->flush();
    }
}