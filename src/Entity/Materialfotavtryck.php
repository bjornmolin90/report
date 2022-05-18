<?php

namespace App\Entity;

use App\Repository\MaterialfotavtryckRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialfotavtryckRepository::class)]
class Materialfotavtryck
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $artal;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $total;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $percapita;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $perbnp;

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

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getPercapita(): ?int
    {
        return $this->percapita;
    }

    public function setPercapita(?int $percapita): self
    {
        $this->percapita = $percapita;

        return $this;
    }

    public function getPerbnp(): ?int
    {
        return $this->perbnp;
    }

    public function setPerbnp(?int $perbnp): self
    {
        $this->perbnp = $perbnp;

        return $this;
    }
}
