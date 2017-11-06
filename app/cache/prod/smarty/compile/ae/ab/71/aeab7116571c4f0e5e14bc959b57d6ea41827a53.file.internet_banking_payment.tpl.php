<?php /* Smarty version Smarty-3.1.19, created on 2017-11-01 19:01:33
         compiled from "modules\omise\views\templates\hook\internet_banking_payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:87257158659f9b79d49d261-23750552%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aeab7116571c4f0e5e14bc959b57d6ea41827a53' => 
    array (
      0 => 'modules\\omise\\views\\templates\\hook\\internet_banking_payment.tpl',
      1 => 1509346696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '87257158659f9b79d49d261-23750552',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59f9b79d4a8380_68870210',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59f9b79d4a8380_68870210')) {function content_59f9b79d4a8380_68870210($_smarty_tpl) {?><div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="row">
        <div class="col-sm-12">
          <form id="omiseInternetBankingCheckoutForm" method="post" action="<?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['escape'][0][0]->smartyEscape($_smarty_tpl->tpl_vars['link']->value->getModuleLink('omise','internetbankingpayment',array(),true),'html'), ENT_QUOTES, 'UTF-8');?>
">
            <ul class="omise-internet-banking">
              <li class="item">
                <input class="no-uniform" id="omiseInternetBankingScb" name="offsite" type="radio" value="internet_banking_scb" autocomplete="off">
                <label for="omiseInternetBankingScb">
                  <div class="omise-logo-wrapper scb">
                    <img src="/modules/omise/img/scb.svg" class="scb">
                  </div>
                  <div class="omise-bank-text-wrapper">
                    <span class="title"><?php echo smartyTranslate(array('s'=>'Siam Commercial Bank','mod'=>'omise'),$_smarty_tpl);?>
</span><br>
                    <span class="secondary-text"><?php echo smartyTranslate(array('s'=>'Fee: 15 THB (same zone), 30 THB (out zone)','mod'=>'omise'),$_smarty_tpl);?>
</span>
                  </div>
                </label>
              </li>
              <li class="item">
                <input class="no-uniform" id="omiseInternetBankingKtb" name="offsite" type="radio" value="internet_banking_ktb" autocomplete="off">
                <label for="omiseInternetBankingKtb">
                  <div class="omise-logo-wrapper ktb">
                    <img src="/modules/omise/img/ktb.svg" class="ktb">
                  </div>
                  <div class="omise-bank-text-wrapper">
                    <span class="title"><?php echo smartyTranslate(array('s'=>'Krungthai Bank','mod'=>'omise'),$_smarty_tpl);?>
</span><br>
                    <span class="secondary-text"><?php echo smartyTranslate(array('s'=>'Fee: 15 THB (same zone), 15 THB (out zone)','mod'=>'omise'),$_smarty_tpl);?>
</span>
                  </div>
                </label>
              </li>
              <li class="item">
                <input class="no-uniform" id="omiseInternetBankingBay" name="offsite" type="radio" value="internet_banking_bay" autocomplete="off">
                <label for="omiseInternetBankingBay">
                  <div class="omise-logo-wrapper bay">
                    <img src="/modules/omise/img/bay.svg" class="bay">
                  </div>
                  <div class="omise-bank-text-wrapper">
                    <span class="title"><?php echo smartyTranslate(array('s'=>'Krungsri Bank','mod'=>'omise'),$_smarty_tpl);?>
</span><br>
                    <span class="secondary-text"><?php echo smartyTranslate(array('s'=>'Fee: 15 THB (same zone), 15 THB (out zone)','mod'=>'omise'),$_smarty_tpl);?>
</span>
                  </div>
                </label>
              </li>
              <li class="item">
                <input class="no-uniform" id="omiseInternetBankingBbl" name="offsite" type="radio" value="internet_banking_bbl" autocomplete="off">
                <label for="omiseInternetBankingBbl">
                  <div class="omise-logo-wrapper bbl">
                    <img src="/modules/omise/img/bbl.svg" class="bbl">
                  </div>
                  <div class="omise-bank-text-wrapper">
                    <span class="title"><?php echo smartyTranslate(array('s'=>'Bangkok Bank','mod'=>'omise'),$_smarty_tpl);?>
</span><br>
                    <span class="secondary-text"><?php echo smartyTranslate(array('s'=>'Fee: 15 THB (same zone), 20 THB (out zone)','mod'=>'omise'),$_smarty_tpl);?>
</span>
                  </div>
                </label>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }} ?>
