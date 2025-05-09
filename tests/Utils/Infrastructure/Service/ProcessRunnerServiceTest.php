<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerSdk\UtilsTest\Infrastructure\Service;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use SprykerSdk\Utils\Infrastructure\Service\ProcessRunnerService;
use Symfony\Component\Process\Process;

class ProcessRunnerServiceTest extends TestCase
{
    /**
     * @dataProvider commandDataProvider
     *
     * @param array<string> $command
     *
     * @return void
     */
    public function testRunReturnsProcessObject(array $command): void
    {
        $service = $this->createProcessRunnerService();

        $process = $service->run($command);

        $this->assertInstanceOf(Process::class, $process);
    }

    /**
     * @return array<int, array>
     */
    public static function commandDataProvider(): array
    {
        return [
            [['ls']],
            [['echo', 'Hello, World!']],
            [['git', 'log']],
        ];
    }

    /**
     * @return void
     */
    public function testMustRunFromCommandLineShouldReturnProcessObject(): void
    {
        $service = $this->createProcessRunnerService();

        $process = $service->mustRunFromCommandLine('ls');

        $this->assertInstanceOf(Process::class, $process);
        $this->assertSame(0, $process->getExitCode());
    }

    /**
     * @return void
     */
    public function testRunShellCommandShouldReturnProcessObject(): void
    {
        $service = $this->createProcessRunnerService();

        $process = $service->runFromCommandLine('ls');

        $this->assertInstanceOf(Process::class, $process);
        $this->assertSame(0, $process->getExitCode());
    }

    /**
     * @return void
     */
    public function testRunShellCommandWithoutLogger(): void
    {
        $service = new ProcessRunnerService();

        $process = $service->run(['ls']);

        $this->assertInstanceOf(Process::class, $process);
        $this->assertSame(0, $process->getExitCode());
    }

    /**
     * @return \SprykerSdk\Utils\Infrastructure\Service\ProcessRunnerService
     */
    protected function createProcessRunnerService(): ProcessRunnerService
    {
        return new ProcessRunnerService($this->createMock(LoggerInterface::class));
    }
}
