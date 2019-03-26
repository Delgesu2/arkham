<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 25/03/19
 * Time: 23:23
 */

namespace App\EntityListener;

use App\Entity\Character;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class CharacterListener
 *
 * @package App\EntityListener
 */
class CharacterListener
{
    /**
     * @param Character $character
     * @param LifecycleEventArgs $eventArgs
     *
     * @throws \Exception
     */
    public function prePersist(Character $character, LifecycleEventArgs $eventArgs): void
    {
        $this->compute($character);
    }

    /**
     * @param Character $character
     *
     * @throws \Exception
     */
    private function compute(Character $character)
    {
        switch ($character->getJob()) {
            case 1:
                $character->setPv(random_int(20, 25));
                $character->setDamage(random_int(4, 6));
                $character->setPsy(random_int(10, 15));
                break;
            case 2:
                $character->setPv(random_int(24, 30));
                $character->setDamage(random_int(5, 8));
                $character->setPsy(random_int(4, 10));
                break;
            case 3:
                $character->setPv(random_int(15, 21));
                $character->setDamage(random_int(2, 5));
                $character->setPsy(random_int(14, 20));
                break;
        }
    }

}