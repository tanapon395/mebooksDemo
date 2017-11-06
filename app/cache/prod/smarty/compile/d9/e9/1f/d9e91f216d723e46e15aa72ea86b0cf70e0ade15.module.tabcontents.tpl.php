<?php /* Smarty version Smarty-3.1.19, created on 2017-10-13 00:17:33
         compiled from "module:facebookcomments/tabcontents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128916832659dfa3adab87b3-13844481%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9e91f216d723e46e15aa72ea86b0cf70e0ade15' => 
    array (
      0 => 'module:facebookcomments/tabcontents.tpl',
      1 => 1506169518,
      2 => 'module',
    ),
  ),
  'nocache_hash' => '128916832659dfa3adab87b3-13844481',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'var' => 0,
    'fcbc_scheme' => 0,
    'fcbc_width' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59dfa3adaf9443_57825618',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59dfa3adaf9443_57825618')) {function content_59dfa3adaf9443_57825618($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['fcbc_width'] = new Smarty_variable($_smarty_tpl->tpl_vars['var']->value['fcbc_width'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['fcbc_nbp'] = new Smarty_variable($_smarty_tpl->tpl_vars['var']->value['fcbc_nbp'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['fcbc_scheme'] = new Smarty_variable($_smarty_tpl->tpl_vars['var']->value['fcbc_scheme'], null, 0);?>

    <style>
        .fb_ltr, .fb_iframe_widget, .fb_iframe_widget span {
            width: 100% !important
        }
    </style>

<div id="fcbc" class="">
    <fb:comments href="http://<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['product_page_url'], ENT_QUOTES, 'UTF-8');?>
" colorscheme="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fcbc_scheme']->value, ENT_QUOTES, 'UTF-8');?>
" width="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fcbc_width']->value, ENT_QUOTES, 'UTF-8');?>
"></fb:comments>
</div>
<?php }} ?>
