<?php

namespace Alameda\Component\Encryption\PrivacyGuard;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
class PrivacyGuardFactory
{
    /**
     * @param string $libDir
     */
    public function __construct($libDir)
    {
        putenv(sprintf('GNUPGHOME=%s', $libDir));
    }

    /**
     * @param integer $ability
     * @param string $fingerprint
     * @param string $password
     * @return AbstractPrivacyGuard
     */
    public function createPrivacyGuardDecrypter($ability, $fingerprint, $password = null)
    {
        if (EncryptionAbility::hasFlags($ability, [EncryptionAbility::DECRYPT, EncryptionAbility::VERIFY])) {
            return new DecryptVerifyPrivacyGuard($fingerprint, $password);
        } elseif (EncryptionAbility::hasFlags($ability, EncryptionAbility::DECRYPT)) {
            return new DecryptPrivacyGuard($fingerprint, $password);
        } elseif (EncryptionAbility::hasFlags($ability, EncryptionAbility::VERIFY)) {
            return new VerifyPrivacyGuard($fingerprint, $password);
        } else {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * @param integer $ability
     * @param string $fingerprint
     * @return AbstractPrivacyGuard
     */
    public function createPrivacyGuardEncrypter($ability, $fingerprint)
    {
        if (EncryptionAbility::hasFlags($ability, [EncryptionAbility::ENCRYPT, EncryptionAbility::SIGN])) {
            return new EncryptSignPrivacyGuard($fingerprint);
        } elseif (EncryptionAbility::hasFlags($ability, EncryptionAbility::ENCRYPT)) {
            return new EncryptPrivacyGuard($fingerprint);
        } elseif (EncryptionAbility::hasFlags($ability, EncryptionAbility::SIGN)) {
            return new SignPrivacyGuard($fingerprint);
        } else {
            throw new \InvalidArgumentException();
        }
    }
}
