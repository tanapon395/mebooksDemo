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

<div class="row">
  <div class="col-lg-12">
    <div class="panel col-lg-12">
      <div class="panel-heading">
        {l s='Birthday Cron' mod='mtarget'}
      </div>
      <div class="row">
        <div class="col-lg-12">
          <p>{l s='You can launch birthday SMS for your customers using the two following methods:' mod='mtarget'}</p>

          <p><span class="mtarget-number">1. </span>{l s='Manually, by clicking the button below' mod='mtarget'}</p>
          <a href="{$mtarget_launch_birthdays|escape:'html':'utf-8'}"
             class="btn btn-primary btn-cron">{l s='Send SMS Birthdays' mod='mtarget'}</a>

          <p class="info-birthday">{$nb_birthday_contacts|escape:'html':'utf-8'} &nbsp;{l s='birthday(s) to send' mod='mtarget'}</p>

          <p class="mtarget-or">{l s='-or-' mod='mtarget'}</p>

          <p>
            <span class="mtarget-number">2. </span>{l s='Automatically, ask your hosting provider or your administrator to setup a "Cron Task" to load the following URL at the time you would like:' mod='mtarget'}
          </p>
          {$mtarget_birthdays_url|escape:'html':'utf-8'}
        </div>
      </div>
    </div>
  </div>
</div>
