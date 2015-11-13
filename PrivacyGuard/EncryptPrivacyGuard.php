<?php

namespace Alameda\Component\Encryption\PrivacyGuard;

use Alameda\Component\Encryption\Exception\ConfigurationException;

class EncryptPrivacyGuard extends AbstractPrivacyGuard
{
    /**
     * @param string $fingerprint
     * @throws ConfigurationException
     */
    public function __construct($fingerprint)
    {
        #putenv('GNUPGHOME=/home/sf/.gnupg');
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
