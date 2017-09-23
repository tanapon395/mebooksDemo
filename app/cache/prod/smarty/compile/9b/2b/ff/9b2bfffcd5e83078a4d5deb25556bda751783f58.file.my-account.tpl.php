<?php /* Smarty version Smarty-3.1.19, created on 2017-09-23 23:21:01
         compiled from "C:\xampp\htdocs\mebooks\themes\classic\modules\ps_emailalerts\views\templates\hook\my-account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:191417286159c689eda48500-10931569%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b2bfffcd5e83078a4d5deb25556bda751783f58' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\themes\\classic\\modules\\ps_emailalerts\\views\\templates\\hook\\my-account.tpl',
      1 => 1502706660,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '191417286159c689eda48500-10931569',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59c689eda4d038_39326734',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c689eda4d038_39326734')) {function content_59c689eda4d038_39326734($_smarty_tpl) {?>

<a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="emailsalerts"
   href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->getUrlSmarty(array('entity'=>'module','name'=>'ps_emailalerts','controller'=>'account'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'My alerts','d'=>'Shop.Theme.Catalog'),$_smarty_tpl);?>
">
  <span class="link-item">
  <i class="material-icons">&#xE151;</i>
    <?php echo smartyTranslate(array('s'=>'My alerts','d'=>'Shop.Theme.Catalog'),$_smarty_tpl);?>

  </span>
</a>
<?php }} ?>
