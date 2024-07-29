<?php

namespace App\Dto\request;

class PostRiskScoreDto
{

    private string $userToken;
    private string $spreadSheet;

    public function getUserToken(): string
    {
        return $this->userToken;
    }

    public function setUserToken(string $userToken): void
    {
        $this->userToken = $userToken;
    }

    public function getSpreadSheet(): string
    {
        return $this->spreadSheet;
    }

    public function setSpreadSheet(string $spreadSheet): void
    {
        $this->spreadSheet = $spreadSheet;
    }

}