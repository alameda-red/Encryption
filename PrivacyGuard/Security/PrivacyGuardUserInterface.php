<?php

namespace Alameda\Component\Encryption\PrivacyGuard\Security;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
interface PrivacyGuardUserInterface extends UserInterface
{
    /**
     * @return string
     */
    public function getPublicGnuPGKeyFingerprint();
}
