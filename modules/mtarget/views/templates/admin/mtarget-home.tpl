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
{include file='./_partials/mtarget-header.tpl'}
<div id="bo-mtarget">
  <div class="form-wrapper">
    <ul class="nav nav-tabs">
      <li {if $active == 'home'}class="active"{/if}>
        <a href="#home" data-toggle="tab">{l s='Presentation' mod='mtarget'}</a>
      </li>
      <li {if $active == 'configuration'}class="active"{/if}>
        <a href="#configuration" data-toggle="tab">{l s='Configuration' mod='mtarget'}</a>
      </li>
    </ul>
    <div class="tab-content panel">
      <div id="home" class="tab-pane {if $active == 'home'}active{/if}">
        {include file='./_partials/mtarget-presentation.tpl'}
      </div>
      <div id="configuration" class="tab-pane {if $active == 'configuration'}active{/if}">
        <div class="account-create"> {include file="./mtarget-account.tpl"}</div>
        <div class="account-setting"> {$authenticationSettings}</div>
        <div class="clearfix"></div>
        {include file='./_partials/mtarget-footer.tpl'}
      </div>
    </div>
  </div>
</div>

