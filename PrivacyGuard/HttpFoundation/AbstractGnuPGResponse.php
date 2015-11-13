<?php

namespace Alameda\Component\Encryption\PrivacyGuard\HttpFoundation;

use Alameda\Component\Encryption\PrivacyGuard\MimeType;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Component\Encryption
 */
abstract class AbstractGnuPGResponse extends Response
{
    /**
     * @inheritdoc
     */
    public function __construct($content = '', $status = 200, $headers = [])
    {
        $defaultHeaders = [
            'Content-type' => MimeType::GNUPG_ENCRYPTED,
        ];

        $headers = array_merge($defaultHeaders, $headers);

        parent::__construct($content, $status, $headers);
    }
}
