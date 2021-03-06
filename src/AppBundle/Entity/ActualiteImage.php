<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ActualiteImage
 *
 * @ORM\Table(name="ActualiteImage")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActualiteImageRepository")
 */
class ActualiteImage
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
     * @Assert\File(
     *     maxSize="5120k",
     *     maxSizeMessage="5 Mo maximum par fichier",
     *     mimeTypes={"image/*"},
     *     mimeTypesMessage="Seulement les images")
     **/
    private $imageFile;
    /**
     * @var string
     *
     * @ORM\Column(name="imageName", type="string", length=255)
     */
    private $imageName;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uploadDate", type="datetime")
     */
    private $uploadDate;
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
     * Set actualite
     *
     * @param string $actualite
     *
     * @return ActualiteImage
     */
    public function setActualite($actualite)
    {
        $this->actualite = $actualite;
        return $this;
    }
    /**
     * Get actualite
     *
     * @return string
     */
    public function getActualite()
    {
        return $this->actualite;
    }
    /**
     * Set imageFile
     *
     * @param string $imageFile
     *
     * @return ActualiteImage
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
        return $this;
    }
    /**
     * Get imageFile
     *
     * @return string
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return ActualiteImage
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
        return $this;
    }
    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }
    /**
     * Set uploadDate
     *
     * @param \DateTime $uploadDate
     *
     * @return ActualiteImage
     */
    public function setUploadDate($uploadDate)
    {
        $this->uploadDate = $uploadDate;
        return $this;
    }
    /**
     * Get uploadDate
     *
     * @return \DateTime
     */
    public function getUploadDate()
    {
        return $this->uploadDate;
    }
}
