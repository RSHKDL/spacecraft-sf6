<?php

namespace App\Spaceship;

use App\Spaceship\Enum\ConformityInspectionStatus;
use App\Spaceship\Model\ConformityInspectionReport;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class GithubService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly LoggerInterface $logger
    ) {}

    public function getConformityInspectionReport(string $spaceshipName): ConformityInspectionReport
    {
        $report = new ConformityInspectionReport();
        try {
            $response = $this->httpClient->request(
                method: 'GET',
                url: 'https://api.github.com/repos/RSHKDL/spacecraft-sf6/issues'
            );

            foreach ($response->toArray() as $issue) {
                if ($spaceshipName === $issue['title']) {
                    $status = $this->getConformityInspectionStatusFromLabels($issue['labels'], $spaceshipName);
                }

            }

        } catch (\Throwable $throwable) {
            $report->errorMessage = $throwable->getMessage();
            $this->logger->critical("An error occurred when attempting to retrieve a conformity inspection report", [
                'spaceship' => $spaceshipName,
                'exceptionMessage' => $throwable->getMessage()
            ]);
        }

        $report->spaceshipName = $spaceshipName;
        $report->status = $status ?? null;

        return $report;
    }

    private function getConformityInspectionStatusFromLabels(array $labels, string $spaceshipName): ConformityInspectionStatus
    {
        $labelName = null;
        foreach ($labels as $label) {
            // We only care about labels described as "demo"
            if ("For demo purpose" === $label['description']) {
                $labelName = $label['name'];
            }
        }

        if (null === $labelName) {
            throw new \RuntimeException("No valid status found for spaceship $spaceshipName");
        }

        $status = ConformityInspectionStatus::tryFrom($labelName);
        if (null === $status) {
            throw new \RuntimeException("$labelName is an unknown status for spaceship $spaceshipName");
        }

        return $status;
    }

}