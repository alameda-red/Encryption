<?php

namespace Alameda\Component\Encryption\PrivacyGuard;

/**
 * Class PrivacyGuard
 * @package Alameda\Component\Encryption
 */
abstract class AbstractPrivacyGuard extends \gnupg
{
    /** @var integer */
    protected $ability = EncryptionAbility::NONE;
}
