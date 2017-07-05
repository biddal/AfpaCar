<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carpooling
 *
 * @ORM\Table(name="carpooling", indexes={@ORM\Index(name="FK_establishmentID", columns={"establishment"}), @ORM\Index(name="FK_userID", columns={"user"})})
 * @ORM\Entity
 */
class Carpooling
{
    /**
     * @var integer
     *
     * @ORM\Column(name="description", type="integer", nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Establishment
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Establishment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="establishment", referencedColumnName="ID")
     * })
     */
    private $establishment;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Set description
     *
     * @param integer $description
     *
     * @return Carpooling
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return integer
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set establishment
     *
     * @param \AppBundle\Entity\Establishment $establishment
     *
     * @return Carpooling
     */
    public function setEstablishment(\AppBundle\Entity\Establishment $establishment = null)
    {
        $this->establishment = $establishment;

        return $this;
    }

    /**
     * Get establishment
     *
     * @return \AppBundle\Entity\Establishment
     */
    public function getEstablishment()
    {
        return $this->establishment;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Carpooling
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
