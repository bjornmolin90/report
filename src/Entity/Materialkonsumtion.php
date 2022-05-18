<?php

namespace App\Entity;

use App\Repository\MaterialkonsumtionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialkonsumtionRepository::class)]
class Materialkonsumtion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $artal;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $inhemsk;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $import;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $export;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtal(): ?int
    {
        return $this->artal;
    }

    public function setArtal(int $artal): self
    {
        $this->artal = $artal;

        return $this;
    }

    public function getInhemsk(): ?int
    {
        return $this->inhemsk;
    }

    public function setInhemsk(?int $inhemsk): self
    {
        $this->inhemsk = $inhemsk;

        return $this;
    }

    public function getImport(): ?int
    {
        return $this->import;
    }

    public function setImport(?int $import): self
    {
        $this->import = $import;

        return $this;
    }

    public function getExport(): ?int
    {
        return $this->export;
    }

    public function setExport(?int $export): self
    {
        $this->export = $export;

        return $this;
    }
}
