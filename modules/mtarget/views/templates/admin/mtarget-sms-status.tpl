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
<form id="mtarget-update-status"
      class="defaultForm form-horizontal"
      action="{$url_config|escape:'htmlall':'UTF-8'}&action=mtargetUpdateStatus"
      method="post"
      enctype="multipart/form-data">
  <div class="panel">
    <div class="enabled-sms"><span>{$enable_sms|escape:'htmlall':'utf-8'}</span> {l s='enabled SMS' mod='mtarget'}</div>
    <div class="desabled-sms"><span>{$desable_sms|escape:'htmlall':'utf-8'}</span> {l s='disabled SMS' mod='mtarget'}</div>
    <table class="table col-lg-12 mtarget-table">
      {foreach $admin_sms as $sms}
        <tr>
          <td class="user">Admin</td>
          <td class="event">{$sms->event[$lang]|escape:'htmlall':'utf-8'}</td>
          <td>
                  <span class="switch prestashop-switch fixed-width-lg">
                    <input type="radio"
                           name="sms_{$sms->id_mtarget_sms|intval}" id="sms_{$sms->id_mtarget_sms|intval}_on"
                           value="1" {if $sms->active == 1} checked="checked"{/if}
                    />
                    {strip}
                      <label for="sms_{$sms->id_mtarget_sms|intval}_on">
                        {l s='Yes' d='Admin.Global' mod='mtarget'}
                      </label>
                    {/strip}
                    <input type="radio"
                           name="sms_{$sms->id_mtarget_sms|intval}" id="sms_{$sms->id_mtarget_sms|intval}_off"
                           value="0" {if $sms->active == 0} checked="checked"{/if}
                    />
                    {strip}
                      <label for="sms_{$sms->id_mtarget_sms|intval}_off">
                        {l s='No' d='Admin.Global' mod='mtarget'}
                      </label>
                    {/strip}
                    <a class="slide-button btn"></a>
                  </span>
          </td>
        </tr>
      {/foreach}
      {foreach $customer_sms as $sms}
        <tr>
          <td class="user">{l s='Customer' mod='mtarget'}</td>
          <td class="event">{$sms->event[$lang]|escape:'htmlall':'utf-8'}</td>
          <td>
                  <span class="switch prestashop-switch fixed-width-lg">
                    <input type="radio"
                           name="sms_{$sms->id_mtarget_sms|intval}" id="sms_{$sms->id_mtarget_sms|intval}_on"
                           value="1" {if $sms->active == 1} checked="checked"{/if}
                    />
                    {strip}
                      <label for="sms_{$sms->id_mtarget_sms|intval}_on">
                        {l s='Yes' d='Admin.Global' mod='mtarget'}
                      </label>
                    {/strip}
                    <input type="radio"
                           name="sms_{$sms->id_mtarget_sms|intval}" id="sms_{$sms->id_mtarget_sms|intval}_off"
                           value="0" {if $sms->active == 0} checked="checked"{/if}
                    />
                    {strip}
                      <label for="sms_{$sms->id_mtarget_sms|intval}_off">
                        {l s='No' d='Admin.Global' mod='mtarget'}
                      </label>
                    {/strip}
                    <a class="slide-button btn"></a>
                  </span>
          </td>
        </tr>
      {/foreach}
    </table>
    <button type="submit"
            name="submitMtargetUpdateStatus"
            id="mtarget-submit-account"
            class="btn btn-default pull-right">
      <i class="process-icon-save"></i> {l s='Save' mod='mtarget'}
    </button>
    <div class="clearfix"></div>
  </div>
</form>
