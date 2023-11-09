<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerSdk\Utils\Infrastructure\Helper;

use Laminas\Filter\FilterChain;
use Laminas\Filter\StringToLower;
use Laminas\Filter\Word\CamelCaseToDash;
use Laminas\Filter\Word\DashToCamelCase;
use SprykerSdk\Utils\Infrastructure\Helper\Filter\CamelCaseToDash as CamelCaseToDashWithoutAbbreviation;

class StrHelper
{
    /**
     * @param string $value
     * @param bool $separateAbbreviation
     *
     * @return string
     */
    public static function camelCaseToDash(string $value, bool $separateAbbreviation = true): string
    {
        $filterChain = new FilterChain();

        $camelCaseToDashFilter = $separateAbbreviation
            ? new CamelCaseToDash()
            : new CamelCaseToDashWithoutAbbreviation();

        $filterChain->attach($camelCaseToDashFilter);
        $filterChain->attach(new StringToLower());

        return $filterChain->filter($value);
    }

    /**
     * @param string $value
     * @param bool $upperCaseFirst
     *
     * @return string
     */
    public static function dashToCamelCase(string $value, bool $upperCaseFirst = true): string
    {
        $filterChain = new FilterChain();
        $filterChain->attach(new DashToCamelCase());
        $filterResult = $filterChain->filter($value);

        if ($upperCaseFirst) {
            return ucfirst($filterResult);
        }

        // Set first character in original case
        return mb_substr($value, 0, 1) . mb_substr($filterResult, 1);
    }

    /**
     * Spryker.SymfonyMailer => spryker/symfony-mailer
     *
     * @param string $originName
     *
     * @return string
     */
    public static function packageCamelCaseToDash(string $originName): string
    {
        [$organization, $package] = explode('.', $originName);

        return implode('/', [
            static::camelCaseToDash($organization),
            static::camelCaseToDash($package),
        ]);
    }
}
