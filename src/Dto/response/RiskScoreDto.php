<?php

namespace App\Dto\response;

class RiskScoreDto
{
    private string $riskScore;

    public function getRiskScore(): string
    {
        return $this->riskScore;
    }

    public function setRiskScore(string $riskScore): void
    {
        $this->riskScore = $riskScore;
    }
}