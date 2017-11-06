
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

<div id="mtarget-presentation">
  <div class="header-home {if $lang_iso == "fr"}header-home-fr{elseif $lang_iso == "en"}header-home-en {elseif $lang_iso == "es"}header-home-es{elseif $lang_iso == "it"}header-home-it{/if}"></div>
  <h1>{l s='Send SMS from your Prestashop shop !' mod='mtarget'}</h1>

  <div class="target clearfix">
    <div class="col-lg-6">
      <div class="list-content">
        <div class="bubble1"><p>{l s='To your customer' mod='mtarget'}</p></div>
        <div class="list">
          <ul>
            <li>{l s='Change of the order\'s status' mod='mtarget'}</li>
            <li>{l s='Reminders of abandoned baskets' mod='mtarget'}</li>
            <li>{l s='Birthdays' mod='mtarget'}</li>
            <li>{l s='Promotional SMS (sales, private sales ...)' mod='mtarget'}</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="list-content">
        <div class="bubble2"><p>{l s='To your merchant' mod='mtarget'}</p></div>
        <div class="list">
          <ul>
            <li>{l s='With each new registration' mod='mtarget'}</li>
            <li>{l s='With each new order' mod='mtarget'}</li>
            <li>{l s='With each product return request' mod='mtarget'}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="bubble3"><p>{l s='where to start ?' mod='mtarget'}</p></div>
  <div class='start'>
    <p>{l s='Register via the "configuration" tab' mod='mtarget'}</p>

    <p>{l s='The connection to our platform is done' mod='mtarget'}
      &nbsp;<span>{l s='automatically !' mod='mtarget'}</span></p>
  </div>
  <p class="line">{l s='Once you are registered a new tabs appear' mod='mtarget'}</p>

  <div class='mtarget-bloc clearfix'>
    <div class="col-lg-3 blc">
      <div class="content-lg3">
        <h1>{l s='Home' mod='mtarget'}</h1>

        <p>{l s='View the configuration, consumption and balance of your account in real time' mod='mtarget'}</p></div>
    </div>

    <div class="col-lg-3 blc">
      <div class="content-lg3">
        <h1>{l s='Sms automated' mod='mtarget'}</h1>

        <p>{l s='Activate and configure in 1 click your different automated SMS (personalized texts with name / first name of the customer, order number)' mod='mtarget'}</p>
      </div>
    </div>
    <div class="col-lg-3 blc">
      <div class="content-lg3">
        <h1>{l s='Sms Marketing' mod='mtarget'}</h1>

        <p>{l s='Segment and synchronize your customers to start sending promotional sms' mod='mtarget'}</p></div>
    </div>
    <div class="col-lg-3 blc">
      <div class="content-lg3">
        <h1>{l s='Customer support' mod='mtarget'}</h1>

        <p>{l s='Check our complete faq or contact our customer support in France' mod='mtarget'}</p></div>
    </div>
  </div>
  <p class="line">{l s='You just have to credit your account and start sending your first sms' mod='mtarget'}</p>

  <div id='warning'>
    <div class='phone'></div>
    <p>{l s='Advice: for optimal functioning of the module, we advise you to activate the mandatory input of the telephone number of your customers' mod='mtarget'}</p>

    <p class="version">{l s='Prestashop 1.6: In "Preferences / Clients", then in the general settings you can set the phone as mandatory when registering.' mod='mtarget'}</p>

    <p class="version">{l s='Prestashop 1.7: In "Sales / Clients / Addresses", at the bottom of the page a button "define the required fields for this section"' mod='mtarget'}</p>
  </div>

  <div class="bubble4"><p>{l s='Why choose our module ?' mod='mtarget'}</p></div>
  <div class='footer-presentation'>
    <div class="content">
      <p>{l s='100 sms offered at registration' mod='mtarget'}</p>

      <p>{l s='No extra costs for your clients' mod='mtarget'}</p>

      <p>{l s='No subscription or hidden cost, you know what you use in real time' mod='mtarget'}</p>

      <p>{l s='Your sms arrive in real time and in hour with optimized deliverability' mod='mtarget'}</p>

      <p>{l s='Our prices are among the lowest in the market' mod='mtarget'}</p>
    </div>
  </div>
  <div class="clearfix"></div>

</div>
