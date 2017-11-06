<?php /* Smarty version Smarty-3.1.19, created on 2017-11-01 19:02:10
         compiled from "C:\xampp\htdocs\mebooks\pdf\\invoice.shipping-tab.tpl" */ ?>
<?php /*%%SmartyHeaderCode:58427554459f9b7c29dbcb3-92435445%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed4253509d1dca1c035032d533d0985ac8f517bb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\pdf\\\\invoice.shipping-tab.tpl',
      1 => 1502706660,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58427554459f9b7c29dbcb3-92435445',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'carrier' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59f9b7c29f64c2_91676713',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59f9b7c29f64c2_91676713')) {function content_59f9b7c29f64c2_91676713($_smarty_tpl) {?>
<table id="shipping-tab" width="100%">
	<tr>
		<td class="shipping center small grey bold" width="44%"><?php echo smartyTranslate(array('s'=>'Carrier','d'=>'Shop.Pdf','pdf'=>'true'),$_smarty_tpl);?>
</td>
		<td class="shipping center small white" width="56%"><?php echo $_smarty_tpl->tpl_vars['carrier']->value->name;?>
</td>
	</tr>
</table>
<?php }} ?>
