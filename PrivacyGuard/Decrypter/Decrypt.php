<?php

namespace Alameda\Component\Encryption\PrivacyGuard\Decrypter;

use Alameda\Component\Encryption\DecrypterInterface;
use Alameda\Component\Encryption\PrivacyGuard\AbstractPrivacyGuard;
use Alameda\Component\Encryption\Exception\EncryptionException;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
class Decrypt implements DecrypterInterface
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
    public function decrypt($encrypted)
    {
        $decrypted = $this->gpg->decrypt($encrypted);

        if (! $decrypted) {
            throw EncryptionException::notDecrypted($this->gpg->geterror());
        }

        return $decrypted;
    }
}
