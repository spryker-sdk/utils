<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace UtilsTest\Infrastructure\Helper;

use Generator;
use PHPUnit\Framework\TestCase;
use SprykerSdk\Utils\Infrastructure\Helper\StrHelper;

class StrHelperTest extends TestCase
{
    /**
     * @return \Generator
     */
    public function camelCaseToDashDataProvider(): Generator
    {
        $data = [
            ['test-foo-bar', 'testFooBar', true],
            ['test-foo-bar', 'testFooBar', false],
            ['test-foo-bar', 'TestFooBar', true],
            ['test-foo-bar', 'TestFooBar', false],
            ['test-foo-bar', 'test-Foo-Bar', true],
            ['test-foo-bar', 'test-Foo-Bar', false],
            ['test-foo-bar-abc-test', 'testFooBarABCTest', true],
            ['test-foo-bar-abctest', 'testFooBarABCTest', false],
        ];

        foreach ($data as $set) {
            yield $set;
        }
    }

    /**
     * @dataProvider camelCaseToDashDataProvider
     *
     * @param string $expResult
     * @param string $value
     * @param bool $separateAbbreviation
     *
     * @return void
     */
    public function testCamelCaseToDash(string $expResult, string $value, bool $separateAbbreviation): void
    {
        $this->assertSame($expResult, StrHelper::camelCaseToDash($value, $separateAbbreviation));
    }

    /**
     * @return \Generator
     */
    public function dashToCamelCaseDataProvider(): Generator
    {
        $data = [
            ['TestFooBar', 'test-foo-bar', true],
            ['testFooBar', 'test-foo-bar', false],
            ['TestFooBar', 'Test-foo-bar', false],
            ['TestFooBarAbcTest', 'test-foo-bar-abc-test', true],
            ['testFooBarAbctest', 'test-foo-bar-abctest', false],
            ['TestFooBarAbc123Test', 'test-foo-bar-abc123-test', true],
            ['TestFooBarAbc123Test', 'test-foo-bar-abc-123-test', true],
            ['TestFooBarAbc123test', 'test-foo-bar-abc-123test', true],
        ];

        foreach ($data as $set) {
            yield $set;
        }
    }

    /**
     * @dataProvider dashToCamelCaseDataProvider
     *
     * @param string $expResult
     * @param string $value
     * @param bool $upperCaseFirst
     *
     * @return void
     */
    public function testDashToCamelCase(string $expResult, string $value, bool $upperCaseFirst): void
    {
        $this->assertSame($expResult, StrHelper::dashToCamelCase($value, $upperCaseFirst));
    }
}