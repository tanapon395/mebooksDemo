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
 * Class Mtarget
 */
class Mtarget extends Module
{
    /**
     * @var bool
     */
    public $new_user = true;

    /**
     * Mtarget constructor.
     */
    public function __construct()
    {
        $this->name = 'mtarget';
        $this->tab = 'advertising_marketing';
        $this->version = '1.0.2';
        $this->author = 'Mtarget';
        $this->module_key = 'f5629ffc527fe0da855f637a711d64f1';
        $this->need_instance = 0;
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Mtarget SMS');
        $this->description = $this->l('With Mtarget SMS, simplify your life, retain your customers and increase your turnover quickly. Many options and an unbeatable price! Easy to install, 100 SMS available at registration.');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall the module?');
        $this->ps_versions_compliancy = array(
            'min' => '1.6',
            'max' => _PS_VERSION_,
        );
        $this->api_key = '';
        $this->api_secret = '';
        $this->link_credit = "http://prestashop.mylittlebiz.fr/exterior-login/" . Configuration::get('MTARGET_TOKEN');
        require_once(dirname(__FILE__) . '/classes/MtargetManage.php');
        require_once(dirname(__FILE__) . '/classes/MtargetSMS.php');
        require_once(dirname(__FILE__) . '/api/MtargetApiConnect.php');
        require_once(dirname(__FILE__) . '/api/MtargetApiSmsAlerting.php');
        require_once(dirname(__FILE__) . '/api/MtargetApiSmsMarketing.php');
        require_once(dirname(__FILE__) . '/classes/MtargetSegment.php');
    }

    /**
     * @return bool
     * @throws PrestaShopException
     */
    public function install()
    {
        if (extension_loaded('curl') == false) {
            $this->_errors[] = $this->l('You have to enable the cURL extension on your server to install this module');

            return false;
        }
        Configuration::updateValue('PS_CART_FOLLOWING', 1);
        /* SMS ADMIN */
        Configuration::updateValue('MTARGET_ADMIN_ACCOUNT', 0);
        Configuration::updateValue('MTARGET_ADMIN_ORDER', 0);
        Configuration::updateValue('MTARGET_ADMIN_ORDER_RETURN', 0);
        /* SMS CUSTOMER */
        Configuration::updateValue('MTARGET_CUSTOMER_ORDER', 0);
        Configuration::updateValue('MTARGET_CUSTOMER_ORDER_STATUS', 0);
        Configuration::updateValue('MTARGET_CUSTOMER_CART', 0);
        Configuration::updateValue('MTARGET_CUSTOMER_BIRTHDAY', 0);

        include dirname(__FILE__) . '/install/install.php';
        /* Account settings */
        Configuration::updateValue('MTARGET_API_KEY', '');
        Configuration::updateValue('MTARGET_API_SECRET', '');
        Configuration::updateValue('MTARGET_TOKEN', '');
        Configuration::updateValue('MTARGET_LIVE_MODE', 0);
        Configuration::updateValue('MTARGET_ADMIN_NUM', '');
        Configuration::updateValue('MTARGET_SENDER', '');
        Configuration::updateValue('MTARGET_CONNECTION_STATUS', 0);
        Configuration::updateValue('MTARGET_TEMPLATE_GROUP', 0);

        if (!parent::install() ||
            !$this->registerHook('postUpdateOrderStatus') ||
            !$this->registerHook('createAccount') ||
            !$this->registerHook('newOrder') ||
            !$this->registerHook('orderReturn') ||
            !$this->registerHook('actionCartSave')
        ) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        /* Account settings */
        Configuration::deleteByName('MTARGET_API_KEY');
        Configuration::deleteByName('MTARGET_API_SECRET');
        Configuration::deleteByName('MTARGET_TOKEN');
        Configuration::deleteByName('MTARGET_LIVE_MODE');
        Configuration::deleteByName('MTARGET_CONNECTION_STATUS');
        Configuration::deleteByName('MTARGET_ADMIN_NUM');
        Configuration::deleteByName('MTARGET_SENDER');
        Configuration::deleteByName('MTARGET_TEMPLATE_GROUP');
        /* SMS ADMIN */
        Configuration::deleteByName('MTARGET_ADMIN_ACCOUNT');
        Configuration::deleteByName('MTARGET_ADMIN_ORDER');
        Configuration::deleteByName('MTARGET_ADMIN_ORDER_RETURN');
        /* SMS CUSTOMER */
        Configuration::deleteByName('MTARGET_CUSTOMER_ORDER');
        Configuration::deleteByName('MTARGET_CUSTOMER_ORDER_STATUS');
        Configuration::deleteByName('MTARGET_CUSTOMER_CART');
        Configuration::deleteByName('MTARGET_CUSTOMER_BIRTHDAY');

        Db::getInstance()
            ->execute('DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'mtarget_sms');
        Db::getInstance()
            ->execute('DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'mtarget_sms_lang');
        Db::getInstance()
            ->execute('DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'mtarget_cart');
        Db::getInstance()
            ->execute('DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'mtarget_segment');
        Db::getInstance()
            ->execute('DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'mtarget_segment_lang');

        return parent::uninstall();
    }

    public function getContent()
    {
        $this->context->controller->addCSS($this->_path . 'views/css/mtarget.css');
        $this->context->controller->addJS($this->_path . 'views/js/mtarget.js');
        $this->context->controller->addJS($this->_path . 'views/js/canvasjs.min.js');
        $this->context->controller->addJqueryPlugin('fancybox');

        $output = '';
        /* check if a new user */
        $this->checkMtargetUser($this->api_key, $this->api_secret);
        if ($this->new_user == true) {
            $this->context->smarty->assign('active', 'home');
        } else {
            $this->context->smarty->assign('active', 'dashboard');
        }
        if (Tools::isSubmit('submitMtargetAuthentication')) {
            $output .= $this->postProcessMtargetSettings(false);
            if ($this->new_user == true) {
                $this->context->smarty->assign('active', 'configuration');
            }
        }
        if (Tools::isSubmit('submitMtargetLogout')) {
            $output .= $this->postProcessMtargetLogout();
            $this->context->smarty->assign('active', 'home');
        } else {
            if (Tools::isSubmit('submitMtargetAccount')) {
                $output .= $this->postProcessMtargetSettings(true);
                $this->context->smarty->assign('active', 'myaccount');
            }
        }
        if (Tools::isSubmit('submitMtargetRegistration')) {
            $output .= $this->postProcessMtargetRegistration();
            if ($this->new_user == true) {
                $this->context->smarty->assign('active', 'configuration');
            }
        }
        if (Tools::isSubmit('submitMtargetModeSetting')) {
            $output .= $this->postProcessLiveMode();
            $this->context->smarty->assign('active', 'dashboard');
        }
        if (Tools::isSubmit('submitSmsTest')) {
            $output .= $this->postProcessSmsTest();
            $this->context->smarty->assign('active', 'sms');
        } else {
            if (Tools::isSubmit('submitMtargetSmsSetting')) {
                $output .= $this->postProcessSmsSetting();
                $this->context->smarty->assign('active', 'sms');
            }
        }
        if (Tools::isSubmit('submitMtargetUpdateStatus')) {
            $output .= $this->postProcessUpdateSmsStatus();
            $this->context->smarty->assign('active', 'dashboard');
        }
        if (Tools::isSubmit('submitSmsAdminForm')) {
            $output .= $this->postProcessSMS('admin');
            $this->context->smarty->assign('active', 'sms');
        }
        if (Tools::isSubmit('submitSmsCustomerForm')) {
            $output .= $this->postProcessSMS('customer');
            $this->context->smarty->assign('active', 'sms');
        }
        /* launch birthdays cron */
        $action = Tools::getValue('action');
        if ($action == 'launchBirthdays') {
            $output .= $this->launchSMSBirthdays();
            $this->context->smarty->assign('active', 'sms');
        }
        if (Tools::getValue('deleteSegment')) {
            $output .= $this->postProcessDeleteSegment((int) Tools::getValue('deleteSegment'));
            $this->context->smarty->assign('active', 'marketing');
        }
        if (Tools::getValue('link_page') == 'marketing') {
            $this->context->smarty->assign('active', 'marketing');
        }
        if (Tools::getValue('link_page') == 'alerting') {
            $this->context->smarty->assign('active', 'sms');
        }
        if (Tools::getValue('link_page') == 'dashboard') {
            $this->context->smarty->assign('active', 'dashboard');
        }
        if (Tools::getValue('link_page') == 'myaccount') {
            $this->context->smarty->assign('active', 'myaccount');
        }
        if (Tools::getValue('segmentAdd') == '1') {
            $this->context->smarty->assign('active', 'marketing');
            $output .= $this->displayConfirmation($this->l('Segment successfully added.'));
        }
        $manage = new MtargetManage();
        $segment = new MtargetSegment();
        $contacts_list_segment = array();
        if (Tools::getValue('useSegment')) {
            $contacts_list_segment = $manage->renderSegmentList((int) Tools::getValue('useSegment'));
            $this->context->smarty->assign('active', 'marketing');
        }
        if (Tools::getValue('sendSegment')) {
            $id_segment = (int) Tools::getValue('sendSegment');
            $output .= $this->sendSegment($id_segment);
            $this->context->smarty->assign('active', 'marketing');
        }
        $birthdaySMS = new MtargetSMS((int) Configuration::get('MTARGET_CUSTOMER_BIRTHDAY'));
        $nb_days = (int) $birthdaySMS->time_limit;
        $customersListBirthday = $manage->getCustomersBirthdays($nb_days);
        $nb_birthday_contacts = 0;
        if (!empty($customersListBirthday)) {
            $nb_birthday_contacts = count($customersListBirthday);
        }

        $authenticationSettings = $manage->renderAuthenticationSettingsForm();
        $accountSettings = $manage->renderAccountSettingForm();
        $modeSetting = $manage->renderModeSettingForm();
        $smsSetting = $manage->renderSmsSettingForm();
        $smsTemplateAdmin = $manage->renderSmsTemplateListAdmin();
        $smsTemplateCustomer = $manage->renderSmsTemplateListCustomer();
        $countries = Country::getCountries(Configuration::get('PS_LANG_DEFAULT'));
        $admin_sms = MtargetSMS::getByUser('admin');
        $customer_sms = MtargetSMS::getByUser('customer');
        $enable_sms = MtargetSMS::getByStatus(true);
        $desable_sms = MtargetSMS::getByStatus(false);
        $genders = Gender::getGenders();
        $newSegment = $manage->renderNewSegment();
        $SegmentsList = $segment->getList();
        $id_lang = $this->context->language->id;
        $langue = new LanguageCore((int) $id_lang);

        $this->getMatrgetStatisticsByType();
        $this->getMatrgetStatisticsByMonths();
        $secureKey = md5(_COOKIE_KEY_ . Configuration::get('PS_SHOP_NAME'));
        $urlConfig = $this->context->link->getAdminLink('AdminModules', false);
        $urlConfig .= '&token=' . Tools::getAdminTokenLite('AdminModules') . '&configure=' . $this->name;
        $launchBirthdaysUrl = $this->context->link->getAdminLink('AdminModules', false);
        $launchBirthdaysUrl .= '&token=' . Tools::getAdminTokenLite('AdminModules');
        $birthdayUrl = $this->context->link->getModuleLink($this->name, 'cronbirthdays') . '&secure_key=' . $secureKey;
        $langs = array(
            'fr',
            'en',
            'es',
        );
        $faq = $this->_path . 'faq-' . (in_array($langue->iso_code, $langs) ? $langue->iso_code : 'en') . '.pdf';
        $this->context->smarty->assign(
            array(
                'authenticationSettings' => $authenticationSettings,
                'modeSetting' => $modeSetting,
                'accountSettings' => $accountSettings,
                'smsSetting' => $smsSetting,
                'smsTemplateAdmin' => $smsTemplateAdmin,
                'smsTemplateCustomer' => $smsTemplateCustomer,
                'connection_status' => Configuration::get('MTARGET_CONNECTION_STATUS'),
                'url_config' => $urlConfig,
                'countries' => $countries,
                'admin_sms' => $admin_sms,
                'customer_sms' => $customer_sms,
                'enable_sms' => $enable_sms,
                'desable_sms' => $desable_sms,
                'genders' => $genders,
                'newSegment' => $newSegment,
                'SegmentsList' => $SegmentsList,
                'contacts_list_segment' => $contacts_list_segment,
                'mtarget_img_path' => $this->_path . 'views/img/',
                'lang' => $this->context->language->id,
                'lang_iso' => $langue->iso_code,
                'pdf_guide' => $faq,
                'link_credit' => $this->link_credit,
                'nb_birthday_contacts' => $nb_birthday_contacts,
                'mtarget_launch_birthdays' => $launchBirthdaysUrl . '&configure=' . $this->name . '&action=launchBirthdays',
                'mtarget_birthdays_url' => $birthdayUrl,
            )
        );
        if ($this->new_user == true) {
            return $output . $this->context->smarty->fetch($this->local_path . 'views/templates/admin/mtarget-home.tpl');
        } else {
            return $output . $this->context->smarty->fetch(
                    $this->local_path . 'views/templates/admin/mtarget-home-connect.tpl'
            );
        }
    }

    /**
     * @return array
     */
    public function getConfigFieldsValues()
    {
        return array(
            'MTARGET_API_KEY' => Configuration::get('MTARGET_API_KEY'),
            'MTARGET_API_SECRET' => Configuration::get('MTARGET_API_SECRET'),
            'MTARGET_TOKEN' => Configuration::get('MTARGET_TOKEN'),
        );
    }

    /**
     * @param string $user
     * @return array
     */
    public function getSmsFormValues($user)
    {
        require_once(dirname(__FILE__) . '/classes/MtargetSMS.php');
        $admin_sms = MtargetSMS::getByUser($user);
        $smsArray = array();
        $languages = Language::getLanguages(false);
        foreach ($admin_sms as $sms) {
            $sms_admin = new MtargetSMS($sms->id_mtarget_sms);
            $smsArray['active' . $sms_admin->id_mtarget_sms] = (int) $sms_admin->active;
            $smsArray['time_limit' . $sms_admin->id_mtarget_sms] = (int) $sms_admin->time_limit;
            $smsArray['event' . $sms_admin->id_mtarget_sms] = $sms_admin->event[(int) $this->context->language->id];
            foreach ($languages as $lang) {
                $smsArray['content' . $sms_admin->id_mtarget_sms][(int) $lang['id_lang']] = $sms_admin->content[(int) $lang['id_lang']];
            }
        }

        return $smsArray;
    }

    /**
     * get user information settings
     * @param string $api_key
     * @param string $api_secret
     */
    public function checkMtargetUser($api_key, $api_secret)
    {
        $apiConnect = new MtargetApiConnect();
        $check_user = $apiConnect->checkMtargetKeys($api_key, $api_secret);

        if (isset($check_user['data']) && $check_user['code'] == 200) {
            $this->new_user = false;
            Configuration::updateValue('MTARGET_CONNECTION_STATUS', 1);
            $balance = $apiConnect->getMtargetBlance();
            $this->context->smarty->assign('active', 'dashboard');
            $this->context->smarty->assign('balance', $balance['data']);

            return $check_user['data'];
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function postProcessMtargetLogout()
    {
        $this->new_user = true;
        Configuration::updateValue('MTARGET_API_KEY', '');
        Configuration::updateValue('MTARGET_API_SECRET', '');
        Configuration::updateValue('MTARGET_TOKEN', '');
        Configuration::updateValue('MTARGET_CONNECTION_STATUS', 0);
    }

    public function postProcessLiveMode()
    {
        $mode = Configuration::get('MTARGET_LIVE_MODE');
        if ($mode == 0) {
            Configuration::updateValue('MTARGET_LIVE_MODE', Tools::getValue('MTARGET_LIVE_MODE'));

            return $this->displayConfirmation($this->l('Live mode enabled.'));
        } else {
            Configuration::updateValue('MTARGET_LIVE_MODE', Tools::getValue('MTARGET_LIVE_MODE'));

            return $this->displayConfirmation($this->l('Live mode desabled'));
        }
    }

    public function postProcessMtargetRegistration()
    {
        $mtargetEmail = Tools::getValue('account_email');
        $mtargetCountry = pSQL(Tools::getValue('account_country'));
        $mtargetPassword = pSQL(Tools::getValue('account_password'));
        $mtargetLastname = pSQL(Tools::getValue('account_lastname'));
        $mtargetFirstname = pSQL(Tools::getValue('account_firstname'));
        $mtargetCivility = pSQL(Tools::getValue('account_civility'));
        $mtargetCompany = pSQL(Tools::getValue('account_company'));
        $mtargetSiret = pSQL(Tools::getValue('account_siret'));
        $mtargetMobile = pSQL(Tools::getValue('account_mobile'));
        $mtargetAddress = pSQL(Tools::getValue('account_address'));
        $mtargetCP = pSQL(Tools::getValue('account_cp'));
        $mtargetCity = pSQL(Tools::getValue('account_city'));

        if (!$mtargetEmail || !$mtargetCountry || !$mtargetPassword || !$mtargetLastname || !$mtargetFirstname ||
            !$mtargetCivility || !$mtargetCompany || !$mtargetSiret || !$mtargetMobile || !$mtargetAddress ||
            !$mtargetCP || !$mtargetCity
        ) {
            return $this->displayError($this->l('You must fill in the required fields'));
        }
        if (!Validate::isEmail($mtargetEmail)) {
            return $this->displayError($this->l('Invalid email'));
        }
        /* register a new user */
        $connect = new MtargetApiConnect();
        $postdata = array(
            'email' => $mtargetEmail,
            'pays' => $mtargetCountry,
            'motdepasse' => $mtargetPassword,
            'nom' => $mtargetLastname,
            'prenom' => $mtargetFirstname,
            'civilite' => $mtargetCivility,
            'entreprise' => $mtargetCompany,
            'siret' => $mtargetSiret,
            'mobile' => $mtargetMobile,
            'adresse' => $mtargetAddress,
            'codepostal' => $mtargetCP,
            'ville' => $mtargetCity,
        );
        $response = $connect->registerMtargetUser($postdata);

        /* If registered user */
        if ($response['code'] == 200) {
            /* save API KEYS */
            Configuration::updateValue('MTARGET_API_KEY', $response['data']->API_key);
            Configuration::updateValue('MTARGET_API_SECRET', $response['data']->API_secret);
            Configuration::updateValue('MTARGET_TOKEN', $response['data']->token_connexion);
            Configuration::updateValue('MTARGET_ADMIN_NUM', $mtargetMobile);
            $this->checkMtargetUser($response['data']->API_key, $response['data']->API_secret);
            /* Create group SMS */
            $this->createGroupSms($mtargetEmail);

            return $this->displayConfirmation(
                    $this->l('Your account has been created, the module is ready to be used!.')
            );
        } else {
            /* If not registered user : check fields */
            if (isset($response['data']->messages)) {
                $errors = $response['data']->messages;
                foreach ($errors as $error) {
                    if ($error == "This email already exists.") {
                        return $this->displayError($this->l('This email already exists.'));
                    } else {
                        if ($error == "The mobile number already exists") {
                            return $this->displayError($this->l('The mobile number already exists'));
                        }
                    }
                }
            } else {
                if (isset($response['data']) && $response['data'] == 'invalid number !') {
                    return $this->displayError($this->l('invalid phone number'));
                }
            }
        }
    }

    /**
     * check and save Api Keys
     */
    public function postProcessMtargetSettings($connected)
    {
        $api_key = Tools::getValue('MTARGET_API_KEY');
        $api_secret = Tools::getValue('MTARGET_API_SECRET');
        $token = Tools::getValue('MTARGET_TOKEN');

        if (!$api_key || !$api_secret || !$token) {
            return $this->displayError($this->l('You must fill in the required fields'));
        }
        $is_connect = $this->checkMtargetUser($api_key, $api_secret);
        if ($is_connect == false) {
            return $this->displayError($this->l('Invalid parameters'));
        } else {
            /* save api keys */
            Configuration::updateValue('MTARGET_API_KEY', $api_key);
            Configuration::updateValue('MTARGET_API_SECRET', $api_secret);
            Configuration::updateValue('MTARGET_TOKEN', $token);
            /* check group template */
            $sms = new MtargetApiSmsAlerting();
            $valid_group = $sms->searchTemplateGroup();
            if ($valid_group['code'] != 200) {
                $email = $is_connect->email;
                $this->createGroupSms($email);
            }
            if ($connected == false) {
                return $this->displayConfirmation($this->l('The module is ready for use!.'));
            } else {
                return $this->displayConfirmation($this->l('Information was successfully saved.'));
            }
        }
    }

    /**
     * Enable or disable SMS
     */
    public function postProcessUpdateSmsStatus()
    {
        $admin_sms = MtargetSMS::getByUser('admin');
        $customer_sms = MtargetSMS::getByUser('customer');
        foreach ($admin_sms as $sms) {
            $sms_obj = new MtargetSMS($sms->id_mtarget_sms);
            $sms_obj->active = (int) Tools::getValue('sms_' . $sms_obj->id_mtarget_sms);
            $sms_obj->save();
        }
        foreach ($customer_sms as $sms) {
            $sms_obj = new MtargetSMS($sms->id_mtarget_sms);
            $sms_obj->active = (int) Tools::getValue('sms_' . $sms_obj->id_mtarget_sms);
            $sms_obj->save();
        }

        return $this->displayConfirmation($this->l('Automated SMS settings saved successfully.'));
    }

    /**
     * send SMS test
     */
    public function postProcessSmsTest()
    {
        /* create template sms test */
        $sms_alerting = new MtargetApiSmsAlerting();
        $post_params = array(
            'title' => 'SMS Test',
            'sender' => Configuration::get('MTARGET_SENDER'),
            'content' => 'Prestashop SMS Test',
            'editable' => 1,
        );
        $response = $sms_alerting->createTemplate($post_params);

        if ($response['code'] == 200) {
            /* launch campaign */
            $id_template = (int) $response['data']->id;
            $post_launch_params = array(
                'name' => 'SMS Test',
                'numbers' => Configuration::get('MTARGET_ADMIN_NUM'),
                'out_of_offers' => 'send',
                'send_now' => 1,
            );
            $response_launch = $sms_alerting->launchCampaign((int) $id_template, $post_launch_params);

            if ($response_launch['code'] == 200) {
                return $this->displayConfirmation(
                        $this->l('SMS sent successfully. 1 or 2 minutes are required before it is received.')
                );
            } else {
                if ($response_launch['code'] == 404) {
                    return $this->displayError($this->l('A problem occurred when sending the SMS'));
                } else {
                    $link = '<a href="' . $this->link_credit . '" target="_blank">' . $this->l('here') . '</a>';

                    return $this->displayError($this->l('You have no credit remaining! Please top up') . $link);
                }
            }
        } else {
            return $this->displayError($this->l('A problem occurred when sending the SMS'));
        }
    }

    /**
     * save admin num and sender
     */
    public function postProcessSmsSetting()
    {
        if (!Tools::getValue('MTARGET_ADMIN_NUM')) {
            return $this->displayError($this->l('You must fill in the required fields'));
        }
        if (!Tools::getValue('MTARGET_SENDER')) {
            return $this->displayError($this->l('You must fill in the required fields'));
        }
        if (!Validate::isPhoneNumber(Tools::getValue('MTARGET_ADMIN_NUM'))) {
            return $this->displayError($this->l('Invalid number'));
        } else {
            Configuration::updateValue('MTARGET_ADMIN_NUM', Tools::getValue('MTARGET_ADMIN_NUM'));
        }
        if ($this->isValidSender(Tools::getValue('MTARGET_SENDER')) == false) {
            return $this->displayError($this->l('You must enter 11 alphanumeric characters'));
        } else {
            Configuration::updateValue('MTARGET_SENDER', Tools::getValue('MTARGET_SENDER'));
        }

        return $this->displayConfirmation($this->l('The new parameters have been saved.'));
    }

    /**
     * Save content SMS for admin and customer
     * @param string $user
     */
    public function postProcessSMS($user)
    {
        require_once(dirname(__FILE__) . '/classes/MtargetSMS.php');
        $langs = Language::getLanguages(false);

        if ($user == "admin") {
            $user_sms = MtargetSMS::getByUser('admin');
        } else {
            $user_sms = MtargetSMS::getByUser('customer');
        }
        foreach ($user_sms as $sms) {
            $sms_obj = new MtargetSMS($sms->id_mtarget_sms);
            $sms_obj->active = (int) Tools::getValue('active' . $sms_obj->id_mtarget_sms);
            $sms_obj->time_limit = (int) Tools::getValue('time_limit' . $sms_obj->id_mtarget_sms);
            foreach ($langs as $lang) {
                $sms_obj->content[(int) $lang['id_lang']] = Tools::getValue(
                        'content' . $sms_obj->id_mtarget_sms . '_' . (int) $lang['id_lang']
                );
            }
            if (!$sms_obj->save()) {
                return $this->displayError($this->l('SMS cannot be updated.'));
            }
        }
        if ($user == "admin") {
            return $this->displayConfirmation($this->l('SMS Administrator Changes Successfully Registered!'));
        } else {
            return $this->displayConfirmation($this->l('SMS Changes Customers saved successfully!'));
        }
    }

    /**
     * Add a new segment
     */
    public function ajaxProcessRequestNewSegment()
    {
        require_once(dirname(__FILE__) . '/classes/MtargetSegment.php');
        $name = Tools::getValue('segment_name');
        /* get checkbox groups values */
        $groups = Group::getGroups((int) $this->context->language->id);
        $langs = LanguageCore::getLanguages();
        $segment_groups = array();
        $segment_groups_ids = array();
        foreach ($groups as $group) {
            $group_obj = new Group((int) $group['id_group']);
            if (Tools::getValue('group_' . $group['name']) == 'true') {
                $segment_groups_ids[] = (int) $group_obj->id;
                foreach ($langs as $lang) {
                    $segment_groups[$lang['id_lang']][] = $group_obj->name[$lang['id_lang']];
                }
            }
        }
        if ($segment_groups) {
            foreach ($langs as $lang) {
                $segment_groups[$lang['id_lang']] = implode(', ', $segment_groups[$lang['id_lang']]);
            }
        }
        if ($segment_groups_ids) {
            $segment_groups_ids = implode(', ', $segment_groups_ids);
        }
        /* get checkbox languages values */
        $segment_langs = array();
        foreach ($langs as $lang) {
            if (Tools::getValue('lang_' . $lang['id_lang']) == 'true') {
                $segment_langs[] = $lang['id_lang'];
            }
        }
        if ($segment_langs) {
            $segment_langs = implode(', ', $segment_langs);
        }
        /* get other fields */
        $optin = Tools::getValue('optin');
        $has_order = Tools::getValue('order');
        /* add segment */
        $segment = new MtargetSegment();
        if ($segment_langs) {
            $segment->lang = $segment_langs;
        }
        if ($segment_groups) {
            foreach ($langs as $lang) {
                $segment->group[$lang['id_lang']] = $segment_groups[$lang['id_lang']];
            }
        }
        if ($segment_groups_ids) {
            $segment->group_ids = $segment_groups_ids;
        }
        if ($optin == "false") {
            $segment->optin = 0;
        } else {
            $segment->optin = 1;
        }
        if ($has_order == 0) {
            $segment->has_order = 0;
        } else {
            $segment->has_order = 1;
        }
        $segment->reference = $this->generateReference();
        $segment->name = $name;
        if (!$segment->add()) {
            die(Tools::jsonEncode(
                    array(
                        'errors' => true,
                        'description' => $this->l('SMS cannot be added.'),
                    )
            ));
        }
        die(Tools::jsonEncode(
                array(
                    'errors' => false,
                    'description' => $this->l('Segment successfully added.'),
                )
        ));
    }

    public function postProcessDeleteSegment($id_segment)
    {
        $apiMarketing = new MtargetApiSmsMarketing();
        $segment = new MtargetSegment((int) $id_segment);
        /* delete segment from DB */
        if ($segment->deleteSegment((int) $id_segment)) {
            $listContactsGroup = $apiMarketing->getContactGroups();
            /* delete api contacts group */
            if ($listContactsGroup['code'] == 200 && !empty($listContactsGroup['data'])) {
                foreach ($listContactsGroup['data'] as $group) {
                    if ($group->name == $segment->name . '_' . $segment->reference) {
                        $apiMarketing->deleteContactsGroup((int) $group->id);
                    }
                }
            }

            return $this->displayConfirmation($this->l('Segment successfully removed'));
        } else {
            return $this->displayError($this->l('Segment cannot be removed'));
        }
    }

    public function ajaxProcessRequestUseSegment()
    {
        require_once(dirname(__FILE__) . '/classes/MtargetManage.php');
        $manage = new MtargetManage();
        $contacts_list_segment = $manage->renderSegmentList((int) Tools::getValue('id_segment'));
        die(Tools::jsonEncode($contacts_list_segment));
    }

    public function createGroupSms($email)
    {
        $sms = new MtargetApiSmsAlerting();
        /* check if user has a group template */
        $list_group = $sms->listTemplateGroups();
        if ($list_group['code'] == 200) {
            if (isset($list_group['data'][0]->id)) {
                Configuration::updateValue('MTARGET_TEMPLATE_GROUP', (int) $list_group['data'][0]->id);
            } else {
                /* if user has not a group : create group */
                $data = array(
                    'name' => 'Prestashop Group ' . $email,
                );
                $group_response = $sms->createTemplateGroup($data);
                if ($group_response['code'] == 200) {
                    Configuration::updateValue('MTARGET_TEMPLATE_GROUP', (int) $group_response['data']->id);
                }
            }
        }
    }

    /**
     * check if user has a contacts group id in MTARGET
     * @param string $id_segment
     * @return int
     */
    public function checkContactsGroup($id_segment)
    {
        require_once(dirname(__FILE__) . '/api/MtargetApiSmsMarketing.php');
        $smsMarketing = new MtargetApiSmsMarketing();
        $segment = new MtargetSegment((int) $id_segment);
        /* get list contacts group for user in Mtarget */
        $listContactsGroup = $smsMarketing->getContactGroups();
        $has_group = false;
        if ($listContactsGroup['code'] == 200 && isset($listContactsGroup['data'])) {
            foreach ($listContactsGroup['data'] as $group) {
                /* if user has a contacts group :  return group id */
                if ($group->name == $segment->name . '_' . $segment->reference) {
                    $has_group = true;
                    $group_id = (int) $group->id;

                    return $group_id;
                }
            }
            /* if group not exist : create group segment */
            if ($has_group == false) {
                $data = array(
                    'name' => $segment->name . '_' . $segment->reference,
                    'description' => 'Prestashop Contacts Group',
                );
                $group_response = $smsMarketing->createContactsGroup($data);
                if ($group_response['code'] == 200) {
                    $group_id = (int) $group_response['data']->id;

                    return $group_id;
                }
            }
        }
    }

    public function sendSegment($id_segment)
    {
        $smsMarketing = new MtargetApiSmsMarketing();
        $segment = new MtargetSegment();
        $contactsList = $segment->getContactsList((int) $id_segment);
        if ($contactsList) {
            $id_contacts_group = $this->checkContactsGroup($id_segment);
            foreach ($contactsList as $contact) {
                $customer = new Customer((int) $contact['id_customer']);
                $addresses = $customer->getAddresses($customer->id_lang);
                $mobile = '';
                $country = '';
                $civility = '';
                if ($addresses) {
                    if ($addresses[0]['phone'] == '') {
                        $mobile = $addresses[0]['phone_mobile'];
                    } else {
                        $mobile = $addresses[0]['phone'];
                    }
                    if ($addresses[0]['id_country']) {
                        $Country = new Country((int) $addresses[0]['id_country']);
                        $country = $Country->iso_code;
                    }
                }
                if ($customer->id_gender) {
                    $gender = new Gender((int) $customer->id_gender);
                    $civility = $gender->name[$customer->id_lang];
                }
                if ($mobile != '') {
                    $post_params = array(
                        'civility' => $civility,
                        'fname' => $contact['firstname'],
                        'lname' => $contact['lastname'],
                        'mobile' => $mobile,
                        'email' => $contact['email'],
                        'birthday' => $contact['birthday'],
                        'ind' => $country,
                        'is_blacklist' => 0,
                        'updated_field	' => 'mob',
                    );
                    $smsMarketing->createContact($id_contacts_group, $post_params);
                }
            }
            $link = '<a href="' . $this->link_credit . '" target="_blank">' . $this->l('click here') . '</a>';

            return $this->displayConfirmation(
                    $this->l('Segment sent successfully. Connect to the Mtarget platform to use it :') . $link
            );
        } else {
            return $this->displayError($this->l('No contact in the selected segment'));
        }
    }

    /** Get Statistics by SMS types
     *
     */
    public function getMatrgetStatisticsByType()
    {
        $smsMarketing = new MtargetApiSmsMarketing();
        $manage = new MtargetManage();
        /* get last 12 months */
        $tab_months = $manage->getLatestMonth(12);
        $data = array(
            'from' => '' . $tab_months[11]['year'] . '-' . $tab_months[11]['month'] . '-' . $tab_months[11]['firstDay'] . '',
            'to' => '' . $tab_months[0]['year'] . '-' . $tab_months[0]['month'] . '-' . $tab_months[0]['lastDay'] . '',
        );
        /* get all campaigns sms */
        $campaigns_list = $smsMarketing->getCampaignsList($data);

        /* initialize percent values */
        $percent_account = 0;
        $percent_new_order = 0;
        $percent_product_return = 0;
        $percent_order_statut = 0;
        $percent_cart = 0;
        $percent_birthday = 0;

        if ($campaigns_list['code'] == 200) {
            /* initialize the list of counters */
            $counter_account = 0;
            $counter_new_order = 0;
            $counter_order_statut = 0;
            $counter_product_return = 0;
            $counter_cart = 0;
            $counter_birthday = 0;
            /* sms list */
            $sms_account = new MtargetSMS((int) Configuration::get('MTARGET_ADMIN_ACCOUNT'));
            $sms_admin_order = new MtargetSMS((int) Configuration::get('MTARGET_ADMIN_ORDER'));
            $sms_order_statut = new MtargetSMS((int) Configuration::get('MTARGET_CUSTOMER_ORDER_STATUS'));
            $sms_customer_order = new MtargetSMS((int) Configuration::get('MTARGET_CUSTOMER_ORDER'));
            $sms_product_return = new MtargetSMS((int) Configuration::get('MTARGET_ADMIN_ORDER_RETURN'));
            $sms_cart = new MtargetSMS((int) Configuration::get('MTARGET_CUSTOMER_CART'));
            $sms_birthday = new MtargetSMS((int) Configuration::get('MTARGET_CUSTOMER_BIRTHDAY'));
            if (isset($campaigns_list['data'])) {
                foreach ($campaigns_list['data'] as $campaign) {
                    /* statistics new account */
                    $event = $sms_account->event[$this->context->language->id];
                    if ($campaign->name == $event) {
                        $counter_account++;
                    }
                    /* statistics new order */
                    $event_order_admin = $sms_admin_order->event[$this->context->language->id];
                    $event_order_customer = $sms_customer_order->event[$this->context->language->id];
                    if ($campaign->name == $event_order_customer || $campaign->name == $event_order_admin) {
                        $counter_new_order++;
                    }
                    /* statistics product return */
                    $event = $sms_product_return->event[$this->context->language->id];
                    if ($campaign->name == $event) {
                        $counter_product_return++;
                    }
                    /* statistics order statut */
                    $event = $sms_order_statut->event[$this->context->language->id];
                    if ($campaign->name == $event) {
                        $counter_order_statut++;
                    }
                    /* statistics cart */
                    $event = $sms_cart->event[$this->context->language->id];
                    if ($campaign->name == $event) {
                        $counter_cart++;
                    }
                    /* statistics birthday */
                    $event = $sms_birthday->event[$this->context->language->id];
                    if ($campaign->name == $event) {
                        $counter_birthday++;
                    }
                }
            }
            /* calculate sms total */
            $total_sms = (int) $counter_account + (int) $counter_new_order + (int) $counter_product_return;
            $total_sms += (int) $counter_order_statut + (int) $counter_cart + (int) $counter_birthday;
            if ($total_sms) {
                $percent_account = ($counter_account * 100) / $total_sms;
                $percent_new_order = ($counter_new_order * 100) / $total_sms;
                $percent_product_return = ($counter_product_return * 100) / $total_sms;
                $percent_order_statut = ($counter_order_statut * 100) / $total_sms;
                $percent_cart = ($counter_cart * 100) / $total_sms;
                $percent_birthday = ($counter_birthday * 100) / $total_sms;
                $this->context->smarty->assign('empty_stat', 0);
            } else {
                $this->context->smarty->assign('empty_stat', 1);
            }
        }
        $this->context->smarty->assign(
            array(
                'percent_account' => (float) number_format($percent_account, 2, '.', ' '),
                'percent_new_order' => (float) number_format($percent_new_order, 2, '.', ' '),
                'percent_product_return' => (float) number_format($percent_product_return, 2, '.', ' '),
                'percent_order_statut' => (float) number_format($percent_order_statut, 2, '.', ' '),
                'percent_cart' => (float) number_format($percent_cart, 2, '.', ' '),
                'percent_birthday' => (float) number_format($percent_birthday, 2, '.', ' '),
            )
        );
    }

    /** Get SMS Statistics per month
     *
     */
    public function getMatrgetStatisticsByMonths()
    {
        $smsMarketing = new MtargetApiSmsMarketing();
        $manage = new MtargetManage();
        /* check if user has campaigns SMS */
        $campaigns_list = $smsMarketing->getCampaignsList($data = array());

        $tab_stat = array();
        if ($campaigns_list['code'] == 200) {
            $tab_months = $manage->getLatestMonth(12);
            /* get statistics for each month */
            foreach ($tab_months as $key => $month) {
                $nbr_sms = 0;
                $data = array(
                    'from' => '' . $month['year'] . '-' . $month['month'] . '-' . $month['firstDay'] . '',
                    'to' => '' . $month['year'] . '-' . $month['month'] . '-' . $month['lastDay'] . '',
                );
                $campaigns_list_month = $smsMarketing->getCampaignsList($data);
                if ($campaigns_list_month['code'] == 200) {
                    $tab_stat[$key]['year'] = (int) $month['year'];
                    $tab_stat[$key]['month'] = (int) $month['month'] - 1;
                    $tab_stat[$key]['lastDay'] = (int) $month['lastDay'];
                    if (!empty($campaigns_list_month['data'])) {
                        foreach ($campaigns_list_month['data'] as $campaign) {
                            $nbr_sms += $campaign->nbr_sms;
                        }
                        $tab_stat[$key]['sms'] = $nbr_sms;
                    } else {
                        $tab_stat[$key]['sms'] = 0;
                    }
                }
            }
        }
        $this->context->smarty->assign('tab_stat', $tab_stat);
    }

    /** Send SMS to the admin when a new account is created
     *
     * @param $params
     */
    public function hookCreateAccount($params)
    {
        require_once(dirname(__FILE__) . '/classes/MtargetSMS.php');
        require_once(dirname(__FILE__) . '/api/MtargetApiSmsAlerting.php');

        $id_shop = (int) $params['newCustomer']->id_shop;
        $email = $params['newCustomer']->email;
        $shop = new Shop((int) $id_shop);
        $shop_url = $shop->getBaseURL();

        /* SMS TO ADMIN */
        /* update content template admin */
        $sms_admin = new MtargetSMS((int) Configuration::get('MTARGET_ADMIN_ACCOUNT'));
        if ($sms_admin->active == 1) {
            $template_sms = $sms_admin->content[(int) $this->context->language->id];
            $template_sms = str_replace('#email#', $email, $template_sms);
            $template_sms = str_replace('#url#', $shop_url, $template_sms);
            /* create template sms admin */
            $sms_alerting = new MtargetApiSmsAlerting();
            $post_params = array(
                'title' => $sms_admin->event[(int) $this->context->language->id],
                'sender' => Configuration::get('MTARGET_SENDER'),
                'content' => $template_sms,
                'editable' => 1,
            );
            $response = $sms_alerting->createTemplate($post_params);
            if ($response['code'] == 200) {
                /* launch campaign */
                $id_template = (int) $response['data']->id;
                $post_launch_params = array(
                    'name' => $sms_admin->event[(int) $this->context->language->id],
                    'numbers' => Configuration::get('MTARGET_ADMIN_NUM'),
                    'out_of_offers' => 'send',
                    'send_now' => 1,
                );
                $sms_alerting->launchCampaign((int) $id_template, $post_launch_params);
            }
        }
    }

    /**
     * Send SMS to the admin and the customer when a new order is created
     *
     * @param array $params
     */
    public function hookNewOrder($params)
    {
        require_once(dirname(__FILE__) . '/classes/MtargetSMS.php');
        require_once(dirname(__FILE__) . '/api/MtargetApiSmsAlerting.php');

        $num_order = $params['order']->reference;
        $total_order = $params['order']->total_paid . " " . $params['currency']->sign;
        $id_shop = (int) $params['order']->id_shop;
        $email = $params['customer']->email;
        $firstname = $params['customer']->firstname;
        $lastname = $params['customer']->lastname;
        $address = new Address((int) $params['order']->id_address_delivery);
        $phone = $address->phone;
        $shop = new Shop((int) $id_shop);
        $shop_url = $shop->getBaseURL();
        /* SMS TO ADMIN */
        /* update content template admin */
        $sms_admin = new MtargetSMS((int) Configuration::get('MTARGET_ADMIN_ORDER'));
        if ($sms_admin->active == 1) {
            $template_sms = $sms_admin->content[(int) $this->context->language->id];
            $template_sms = str_replace('#email#', $email, $template_sms);
            $template_sms = str_replace('#url#', $shop_url, $template_sms);
            $template_sms = str_replace('#num_order#', $num_order, $template_sms);
            $template_sms = str_replace('#amount#', $total_order, $template_sms);
            /* create template sms admin */
            $sms_alerting = new MtargetApiSmsAlerting();
            $post_params = array(
                'title' => $sms_admin->event[(int) $this->context->language->id],
                'sender' => Configuration::get('MTARGET_SENDER'),
                'content' => $template_sms,
                'editable' => 1,
            );
            $response = $sms_alerting->createTemplate($post_params);
            if ($response['code'] == 200) {
                /* launch campaign */
                $id_template = (int) $response['data']->id;
                $post_launch_params = array(
                    'name' => $sms_admin->event[(int) $this->context->language->id],
                    'numbers' => Configuration::get('MTARGET_ADMIN_NUM'),
                    'out_of_offers' => 'send',
                    'send_now' => 1,
                );
                $sms_alerting->launchCampaign((int) $id_template, $post_launch_params);
            }
        }
        /* SMS TO CUSTOMER */
        /* check if mode test not activated */
        if (Configuration::get('MTARGET_LIVE_MODE') == 1) {
            /* update content template customer */
            $sms_customer = new MtargetSMS((int) Configuration::get('MTARGET_CUSTOMER_ORDER'));
            if ($sms_customer->active == 1) {
                $template_sms = $sms_customer->content[(int) $this->context->language->id];
                $template_sms = str_replace('#firstname#', $firstname, $template_sms);
                $template_sms = str_replace('#lastname#', $lastname, $template_sms);
                $template_sms = str_replace('#url#', $shop_url, $template_sms);
                $template_sms = str_replace('#num_order#', $num_order, $template_sms);
                /* create template sms admin */
                $sms_alerting = new MtargetApiSmsAlerting();
                $post_params = array(
                    'title' => $sms_customer->event[(int) $this->context->language->id],
                    'sender' => Configuration::get('MTARGET_SENDER'),
                    'content' => $template_sms,
                    'editable' => 1,
                );
                $response = $sms_alerting->createTemplate($post_params);
                if ($response['code'] == 200) {
                    /* launch campaign */
                    $id_template = (int) $response['data']->id;
                    $post_launch_params = array(
                        'name' => $sms_customer->event[(int) $this->context->language->id],
                        'numbers' => $phone,
                        'out_of_offers' => 'send',
                        'send_now' => 1,
                    );
                    $sms_alerting->launchCampaign((int) $id_template, $post_launch_params);
                }
                /* Delete campaign for Abandoned Carts for this order */
                $this->deleteCampaign((int) $params['order']->id_cart);
            }
        }
    }

    /**
     * Send SMS to the admin
     * @param array $params
     */
    public function hookOrderReturn($params)
    {
        require_once(dirname(__FILE__) . '/classes/MtargetSMS.php');
        require_once(dirname(__FILE__) . '/api/MtargetApiSmsAlerting.php');

        $id_customer = (int) $params['orderReturn']->id_customer;
        $id_order = (int) $params['orderReturn']->id_order;
        $customer = new Customer((int) $id_customer);
        $order = new Order($id_order);
        $order_retutrn = new OrderReturn($params['orderReturn']->id);
        $shop = new Shop((int) $params['cart']->id_shop);
        $shop_url = $shop->getBaseURL();
        $return_products = $order_retutrn->getOrdersReturnProducts((int) $params['orderReturn']->id, $order);
        $codes = array();
        foreach ($return_products as $product) {
            $codes[] = $product['reference'];
        }
        $codes_list = implode(', ', $codes);

        /* update content template */
        $sms = new MtargetSMS((int) Configuration::get('MTARGET_ADMIN_ORDER_RETURN'));
        if ($sms->active == 1) {
            $template_sms = $sms->content[(int) $this->context->language->id];
            $template_sms = str_replace('#email#', $customer->email, $template_sms);
            $template_sms = str_replace('#code_prod#', $codes_list, $template_sms);
            $template_sms = str_replace('#url#', $shop_url, $template_sms);

            /* create template sms */
            $sms_alerting = new MtargetApiSmsAlerting();
            $post_params = array(
                'title' => $sms->event[(int) $this->context->language->id],
                'sender' => Configuration::get('MTARGET_SENDER'),
                'content' => $template_sms,
                'editable' => 1,
            );
            $response = $sms_alerting->createTemplate($post_params);
            if ($response['code'] == 200) {
                /* launch campaign */
                $id_template = (int) $response['data']->id;
                $post_launch_params = array(
                    'name' => $sms->event[(int) $this->context->language->id],
                    'numbers' => Configuration::get('MTARGET_ADMIN_NUM'),
                    'out_of_offers' => 'send',
                    'send_now' => 1,
                );
                $sms_alerting->launchCampaign((int) $id_template, $post_launch_params);
            }
        }
    }

    /**
     * Send SMS to the customer if order status is changed
     * @param array $params
     */
    public function hookPostUpdateOrderStatus($params)
    {
        require_once(dirname(__FILE__) . '/classes/MtargetSMS.php');
        require_once(dirname(__FILE__) . '/api/MtargetApiSmsAlerting.php');

        /* check if mode test is not activated */
        if (Configuration::get('MTARGET_LIVE_MODE') == 1) {
            $id_customer = (int) $params['cart']->id_customer;
            $id_order = (int) $params['id_order'];
            $customer = new Customer((int) $id_customer);
            $order = new Order((int) $id_order); //refrence
            $address = new Address((int) $params['cart']->id_address_delivery);
            $phone = $address->phone;
            $shop = new Shop((int) $params['cart']->id_shop);
            $shop_url = $shop->getBaseURL();

            /* update content template */
            $sms = new MtargetSMS((int) Configuration::get('MTARGET_CUSTOMER_ORDER_STATUS'));
            if ($sms->active == 1) {
                $template_sms = $sms->content[(int) $this->context->language->id];
                $template_sms = str_replace('#firstname#', $customer->firstname, $template_sms);
                $template_sms = str_replace('#lastname#', $customer->lastname, $template_sms);
                $template_sms = str_replace('#num_order#', $order->reference, $template_sms);
                $template_sms = str_replace('#amount#', $order->total_paid, $template_sms);
                $template_sms = str_replace('#url#', $shop_url, $template_sms);
                $template_sms = str_replace('#status#', $params['newOrderStatus']->name, $template_sms);
                /* create template sms */
                $sms_alerting = new MtargetApiSmsAlerting();
                $post_params = array(
                    'title' => $sms->event[(int) $this->context->language->id],
                    'sender' => Configuration::get('MTARGET_SENDER'),
                    'content' => $template_sms,
                    'editable' => 1,
                );
                $response = $sms_alerting->createTemplate($post_params);
                if ($response['code'] == 200) {
                    /* launch campaign */
                    $id_template = (int) $response['data']->id;
                    $post_launch_params = array(
                        'name' => $sms->event[(int) $this->context->language->id],
                        'numbers' => $phone,
                        'out_of_offers' => 'send',
                        'send_now' => 1,
                    );
                    $sms_alerting->launchCampaign((int) $id_template, $post_launch_params);
                }
            }
        }
    }

    /**
     * Send SMS to the customer
     * @param array $params
     */
    public function hookActionCartSave($params)
    {
        require_once(dirname(__FILE__) . '/classes/MtargetSMS.php');
        require_once(dirname(__FILE__) . '/classes/MtargetManage.php');
        require_once(dirname(__FILE__) . '/api/MtargetApiSmsAlerting.php');
        /* check if mode test not activated */
        if (Configuration::get('MTARGET_LIVE_MODE') == 1) {
            if (isset($params['cart']) && $params['cart']) {
                $customer = new Customer((int) $params['cart']->id_customer);
                $shop = new Shop((int) $params['cart']->id_shop);
                $id_cart = (int) $params['cart']->id;
                /* check if user has address */
                if ($params['cart']->id_address_delivery) {
                    $address = new Address((int) $params['cart']->id_address_delivery);
                    $phone = $address->phone;
                    $shop_url = $shop->getBaseURL();
                    /* check if id_cart exist in table mtarget_cart */
                    $dbQuery = new DbQuery();
                    $dbQuery->select('cr.id_mtarget_cart');
                    $dbQuery->from('mtarget_cart', 'cr');
                    $dbQuery->where('cr.id_cart = ' . (int) $id_cart);
                    $id = Db::getInstance(_PS_USE_SQL_SLAVE_)
                        ->getValue($dbQuery);
                    $manage = new MtargetManage();
                    /* cehck if cart is empty */
                    $cartProducts = $manage->getCartProducts((int) $id_cart);
                    /* if id_cart not exist in table mtarget_cart : save id_cart and send SMS */
                    if (!$id) {
                        if ($cartProducts == true) {
                            Db::getInstance()
                                ->insert(
                                    'mtarget_cart', array(
                                    'id_cart' => $id_cart,
                                    'id_campaign' => '',
                                    )
                            );
                            /* update content template */
                            $sms = new MtargetSMS((int) Configuration::get('MTARGET_CUSTOMER_CART'));
                            if ($sms->active == 1) {
                                $template_sms = $sms->content[(int) $this->context->language->id];
                                $template_sms = str_replace('#firstname#', $customer->firstname, $template_sms);
                                $template_sms = str_replace('#lastname#', $customer->lastname, $template_sms);
                                $template_sms = str_replace('#url#', $shop_url, $template_sms);
                                /* create template sms */
                                $sms_alerting = new MtargetApiSmsAlerting();
                                $post_params = array(
                                    'title' => $sms->event[(int) $this->context->language->id],
                                    'sender' => Configuration::get('MTARGET_SENDER'),
                                    'content' => $template_sms,
                                    'editable' => 1,
                                );
                                $response = $sms_alerting->createTemplate($post_params);

                                if ($response['code'] == 200) {
                                    /* launch campaign after n hours entered by user */
                                    $dateTime = new DateTime('now');
                                    $dateInterval = new DateInterval('PT' . (int) $sms->time_limit . 'H');
                                    $dateTime->add($dateInterval);
                                    $send_date = $dateTime->format('Y-m-d H:i:s');
                                    $id_template = (int) $response['data']->id;
                                    $post_launch_params = array(
                                        'name' => $sms->event[(int) $this->context->language->id],
                                        'numbers' => $phone,
                                        'out_of_offers' => 'send',
                                        'send_date' => $send_date,
                                    );
                                    $response_launch = $sms_alerting->launchCampaign(
                                        (int) $id_template, $post_launch_params
                                    );

                                    if ($response_launch['code'] == 200) {
                                        /* save id campaign in table mtarget_cart */
                                        Db::getInstance()
                                            ->update(
                                                'mtarget_cart', array(
                                                'id_campaign' => (int) $response_launch['data']->id,
                                                ), 'id_cart = ' . (int) $id_cart
                                        );

                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        /* if user clear cart : delete campaign */
                        if ($cartProducts == false) {
                            $this->deleteCampaign((int) $id_cart);
                        }
                    }
                }
            }
        }
    }

    public function launchSMSBirthdays()
    {
        $birthdaySMS = new MtargetSMS((int) Configuration::get('MTARGET_CUSTOMER_BIRTHDAY'));
        if ($birthdaySMS->active == 1 && Configuration::get('MTARGET_LIVE_MODE') == 1) {
            $nb_days = (int) $birthdaySMS->time_limit;
            /* get list of customers who anniversary date after $nb_days */
            $manage = new MtargetManage();
            $customersList = $manage->getCustomersBirthdays($nb_days);
            if (!empty($customersList)) {
                $nb_contacts = count($customersList);
                $nb_send_sms = 0;
                foreach ($customersList as $customer) {
                    $shop = new Shop((int) $customer->id_shop);
                    $shop_url = $shop->getBaseURL();
//get mobile number
                    $addresses = $customer->getAddresses($customer->id_lang);
                    $mobile = '';
                    if ($addresses) {
                        if ($addresses[0]['phone'] == '') {
                            $mobile = $addresses[0]['phone_mobile'];
                        } else {
                            $mobile = $addresses[0]['phone'];
                        }
                    }
// if customer has mobile number : send SMS
                    if ($mobile != '') {
                        $template_sms = $birthdaySMS->content[(int) $this->context->language->id];
                        $template_sms = str_replace('#firstname#', $customer->firstname, $template_sms);
                        $template_sms = str_replace('#lastname#', $customer->lastname, $template_sms);
                        $template_sms = str_replace('#url#', $shop_url, $template_sms);

                        /* create template sms */
                        $sms_alerting = new MtargetApiSmsAlerting();
                        $post_params = array(
                            'title' => $birthdaySMS->event[(int) $this->context->language->id],
                            'sender' => Configuration::get('MTARGET_SENDER'),
                            'content' => $template_sms,
                            'editable' => 1,
                        );
                        $response = $sms_alerting->createTemplate($post_params);
                        if ($response['code'] == 200) {
                            /* launch campaign */
                            $id_template = (int) $response['data']->id;
                            $post_launch_params = array(
                                'name' => $birthdaySMS->event[(int) $this->context->language->id],
                                'numbers' => $mobile,
                                'out_of_offers' => 'send',
                                'send_now' => 1,
                            );
                            $response_launch = $sms_alerting->launchCampaign((int) $id_template, $post_launch_params);
                            if ($response_launch['code'] == 200) {
                                $nb_send_sms++;
                            }
                        }
                    }
                }

                return $this->displayConfirmation($nb_send_sms . ' ' . $this->l('sms sent from') . ' ' . $nb_contacts);
            } else {
                return $this->adminDisplayWarning($this->l('No customer birthdays today.'));
            }
        } else {
            return $this->adminDisplayWarning($this->l('Please activate the live mode and the sms birthday.'));
        }
    }

    /**
     * Delete campaign for Abandoned Carts if order is validated
     * @param int id_cart
     * @return bool
     */
    public function deleteCampaign($id_cart)
    {
        /* get id_campaign if exist */
        $dbQuery = new DbQuery();
        $dbQuery->select('cr.id_campaign');
        $dbQuery->from('mtarget_cart', 'cr');
        $dbQuery->where('cr.id_cart = ' . (int) $id_cart);
        $id_campaign = Db::getInstance(_PS_USE_SQL_SLAVE_)
            ->getValue($dbQuery);
        if ($id_campaign) {
            /* delete campaign */
            $sms_alerting = new MtargetApiSmsAlerting();
            $response = $sms_alerting->deleteCampaign((int) $id_campaign);
            if ($response['code'] == 200) {
                /* delete row from mtarget_cart */
                Db::getInstance()
                    ->delete('mtarget_cart', 'id_cart = ' . (int) $id_cart);
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $sender
     * @return bool
     */
    public function isValidSender($sender)
    {
        if (ctype_digit($sender) == true || Tools::strlen($sender) > 11) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Gennerate a unique reference for segments
     *
     * @return String
     */
    public function generateReference()
    {
        return Tools::strtoupper(Tools::passwdGen(9, 'NO_NUMERIC'));
    }
}
