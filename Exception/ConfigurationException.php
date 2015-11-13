<?php

namespace Alameda\Component\Encryption\Exception;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
class ConfigurationException extends \Exception
{
    /** @var integer */
    const MISSING_GNUPG_EXTENSION = 0;

    /** @var integer */
    const MISSING_KEY = 1;

    /** @var integer */
    const INSUFFICIENT_ACCESS_RIGHTS_TO_GNUPG_DIRECTORY = 2;

    /** @var integer */
    const FAILED_TO_ADD_DECRYPTION_KEY = 5;

    /** @var integer */
    const FAILED_TO_ADD_ENCRYPTION_KEY = 8;

    /** @var integer */
    const FAILED_TO_ADD_SIGN_KEY = 16;

    /** @var integer */
    const FAILED_TO_CREATE_DECRYPTER_AND_ENCRYPTER = 32;

    /** @var integer */
    const FAILED_TO_ADD_USER_KEY = 64;

    /**
     * @param \Exception $previous
     * @return ConfigurationException
     */
    public static function missingGnuPGExtension(\Exception $previous = null)
    {
        return new self(
            'The GnuPG extension is not available.',
            self::MISSING_GNUPG_EXTENSION,
            $previous
        );
    }

    /**
     * @param \Exception|null $previous
     * @return ConfigurationException
     */
    public static function missingKey(\Exception $previous = null)
    {
        return new self(
            'No key was configured to be added.',
            self::MISSING_KEY,
            $previous
        );
    }

    /**
     * @param \Exception $previous
     * @return ConfigurationException
     */
    public static function insufficientAccessRightsToGnuPGDirectory(\Exception $previous = null)
    {
        return new self(
            'The provided GnuPG directory has insufficient access rights.',
            self::INSUFFICIENT_ACCESS_RIGHTS_TO_GNUPG_DIRECTORY,
            $previous
        );
    }

    /**
     * @param string $fingerprint
     * @param string $gpgError
     * @return ConfigurationException
     */
    public static function failedToAddDecryptKey(
        $fingerprint,
        $gpgError,
        \Exception $previous = null
    ) {
        return new self(
            sprintf(
                'Unable to add decryption key \'%s\'. GPG error: %s.',
                $fingerprint,
                $gpgError
            ),
            self::FAILED_TO_ADD_DECRYPTION_KEY,
            $previous
        );
    }

    /**
     * @param string $fingerprint
     * @param string $gpgError
     * @param \Exception $previous
     * @return ConfigurationException
     */
    public static function failedToAddEncryptKey(
        $fingerprint,
        $gpgError,
        \Exception $previous = null
    ) {
        return new self(
            sprintf(
                'Unable to add encryption key \'%s\'. GPG error: %s.',
                $fingerprint,
                $gpgError
            ),
            self::FAILED_TO_ADD_ENCRYPTION_KEY,
            $previous
        );
    }

    /**
     * @param string $fingerprint
     * @param string $gpgError
     * @param \Exception $previous
     * @return ConfigurationException
     */
    public static function failedToAddSignKey(
        $fingerprint,
        $gpgError,
        \Exception $previous = null
    ) {
        return new self(
            sprintf(
                'Unable to add sign key \'%s\'. GPG error: %s.',
                $fingerprint,
                $gpgError
            ),
            self::FAILED_TO_ADD_SIGN_KEY,
            $previous
        );
    }

    /**
     * @param \Exception|null $previous
     * @return ConfigurationException
     */
    public static function failedToCreateDecrypterAndEncrypter(\Exception $previous = null)
    {
        return new self(
            'Unable to configure the decrypter and encrypter to wrong mode.',
            self::FAILED_TO_CREATE_DECRYPTER_AND_ENCRYPTER,
            $previous
        );
    }

    /**
     * @param \Exception|null $previous
     * @return ConfigurationException
     */
    public static function failedToAddUserKey(\Exception $previous = null)
    {
        return new self(
            'Unable to add user assigned key.',
            self::FAILED_TO_ADD_USER_KEY,
            $previous
        );
    }
}
