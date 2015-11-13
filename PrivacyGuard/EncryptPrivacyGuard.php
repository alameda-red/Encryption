<?php

namespace Alameda\Component\Encryption\PrivacyGuard;

use Alameda\Component\Encryption\Exception\ConfigurationException;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
class EncryptPrivacyGuard extends AbstractPrivacyGuard
{
    /**
     * @param string $fingerprint
     * @throws ConfigurationException
     */
    public function __construct($fingerprint)
    {
        $gpg = new \gnupg;

        if (! $gpg->addencryptkey($fingerprint)) {
            throw ConfigurationException::failedToAddEncryptKey($fingerprint, $gpg->geterror());
        }

        if (! $this->addencryptkey($fingerprint)) {
            throw ConfigurationException::failedToAddEncryptKey($fingerprint, $this->geterror());
        }

        $this->ability |= EncryptionAbility::ENCRYPT;
    }
}
