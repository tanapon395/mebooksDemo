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

<div style="display: none;">

  <div id="segment_name_form" class="bootstrap">
    <p>{l s='Please enter a unique name for your segment' mod='mtarget'} </p>

    <div class="segment-error-name"></div>
    <input class="segment_name" name="segment_name" type="text" value="" maxlength="15"/>

    <p class="submit">
      <input id="addName" class="btn btn-default" name="addName" type="submit" value="{l s='Add Name' mod='mtarget'}"/>
    </p>
  </div>
</div>
<script type="text/javascript">
  {literal}
  $('#addName').click(function () {

    var segment_name = $('.segment_name').val();
    var segmentError = $('#segment-error');
    var nameError = $('.segment-error-name');
    var optin = $('#optin_1').is(":checked");
    var order = $('input[name=order]:checked').val();
    var groups = '';
    var langs = '';

    $("input[name*=group_]").each(function () {
      var group_name = $(this).attr('name');
      var group_value = $(this).is(":checked");
      groups = groups + '&' + group_name + '=' + group_value;

    });
    $("input[name*=lang_]").each(function () {
      var lang_name = $(this).attr('name');
      var lang_value = $(this).is(":checked");
      langs = langs + '&' + lang_name + '=' + lang_value;
    });

    segmentError.hide(200);
    segmentError.text('');
    if (segment_name) {
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '{/literal}{urldecode($url_config|escape:'url')}{literal}&ajax=1&action=RequestNewSegment',
        data: 'segment_name=' + segment_name + '&optin=' + optin + '&order=' + order + groups + langs,
        success: function (data) {
          if (data.errors !== true) {
            window.location = '{/literal}{urldecode($url_config|escape:'url')}{literal}&segmentAdd=1';
          } else {
            $.fancybox.close();
            segmentError.text(data.description);
            segmentError.show(400);
          }

        }
      });
    } else {
      nameError.text("{/literal}{l s='Thank you for naming your segment, 15 characters max' mod='mtarget'}{literal}");
    }

  });


  {/literal}
</script>


