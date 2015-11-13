<?php

namespace Alameda\Component\Encryption\PrivacyGuard;

use Alameda\Component\Encryption\Exception\ConfigurationException;

class SignPrivacyGuard extends AbstractPrivacyGuard
{
    /**
     * @param string $fingerprint
     * @throws ConfigurationException
     */
    public function __construct($fingerprint)
    {
        if (! $this->addsignkey($fingerprint)) {
            throw ConfigurationException::failedToAddSignKey($fingerprint, $this->geterror());
        }

        $this->ability |= EncryptionAbility::SIGN;
    }
}
