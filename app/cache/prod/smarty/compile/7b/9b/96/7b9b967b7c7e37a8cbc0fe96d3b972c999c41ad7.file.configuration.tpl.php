<?php /* Smarty version Smarty-3.1.19, created on 2017-09-23 23:26:44
         compiled from "C:\xampp\htdocs\mebooks\modules\ps_googleanalytics\views\templates\admin\configuration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18565629159c68b444cab76-16353087%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b9b967b7c7e37a8cbc0fe96d3b972c999c41ad7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\modules\\ps_googleanalytics\\views\\templates\\admin\\configuration.tpl',
      1 => 1505840221,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18565629159c68b444cab76-16353087',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59c68b4452ca10_73159306',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c68b4452ca10_73159306')) {function content_59c68b4452ca10_73159306($_smarty_tpl) {?>

<div class="panel">
	<div class="row" id="google_analytics_top">
		<div class="col-lg-6">
			<img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
views/img/ga_logo.png" alt="Google Analytics" />
		</div>
		<div class="col-lg-6 text-right">
			<a href="https://support.google.com/analytics/answer/1008015" rel="external"><img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
views/img/create_account_btn.png" alt="" /></a>
		</div>
	</div>
	<hr/>
	<div id="google_analytics_content">
		<div class="row">
			<div class="col-lg-6">
				<p>
					<?php echo smartyTranslate(array('s'=>'Your customers go everywhere; shouldn\'t your analytics.','d'=>'Modules.GAnalytics.Admin'),$_smarty_tpl);?>

				</p><p>
					<?php echo smartyTranslate(array('s'=>'Google Analytics shows you the full customer picture across ads and videos, websites and social tools, tables and smartphones. That makes it easier to serve your current customers and win new ones.','d'=>'Modules.GAnalytics.Admin'),$_smarty_tpl);?>

				</p>
				<p><b><?php echo smartyTranslate(array('s'=>'With ecommerce functionality in Google Analytics you can gain clear insight into important metrics about shopper behavior and conversion, including:','d'=>'Modules.GAnalytics.Admin'),$_smarty_tpl);?>
</b></p>
				<div id="advantages_list">
					<div class="col-xs-6"><img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
views/img/product_detail_icon.png" alt="" /><?php echo smartyTranslate(array('s'=>'Product detail views','d'=>'Modules.GAnalytics.Admin'),$_smarty_tpl);?>
</div>
					<div class="col-xs-6"><img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
views/img/merchandising_tools_icon.png" alt="" /><?php echo smartyTranslate(array('s'=>'Internal merchandising Success','d'=>'Modules.GAnalytics.Admin'),$_smarty_tpl);?>
</div>
					<div class="col-xs-6"><img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
views/img/add_to_cart_icon.png" alt="" /><?php echo smartyTranslate(array('s'=>'"Add to cart" actions','d'=>'Modules.GAnalytics.Admin'),$_smarty_tpl);?>
</div>
					<div class="col-xs-6"><img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
views/img/checkout_icon.png" alt="" /><?php echo smartyTranslate(array('s'=>'The checkout process','d'=>'Modules.GAnalytics.Admin'),$_smarty_tpl);?>
</div>
					<div class="col-xs-6"><img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
views/img/campaign_clicks_icon.png" alt="" /><?php echo smartyTranslate(array('s'=>'Internal campaign clicks','d'=>'Modules.GAnalytics.Admin'),$_smarty_tpl);?>
</div>
					<div class="col-xs-6"><img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
views/img/purchase_icon.png" alt="" /><?php echo smartyTranslate(array('s'=>'And purchase','d'=>'Modules.GAnalytics.Admin'),$_smarty_tpl);?>
</div>
				</div>
			</div>
			<div class="col-lg-6 text-center">
				<p>
					<img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
views/img/stats.png" alt="" /><br />
					<span class="small"><em><?php echo smartyTranslate(array('s'=>'Merchants are able to understand how far along users get in the buying process and where they are dropping off.','d'=>'Modules.GAnalytics.Admin'),$_smarty_tpl);?>
</em></span>
				</p>
				<p class="text-right">
					<b><a href="https://support.google.com/analytics/answer/1008015" rel="external"><?php echo smartyTranslate(array('s'=>'Create your account to get started.','d'=>'Modules.GAnalytics.Admin'),$_smarty_tpl);?>
</a></b>
				</p>
			</div>
		</div>
	</div>
</div>
<?php }} ?>
