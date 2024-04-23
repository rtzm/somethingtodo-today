<?php

namespace App\Entity;

use App\Repository\PromptRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromptRepository::class)]
#[ORM\Index(name: "use_date_idx", columns: ["use_date"])]
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

    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE, nullable: false, insertable: false, updatable: false, options: ["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeInterface $created_timestamp = null;

    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE, nullable: false, insertable: false, updatable: false, options: ["default" => "CURRENT_TIMESTAMP"])]
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

    public function getUpdatedTimestamp(): ?\DateTimeInterface
    {
        return $this->updated_timestamp;
    }
}
