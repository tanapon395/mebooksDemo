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
      <li {if $active == 'dashboard'}class="active"{/if}>
        <a href="{$url_config|escape:'htmlall':'utf-8'}&link_page=dashboard">{l s='Home' mod='mtarget'}</a>
      </li>
      <li {if $active == 'sms'}class="active"{/if}>
        <a href="#sms" data-toggle="tab">{l s='Automated SMS' mod='mtarget'}</a>
      </li>
      <li {if $active == 'marketing'}class="active"{/if}>
        <a href="#marketing" data-toggle="tab">{l s='SMS Marketing' mod='mtarget'}</a>
      </li>
      <li {if $active == 'help'}class="active"{/if}>
        <a href="https://addons.prestashop.com/contact-form.php?id_product=27869" target=_blank>{l s='Customer Support' mod='mtarget'}</a>
      </li>
      <li class="myaccount {if $active == 'myaccount'}active{/if}">
        <a href="{$url_config|escape:'htmlall':'utf-8'}&link_page=myaccount">{l s='MY ACCOUNT' mod='mtarget'}
          &nbsp;&nbsp;<i class="icon-user"></i></a>
      </li>
    </ul>
    <div class="tab-content panel">
      <div id="dashboard" class="tab-pane {if $active == 'dashboard'}active{/if}">
        {include file='./_partials/user-info.tpl'}
        <div class="mode-setting">{$modeSetting}</div>
        <div class="col-lg-6 marget-status">
          {include file='./mtarget-sms-status.tpl'}
        </div>
        <div class="col-lg-6 bloc-img">
          <div id="chartContainer" style="height: 200px; width: 100%;"></div>
          <div id="chartContainerLine" style="height: 200px; width: 100%;"></div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div id="sms" class="tab-pane {if $active == 'sms'}active{/if}">
        <div class="alert alert-info">{l s='To enhance the module performance, we recommand to make the phone number input mandatory on the address webform.' mod='mtarget'}
          <br/>{l s='To do so, go to "Sell > Customers > Addresses",  a button "Set required fields for this section" is available at the bottom of the page' mod='mtarget'}
        </div>
        {$smsSetting}
        <div class="clearfix"></div>
        <div class="alert alert-info">{l s='Customize the sms using the variables listed below each block' mod='mtarget'}
          <br/>{l s='NB: The number of characters of your sms is presented to you for information (subject to the variables that may have impacted the actual number of characters, this estimate will allow you to measure the number of credits consumed according to the following grid:' mod='mtarget'}
          <br/>{l s='From 1 to 160 characters = 1 SMS' mod='mtarget'}<br/>
          {l s='From 161 to 306 characters = 2 SMS' mod='mtarget'}<br/>
          {l s='From 307 to 459 characters = 3 SMS' mod='mtarget'}<br/>
          {l s='From 460 to 612 characters = 4 SMS' mod='mtarget'}<br/>
          {l s='From 613 to 765 characters = 5 SMS' mod='mtarget'}
        </div>
        {$smsTemplateAdmin}
        <div class="clearfix"></div>
        <div class="alert alert-info">{l s='Customize the sms using the variables listed below each block' mod='mtarget'}
          <br/>{l s='NB: The number of characters of your sms is presented to you for information (subject to the variables that may have impacted the actual number of characters, this estimate will allow you to measure the number of credits consumed according to the following grid:' mod='mtarget'}
          <br/>{l s='From 1 to 160 characters = 1 SMS' mod='mtarget'}<br/>
          {l s='From 161 to 306 characters = 2 SMS' mod='mtarget'}<br/>
          {l s='From 307 to 459 characters = 3 SMS' mod='mtarget'}<br/>
          {l s='From 460 to 612 characters = 4 SMS' mod='mtarget'}<br/>
          {l s='From 613 to 765 characters = 5 SMS' mod='mtarget'}
        </div>
        <div>{$smsTemplateCustomer}</div>
        {include file='./_partials/mtarget-birthday-cron.tpl'}
        <div class="clearfix"></div>

      </div>
      <div id="marketing" class="tab-pane {if $active == 'marketing'}active{/if}">
        <p>{l s='Configure the customer segments to which you want to send SMS from your Mtarget platform' mod='mtarget'}</p>

        <div id="segment-error" class="alert alert-danger" style="display: none;"></div>
        <div class="clearfix col-lg-5"> {$newSegment}
          <div class="panel-footer footer-segment">
            <a href="#segment_name_form"
               id="submitNewSegmentForm"
               class="btn btn-default pull-right"><i class="process-icon-plus-sign icon-plus-sign"></i>{l s='Add a new segment' mod='mtarget'}
            </a></div>
        </div>
        {include file='./mtarget-segment-name.tpl'}
        {include file='./mtarget-segments-list.tpl'}
        <div class="col-lg-12 segments-list">
          <div id="segments-list"></div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div id="myaccount" class="tab-pane {if $active == 'myaccount'}active{/if}">
        <div class="panel account-settings">
          <div class="panel-heading"><i class="icon-cogs"></i>{l s=' Account Settings' mod='mtarget'}</div>
          <div class="alert alert-info">{l s='We recommend that you save your API IDs in a safe place so that you can re-enter them if you need them.' mod='mtarget'}
          </div>
          {include file='./_partials/user-info.tpl'}
          {if $balance != 0}
          <p class="buy-credit clearfix">{l s='To buy credit or connect to the marketing platform please click :' mod='mtarget'}
            <a href="{$link_credit|escape:'htmlall':'utf-8'}" target="_blank">&nbsp;{l s='here' mod='mtarget'}</a>
            {/if}

          <div> {$accountSettings}</div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>

{include file='./_partials/mtarget-footer-connect.tpl'}
<script type="text/javascript">
  {literal}
  window.onload = function () {
    var legend = false;
    if ({/literal}{$empty_stat|intval}{literal} == 1
    )
    {
      legend = true;
    }
    var chart = new CanvasJS.Chart("chartContainer",
      {
        title: {
          text: {/literal}"{l s='Distribution of sms by type' mod='mtarget'}"{literal}
        },
        animationEnabled: true,
        theme: "theme2",
        data: [
          {
            type: "doughnut",
            indexLabelFontFamily: "Garamond",
            indexLabelFontSize: 16,
            startAngle: 0,
            indexLabelFontColor: "dimgrey",
            indexLabelLineColor: "darkgrey",
            showInLegend: legend,
            //toolTipContent: "y %",

            dataPoints: [
              {
                y: {/literal}{$percent_new_order|floatval} {literal},
                legendText: "{/literal}{l s='New order' mod='mtarget'}{literal} " + {/literal}{$percent_new_order|floatval}{literal} +"%",
                indexLabel: "{/literal}{l s='New order' mod='mtarget'}{literal} " + {/literal}{$percent_new_order|floatval}{literal} +"%"
              },
              {
                y: {/literal}{$percent_order_statut|floatval}{literal},
                legendText: "{/literal}{l s='Order status' mod='mtarget'}{literal} " + {/literal}{$percent_order_statut|floatval}{literal} +"%",
                indexLabel: "{/literal}{l s='Order status' mod='mtarget'}{literal} " + {/literal}{$percent_order_statut|floatval}{literal} +"%"
              },
              {
                y: {/literal}{$percent_cart|floatval}{literal},
                legendText: "{/literal}{l s='Abandoned cart' mod='mtarget'}{literal} " + {/literal}{$percent_cart|floatval}{literal} +"%",
                indexLabel: "{/literal}{l s='Abandoned cart' mod='mtarget'}{literal} " + {/literal}{$percent_cart|floatval}{literal} +"%"
              },
              {
                y: {/literal}{$percent_account|floatval}{literal},
                legendText: "{/literal}{l s='Account creation' mod='mtarget'}{literal} " + {/literal}{$percent_account|floatval}{literal} +"%",
                indexLabel: "{/literal}{l s='Account creation' mod='mtarget'}{literal} " + {/literal}{$percent_account|floatval}{literal} +"%"
              },
              {
                y: {/literal}{$percent_product_return|floatval}{literal},
                legendText: "{/literal}{l s='Product return' mod='mtarget'}{literal} " + {/literal}{$percent_product_return|floatval}{literal} +"%",
                indexLabel: "{/literal}{l s='Product return' mod='mtarget'}{literal} " + {/literal}{$percent_product_return|floatval}{literal} +"%"
              },
              {
                y: {/literal}{$percent_birthday|floatval}{literal},
                legendText: "{/literal}{l s='Birthday' mod='mtarget'}{literal} " + {/literal}{$percent_birthday|floatval}{literal} +"%",
                indexLabel: "{/literal}{l s='Birthday' mod='mtarget'}{literal} " + {/literal}{$percent_birthday|floatval}{literal} +"%"
              }

            ]
          }
        ]
      });


    chart.render();


    var array = {/literal}{$tab_stat|json_encode}{literal};
    if (array.length != 0){
      var chartLine = new CanvasJS.Chart("chartContainerLine",
        {
          theme: "theme2",
          title: {
            text: {/literal}"{l s='Distribution of sms per month' mod='mtarget'}"{literal}
          },
          animationEnabled: true,
          axisX: {
            valueFormatString: "MMM",
            interval: 1,
            intervalType: "month"

          },
          axisY: {
            includeZero: true

          },
          data: [
            {
              type: "line",
              dataPoints: [
                {
                  x: new Date({/literal}{$tab_stat[0]['year']|intval}{literal}, {/literal}{$tab_stat[0]['month']|intval}{literal}, {/literal}{$tab_stat[0]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[0]['sms']|intval}{literal}
                },
                {
                  x: new Date({/literal}{$tab_stat[1]['year']|intval}{literal}, {/literal}{$tab_stat[1]['month']|intval}{literal}, {/literal}{$tab_stat[1]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[1]['sms']|intval}{literal}
                },
                {
                  x: new Date({/literal}{$tab_stat[2]['year']|intval}{literal}, {/literal}{$tab_stat[2]['month']|intval}{literal}, {/literal}{$tab_stat[2]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[2]['sms']|intval}{literal}
                },
                {
                  x: new Date({/literal}{$tab_stat[3]['year']|intval}{literal}, {/literal}{$tab_stat[3]['month']|intval}{literal}, {/literal}{$tab_stat[3]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[3]['sms']|intval}{literal}
                },
                {
                  x: new Date({/literal}{$tab_stat[4]['year']|intval}{literal}, {/literal}{$tab_stat[4]['month']|intval}{literal}, {/literal}{$tab_stat[4]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[4]['sms']|intval}{literal}
                },
                {
                  x: new Date({/literal}{$tab_stat[5]['year']|intval}{literal}, {/literal}{$tab_stat[5]['month']|intval}{literal}, {/literal}{$tab_stat[5]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[5]['sms']|intval}{literal}
                },
                {
                  x: new Date({/literal}{$tab_stat[6]['year']|intval}{literal}, {/literal}{$tab_stat[6]['month']|intval}{literal}, {/literal}{$tab_stat[6]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[6]['sms']|intval}{literal}
                },
                {
                  x: new Date({/literal}{$tab_stat[7]['year']|intval}{literal}, {/literal}{$tab_stat[7]['month']|intval}{literal}, {/literal}{$tab_stat[7]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[7]['sms']|intval}{literal}
                },
                {
                  x: new Date({/literal}{$tab_stat[8]['year']|intval}{literal}, {/literal}{$tab_stat[8]['month']|intval}{literal}, {/literal}{$tab_stat[8]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[8]['sms']|intval}{literal}
                },
                {
                  x: new Date({/literal}{$tab_stat[9]['year']|intval}{literal}, {/literal}{$tab_stat[9]['month']|intval}{literal}, {/literal}{$tab_stat[9]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[9]['sms']|intval}{literal}
                },
                {
                  x: new Date({/literal}{$tab_stat[10]['year']|intval}{literal}, {/literal}{$tab_stat[10]['month']|intval}{literal}, {/literal}{$tab_stat[10]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[10]['sms']|intval}{literal}
                },
                {
                  x: new Date({/literal}{$tab_stat[11]['year']|intval}{literal}, {/literal}{$tab_stat[11]['month']|intval}{literal}, {/literal}{$tab_stat[11]['lastDay']|intval}{literal}),
                  y: {/literal}{$tab_stat[11]['sms']|intval}{literal}
                }

              ]
            }
          ]
        });

      chartLine.render();

    }

  }
  {/literal}
</script>
