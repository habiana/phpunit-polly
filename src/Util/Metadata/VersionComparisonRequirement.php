<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Util\Metadata;

use function version_compare;
use PHPUnit\Util\VersionComparisonOperator;

/**
 * @psalm-immutable
 *
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class VersionComparisonRequirement extends VersionRequirement
{
    private string $version;

    private VersionComparisonOperator $operator;

    public function __construct(string $version, VersionComparisonOperator $operator)
    {
        $this->version  = $version;
        $this->operator = $operator;
    }

    public function isSatisfiedBy(string $version): bool
    {
        return version_compare($version, $this->version, $this->operator->asString());
    }

    public function version(): string
    {
        return $this->version;
    }

    public function operator(): VersionComparisonOperator
    {
        return $this->operator;
    }
}
