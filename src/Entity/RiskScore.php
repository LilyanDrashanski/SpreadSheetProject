<?php

namespace App\Entity;

use App\Repository\RiskScoreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RiskScoreRepository::class)]
class RiskScore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $riskScore = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getRiskScore(): ?int
    {
        return $this->riskScore;
    }

    public function setRiskScore(int $riskScore): static
    {
        $this->riskScore = $riskScore;

        return $this;
    }
}
