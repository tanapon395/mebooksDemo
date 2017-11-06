<?php /* Smarty version Smarty-3.1.19, created on 2017-11-01 19:02:10
         compiled from "C:\xampp\htdocs\mebooks\pdf\\invoice.total-tab.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142949056559f9b7c2871352-84087804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53622101538426481d895131f45cf262fc64b4ac' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\pdf\\\\invoice.total-tab.tpl',
      1 => 1502706662,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142949056559f9b7c2871352-84087804',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'order' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59f9b7c28aa650_53444703',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59f9b7c28aa650_53444703')) {function content_59f9b7c28aa650_53444703($_smarty_tpl) {?>
<table id="total-tab" width="100%">

	<tr>
		<td class="grey" width="70%">
			<?php echo smartyTranslate(array('s'=>'Total Products','d'=>'Shop.Pdf','pdf'=>'true'),$_smarty_tpl);?>

		</td>
		<td class="white" width="30%">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['footer']->value['products_before_discounts_tax_excl']),$_smarty_tpl);?>

		</td>
	</tr>

	<?php if ($_smarty_tpl->tpl_vars['footer']->value['product_discounts_tax_excl']>0) {?>

		<tr>
			<td class="grey" width="70%">
				<?php echo smartyTranslate(array('s'=>'Total Discounts','d'=>'Shop.Pdf','pdf'=>'true'),$_smarty_tpl);?>

			</td>
			<td class="white" width="30%">
				- <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['footer']->value['product_discounts_tax_excl']),$_smarty_tpl);?>

			</td>
		</tr>

	<?php }?>
	<?php if (!$_smarty_tpl->tpl_vars['order']->value->isVirtual()) {?>
	<tr>
		<td class="grey" width="70%">
			<?php echo smartyTranslate(array('s'=>'Shipping Costs','d'=>'Shop.Pdf','pdf'=>'true'),$_smarty_tpl);?>

		</td>
		<td class="white" width="30%">
			<?php if ($_smarty_tpl->tpl_vars['footer']->value['shipping_tax_excl']>0) {?>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['footer']->value['shipping_tax_excl']),$_smarty_tpl);?>

			<?php } else { ?>
				<?php echo smartyTranslate(array('s'=>'Free Shipping','d'=>'Shop.Pdf','pdf'=>'true'),$_smarty_tpl);?>

			<?php }?>
		</td>
	</tr>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['footer']->value['wrapping_tax_excl']>0) {?>
		<tr>
			<td class="grey">
				<?php echo smartyTranslate(array('s'=>'Wrapping Costs','d'=>'Shop.Pdf','pdf'=>'true'),$_smarty_tpl);?>

			</td>
			<td class="white"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['footer']->value['wrapping_tax_excl']),$_smarty_tpl);?>
</td>
		</tr>
	<?php }?>

	<tr class="bold">
		<td class="grey">
			<?php echo smartyTranslate(array('s'=>'Total (Tax excl.)','d'=>'Shop.Pdf','pdf'=>'true'),$_smarty_tpl);?>

		</td>
		<td class="white">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['footer']->value['total_paid_tax_excl']),$_smarty_tpl);?>

		</td>
	</tr>
	<?php if ($_smarty_tpl->tpl_vars['footer']->value['total_taxes']>0) {?>
	<tr class="bold">
		<td class="grey">
			<?php echo smartyTranslate(array('s'=>'Total Tax','d'=>'Shop.Pdf','pdf'=>'true'),$_smarty_tpl);?>

		</td>
		<td class="white">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['footer']->value['total_taxes']),$_smarty_tpl);?>

		</td>
	</tr>
	<?php }?>
	<tr class="bold big">
		<td class="grey">
			<?php echo smartyTranslate(array('s'=>'Total','d'=>'Shop.Pdf','pdf'=>'true'),$_smarty_tpl);?>

		</td>
		<td class="white">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['footer']->value['total_paid_tax_incl']),$_smarty_tpl);?>

		</td>
	</tr>
</table>
<?php }} ?>
