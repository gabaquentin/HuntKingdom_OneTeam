<?php

namespace Boutique\BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity(repositoryClass="Boutique\BoutiqueBundle\Repository\FournisseurRepository")
 */
class Fournisseur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomFournisseur", type="string", length=255)
     */
    private $nomFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="idFournisseur", type="string", length=255)
     */
    private $idFournisseur;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomFournisseur
     *
     * @param string $nomFournisseur
     *
     * @return Fournisseur
     */
    public function setNomFournisseur($nomFournisseur)
    {
        $this->nomFournisseur = $nomFournisseur;

        return $this;
    }

    /**
     * Get nomFournisseur
     *
     * @return string
     */
    public function getNomFournisseur()
    {
        return $this->nomFournisseur;
    }

    /**
     * Set idFournisseur
     *
     * @param string $idFournisseur
     *
     * @return Fournisseur
     */
    public function setIdFournisseur($idFournisseur)
    {
        $this->idFournisseur = $idFournisseur;

        return $this;
    }

    /**
     * Get idFournisseur
     *
     * @return string
     */
    public function getIdFournisseur()
    {
        return $this->idFournisseur;
    }
}

