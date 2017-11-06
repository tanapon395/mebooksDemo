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
class MtargetApiSmsAlerting
{

    public function __construct()
    {
        include_once 'MtargetApi.php';

        $this->api_key = Configuration::get('MTARGET_API_KEY');
        $this->api_secret = Configuration::get('MTARGET_API_SECRET');
        $this->template_group = Configuration::get('MTARGET_TEMPLATE_GROUP');
        $this->token = "824d4611aa08e8bde5148c5cb9b6b73f";
        $this->httpUser = new MtargetApi();
    }

    public function createTemplateGroup($data = array())
    {
        $group_url = "objectifs/sms";
        $httpRequest = "POST";
        $params = array(
            'api_key'    => $this->api_key,
            'api_secret' => $this->api_secret,
        );

        $response = $this->httpUser->request(
            $group_url,
            $httpRequest,
            Tools::jsonEncode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            $params
        );

        return $response;
    }

    public function searchTemplateGroup()
    {
        $group_url = "objectifs/".Configuration::get('MTARGET_TEMPLATE_GROUP');
        $httpRequest = "GET";
        $params = array(
            'api_key'    => $this->api_key,
            'api_secret' => $this->api_secret,
        );
        $response = $this->httpUser->request($group_url, $httpRequest, '', $params);

        return $response;
    }

    public function listTemplateGroups()
    {
        $register_url = "objectifs/sms";
        $httpRequest = "GET";
        $params = array(
            'api_key'    => $this->api_key,
            'api_secret' => $this->api_secret,
        );
        $response = $this->httpUser->request($register_url, $httpRequest, '', $params);

        return $response;
    }

    public function createTemplate($data = array())
    {
        $register_url = "objectifs/".(int) $this->template_group."/models";
        $httpRequest = "POST";
        $params = array(
            'api_key'    => $this->api_key,
            'api_secret' => $this->api_secret,
        );
        $response = $this->httpUser->request(
            $register_url,
            $httpRequest,
            Tools::jsonEncode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            $params
        );

        return $response;
    }

    public function launchCampaign($model_id, $data = array())
    {
        $register_url = "campaigns/sms/".(int) $model_id;
        $httpRequest = "POST";
        $params = array(
            'api_key'    => $this->api_key,
            'api_secret' => $this->api_secret,
        );
        $response = $this->httpUser->request(
            $register_url,
            $httpRequest,
            Tools::jsonEncode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            $params
        );

        return $response;
    }

    public function deleteCampaign($campaign_id)
    {
        $register_url = "campaigns/".(int) $campaign_id;
        $httpRequest = "DELETE";
        $params = array(
            'api_key'    => $this->api_key,
            'api_secret' => $this->api_secret,
        );
        $response = $this->httpUser->request($register_url, $httpRequest, '', $params);

        return $response;
    }
}
