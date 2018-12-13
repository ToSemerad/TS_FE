<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class File
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="files")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Musíte nahrát soubor s článkem (PDF nebo doc(x))")
     * @Assert\File(mimeTypes={"application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"})
     */
    private $file;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile()
    {
        return $this->file;
    }


    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime("now");
    }

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }

}
