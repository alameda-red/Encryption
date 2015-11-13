<?php

namespace Alameda\Component\Encryption;

use Alameda\Component\Encryption\Exception\EncryptionException;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
interface EncrypterInterface
{
    /**
     * @param string $unencrypted
     * @throws EncryptionException
     * @return string
     */
    public function encrypt($unencrypted);
}
