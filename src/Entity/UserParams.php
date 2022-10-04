<?php

namespace App\Entity;

use App\Repository\UserParamsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserParamsRepository::class)]
class UserParams
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1)]
    private ?string $sex = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\OneToOne(mappedBy: 'user_params', cascade: ['persist', 'remove'])]
    private ?User $id_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        // unset the owning side of the relation if necessary
        if ($id_user === null && $this->id_user !== null) {
            $this->id_user->setUserParams(null);
        }

        // set the owning side of the relation if necessary
        if ($id_user !== null && $id_user->getUserParams() !== $this) {
            $id_user->setUserParams($this);
        }

        $this->id_user = $id_user;

        return $this;
    }
}
