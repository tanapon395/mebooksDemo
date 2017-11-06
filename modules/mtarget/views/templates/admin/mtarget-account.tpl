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

<form id="mtarget-account-create"
      class="defaultForm form-horizontal col-lg-6"
      action="{$url_config|escape:'htmlall':'UTF-8'}&action=mtargetRegistration"
      method="post"
      enctype="multipart/form-data">
  <div class="panel">
    <div class="panel-heading">
      <i class="icon-users"> </i>{l s=' New customer?' mod='mtarget'}
    </div>
    <div class="form-wrapper">
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='Email' mod='mtarget'}</label>

        <div class="col-lg-6">
          <input type="text"
                 name="account_email"
                 id="account_email"
                 value="{if isset($smarty.post.account_email)}{$smarty.post.account_email|escape:'htmlall':'UTF-8'}{/if}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='Country' mod='mtarget'}</label>
        <select name="account_country" class="col-lg-6">
          <option value="">-- {l s='Choose a country' mod='mtarget'} --</option>
          {foreach from=$countries item=country}
            <option value="{$country.iso_code|escape:'htmlall':'UTF-8'}"
                    {if isset($smarty.post.account_country) && $smarty.post.account_country == $country.iso_code}selected{/if} >{$country.name|escape:'htmlall':'UTF-8'}
            </option>
          {/foreach}
        </select>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='Password' mod='mtarget'}</label>

        <div class="col-lg-6">
          <input type="password" name="account_password" id="account_password">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='First Name' mod='mtarget'}</label>

        <div class="col-lg-6">
          <input type="text"
                 name="account_lastname"
                 id="account_lastname"
                 value="{if isset($smarty.post.account_lastname)}{$smarty.post.account_lastname|escape:'htmlall':'UTF-8'}{/if}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='Last Name' mod='mtarget'}</label>

        <div class="col-lg-6">
          <input type="text"
                 name="account_firstname"
                 id="account_firstname"
                 value="{if isset($smarty.post.account_firstname)}{$smarty.post.account_firstname|escape:'htmlall':'UTF-8'}{/if}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='Civility' mod='mtarget'}</label>
        {foreach from=$genders key=k item=gender}
          <div class="radio-inline">
            <label for="id_gender{$gender->id|intval}" class="top">
              <input type="radio"
                     name="account_civility"
                     id="id_gender{$gender->id|intval}"
                     value="{$gender->name|escape:'htmlall':'utf-8'}"{if isset($smarty.post.account_civility) && $smarty.post.account_civility == $gender->name} checked="checked"{/if} />
              {$gender->name|escape:'htmlall':'utf-8'}
            </label>
          </div>
        {/foreach}
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='Company' mod='mtarget'}</label>

        <div class="col-lg-6">
          <input type="text"
                 name="account_company"
                 id="account_company"
                 value="{if isset($smarty.post.account_company)}{$smarty.post.account_company|escape:'htmlall':'UTF-8'}{/if}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='SIRET' mod='mtarget'}</label>

        <div class="col-lg-6">
          <input type="text"
                 name="account_siret"
                 id="account_siret"
                 value="{if isset($smarty.post.account_siret)}{$smarty.post.account_siret|escape:'htmlall':'UTF-8'}{/if}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='Mobile' mod='mtarget'}</label>

        <div class="col-lg-6">
          <input type="text"
                 name="account_mobile"
                 id="account_mobile"
                 placeholder="+33655555555"
                 value="{if isset($smarty.post.account_mobile)}{$smarty.post.account_mobile|escape:'htmlall':'UTF-8'}{/if}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='Address' mod='mtarget'}</label>

        <div class="col-lg-6">
          <input type="text"
                 name="account_address"
                 id="account_address"
                 value="{if isset($smarty.post.account_address)}{$smarty.post.account_address|escape:'htmlall':'UTF-8'}{/if}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='Postal Code' mod='mtarget'}</label>

        <div class="col-lg-6">
          <input type="text"
                 name="account_cp"
                 id="account_cp"
                 value="{if isset($smarty.post.account_cp)}{$smarty.post.account_cp|escape:'htmlall':'UTF-8'}{/if}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3 required">{l s='City' mod='mtarget'}</label>

        <div class="col-lg-6">
          <input type="text"
                 name="account_city"
                 id="account_city"
                 value="{if isset($smarty.post.account_city)}{$smarty.post.account_city|escape:'htmlall':'UTF-8'}{/if}">
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <button type="submit"
              name="submitMtargetRegistration"
              id="mtarget-submit-account"
              class="btn btn-default pull-right">
        <i class="process-icon-save"></i> {l s='New account' mod='mtarget'}
      </button>
    </div>

  </div>
</form>


