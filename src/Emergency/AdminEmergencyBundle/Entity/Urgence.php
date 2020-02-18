<?php

namespace Emergency\AdminEmergencyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Urgence
 *
 * @ORM\Table(name="urgence")
 * @ORM\Entity(repositoryClass="Emergency\AdminEmergencyBundle\Repository\UrgenceRepository")
 */
class Urgence
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
     * @ORM\Column(name="utilisateur", type="string", length=255)
     */
    private $utilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="plus", type="string", length=255)
     */
    private $plus;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="place_id", type="string")
     */
    private $place_id;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string")
     */
    private $etat;

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getExpedition()
    {
        return $this->expedition;
    }

    /**
     * @param mixed $expedition
     */
    public function setExpedition($expedition)
    {
        $this->expedition = $expedition;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Expedition")
     * @ORM\JoinColumn(name="expedition", referencedColumnName="id")
     */
    private $expedition;


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
     * Set utilisateur
     *
     * @param string $utilisateur
     *
     * @return Urgence
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return string
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Urgence
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Urgence
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set plus
     *
     * @param string $plus
     *
     * @return Urgence
     */
    public function setPlus($plus)
    {
        $this->plus = $plus;

        return $this;
    }

    /**
     * Get plus
     *
     * @return string
     */
    public function getPlus()
    {
        return $this->plus;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Urgence
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Urgence
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set place_id
     *
     * @param integer $place_id
     *
     * @return string
     */
    public function setPlace_id($place_id)
    {
        $this->place_id = $place_id;

        return $this;
    }

    /**
     * Get place_id
     *
     * @return string
     */
    public function getPlace_id()
    {
        return $this->place_id;
    }
}

