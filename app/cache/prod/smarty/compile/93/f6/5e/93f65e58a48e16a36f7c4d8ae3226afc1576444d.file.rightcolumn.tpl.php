<?php /* Smarty version Smarty-3.1.19, created on 2017-09-23 23:18:30
         compiled from "modules\likeboxfree\rightcolumn.tpl" */ ?>
<?php /*%%SmartyHeaderCode:115177692559c68956a35b66-90568315%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '93f65e58a48e16a36f7c4d8ae3226afc1576444d' => 
    array (
      0 => 'modules\\likeboxfree\\rightcolumn.tpl',
      1 => 1506060680,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '115177692559c68956a35b66-90568315',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59c68956a46be7_28827150',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c68956a46be7_28827150')) {function content_59c68956a46be7_28827150($_smarty_tpl) {?><?php if (Configuration::get('lbf_includeapp')==1) {?>
    
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        </script>
    
<?php }?>
<div class="fb-page" data-width="<?php echo htmlspecialchars(Configuration::get('lbf_width'), ENT_QUOTES, 'UTF-8');?>
" adapt_container_width="true" data-height="<?php echo htmlspecialchars(Configuration::get('lbf_height'), ENT_QUOTES, 'UTF-8');?>
" data-href="<?php echo htmlspecialchars(Configuration::get('lbf_url'), ENT_QUOTES, 'UTF-8');?>
" data-small-header="<?php if (Configuration::get('lbf_small_header')==1) {?>true<?php } else { ?>false<?php }?>" data-hide-cta="<?php if (Configuration::get('lbf_hide_cta')==1) {?>true<?php } else { ?>false<?php }?>" data-hide-cover="<?php if (Configuration::get('lbf_hide_cover')==1) {?>true<?php } else { ?>false<?php }?>" data-show-facepile="<?php if (Configuration::get('lbf_show_facepile')==1) {?>true<?php } else { ?>false<?php }?>" data-show-posts="<?php if (Configuration::get('lbf_show_posts')==1) {?>true<?php } else { ?>false<?php }?>"><div class="fb-xfbml-parse-ignore"></div></div><?php }} ?>
