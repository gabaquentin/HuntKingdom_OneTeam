<?php

namespace  SAV\AdminSAVBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison")
 * @ORM\Entity(repositoryClass="SAV\AdminSAVBundle\Repository\LivraisonRepository")
 */
class Livraison
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateliv", type="date")
     */
    private $dateliv;


    /**
     * @ORM\ManyToOne(targetEntity="Livreur")
     * @ORM\JoinColumn(name="livreur",referencedColumnName="id",onDelete="CASCADE")
     */
    private $Livreur ;

    /**
     * @return mixed
     */
    public function getLivreur()
    {
        return $this->Livreur;
    }

    /**
     * @param mixed $Livreur
     */
    public function setLivreur($Livreur)
    {
        $this->Livreur = $Livreur;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="prixliv", type="integer")
     */
    private $prixliv;


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
     * Set dateliv
     *
     * @param \DateTime $dateliv
     *
     * @return Livraison
     */
    public function setDateliv($dateliv)
    {
        $this->dateliv = $dateliv;

        return $this;
    }

    /**
     * Get dateliv
     *
     * @return \DateTime
     */
    public function getDateliv()
    {
        return $this->dateliv;
    }

    /**
     * Set prixliv
     *
     * @param integer $prixliv
     *
     * @return Livraison
     */
    public function setPrixliv($prixliv)
    {
        $this->prixliv = $prixliv;

        return $this;
    }

    /**
     * Get prixliv
     *
     * @return int
     */
    public function getPrixliv()
    {
        return $this->prixliv;
    }
}

