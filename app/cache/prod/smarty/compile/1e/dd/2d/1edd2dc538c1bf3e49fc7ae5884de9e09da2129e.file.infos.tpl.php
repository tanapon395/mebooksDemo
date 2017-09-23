<?php /* Smarty version Smarty-3.1.19, created on 2017-09-23 23:23:23
         compiled from "C:\xampp\htdocs\mebooks\modules\ps_wirepayment\views\templates\hook\infos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:51527783859c68a7b16a774-00882675%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1edd2dc538c1bf3e49fc7ae5884de9e09da2129e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\modules\\ps_wirepayment\\views\\templates\\hook\\infos.tpl',
      1 => 1502706738,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '51527783859c68a7b16a774-00882675',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59c68a7b1855c3_75360490',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c68a7b1855c3_75360490')) {function content_59c68a7b1855c3_75360490($_smarty_tpl) {?>

<div class="alert alert-info">
<img src="../modules/ps_wirepayment/logo.png" style="float:left; margin-right:15px;" height="60">
<p><strong><?php echo smartyTranslate(array('s'=>"This module allows you to accept secure payments by bank wire.",'d'=>'Modules.Wirepayment.Admin'),$_smarty_tpl);?>
</strong></p>
<p><?php echo smartyTranslate(array('s'=>"If the client chooses to pay by bank wire, the order status will change to 'Waiting for Payment'.",'d'=>'Modules.Wirepayment.Admin'),$_smarty_tpl);?>
</p>
<p><?php echo smartyTranslate(array('s'=>"That said, you must manually confirm the order upon receiving the bank wire.",'d'=>'Modules.Wirepayment.Admin'),$_smarty_tpl);?>
</p>
</div>
<?php }} ?>
