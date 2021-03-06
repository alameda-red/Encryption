<?php

namespace Alameda\Component\Encryption\PrivacyGuard\Encrypter;

use Alameda\Component\Encryption\EncrypterInterface;
use Alameda\Component\Encryption\PrivacyGuard\AbstractPrivacyGuard;
use Alameda\Component\Encryption\Exception\EncryptionException;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
class EncryptSign implements EncrypterInterface
{
    /** @var AbstractPrivacyGuard */
    private $gpg;

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
    public function encrypt($unencrypted)
    {
        $encrypted = $this->gpg->encryptsign($unencrypted);

        if (! $encrypted) {
            throw EncryptionException::notEncrypted($this->gpg->geterror());
        }

        return $encrypted;
    }
}
