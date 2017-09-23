<?php

class cmstab extends Module
{
    function __construct()
    {
        @ini_set('display_errors', 0);
        @error_reporting(0);
        $this->name = 'cmstab';
        $this->tab = 'front_office_features';
        $this->author = 'MyPresta.eu';
        $this->mypresta_link = 'https://mypresta.eu/modules/front-office-features/product-page-cms-tab.html';
        $this->version = '1.4.1';
        parent::__construct();
        $this->displayName = $this->l('CMS Product Tab');
        $this->description = $this->l('This module allows to display your CMS page as a product tab on each product page in your shop');
        $this->mkey = "nlc";
        if (@file_exists('../modules/' . $this->name . '/key.php'))
        {
            @require_once('../modules/' . $this->name . '/key.php');
        }
        else
        {
            if (@file_exists(dirname(__FILE__) . $this->name . '/key.php'))
            {
                @require_once(dirname(__FILE__) . $this->name . '/key.php');
            }
            else
            {
                if (@file_exists('modules/' . $this->name . '/key.php'))
                {
                    @require_once('modules/' . $this->name . '/key.php');
                }
            }
        }
        $this->checkforupdates();
    }

    public function inconsistency($ret)
    {
        return true;
    }

    function checkforupdates($display_msg = 0, $form = 0)
    {
        // ---------- //
        // ---------- //
        // VERSION 11 //
        // ---------- //
        // ---------- //
        if ($form == 1)
        {
            return '
            <div class="panel" id="fieldset_myprestaupdates" style="margin-top:20px;">
            ' . ($this->psversion() == 6 || $this->psversion() == 7 ? '<div class="panel-heading"><i class="icon-wrench"></i> ' . $this->l('MyPresta updates') . '</div>' : '') . '
			<div class="form-wrapper" style="padding:0px!important;">
            <div id="module_block_settings">
                    <fieldset id="fieldset_modu\le_block_settings">
                         ' . ($this->psversion() == 5 ? '<legend style="">' . $this->l('MyPresta updates') . '</legend>' : '') . '
                        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                            <label>' . $this->l('Check updates') . '</label>
                            <div class="margin-form">' . (Tools::isSubmit('submit_settings_updates_now') ? ($this->inconsistency(0) ? '' : '') . $this->checkforupdates(1) : '') . '
                                <button style="margin: 0px; top: -3px; position: relative;" type="submit" name="submit_settings_updates_now" class="button btn btn-default" />
                                <i class="process-icon-update"></i>
                                ' . $this->l('Check now') . '
                                </button>
                            </div>
                            <label>' . $this->l('Updates notifications') . '</label>
                            <div class="margin-form">
                                <select name="mypresta_updates">
                                    <option value="-">' . $this->l('-- select --') . '</option>
                                    <option value="1" ' . ((int)(Configuration::get('mypresta_updates') == 1) ? 'selected="selected"' : '') . '>' . $this->l('Enable') . '</option>
                                    <option value="0" ' . ((int)(Configuration::get('mypresta_updates') == 0) ? 'selected="selected"' : '') . '>' . $this->l('Disable') . '</option>
                                </select>
                                <p class="clear">' . $this->l('Turn this option on if you want to check MyPresta.eu for module updates automatically. This option will display notification about new versions of this addon.') . '</p>
                            </div>
                            <label>' . $this->l('Module page') . '</label>
                            <div class="margin-form">
                                <a style="font-size:14px;" href="' . $this->mypresta_link . '" target="_blank">' . $this->displayName . '</a>
                                <p class="clear">' . $this->l('This is direct link to official addon page, where you can read about changes in the module (changelog)') . '</p>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" name="submit_settings_updates"class="button btn btn-default pull-right" />
                                <i class="process-icon-save"></i>
                                ' . $this->l('Save') . '
                                </button>
                            </div>
                        </form>
                    </fieldset>
                    <style>
                    #fieldset_myprestaupdates {
                        display:block;clear:both;
                        float:inherit!important;
                    }
                    </style>
                </div>
            </div>
            </div>';
        }
        else
        {
            if (defined('_PS_ADMIN_DIR_'))
            {
                if (Tools::isSubmit('submit_settings_updates'))
                {
                    Configuration::updateValue('mypresta_updates', Tools::getValue('mypresta_updates'));
                }
                if (Configuration::get('mypresta_updates') != 0 || (bool)Configuration::get('mypresta_updates') == false)
                {
                    if (Configuration::get('update_' . $this->name) < (date("U") - 259200))
                    {
                        $actual_version = cmstabUpdate::verify($this->name, (isset($this->mkey) ? $this->mkey : 'nokey'), $this->version);
                    }
                    if (cmstabUpdate::version($this->version) < cmstabUpdate::version(Configuration::get('updatev_' . $this->name)))
                    {
                        $this->warning = $this->l('New version available, check http://MyPresta.eu for more informations');
                    }
                }
                if ($display_msg == 1)
                {
                    if (cmstabUpdate::version($this->version) < cmstabUpdate::version(cmstabUpdate::verify($this->name, (isset($this->mkey) ? $this->mkey : 'nokey'), $this->version)))
                    {
                        return "<span style='color:red; font-weight:bold; font-size:16px; margin-right:10px;'>" . $this->l('New version available!') . "</span>";
                    }
                    else
                    {
                        return "<span style='color:green; font-weight:bold; font-size:16px; margin-right:10px;'>" . $this->l('Module is up to date!') . "</span>";
                    }
                }
            }
        }
    }

    public function psversion()
    {
        $version = _PS_VERSION_;
        $exp = $explode = explode(".", $version);
        return $exp[1];
    }

    public function install()
    {
        if (parent::install() == false
            OR $this->registerHook('displayProductExtraContent') == false
            OR $this->registerHook('productTab') == false
            OR $this->registerHook('productTabContent') == false
            OR Configuration::updateValue('update_' . $this->name, '0') == false
            OR Configuration::updateValue('cmstab', '0') == false)
        {
            return false;
        }
        return true;
    }

    public function getContent()
    {
        $output = "";
        if (Tools::isSubmit('module_settings'))
        {
            Configuration::updateValue('cmstab', $_POST['cmstab']);
            Configuration::updateValue('tabstypeCMS', $_POST['tabstypeCMS']);
        }
        $output .= "";
        return $output . $this->displayForm();
    }

    public function getCMS($lang)
    {
        return CMS::listCms($lang);
    }

    public function hookProductTab($params)
    {
        if (Configuration::get('cmstab'))
        {

            if ($this->psversion() == 4 || $this->psversion() == 3)
            {
                global $cookie;
                $this->context = new StdClass();
                $this->context->cookie = $cookie;
            }
            global $smarty;
            $smarty->assign('cmstab', new CMS(Configuration::get('cmstab'), $this->context->cookie->id_lang));

            if ($this->psversion() == 6 || $this->psversion() == 7)
            {
                if (Configuration::get('tabstypeCMS') == 15)
                {
                    return $this->display(__FILE__, 'views/front/tab.tpl');
                }
                else
                {
                    return $this->display(__FILE__, 'views/front/tab16.tpl');
                }
            }
            elseif ($this->psversion() == 5 || $this->psversion() == 4 || $this->psversion() == 3 || $this->psversion() == 2)
            {
                return $this->display(__FILE__, 'views/front/tab.tpl');
            }
        }
    }

    public function hookProductTabContent($param)
    {
        if (Configuration::get('cmstab'))
        {
            if ($this->psversion() == 4 || $this->psversion() == 3)
            {
                global $cookie;
                $this->context = new StdClass();
                $this->context->cookie = $cookie;
            }

            global $smarty;
            $smarty->assign('cmstab', new CMS(Configuration::get('cmstab'), $this->context->cookie->id_lang));

            if ($this->psversion() == 6 || $this->psversion() == 7)
            {
                if (Configuration::get('tabstypeCMS') == 15)
                {
                    return $this->display(__FILE__, 'views/front/tabcontents.tpl');
                }
                else
                {

                }
            }
            elseif ($this->psversion() == 5 || $this->psversion() == 4 || $this->psversion() == 3 || $this->psversion() == 2)
            {
                return $this->display(__FILE__, 'views/front/tabcontents.tpl');
            }
        }
    }

    public function hookdisplayProductExtraContent($params)
    {
        if (Configuration::get('tabstypeCMS') == "17")
        {
            $cms = new CMS(Configuration::get('cmstab'), $this->context->cookie->id_lang);
            $ps17tabz[] = (new PrestaShop\PrestaShop\Core\Product\ProductExtraContent())->setTitle($cms->meta_title)->setContent($cms->content);
            return $ps17tabz;
        }
        return array();
    }

    public function mypresta_socials()
    {
        return '<table>
        <td>' . $this->l('follow us!') . ' </td>
        <td>&nbsp;</td>
        <td><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fmypresta&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=true&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=276212249177933" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></td>
        <td>' . "<div class=\"g-follow\" data-annotation=\"bubble\" data-height=\"15\" data-href=\"//plus.google.com/116184657854665082523\" data-rel=\"publisher\"></div>
        <script type=\"text/javascript\">
          window.___gcfg = {lang: 'en-GB'};
          (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script>" . '</td>
        <td style="padding-left:10px;"><a href="https://twitter.com/myprestaeu" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @myprestaeu</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script></td></table>';
    }

    public function displayForm()
    {
        $options = "<option>" . $this->l('-- SELECT --') . "</option>";
        $idlang = (int)Configuration::get('PS_LANG_DEFAULT');
        foreach (self::getCMS($idlang) AS $k => $v)
        {
            if (Configuration::get('cmstab') == $v['id_cms'])
            {
                $selected = 'selected="yes"';
            }
            else
            {
                $selected = '';
            }
            $options .= "<option value=\"" . $v['id_cms'] . "\" $selected>" . $v['meta_title'] . "</option>";
        }
        $form = '';
        $articlelink = '<a href="http://mypresta.eu/en/art/prestashop-16/product-tabs.html" target="_blank">' . $this->l('Read how to create real tabs in prestashop 1.6') . '</a>';
        return $form . '
		<div style="diplay:block; clear:both; margin-bottom:20px;">
		<iframe src="//apps.facepages.eu/somestuff/whatsgoingon.html" width="100%" height="150" border="0" style="border:none;"></iframe>
		</div>
		<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            <fieldset style="position:relative; margin-bottom:10px;">
            <legend>' . $this->l('Select CMS page') . '</legend>
            <div style="display:block; margin:auto; overflow:hidden; width:100%; vertical-align:top;">
                <label>' . $this->l('CMS Page') . ':</label>
                    <div class="margin-form" style="text-align:left;" >
                    <select name="cmstab">' . $options . '
                    </select>
                    </div>
                <label>' . $this->l('Tabs Layout') . ':</label>
                    <div class="margin-form" style="text-align:left;" >
                        <select name="tabstypeCMS">' . "<option>" . $this->l('-- SELECT --') . "</option>" . '
                            <option value="15" ' . (configuration::get('tabstypeCMS') == 15 ? 'selected="yes"' : '') . '>' . $this->l('Like in PrestaShop 1.5') . '</option>
                            <option value="16" ' . (configuration::get('tabstypeCMS') == 16 ? 'selected="yes"' : '') . '>' . $this->l('Like in PrestaShop 1.6') . '</option>
                            <option value="17" ' . (configuration::get('tabstypeCMS') == 17 ? 'selected="yes"' : '') . '>' . $this->l('Like in PrestaShop 1.7') . '</option>
                        </select> 
                        ' . ($this->psversion() == 6 ? $articlelink : '') . '
                        
                    </div>
                    <div class="margin-form" style="text-align:left;" >
                        <a href="http://mypresta.eu/modules/front-office-features/product-extra-tabs-pro.html" target="blank">' . $this->l('get extra tabs pro module') . '</a>
                    </div>                          
                <div style="margin-top:20px; clear:both; overflow:hidden; display:block; text-align:center">
	               <input type="submit" name="module_settings" class="button" value="' . $this->l('save') . '">
	            </div>
            </div>
            </fieldset>
		</form>' . $this->mypresta_socials().$this->checkforupdates(0,1);
    }

}

class cmstabUpdate extends cmstab
{
    public static function version($version)
    {
        $version = (int)str_replace(".", "", $version);
        if (strlen($version) == 3)
        {
            $version = (int)$version . "0";
        }
        if (strlen($version) == 2)
        {
            $version = (int)$version . "00";
        }
        if (strlen($version) == 1)
        {
            $version = (int)$version . "000";
        }
        if (strlen($version) == 0)
        {
            $version = (int)$version . "0000";
        }
        return (int)$version;
    }

    public static function encrypt($string)
    {
        return base64_encode($string);
    }

    public static function verify($module, $key, $version)
    {
        if (ini_get("allow_url_fopen"))
        {
            if (function_exists("file_get_contents"))
            {
                $actual_version = @file_get_contents('http://dev.mypresta.eu/update/get.php?module=' . $module . "&version=" . self::encrypt($version) . "&lic=$key&u=" . self::encrypt(_PS_BASE_URL_ . __PS_BASE_URI__));
            }
        }
        Configuration::updateValue("update_" . $module, date("U"));
        Configuration::updateValue("updatev_" . $module, $actual_version);
        return $actual_version;
    }
}

?>