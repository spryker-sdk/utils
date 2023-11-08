<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace UtilsTest\Infrastructure\Service;

use PHPUnit\Framework\TestCase;
use SprykerSdk\Utils\Infrastructure\Service\FinderFactory;
use Symfony\Component\Finder\Finder;

class FinderFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreateFinderShouldCreateFinder(): void
    {
        // Arrange
        $finderFactory = new FinderFactory();

        // Act
        $finder = $finderFactory->createFinder();

        // Assert
        $this->assertInstanceOf(Finder::class, $finder);
    }
}
