<?php /* Smarty version Smarty-3.1.19, created on 2017-11-01 19:00:38
         compiled from "C:\xampp\htdocs\mebooks\modules\omise\views\templates\admin\setting.tpl" */ ?>
<?php /*%%SmartyHeaderCode:42955573659f9b766758368-68983149%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98c5791f0668c7033239e2613aa4ba9523c5e21f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\modules\\omise\\views\\templates\\admin\\setting.tpl',
      1 => 1509346696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '42955573659f9b766758368-68983149',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'confirmation' => 0,
    'module_status' => 0,
    'sandbox_status' => 0,
    'test_public_key' => 0,
    'test_secret_key' => 0,
    'live_public_key' => 0,
    'live_secret_key' => 0,
    'title' => 0,
    'three_domain_secure_status' => 0,
    'internet_banking_status' => 0,
    'submit_action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59f9b7667b4a66_19947535',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59f9b7667b4a66_19947535')) {function content_59f9b7667b4a66_19947535($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['confirmation']->value)) {?><?php echo $_smarty_tpl->tpl_vars['confirmation']->value;?>
<?php }?>

<form class="defaultForm form-horizontal" method="post">
  <div class="panel">
    <div class="panel-heading"><?php echo smartyTranslate(array('s'=>'Settings','mod'=>'omise'),$_smarty_tpl);?>
</div>
    <div class="form-wrapper">
      <div class="form-group">
        <label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Enable/Disable','mode'=>'omise'),$_smarty_tpl);?>
</label>
        <div class="col-lg-9">
          <span class="switch prestashop-switch fixed-width-lg">
            <input id="module_status_enabled" name="module_status" type="radio" value="1" <?php if ($_smarty_tpl->tpl_vars['module_status']->value==1) {?>checked="checked"<?php }?>>
            <label for="module_status_enabled"><?php echo smartyTranslate(array('s'=>'Yes','mode'=>'omise'),$_smarty_tpl);?>
</label>
            <input id="module_status_disabled" name="module_status" type="radio" value="0" <?php if ($_smarty_tpl->tpl_vars['module_status']->value==0) {?>checked="checked"<?php }?>>
            <label for="module_status_disabled"><?php echo smartyTranslate(array('s'=>'No','mode'=>'omise'),$_smarty_tpl);?>
</label>
            <a class="slide-button btn"></a>
          </span>
          <p class="help-block"><?php echo smartyTranslate(array('s'=>'Enable Omise Payment Module.','mode'=>'omise'),$_smarty_tpl);?>
</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Sandbox','mode'=>'omise'),$_smarty_tpl);?>
</label>
        <div class="col-lg-9">
          <span class="switch prestashop-switch fixed-width-lg">
            <input id="sandbox_status_enabled" name="sandbox_status" type="radio" value="1" <?php if ($_smarty_tpl->tpl_vars['sandbox_status']->value==1) {?>checked="checked"<?php }?>>
            <label for="sandbox_status_enabled"><?php echo smartyTranslate(array('s'=>'Yes','mode'=>'omise'),$_smarty_tpl);?>
</label>
            <input id="sandbox_status_disabled" name="sandbox_status" type="radio" value="0" <?php if ($_smarty_tpl->tpl_vars['sandbox_status']->value==0) {?>checked="checked"<?php }?>>
            <label for="sandbox_status_disabled"><?php echo smartyTranslate(array('s'=>'No','mode'=>'omise'),$_smarty_tpl);?>
</label>
            <a class="slide-button btn"></a>
          </span>
          <p class="help-block"><?php echo smartyTranslate(array('s'=>'Enabling sandbox means that all your transactions will be in TEST mode.','mode'=>'omise'),$_smarty_tpl);?>
</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3" for="test_public_key"><?php echo smartyTranslate(array('s'=>'Public key for test','mode'=>'omise'),$_smarty_tpl);?>
</label>
        <div class="col-lg-9">
          <input id="test_public_key" name="test_public_key" type="text" value="<?php echo $_smarty_tpl->tpl_vars['test_public_key']->value;?>
">
          <p class="help-block"><?php echo smartyTranslate(array('s'=>'The "Test" mode public key can be found in Omise Dashboard.','mode'=>'omise'),$_smarty_tpl);?>
</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3" for="test_secret_key"><?php echo smartyTranslate(array('s'=>'Secret key for test','mode'=>'omise'),$_smarty_tpl);?>
</label>
        <div class="col-lg-9">
          <input id="test_secret_key" name="test_secret_key" type="password" value="<?php echo $_smarty_tpl->tpl_vars['test_secret_key']->value;?>
">
          <p class="help-block"><?php echo smartyTranslate(array('s'=>'The "Test" mode secret key can be found in Omise Dashboard.','mode'=>'omise'),$_smarty_tpl);?>
</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3" for="live_public_key"><?php echo smartyTranslate(array('s'=>'Public key for live','mode'=>'omise'),$_smarty_tpl);?>
</label>
        <div class="col-lg-9">
          <input type="text" id="live_public_key" name="live_public_key" value="<?php echo $_smarty_tpl->tpl_vars['live_public_key']->value;?>
">
          <p class="help-block"><?php echo smartyTranslate(array('s'=>'The "Live" mode public key can be found in Omise Dashboard.','mode'=>'omise'),$_smarty_tpl);?>
</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3" for="live_secret_key"><?php echo smartyTranslate(array('s'=>'Secret key for live','mode'=>'omise'),$_smarty_tpl);?>
</label>
        <div class="col-lg-9">
          <input id="live_secret_key" name="live_secret_key" type="password" value="<?php echo $_smarty_tpl->tpl_vars['live_secret_key']->value;?>
">
          <p class="help-block"><?php echo smartyTranslate(array('s'=>'The "Live" mode secret key can be found in Omise Dashboard.','mode'=>'omise'),$_smarty_tpl);?>
</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3"><b><?php echo smartyTranslate(array('s'=>'Advance Settings','mode'=>'omise'),$_smarty_tpl);?>
</b></label>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3" for="title"><?php echo smartyTranslate(array('s'=>'Title','mode'=>'omise'),$_smarty_tpl);?>
</label>
        <div class="col-lg-9">
          <input id="title" name="title" type="text" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
">
          <p class="help-block"><?php echo smartyTranslate(array('s'=>'This controls the title which the user sees during checkout.','mode'=>'omise'),$_smarty_tpl);?>
</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'3-D Secure support','mode'=>'omise'),$_smarty_tpl);?>
</label>
        <div class="col-lg-9">
          <span class="switch prestashop-switch fixed-width-lg">
            <input id="three_domain_secure_status_enabled" name="three_domain_secure_status" type="radio" value="1" <?php if ($_smarty_tpl->tpl_vars['three_domain_secure_status']->value==1) {?>checked="checked"<?php }?>>
            <label for="three_domain_secure_status_enabled"><?php echo smartyTranslate(array('s'=>'Yes','mode'=>'omise'),$_smarty_tpl);?>
</label>
            <input id="three_domain_secure_status_disabled" name="three_domain_secure_status" type="radio" value="0" <?php if ($_smarty_tpl->tpl_vars['three_domain_secure_status']->value==0) {?>checked="checked"<?php }?>>
            <label for="three_domain_secure_status_disabled"><?php echo smartyTranslate(array('s'=>'No','mode'=>'omise'),$_smarty_tpl);?>
</label>
            <a class="slide-button btn"></a>
          </span>
          <p class="help-block"><?php echo smartyTranslate(array('s'=>'Enable or disable 3-D Secure for the account. (Japan-based accounts are not eligible for the service.)','mode'=>'omise'),$_smarty_tpl);?>
</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Internet Banking','mode'=>'omise'),$_smarty_tpl);?>
</label>
        <div class="col-lg-9">
          <span class="switch prestashop-switch fixed-width-lg">
            <input id="internet_banking_status_enabled" name="internet_banking_status" type="radio" value="1" <?php if ($_smarty_tpl->tpl_vars['internet_banking_status']->value==1) {?>checked="checked"<?php }?>>
            <label for="internet_banking_status_enabled"><?php echo smartyTranslate(array('s'=>'Yes','mode'=>'omise'),$_smarty_tpl);?>
</label>
            <input id="internet_banking_status_disabled" name="internet_banking_status" type="radio" value="0" <?php if ($_smarty_tpl->tpl_vars['internet_banking_status']->value==0) {?>checked="checked"<?php }?>>
            <label for="internet_banking_status_disabled"><?php echo smartyTranslate(array('s'=>'No','mode'=>'omise'),$_smarty_tpl);?>
</label>
            <a class="slide-button btn"></a>
          </span>
          <p class="help-block"><?php echo smartyTranslate(array('s'=>'Enables customers of a bank to easily conduct financial transactions through a bank-operated website (only available in Thailand).','mode'=>'omise'),$_smarty_tpl);?>
</p>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <button class="btn btn-default pull-right" name="<?php echo $_smarty_tpl->tpl_vars['submit_action']->value;?>
" type="submit" value="1">
        <i class="process-icon-save"></i><?php echo smartyTranslate(array('s'=>'Save','mode'=>'omise'),$_smarty_tpl);?>

      </button>
    </div>
  </div>
</form><?php }} ?>
