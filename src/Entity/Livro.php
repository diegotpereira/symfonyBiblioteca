<?php

namespace App\Entity;

use App\Repository\LivroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivroRepository::class)
 */
class Livro
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
    private $nome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $autor;

    /**
      * @return mixed
    */

    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     * @return Livro
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
    */

    public function getNome()
    {
        return $this->nome;
    }
    /**
     * @param mixed $nome
     * @return Livro
     */

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }
    /**
     * @return mixed
     */

    public function getAutor()
    {
        return $this->autor;
    }
    /**
     * @param mixed $autor 
     * @return Livro
     */

    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }
}
