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

use PharIo\Version\Version;
use PharIo\Version\VersionConstraint;

/**
 * @psalm-immutable
 *
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class VersionConstraintRequirement extends VersionRequirement
{
    private VersionConstraint $constraint;

    public function __construct(VersionConstraint $constraint)
    {
        $this->constraint = $constraint;
    }

    /**
     * @psalm-suppress ImpureMethodCall
     */
    public function isSatisfiedBy(string $version): bool
    {
        return $this->constraint->complies(
            new Version($this->sanitize($version))
        );
    }

    public function constraint(): VersionConstraint
    {
        return $this->constraint;
    }

    private function sanitize(string $version): string
    {
        return preg_replace(
            '/^(\d+\.\d+(?:.\d+)?).*$/',
            '$1',
            $version
        );
    }
}
