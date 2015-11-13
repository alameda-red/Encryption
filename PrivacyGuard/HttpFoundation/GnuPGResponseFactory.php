<?php

namespace Alameda\Component\Encryption\PrivacyGuard\HttpFoundation;

use Alameda\Component\Encryption\Exception\EncryptionException;
use Alameda\Component\Encryption\PrivacyGuard\EncryptionAbility;
use Alameda\Component\Encryption\Security\GnuPGUserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Bundle\EncryptionBundle
 */
class GnuPGResponseFactory
{
    /** @var SecurityContextInterface */
    private $sc;

    /** @var \gnupg */
    private $gpg;

    /** @var int */
    private $ability = EncryptionAbility::NONE;

    /**
     * @param SecurityContextInterface $sc
     * @param string $gnupgDir
     * @param string $serverEncryptKey
     * @param string $serverSignKey
     */
    public function __construct(
        SecurityContextInterface $sc,
        $gnupgDir,
        $serverEncryptKey = null,
        $serverSignKey = null
    ) {
        putenv(sprintf('GNUPGHOME=%s', $gnupgDir));

        $this->sc = $sc;

        $this->init($serverEncryptKey, $serverSignKey);
    }

    /**
     * @param string $content
     * @param integer $status
     * @param array $headers
     * @return GnuPG\EncryptedSignedResponse
     */
    public function create($content, $status = 200, $headers = [])
    {
        if ($this->ability & EncryptionAbility::ENCRYPT &&
            $this->ability & EncryptionAbility::SIGN
        ) {
            return $this->encryptsign($content, $status, $headers);
        }

        if ($this->ability & EncryptionAbility::ENCRYPT) {
            return $this->encrypt($content, $status, $headers);
        }

        return $this->sign($content, $status, $headers);
    }

    /**
     * @param string $content
     * @param integer $status
     * @param array $headers
     * @return GnuPG\EncryptedSignedResponse
     */
    public function encryptsign($content, $status = 200, $headers = [])
    {
        return new GnuPG\EncryptedSignedResponse(
            $this->gpg->encryptsign($content),
            $status,
            $headers
        );
    }

    /**
     * @param string $content
     * @param integer $status
     * @param array $headers
     * @return GnuPG\EncryptedSignedResponse
     */
    public function encrypt($content, $status = 200, $headers = [])
    {
        return new GnuPG\EncryptedSignedResponse(
            $this->gpg->encrypt($content),
            $status,
            $headers
        );
    }

    /**
     * @param string $content
     * @param integer $status
     * @param array $headers
     * @return GnuPG\EncryptedSignedResponse
     */
    public function sign($content, $status = 200, $headers = [])
    {
        return new GnuPG\EncryptedSignedResponse(
            $this->gpg->sign($content),
            $status,
            $headers
        );
    }

    /**
     * @param string $serverEncryptKey
     * @param string $serverSignKey
     * @throws EncryptionException
     */
    private function init($serverEncryptKey = null, $serverSignKey = null)
    {
        $token = $this->sc->getToken();

        if ($token instanceof TokenInterface &&
            $token->getUser() instanceof GnuPGUserInterface
        ) {
            $encryptKey = ($token->getUser()->getPublicGnuPGKeyFingerprint()) ?: $serverEncryptKey;
            $signKey = ($token->getUser()->getPublicSignGnuPGKeyFingerprint()) ?: $serverSignKey;
        } else {
            $encryptKey = $serverEncryptKey;
            $signKey = $serverSignKey;
        }

        $this->gpg = new \gnupg();

        if (! is_null($encryptKey)) {
            $this->gpg->addencryptkey($encryptKey);

            $this->ability |= EncryptionAbility::ENCRYPT;
        }

        if (! is_null($signKey)) {
            $this->gpg->addsignkey($signKey);

            $this->ability |= EncryptionAbility::SIGN;
        }

        if (EncryptionAbility::NONE === $this->ability) {
            throw EncryptionException::missingConfiguration();
        }
    }
}
