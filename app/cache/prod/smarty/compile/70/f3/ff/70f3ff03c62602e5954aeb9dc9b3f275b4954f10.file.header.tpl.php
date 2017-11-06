<?php /* Smarty version Smarty-3.1.19, created on 2017-10-12 22:31:45
         compiled from "modules\facebookcomments\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166339689259df8ae19657b8-70614751%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70f3ff03c62602e5954aeb9dc9b3f275b4954f10' => 
    array (
      0 => 'modules\\facebookcomments\\header.tpl',
      1 => 1506169518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166339689259df8ae19657b8-70614751',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'var' => 0,
    'fcbc_appid' => 0,
    'fcbc_admins' => 0,
    'fcbc_lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59df8ae19a5e46_81483418',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59df8ae19a5e46_81483418')) {function content_59df8ae19a5e46_81483418($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['fcbc_appid'] = new Smarty_variable($_smarty_tpl->tpl_vars['var']->value['fcbc_appid'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['fcbc_admins'] = new Smarty_variable($_smarty_tpl->tpl_vars['var']->value['fcbc_admins'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['fcbc_lang'] = new Smarty_variable($_smarty_tpl->tpl_vars['var']->value['fcbc_lang'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['fcbc_appid'] = new Smarty_variable($_smarty_tpl->tpl_vars['var']->value['fcbc_appid'], null, 0);?>
<meta property="fb:app_id" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fcbc_appid']->value, ENT_QUOTES, 'UTF-8');?>
"/>
<?php if (Configuration::get('fcbc_addappid')==1) {?>
    <meta property="fb:admins" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fcbc_admins']->value, ENT_QUOTES, 'UTF-8');?>
"/><?php }?>
<div id="fb-root"></div>
<?php if (Configuration::get('fcbc_addappid')==1) {?>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fcbc_lang']->value, ENT_QUOTES, 'UTF-8');?>
/all.js#xfbml=1&appId=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fcbc_appid']->value, ENT_QUOTES, 'UTF-8');?>
";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
<?php }?><?php }} ?>
