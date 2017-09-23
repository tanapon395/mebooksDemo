<?php /* Smarty version Smarty-3.1.19, created on 2017-09-23 23:17:37
         compiled from "C:\xampp\htdocs\mebooks\admin06\themes\default\template\content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:196836143559c68921793068-40128104%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b81750e2f6dc9d23024dca997714541ea63f5a8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\admin06\\themes\\default\\template\\content.tpl',
      1 => 1502706660,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '196836143559c68921793068-40128104',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59c68921798c50_56190372',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c68921798c50_56190372')) {function content_59c68921798c50_56190372($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div>
<?php }} ?>
