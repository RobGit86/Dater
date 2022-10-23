<?php

namespace App\Entity;

use App\Repository\GalleryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GalleryRepository::class)]
class Gallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column(length: 255)]
    private ?string $filepath = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $create_date = null;

    #[ORM\Column]
    private ?bool $profile = null;

    #[ORM\ManyToOne(inversedBy: 'gallery')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UserParams $user_params = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getFilepath(): ?string
    {
        return $this->filepath;
    }

    public function setFilepath(string $filepath): self
    {
        $this->filepath = $filepath;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->create_date;
    }

    public function setCreateDate(\DateTimeInterface $create_date): self
    {
        $this->create_date = $create_date;

        return $this;
    }

    public function isProfile(): ?bool
    {
        return $this->profile;
    }

    public function setProfile(bool $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getUserParams(): ?UserParams
    {
        return $this->user_params;
    }

    public function setUserParams(?UserParams $user_params): self
    {
        $this->user_params = $user_params;

        return $this;
    }
}
