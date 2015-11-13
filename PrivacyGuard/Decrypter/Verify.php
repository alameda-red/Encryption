<?php

namespace Alameda\Component\Encryption\PrivacyGuard\Decrypter;

use Alameda\Component\Encryption\DecrypterInterface;
use Alameda\Component\Encryption\PrivacyGuard\AbstractPrivacyGuard;
use Alameda\Component\Encryption\Exception\EncryptionException;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
class Verify implements DecrypterInterface
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
        $signature = null;

        $info = $this->gpg->verify($encrypted, false, $decrypted);

        if (! $info) {
            throw EncryptionException::notVerified($this->gpg->geterror());
        }

        return $decrypted;
    }

    /**
     * @return array
     */
    public function getSignature()
    {
        return $this->signature;
    }
}
