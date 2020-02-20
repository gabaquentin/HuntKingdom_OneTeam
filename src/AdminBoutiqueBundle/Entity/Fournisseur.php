<?php

namespace AdminBoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity(repositoryClass="AdminBoutiqueBundle\Repository\FournisseurRepository")
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
     * @var int
     *
     * @ORM\Column(name="idFournisseur", type="integer")
     */
    private $idFournisseur;


    /**
     * @var string
     *
     * @ORM\Column(name="emailFournisseur", type="string")
     *
     * @Assert\Email()
     */
    private $emailFournisseur;

    /**
     * @return string
     */
    public function getEmailFournisseur()
    {
        return $this->emailFournisseur;
    }

    /**
     * @param string $emailFournisseur
     */
    public function setEmailFournisseur($emailFournisseur)
    {
        $this->emailFournisseur = $emailFournisseur;
    }





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
     * @param integer $idFournisseur
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
     * @return int
     */
    public function getIdFournisseur()
    {
        return $this->idFournisseur;
    }
}

