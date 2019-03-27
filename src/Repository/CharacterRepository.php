<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/03/19
 * Time: 22:31
 */

namespace App\Repository;

use App\Entity\Chara;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CharacterRepository
 *
 * @method Chara|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chara[]    findAll()
 *
 */
class CharacterRepository extends ServiceEntityRepository
{
    /**
     * {@inheritdoc}
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Chara::class);
    }

    /**
     * Save Chara
     *
     * @param $character
     */
    public function save($character)
    {
        $this->_em->persist($character);
        $this->_em->flush();
    }
}