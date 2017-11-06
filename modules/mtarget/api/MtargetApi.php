<?php
/**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

/**
 *
 */
class MtargetApi
{

    public function __construct()
    {
        $this->urlRegister = "http://prestashop.mylittlebiz.fr/api/1.1/";
        $this->baseUrl = "https://app.mylittlebiz.fr/api/1.1/";
    }

    public function request($resource, $httpRequest, $data = null, $params = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $this->setCurlOptions($ch, $httpRequest, $data);
        $url = $this->createUrl($resource, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
        $content = curl_exec($ch);
        $responseData = Tools::jsonDecode($content);
        $responseInfo = curl_getinfo($ch);
        // Response code
        $responseCode = $responseInfo['http_code'];
        // Close curl
        curl_close($ch);
        $response = array();
        $response['code'] = $responseCode;
        if ($responseData) {
            $response['data'] = $responseData->data;
        }

        return $response;
    }

    /**
     * Set Curl options.
     *
     * @param resource $ch
     * @param string   $httpRequest
     * @param array    $data
     */
    private function setCurlOptions($ch, $httpRequest, $data)
    {

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'content-type: application/x-www-form-urlencoded; charset=utf-8',
            )
        );
        if ($httpRequest == 'POST') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(Tools::jsonDecode($data)));
        } elseif ($httpRequest == 'GET') {
            curl_setopt($ch, CURLOPT_POST, false);
        } elseif ($httpRequest == 'DELETE') {
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }
    }

    /**
     *
     * @param string $resource
     * @param array  $params
     *
     * @return string
     */
    private function createUrl($resource, $params = array())
    {
        if ($resource == 'users') {
            $url = $this->urlRegister;
        } else {
            $url = $this->baseUrl;
        }
        $url = $url.$resource;
        if (!empty($params) && is_array($params)) {
            $url .= '?'.http_build_query($params);
        }

        return $url;
    }
}
