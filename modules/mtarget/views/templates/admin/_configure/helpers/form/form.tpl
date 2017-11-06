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

{extends file="helpers/form/form.tpl"}

{block name="input_row"}
  {if $input.type == 'textareaCounter'}
    <div class="form-group">
      <label class="control-label col-lg-3">{l s='Content' mod='mtarget'}</label>

      {if isset($input.countchar)}
      <div class="col-lg-6 textarea_sms">
        <div class="input-group">{/if}
          {assign var=use_textarea_autosize value=true}
          {if isset($input.lang) AND $input.lang}
          {foreach $languages as $language}
          {if $languages|count > 1}
            <div class="input-group form-group translatable-field lang-{$language.id_lang|intval}"{if $language.id_lang != $defaultFormLanguage} style="display:none;"{/if}>

          {/if}
            {if isset($input.countchar) }
              <span id="{if isset($input.id)}{$input.id|intval}_{$language.id_lang|intval}{else}{$input.name|escape:'htmlall':'utf-8'}_{$language.id_lang|intval}{/if}_counter"
                    class="input-group-addon">
				<span class="text-count-up">{$input.countchar|intval}</span>
				</span>
            {/if}
            <textarea{if isset($input.readonly) && $input.readonly} readonly="readonly"{/if} name="{$input.name|escape:'htmlall':'utf-8'}_{$language.id_lang|intval}"
                                                                                             id="{if isset($input.id)}{$input.id|intval}{else}{$input.name|escape:'htmlall':'utf-8'}{/if}_{$language.id_lang|intval}"
                                                                                             class="{if isset($input.autoload_rte) && $input.autoload_rte}rte autoload_rte{else}textarea-autosize{/if}{if isset($input.class)} {$input.class|escape:'htmlall':'utf-8'}{/if}"{if isset($input.countchar)} {/if}{if isset($input.countchar) } data-maxchar="{$input.countchar|intval}"{/if}>{$fields_value[$input.name][$language.id_lang]|escape:'html':'UTF-8'}</textarea>
          {if $languages|count > 1}
            <div class="col-lg-2">
              <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                {$language.iso_code|escape:'htmlall':'utf-8'}
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                {foreach from=$languages item=language}
                  <li>
                    <a href="javascript:hideOtherLanguage({$language.id_lang|intval});" tabindex="-1">{$language.name|escape:'htmlall':'utf-8'}</a>
                  </li>
                {/foreach}
              </ul>
            </div>
            </div>
          {/if}
          {/foreach}
          {if isset($input.countchar)}
            <script type="text/javascript">
              $(document).ready(function () {
                {foreach from=$languages item=language}
                countChar($("#{if isset($input.id)}{$input.id|intval}_{$language.id_lang|intval}{else}{$input.name|escape:'htmlall':'utf-8'}_{$language.id_lang|intval}{/if}"), $("#{if isset($input.id)}{$input.id|intval}_{$language.id_lang|intval}{else}{$input.name|escape:'htmlall':'utf-8'}_{$language.id_lang|intval}{/if}_counter"));
                {/foreach}
              });
            </script>
          {/if}
          {else}
          {if isset($input.countchar)}
            <span id="{if isset($input.id)}{$input.id|intval}_{$language.id_lang|intval}{else}{$input.name|escape:'htmlall':'utf-8'}_{$language.id_lang|intval}{/if}_counter"
                  class="input-group-addon">
		        <span class="text-count-up">{$input.countchar|intval}</span>
		    </span>
          {/if}
            <textarea{if isset($input.readonly) && $input.readonly} readonly="readonly"{/if} name="{$input.name|escape:'htmlall':'utf-8'}"
                                                                                             id="{if isset($input.id)}{$input.id|intval}{else}{$input.name|escape:'htmlall':'utf-8'}{/if}" {if isset($input.cols)}cols="{$input.cols}"{/if} {if isset($input.rows)}rows="{$input.rows}"{/if}
                                                                                             class="{if isset($input.autoload_rte) && $input.autoload_rte}rte autoload_rte{else}textarea-autosize{/if}{if isset($input.class)} {$input.class|escape:'htmlall':'utf-8'}{/if}"{if isset($input.maxlength) && $input.maxlength} maxlength="{$input.maxlength|intval}" height="100"{/if}{if isset($input.countchar)} data-maxchar="{$input.countchar|intval}"{/if} >{$fields_value[$input.name]|escape:'html':'UTF-8'}</textarea>
          {if isset($input.countchar) && $input.countchar}
            <script type="text/javascript">
              $(document).ready(function () {
                countChar($("#{if isset($input.id)}{$input.id|intval}{else}{$input.name|escape:'htmlall':'utf-8'}{/if}"), $("#{if isset($input.id)}{$input.id|intval}{else}{$input.name|escape:'htmlall':'utf-8'}{/if}_counter"));
              });
            </script>
          {/if}
          {/if}
          {if isset($input.countchar) }</div>
        <p class="help-block">{$input.desc|escape:'htmlall':'utf-8'}</p></div>{/if}
    </div>
  {else}
    {$smarty.block.parent}
  {/if}
{/block}
