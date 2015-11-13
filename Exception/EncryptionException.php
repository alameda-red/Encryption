<?php

namespace Alameda\Component\Encryption\Exception;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
class EncryptionException extends \Exception
{
    /** @var integer */
    const MISSING_CONFIGURATION = 1;

    /** @var integer */
    const NOT_ENCRYPTED = 2;

    /** @var integer */
    const NOT_DECRYPTED = 4;

    /** @var integer */
    const NOT_VERIFIED = 8;

    /** @var integer */
    const NOT_DECRYPTED_AND_VERIFIED = 16;

    /**
     * @param \Exception|null $previous
     * @return EncryptionException
     */
    public static function missingConfiguration(\Exception $previous = null)
    {
        return new self(
            'Unable to encrypt/sign due to missing configuration parameters',
            self::MISSING_CONFIGURATION,
            $previous
        );
    }

    /**
     * @param string $gpgError
     * @param \Exception|null $previous
     * @return EncryptionException
     */
    public static function notEncrypted($gpgError, \Exception $previous = null)
    {
        return new self(
            sprintf(
                'Unable to encrypt/sign. GPG error: %s.',
                $gpgError
            ),
            self::NOT_ENCRYPTED,
            $previous
        );
    }

    /**
     * @param string $gpgError
     * @param \Exception|null $previous
     * @return EncryptionException
     */
    public static function notDecrypted($gpgError, \Exception $previous = null)
    {
        return new self(
            sprintf(
                'Unable to decrypt. GPG error: %s.',
                $gpgError
            ),
            self::NOT_DECRYPTED,
            $previous
        );
    }

    /**
     * @param string $gpgError
     * @param \Exception|null $previous
     * @return EncryptionException
     */
    public static function notVerified($gpgError, \Exception $previous = null)
    {
        return new self(
            sprintf(
                'Unable to verify. GPG error: %s.',
                $gpgError
            ),
            self::NOT_VERIFIED,
            $previous
        );
    }

    /**
     * @param string $gpgError
     * @param \Exception|null $previous
     * @return EncryptionException
     */
    public static function notDecryptedAndVerified($gpgError, \Exception $previous = null)
    {
        return new self(
            sprintf(
                'Unable to decrypt and verify. GPG error: %s.',
                $gpgError
            ),
            self::NOT_DECRYPTED_AND_VERIFIED,
            $previous
        );
    }
}
