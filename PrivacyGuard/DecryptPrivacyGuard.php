<?php

namespace Alameda\Component\Encryption\PrivacyGuard;

use Alameda\Component\Encryption\Exception\ConfigurationException;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
class DecryptPrivacyGuard extends AbstractPrivacyGuard
{
    /**
     * @param string $fingerprint
     * @param string $password
     * @throws ConfigurationException
     */
    public function __construct($fingerprint, $password = null)
    {
        if (! $this->adddecryptkey($fingerprint, $password)) {
            throw ConfigurationException::failedToAddDecryptKey($fingerprint, $this->geterror());
        }

        $this->ability |= EncryptionAbility::DECRYPT;
    }
}
