<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerSdk\Utils\Infrastructure\Service;

use Symfony\Component\Process\Process;

interface ProcessRunnerServiceInterface
{
    /**
     * @var float
     */
    public const DEFAULT_PROCESS_TIMEOUT = 900.0;

    /**
     * @param array<string> $command
     * @param array<mixed> $env
     * @param string|null $cwd
     * @param mixed $input
     * @param float|null $timeout
     *
     * @return \Symfony\Component\Process\Process
     */
    public function run(
        array $command,
        array $env = [],
        ?string $cwd = null,
        $input = null,
        ?float $timeout = self::DEFAULT_PROCESS_TIMEOUT
    ): Process;

    /**
     * @param string $command
     * @param string|null $cwd
     * @param array<mixed>|null $env
     * @param mixed $input
     * @param float|null $timeout
     *
     * @return \Symfony\Component\Process\Process
     */
    public function runFromCommandLine(
        string $command,
        ?string $cwd = null,
        ?array $env = null,
        $input = null,
        ?float $timeout = self::DEFAULT_PROCESS_TIMEOUT
    ): Process;

    /**
     * @param string $command
     * @param string|null $cwd
     * @param array<mixed>|null $env
     * @param mixed $input
     * @param float|null $timeout
     *
     * @return \Symfony\Component\Process\Process
     */
    public function mustRunFromCommandLine(
        string $command,
        ?string $cwd = null,
        ?array $env = null,
        $input = null,
        ?float $timeout = self::DEFAULT_PROCESS_TIMEOUT
    ): Process;

    /**
     * @param array<mixed> $command
     * @param string|null $cwd
     * @param array<mixed>|null $env
     * @param mixed $input
     * @param float|null $timeout
     *
     * @return \Symfony\Component\Process\Process
     */
    public function mustRun(
        array $command,
        ?string $cwd = null,
        ?array $env = null,
        $input = null,
        ?float $timeout = self::DEFAULT_PROCESS_TIMEOUT
    ): Process;
}
