<?php

/**
 * Klaviyo
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Commercial License
 * you can't distribute, modify or sell this code
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file
 * If you need help please contact extensions@klaviyo.com
 *
 * @author    Klaviyo
 * @copyright Klaviyo
 * @license   commercial
 */

namespace KlaviyoPs\Classes\PrestashopServices;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Adapter\LegacyLogger;

class LoggerService extends LegacyLogger
{
    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = [])
    {
        $message = '[klaviyo] ' . $message;

        parent::log($level, $message, $context);
    }

    /**
     * Redact webservice key from stack trace.
     *
     * @param \PrestaShopException $e
     * @return array|string|string[]
     */
    public static function formatTrace(\PrestaShopException $e)
    {
        $traceString = $e->getTraceAsString();
        $wskey = \Configuration::get('KLAVIYO_WEBSERVICE_KEY');

        return str_replace($wskey, "REDACTED", $traceString);
    }
}
