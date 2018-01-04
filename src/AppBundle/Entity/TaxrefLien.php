<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * TaxrefLien
 *
 * @ORM\Table(name="TaxrefLien")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxrefLienRepository")
 */
class TaxrefLien
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
     * @ORM\Column(name="ctName", type="string", length=255)
     */
    private $ctName;
    /**
     * @var string
     *
     * @ORM\Column(name="ctType", type="string", length=255)
     */
    private $ctType;
    /**
     * @var string
     *
     * @ORM\Column(name="ctAuthors", type="string", length=255)
     */
    private $ctAuthors;
    /**
     * @var string
     *
     * @ORM\Column(name="ctTitle", type="string", length=255)
     */
    private $ctTitle;
    /**
     * @var string
     *
     * @ORM\Column(name="ctUrl", type="string", length=255)
     */
    private $ctUrl;
    /**
     * @var integer
     *
     * @ORM\Column(name="cdNom", type="integer", length=255)
     */
    private $cdNom;
    /**
     * @var string
     *
     * @ORM\Column(name="ctSpId", type="string", length=255)
     */
    private $ctSpId;
    /**
     * @var string
     *
     * @ORM\Column(name="urlSp", type="string", length=255)
     */
    private $urlSp;
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
     * Set ctName
     *
     * @param string $ctName
     *
     * @return taxrefLien
     */
    public function setCtName($ctName)
    {
        $this->ctName = $ctName;
        return $this;
    }
    /**
     * Get ctName
     *
     * @return string
     */
    public function getCtName()
    {
        return $this->ctName;
    }
    /**
     * Set ctType
     *
     * @param string $ctType
     *
     * @return taxrefLien
     */
    public function setCtType($ctType)
    {
        $this->ctType = $ctType;
        return $this;
    }
    /**
     * Get ctType
     *
     * @return string
     */
    public function getCtType()
    {
        return $this->ctType;
    }
    /**
     * Set ctAuthors
     *
     * @param string $ctAuthors
     *
     * @return taxrefLien
     */
    public function setCtAuthors($ctAuthors)
    {
        $this->ctAuthors = $ctAuthors;
        return $this;
    }
    /**
     * Get ctAuthors
     *
     * @return string
     */
    public function getCtAuthors()
    {
        return $this->ctAuthors;
    }
    /**
     * Set ctTitle
     *
     * @param string $ctTitle
     *
     * @return taxrefLien
     */
    public function setCtTitle($ctTitle)
    {
        $this->ctTitle = $ctTitle;
        return $this;
    }
    /**
     * Get ctTitle
     *
     * @return string
     */
    public function getCtTitle()
    {
        return $this->ctTitle;
    }
    /**
     * Set ctUrl
     *
     * @param string $ctUrl
     *
     * @return taxrefLien
     */
    public function setCtUrl($ctUrl)
    {
        $this->ctUrl = $ctUrl;
        return $this;
    }
    /**
     * Get ctUrl
     *
     * @return string
     */
    public function getCtUrl()
    {
        return $this->ctUrl;
    }
    /**
     * Set cdNom
     *
     * @param string $cdNom
     *
     * @return taxrefLien
     */
    public function setCdNom($cdNom)
    {
        $this->cdNom = $cdNom;
        return $this;
    }
    /**
     * Get cdNom
     *
     * @return string
     */
    public function getCdNom()
    {
        return $this->cdNom;
    }
    /**
     * Set ctSpId
     *
     * @param string $ctSpId
     *
     * @return taxrefLien
     */
    public function setCtSpId($ctSpId)
    {
        $this->ctSpId = $ctSpId;
        return $this;
    }
    /**
     * Get ctSpId
     *
     * @return string
     */
    public function getCtSpId()
    {
        return $this->ctSpId;
    }
    /**
     * Set urlSp
     *
     * @param string $urlSp
     *
     * @return taxrefLien
     */
    public function seturlSp($urlSp)
    {
        $this->urlSp = $urlSp;
        return $this;
    }
    /**
     * Get urlSp
     *
     * @return string
     */
    public function geturlSp()
    {
        return $this->urlSp;
    }
}