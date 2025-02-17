<?php

namespace App\Entity;

use App\Repository\CharacterOrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterOrderRepository::class)]
class CharacterOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nick = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contacts = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $health = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $food = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $psychological = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $want = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $nowant = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $other = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(?string $nick): static
    {
        $this->nick = $nick;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getContacts(): ?string
    {
        return $this->contacts;
    }

    public function setContacts(string $contacts): static
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getHealth(): ?string
    {
        return $this->health;
    }

    public function setHealth(string $health): static
    {
        $this->health = $health;

        return $this;
    }

    public function getFood(): ?string
    {
        return $this->food;
    }

    public function setFood(string $food): static
    {
        $this->food = $food;

        return $this;
    }

    public function getPsychological(): ?string
    {
        return $this->psychological;
    }

    public function setPsychological(?string $psychological): static
    {
        $this->psychological = $psychological;

        return $this;
    }

    public function getWant(): ?string
    {
        return $this->want;
    }

    public function setWant(?string $want): static
    {
        $this->want = $want;

        return $this;
    }

    public function getNowant(): ?string
    {
        return $this->nowant;
    }

    public function setNowant(?string $nowant): static
    {
        $this->nowant = $nowant;

        return $this;
    }

    public function getOther(): ?string
    {
        return $this->other;
    }

    public function setOther(?string $other): static
    {
        $this->other = $other;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): static
    {
        $this->role = $role;

        return $this;
    }
}
