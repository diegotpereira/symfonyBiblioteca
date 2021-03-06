<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class Usuario implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $senha;

    /**
     * @ORM\Column(type="array")
     */
    private $permissoes;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id 
     * @return Usuario
     */
    public function setId($id)
    {
        $this->id =$id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }
    /**
     * @param mixed $login
     * @return Usuario
     */

    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }
    /**
     * @param mixed $senha
     * @return Usuario
     */

    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getPermissoes()
    {
        return $this->permissoes;
    }
    /**
     * @param mixed $permissoes
     * @return Usuario
     */

    public function setPermissoes($permissoes)
    {
        $this->permissoes = $permissoes;

        return $this;
    }

     /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return $this->getPermissoes();
    }
     /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->getSenha();
    }
     /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        
    }
     /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getLogin();
    }
     /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // m??todo para remover dados sensiveis durante a autentica????o
    }
}
