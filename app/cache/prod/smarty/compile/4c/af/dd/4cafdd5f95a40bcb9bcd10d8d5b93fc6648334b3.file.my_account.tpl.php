<?php /* Smarty version Smarty-3.1.19, created on 2017-09-23 23:21:01
         compiled from "modules\payplug\views\templates\hook\my_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177281298559c689ed9cc413-87245632%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4cafdd5f95a40bcb9bcd10d8d5b93fc6648334b3' => 
    array (
      0 => 'modules\\payplug\\views\\templates\\hook\\my_account.tpl',
      1 => 1505649723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177281298559c689ed9cc413-87245632',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'payplug_cards_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59c689ed9d0c24_59757765',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c689ed9d0c24_59757765')) {function content_59c689ed9d0c24_59757765($_smarty_tpl) {?>

<!-- MODULE Payplug -->
    <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="savedcards-link" href="<?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['escape'][0][0]->smartyEscape($_smarty_tpl->tpl_vars['payplug_cards_url']->value,'htmlall','UTF-8'), ENT_QUOTES, 'UTF-8');?>
">
          <span class="link-item">
            <i class="material-icons">&#xE870;</i>
              <?php echo smartyTranslate(array('s'=>'Saved cards','mod'=>'payplug'),$_smarty_tpl);?>

              
          </span>
    </a>
<!-- END : MODULE Payplug --><?php }} ?>
