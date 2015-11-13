<?php

namespace Alameda\Component\Encryption\PrivacyGuard;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
final class EncryptionAbility
{
    /** @var integer */
    const NONE = 0;

    /** @var integer */
    const SIGN = 1;

    /** @var integer */
    const ENCRYPT = 2;

    /** @var integer */
    const DECRYPT = 4;

    /** @var integer */
    const VERIFY = 8;

    /**
     * @param integer $value
     * @param integer|integer[] $flags
     * @return bool
     */
    public static function hasFlags($value, $flags)
    {
        if (! is_array($flags)) {
            $flags = [$flags];
        }

        foreach ($flags as $flag) {
            if (($value & $flag) !== $flag) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $ability
     * @throws \UnexpectedValueException
     * @return integer
     */
    public static function fromString($ability)
    {
        $value = constant(self::class .'::'. strtoupper($ability));

        if (is_null($value)) {
            throw new \UnexpectedValueException('Could not find requested constant.');
        }

        return $value;
    }

    /**
     * @param integer $ability
     * @return string[]
     */
    public static function toString($ability)
    {
        $configuredAbility = [];

        if ($ability & self::NONE) {
            $configuredAbility[] = 'none';
        }

        if ($ability & self::SIGN) {
            $configuredAbility[] = 'sign';
        }

        if ($ability & self::ENCRYPT) {
            $configuredAbility[] = 'encrypt';
        }

        if ($ability & self::DECRYPT) {
            $configuredAbility[] = 'decrypt';
        }

        if ($ability & self::VERIFY) {
            $configuredAbility[] = 'verify';
        }

        return $configuredAbility;
    }
}
