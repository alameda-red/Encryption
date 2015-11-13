<?php

namespace Alameda\Component\Encryption\PrivacyGuard\Decrypter;

use Alameda\Component\Encryption\PrivacyGuard\AuthorizedSignatureInterface;
use Alameda\Component\Encryption\DecrypterInterface;
use Alameda\Component\Encryption\PrivacyGuard\AbstractPrivacyGuard;
use Alameda\Component\Encryption\Exception\EncryptionException;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
class DecryptVerify implements DecrypterInterface, AuthorizedSignatureInterface
{
    /** @var AbstractPrivacyGuard */
    private $gpg;

    /** @var array */
    private $signature = false;

    /**
     * @param AbstractPrivacyGuard $gpg
     */
    public function __construct(AbstractPrivacyGuard $gpg)
    {
        $this->gpg = $gpg;
    }

    /**
     * @inheritdoc
     */
    public function decrypt($encrypted)
    {
        $decrypted = '';

        $this->signature = $this->gpg->decryptverify($encrypted, false, $decrypted);

        if (! $decrypted || ! $this->signature) {
            throw EncryptionException::notDecryptedAndVerified($this->gpg->geterror());
        }

        return $decrypted;
    }

    /**
     * @inheritdoc
     */
    public function getSignature()
    {
        return $this->signature;
    }
}
