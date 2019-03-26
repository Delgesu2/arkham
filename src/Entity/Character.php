<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/03/19
 * Time: 20:58
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Character
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\CharacterRepository")
 * @ORM\EntityListeners({
 *     "App\EntityListener\CharacterListener"
 * })
 */
class Character
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true, length=60)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pv;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $damage;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $psy;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $job;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return null|int
     */
    public function getPv(): ?int
    {
        return $this->pv;
    }

    /**
     * @param int $pv
     */
    public function setPv(int $pv): void
    {
        $this->pv = $pv;
    }

    /**
     * @return null|int
     */
    public function getDamage(): ?int
    {
        return $this->damage;
    }

    /**
     * @param int $damage
     */
    public function setDamage(int $damage): void
    {
        $this->damage = $damage;
    }

    /**
     * @return null|int
     */
    public function getPsy(): ?int
    {
        return $this->psy;
    }

    /**
     * @return int
     */
    public function getJob(): ?int
    {
        return $this->job;
    }

    /**
     * @param int $job
     */
    public function setJob(int $job): void
    {
        $this->job = $job;
    }

    /**
     * @param int $psy
     */
    public function setPsy(int $psy): void
    {
        $this->psy = $psy;
    }

    public function hit(Monster $monster)
    {
        // Target monster get damage
    }

    public function suffer()
    {
        // Lose x pv (= x monster damage points)
    }

    public function insane()
    {
        // Lose x psy when hit (stocked if 5 in 1 hit)
    }

}