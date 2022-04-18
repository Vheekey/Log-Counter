<?php

namespace App\Controller;

use App\Entity\LogFile;
use App\Message\UploadLogFile;
use App\Repository\LogFileRepository;
use App\Service\TextFileHandler;
use App\Service\UploadFile;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Routing\Annotation\Route;

class CountController extends AbstractController
{

    
    /**
     * Search logs by passing request parameters
     *
     * @param Request $request
     * @param LogFileRepository $logFileRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    #[Route('/count', name: 'app_count')]
    public function index(Request $request, LogFileRepository $logFileRepository)
    {
        $statusCode = $request->query->get('statusCode');
        $serviceNames = $request->query->get('serviceNames');
        $startDate = $request->query->get('startDate');
        $endDate = $request->query->get('endDate');

        $query = $logFileRepository->createQueryBuilder('q')
            ->select('q.statusCode', 'q.serviceName', 'q.date', 'q.endpoint', 'q.method');

        if($statusCode){
            $query->andWhere('q.statusCode='.$statusCode);
        }

        if($serviceNames){
            $query->andWhere('q.serviceName= :requestServiceName')
            ->setParameter('requestServiceName', trim($serviceNames));
        }

        if($startDate && $endDate){
            $query->andWhere('q.date BETWEEN :from AND :to')
                ->setParameter('from', $startDate.' 00:00:00')
                ->setParameter('to', $endDate.' 12:59:59');
        }

        $data = $query->getQuery()->getResult();

        return new JsonResponse($data, 200, ["Content-Type" => "application/json"]);
    }
}
