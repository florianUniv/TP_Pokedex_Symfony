<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PokemonRepository")
 */
class Pokemon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RefPokemon")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ref_pokemon;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexe;

    /**
     * @ORM\Column(type="integer")
     */
    private $xp;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveau;

    /**
     * @ORM\Column(type="boolean")
     */
    private $a_vendre;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_dernier_entrainement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dresseur;

    

    public function __construct()
    {
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefPokemon(): ?RefPokemon
    {
        return $this->ref_pokemon;
    }

    public function setRefPokemon(?RefPokemon $ref_pokemon): self
    {
        $this->ref_pokemon = $ref_pokemon;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getXp(): ?int
    {
        return $this->xp;
    }

    public function setXp(int $xp): self
    {
        $this->xp = $xp;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getAVendre(): ?bool
    {
        return $this->a_vendre;
    }

    public function setAVendre(bool $a_vendre): self
    {
        $this->a_vendre = $a_vendre;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateDernierEntrainement(): ?\DateTimeInterface
    {
        return $this->date_dernier_entrainement;
    }

    public function setDateDernierEntrainement(\DateTimeInterface $date_dernier_entrainement): self
    {
        $this->date_dernier_entrainement = $date_dernier_entrainement;

        return $this;
    }

    public function getDresseur(): ?User
    {
        return $this->dresseur;
    }

    public function setDresseur(?User $dresseur): self
    {
        $this->dresseur = $dresseur;

        return $this;
    }


}
