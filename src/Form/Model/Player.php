<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 27/03/19
 * Time: 13:59
 */

namespace App\Form\Model;

class Player
{
    /**
     * @var string
     */
    private $_username;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->_username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->_username = $username;
    }


}