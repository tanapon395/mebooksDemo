
{*
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
*  @author     PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2017 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div id="mtarget_footer">
  <div class="col-lg-12 footer">
    <div class="col-lg-3 footer-block">
      <div class="footer-img"><img src="{$mtarget_img_path|escape:'htmlall':'utf-8'}SMS-automatises.jpg"/></div>
      <div class="block-content">
        <p class="footer-desc">{l s='Create and configure automated SMS sendings' mod='mtarget'}</p>
        <a href="{$url_config|escape:'htmlall':'utf-8'}&link_page=alerting">{l s='SMS Automated' mod='mtarget'}</a></div>
    </div>
    <div class="col-lg-3 footer-block">
      <div class="footer-img"><img src="{$mtarget_img_path|escape:'htmlall':'utf-8'}SMS-Marketing.jpg"/></div>
      <div class="block-content">
        <p class="footer-desc">{l s='Start sending promotionnal SMS to your clients' mod='mtarget'}</p>
        <a href="{$url_config|escape:'htmlall':'utf-8'}&link_page=marketing">{l s='SMS Marketing' mod='mtarget'}</a></div>
    </div>
    <div class="col-lg-3 footer-block">
      <div class="footer-img"><img src="{$mtarget_img_path|escape:'htmlall':'utf-8'}Support-Client.jpg"/></div>
      <div class="block-content">
        <p class="footer-desc">{l s='Our support team is available to answer any and all questions' mod='mtarget'}</p>
        <a target="_blank"
           href="https://addons.prestashop.com/contact-form.php?id_product=27869">{l s='Customer Support' mod='mtarget'}</a>
      </div>
    </div>
    <div class="col-lg-3 footer-block">
      <div class="footer-img"><img src="{$mtarget_img_path|escape:'htmlall':'utf-8'}Aide-en-Ligne.jpg"/></div>
      <div class="block-content">
        <p class="footer-desc">{l s='You have a question ? Our online help will probably help you find the answer' mod='mtarget'}</p>
        <a target="_blank" href="{$pdf_guide|escape:'htmlall':'utf-8'}">{l s='Online help' mod='mtarget'}</a></div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="legal clearfix"><img class="pull-right"
                                   src="{$mtarget_img_path|escape:'htmlall':'utf-8'}footer-logo.png"/>
  </div>
</div>

