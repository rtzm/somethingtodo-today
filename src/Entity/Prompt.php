<?php

namespace App\Entity;

use App\Repository\PromptRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromptRepository::class)]
class Prompt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $use_date = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTimeInterface $created_timestamp = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTimeInterface $updated_timestamp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getUseDate(): ?\DateTimeInterface
    {
        return $this->use_date;
    }

    public function setUseDate(?\DateTimeInterface $use_date): static
    {
        $this->use_date = $use_date;

        return $this;
    }

    public function getCreatedTimestamp(): ?\DateTimeInterface
    {
        return $this->created_timestamp;
    }

    public function setCreatedTimestamp(\DateTimeInterface $created_timestamp): static
    {
        $this->created_timestamp = $created_timestamp;

        return $this;
    }

    public function getUpdatedTimestamp(): ?\DateTimeInterface
    {
        return $this->updated_timestamp;
    }

    public function setUpdatedTimestamp(\DateTimeInterface $updated_timestamp): static
    {
        $this->updated_timestamp = $updated_timestamp;

        return $this;
    }
}
