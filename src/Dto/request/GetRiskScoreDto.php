<?php

namespace App\Dto\request;

class GetRiskScoreDto
{

    private string $spreadSheet;


    public function getSpreadSheet(): string
    {
        return $this->spreadSheet;
    }

    public function setSpreadSheet(string $spreadSheet): void
    {
        $this->spreadSheet = $spreadSheet;
    }

}