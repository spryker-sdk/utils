<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerSdk\Utils\Infrastructure\Helper;

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
        if (ctype_lower($value)) {
            return $value;
        }

        $pattern = '/([a-z])([A-Z])/';
        $replacement = '$1' . addcslashes('-', '$') . '$2';
        if ($separateAbbreviation) {
            $pattern = ['#(?<=(?:[A-Z]))([A-Z]+)([A-Z][a-z])#', '#(?<=(?:[a-z0-9]))([A-Z])#'];
            $replacement = ['\1-\2', '-\1'];
        }

        $value = (string)preg_replace($pattern, $replacement, $value);

        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * @param string $value
     * @param bool $upperCaseFirst
     *
     * @return string
     */
    public static function dashToCamelCase(string $value, bool $upperCaseFirst = true): string
    {
        $isFirstCharUpper = $value === ucfirst($value);

        $value = str_replace(' ', '', ucwords(str_replace('-', ' ', $value)));
        if ($upperCaseFirst) {
            return ucfirst($value);
        }

        return $isFirstCharUpper ? ucfirst($value) : lcfirst($value);
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
