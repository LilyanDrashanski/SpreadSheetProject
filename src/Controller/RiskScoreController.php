<?php

namespace App\Controller;

use App\Dto\request\GetRiskScoreDto;
use App\Dto\request\PostRiskScoreDto;
use App\Entity\RiskScore;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RiskScoreController extends AbstractController
{
    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;

    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }

    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/riskScore/{id}', name: 'risk_score', methods: ['GET'])]
    public function getRiskScore(int $id): JsonResponse
    {
        $riskScore = $this->entityManager->getRepository(RiskScore::class)->findById($id);
        if ($riskScore === null) {
            return $this->json(['error' => 'Risk Score not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($riskScore);
    }

    #[Route('/riskScore/{cell}', name: 'risk_score', methods: ['POST'])]
    public function setRiskScore(Request $request, string $cell): JsonResponse
    {

        $dto = $this->serializer->deserialize($request->getContent(), PostRiskScoreDto::class, 'json');

        $user = $dto->getUserToken();

        //check if user exists
//        $this->client->request(
//            'GET',
//            'http://localhost:8000/naturalPerson/$user'
//        );

        $spreadsheet = IOFactory::load($dto->getSpreadSheet());

        $spreadsheet->getActiveSheet()->setCellValue($cell, $user);

        $writer = new Xls($spreadsheet);
        $writer->save($dto->getSpreadSheet());

        $riskScoreCell = 'G' . substr($cell, -1);
        $riskScore = $spreadsheet->getActiveSheet()->getCell($riskScoreCell)->getCalculatedValue();

        return $this->json($riskScore);
    }


    #[Route('/riskScore/{cell}', name: 'risk_score', methods: ['GET'])]
    public function getCellValue(Request $request, string $cell): JsonResponse
    {

        $dto = $this->serializer->deserialize($request->getContent(), GetRiskScoreDto::class, 'json');

        $spreadsheet = IOFactory::load($dto->getSpreadSheet());

        $cellValue = $spreadsheet->getActiveSheet()->getCell($cell)->getCalculatedValue();

        return $this->json($cellValue);
    }
}
