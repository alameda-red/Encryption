<?php

namespace Alameda\Component\Encryption;

use Alameda\Component\Encryption\Exception\EncryptionException;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
interface DecrypterInterface
{
    /**
     * @param string $encrypted
     * @throws EncryptionException
     * @return string
     */
    public function decrypt($encrypted);
}
