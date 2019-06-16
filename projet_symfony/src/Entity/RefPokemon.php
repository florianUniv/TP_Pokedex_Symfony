<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\RefPokemonRepository")
 */
class RefPokemon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="boolean")
     */
    private $evolution;

    /**
     * @ORM\Column(type="boolean")
     */
    private $starter;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $type_courbe_niveau;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ElementaryType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ElementaryType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_2;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEvolution(): ?bool
    {
        return $this->evolution;
    }

    public function setEvolution(bool $evolution): self
    {
        $this->evolution = $evolution;

        return $this;
    }

    public function getStarter(): ?bool
    {
        return $this->starter;
    }

    public function setStarter(bool $starter): self
    {
        $this->starter = $starter;

        return $this;
    }

    public function getTypeCourbeNiveau(): ?string
    {
        return $this->type_courbe_niveau;
    }

    public function setTypeCourbeNiveau(string $type_courbe_niveau): self
    {
        $this->type_courbe_niveau = $type_courbe_niveau;

        return $this;
    }

    public function getType1(): ?ElementaryType
    {
        return $this->type_1;
    }

    public function setType1(?ElementaryType $type_1): self
    {
        $this->type_1 = $type_1;

        return $this;
    }

    public function getType2(): ?ElementaryType
    {
        return $this->type_2;
    }

    public function setType2(?ElementaryType $type_2): self
    {
        $this->type_2 = $type_2;

        return $this;
    }

}
