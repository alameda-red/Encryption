<?php

namespace Alameda\Component\Encryption\PrivacyGuard;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
interface AuthorizedSignatureInterface
{
    /**
     * @return array
     */
    public function getSignature();
}
