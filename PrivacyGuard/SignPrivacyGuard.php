<?php

namespace Alameda\Component\Encryption\PrivacyGuard;

use Alameda\Component\Encryption\Exception\ConfigurationException;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
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
