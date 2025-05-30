<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

namespace PrestaShop\Module\Assistant\Security;

use DateTime;

if (!defined('_PS_VERSION_')) {
    exit;
}

class Antispam
{
    const FILE = '';

    public static function verifySpam()
    {
        $path = dirname(__FILE__);
        $file_name = 'antispam';
        $format = 'Y-m-d H:i:s';
        $current_date = DateTime::createFromFormat($format, date($format));
        $file_path = realpath($path) . DIRECTORY_SEPARATOR . basename($file_name);
        //fichier existant donc procédure de vérification
        if (file_exists($file_path)) {
            $date = DateTime::createFromFormat($format, file_get_contents($file_path));
            if ($date) {
                $interval = $date->diff($current_date);
                if ($interval->s >= 2) {
                    file_put_contents(realpath($file_path), $current_date->format($format));

                    return true;
                } else {
                    return false;
                }
            }
        }
        //fichier non existant
        file_put_contents($file_path, $current_date->format($format));

        return true;
    }
}
