<?php

namespace Unit\Spaceship;

use App\Spaceship\Enum\ConformityInspectionStatus;
use App\Spaceship\GithubService;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class GithubServiceTest extends TestCase
{
    /**
     * @dataProvider spaceshipWithStatusProvider
     */
    public function testConformityStatusReportReturnCorrectConformityStatus(
        ConformityInspectionStatus $expectedStatus,
        string $spaceshipName
    ): void
    {
        $mockLogger = $this->createMock(LoggerInterface::class);
        $mockHttpClient = $this->createMock(HttpClientInterface::class);
        $mockResponse = $this->createMock(ResponseInterface::class);
        $mockResponse
            ->method('toArray')
            ->willReturn([
                [
                    'title' => 'Rocinante',
                    'labels' => [['name' => 'rejected', 'description' => 'For demo purpose']],
                ],
                [
                    'title' => 'Serenity',
                    'labels' => [['name' => 'approved', 'description' => 'For demo purpose']],
                ],
            ]);
        $mockHttpClient
            ->expects(self::once())
            ->method('request')
            ->with('GET', 'https://api.github.com/repos/RSHKDL/spacecraft-sf6/issues')
            ->willReturn($mockResponse);

        $service = new GithubService($mockHttpClient, $mockLogger);
        $report = $service->getConformityInspectionReport($spaceshipName);

        self::assertSame($expectedStatus, $report->status);
    }

    public function spaceshipWithStatusProvider(): \Generator
    {
        yield 'Rejected spaceship' => [ConformityInspectionStatus::REJECTED, 'Rocinante'];
        yield 'Approved spaceship' => [ConformityInspectionStatus::APPROVED, 'Serenity'];
    }

    /**
     * @dataProvider spaceshipWithUnprocessableStatusProvider
     */
    public function testReportsAreHandledEvenWithUnprocessableStatus(
        string $spaceshipName,
        string $expectedMessage
    ): void
    {
        $mockLogger = $this->createMock(LoggerInterface::class);
        $mockHttpClient = $this->createMock(HttpClientInterface::class);
        $mockResponse = $this->createMock(ResponseInterface::class);
        $mockResponse
            ->method('toArray')
            ->willReturn([
                [
                    'title' => 'Rocinante',
                    'labels' => [],
                ],
                [
                    'title' => 'Serenity',
                    'labels' => [['name' => 'approved', 'description' => 'wrong description']],
                ],
                [
                    'title' => 'Galactica',
                    'labels' => [['name' => 'unknown name', 'description' => 'For demo purpose']],
                ],
            ]);
        $mockHttpClient
            ->method('request')
            ->willReturn($mockResponse);

        $service = new GithubService($mockHttpClient, $mockLogger);
        $report = $service->getConformityInspectionReport($spaceshipName);
        self::assertNotNull($report->errorMessage);
        self::assertSame($expectedMessage, $report->errorMessage);
    }

    public function spaceshipWithUnprocessableStatusProvider(): \Generator
    {
        yield 'Case: No label' => [
            'Rocinante',
            'No valid status found for spaceship Rocinante'
        ];
        yield 'Case: Wrong label description' => [
            'Serenity',
            'No valid status found for spaceship Serenity'
        ];
        yield 'Case: Unknown label name' => [
            'Galactica',
            'unknown name is an unknown status for spaceship Galactica'
        ];
    }

    /*
 * @see https://stackoverflow.com/questions/5683592/phpunit-assert-that-an-exception-was-thrown
 * Unlike errors, exceptions don't have a capability to recover from them and make PHP continue code
 * execution as if there was no exception at all. Therefore, PHPUnit does not even reach the statement
 * $this->expectException() if it was preceded by throw new \ExceptionToExpect().
 * Moreover, PHPUnit will never be able to reach that place, no matter its exception catching capabilities.
 * In conclusion, any of the PHPUnit's exception testing methods must be placed before a code where an exception
 * is expected to be thrown in contrary to an assertion that is placed after an actual value is set.
 * $this->expectException(\RuntimeException::class);
 */
}