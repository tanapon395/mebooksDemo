<?php /* Smarty version Smarty-3.1.19, created on 2017-11-01 19:01:40
         compiled from "C:\xampp\htdocs\mebooks\themes\classic\templates\checkout\_partials\steps\payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:153453243159f9b7a4916333-81430456%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a55a47fd9569fe8513938dda1a1a092b91896a16' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\themes\\classic\\templates\\checkout\\_partials\\steps\\payment.tpl',
      1 => 1502706660,
      2 => 'file',
    ),
    'a2d70f4a34ccdd4b0d0f8fdd5ecac3b1f4470734' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\themes\\classic\\templates\\checkout\\_partials\\steps\\checkout-step.tpl',
      1 => 1502706660,
      2 => 'file',
    ),
    '343c0e1f31f9a607137fed5437850550f79acd13' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\themes\\classic\\templates\\checkout\\_partials\\order-confirmation-table.tpl',
      1 => 1502706660,
      2 => 'file',
    ),
    'b0a089a26ffbe71b13fb304d95354331d729735d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\themes\\classic\\templates\\checkout\\_partials\\order-final-summary-table.tpl',
      1 => 1502706660,
      2 => 'file',
    ),
    'd3db9db1d8419c2aed3a0256a64223dc4377d85f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mebooks\\themes\\classic\\templates\\checkout\\_partials\\order-final-summary.tpl',
      1 => 1502706660,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153453243159f9b7a4916333-81430456',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'identifier' => 0,
    'step_is_current' => 0,
    'step_is_reachable' => 0,
    'step_is_complete' => 0,
    'position' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59f9b7a4a83864_80587670',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59f9b7a4a83864_80587670')) {function content_59f9b7a4a83864_80587670($_smarty_tpl) {?>

  <section  id    = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['identifier']->value, ENT_QUOTES, 'UTF-8');?>
"
            class = "<?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['classnames'][0][0]->smartyClassnames(array('checkout-step'=>true,'-current'=>$_smarty_tpl->tpl_vars['step_is_current']->value,'-reachable'=>$_smarty_tpl->tpl_vars['step_is_reachable']->value,'-complete'=>$_smarty_tpl->tpl_vars['step_is_complete']->value,'js-current-step'=>$_smarty_tpl->tpl_vars['step_is_current']->value)), ENT_QUOTES, 'UTF-8');?>
"
  >
    <h1 class="step-title h3">
      <i class="material-icons done">&#xE876;</i>
      <span class="step-number"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['position']->value, ENT_QUOTES, 'UTF-8');?>
</span>
      <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>

      <span class="step-edit text-muted"><i class="material-icons edit">mode_edit</i> <?php echo smartyTranslate(array('s'=>'Edit','d'=>'Shop.Theme.Actions'),$_smarty_tpl);?>
</span>
    </h1>

    <div class="content">
      

  <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayPaymentTop'),$_smarty_tpl);?>


  <?php if ($_smarty_tpl->tpl_vars['is_free']->value) {?>
    <p><?php echo smartyTranslate(array('s'=>'No payment needed for this order','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>
</p>
  <?php }?>
  <div class="payment-options <?php if ($_smarty_tpl->tpl_vars['is_free']->value) {?>hidden-xs-up<?php }?>">
    <?php  $_smarty_tpl->tpl_vars["module_options"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["module_options"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['payment_options']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["module_options"]->key => $_smarty_tpl->tpl_vars["module_options"]->value) {
$_smarty_tpl->tpl_vars["module_options"]->_loop = true;
?>
      <?php  $_smarty_tpl->tpl_vars["option"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["option"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['module_options']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["option"]->key => $_smarty_tpl->tpl_vars["option"]->value) {
$_smarty_tpl->tpl_vars["option"]->_loop = true;
?>
        <div>
          <div id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['id'], ENT_QUOTES, 'UTF-8');?>
-container" class="payment-option clearfix">
            
            <span class="custom-radio float-xs-left">
              <input
                class="ps-shown-by-js <?php if ($_smarty_tpl->tpl_vars['option']->value['binary']) {?> binary <?php }?>"
                id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['id'], ENT_QUOTES, 'UTF-8');?>
"
                data-module-name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['module_name'], ENT_QUOTES, 'UTF-8');?>
"
                name="payment-option"
                type="radio"
                required
                <?php if ($_smarty_tpl->tpl_vars['selected_payment_option']->value==$_smarty_tpl->tpl_vars['option']->value['id']||$_smarty_tpl->tpl_vars['is_free']->value) {?> checked <?php }?>
              >
              <span></span>
            </span>
            
            <form method="GET" class="ps-hidden-by-js">
              <?php if ($_smarty_tpl->tpl_vars['option']->value['id']===$_smarty_tpl->tpl_vars['selected_payment_option']->value) {?>
                <?php echo smartyTranslate(array('s'=>'Selected','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>

              <?php } else { ?>
                <button class="ps-hidden-by-js" type="submit" name="select_payment_option" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['id'], ENT_QUOTES, 'UTF-8');?>
">
                  <?php echo smartyTranslate(array('s'=>'Choose','d'=>'Shop.Theme.Actions'),$_smarty_tpl);?>

                </button>
              <?php }?>
            </form>

            <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['id'], ENT_QUOTES, 'UTF-8');?>
">
              <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['call_to_action_text'], ENT_QUOTES, 'UTF-8');?>
</span>
              <?php if ($_smarty_tpl->tpl_vars['option']->value['logo']) {?>
                <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['logo'], ENT_QUOTES, 'UTF-8');?>
">
              <?php }?>
            </label>

          </div>
        </div>

        <?php if ($_smarty_tpl->tpl_vars['option']->value['additionalInformation']) {?>
          <div
            id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['id'], ENT_QUOTES, 'UTF-8');?>
-additional-information"
            class="js-additional-information definition-list additional-information<?php if ($_smarty_tpl->tpl_vars['option']->value['id']!=$_smarty_tpl->tpl_vars['selected_payment_option']->value) {?> ps-hidden <?php }?>"
          >
            <?php echo $_smarty_tpl->tpl_vars['option']->value['additionalInformation'];?>

          </div>
        <?php }?>

        <div
          id="pay-with-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['id'], ENT_QUOTES, 'UTF-8');?>
-form"
          class="js-payment-option-form <?php if ($_smarty_tpl->tpl_vars['option']->value['id']!=$_smarty_tpl->tpl_vars['selected_payment_option']->value) {?> ps-hidden <?php }?>"
        >
          <?php if ($_smarty_tpl->tpl_vars['option']->value['form']) {?>
            <?php echo $_smarty_tpl->tpl_vars['option']->value['form'];?>

          <?php } else { ?>
            <form id="payment-form" method="POST" action="<?php echo $_smarty_tpl->tpl_vars['option']->value['action'];?>
">
              <?php  $_smarty_tpl->tpl_vars['input'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['input']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['option']->value['inputs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['input']->key => $_smarty_tpl->tpl_vars['input']->value) {
$_smarty_tpl->tpl_vars['input']->_loop = true;
?>
                <input type="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['type'], ENT_QUOTES, 'UTF-8');?>
" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['name'], ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['input']->value['value'], ENT_QUOTES, 'UTF-8');?>
">
              <?php } ?>
              <button style="display:none" id="pay-with-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['id'], ENT_QUOTES, 'UTF-8');?>
" type="submit"></button>
            </form>
          <?php }?>
        </div>
      <?php } ?>
    <?php }
if (!$_smarty_tpl->tpl_vars["module_options"]->_loop) {
?>
      <p class="alert alert-danger"><?php echo smartyTranslate(array('s'=>'Unfortunately, there are no payment method available.','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>
</p>
    <?php } ?>
  </div>

  <?php if (count($_smarty_tpl->tpl_vars['conditions_to_approve']->value)) {?>
    <p class="ps-hidden-by-js">
      
      <?php echo smartyTranslate(array('s'=>'By confirming the order, you certify that you have read and agree with all of the conditions below:','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>

    </p>

    <form id="conditions-to-approve" method="GET">
      <ul>
        <?php  $_smarty_tpl->tpl_vars["condition"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["condition"]->_loop = false;
 $_smarty_tpl->tpl_vars["condition_name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['conditions_to_approve']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["condition"]->key => $_smarty_tpl->tpl_vars["condition"]->value) {
$_smarty_tpl->tpl_vars["condition"]->_loop = true;
 $_smarty_tpl->tpl_vars["condition_name"]->value = $_smarty_tpl->tpl_vars["condition"]->key;
?>
          <li>
            <div class="float-xs-left">
              <span class="custom-checkbox">
                <input  id    = "conditions_to_approve[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['condition_name']->value, ENT_QUOTES, 'UTF-8');?>
]"
                        name  = "conditions_to_approve[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['condition_name']->value, ENT_QUOTES, 'UTF-8');?>
]"
                        required
                        type  = "checkbox"
                        value = "1"
                        class = "ps-shown-by-js"
                >
                <span><i class="material-icons checkbox-checked">&#xE5CA;</i></span>
              </span>
            </div>
            <div class="condition-label">
              <label class="js-terms" for="conditions_to_approve[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['condition_name']->value, ENT_QUOTES, 'UTF-8');?>
]">
                <?php echo $_smarty_tpl->tpl_vars['condition']->value;?>

              </label>
            </div>
          </li>
        <?php } ?>
      </ul>
    </form>
  <?php }?>

  <?php if ($_smarty_tpl->tpl_vars['show_final_summary']->value) {?>
    <?php /*  Call merged included template "checkout/_partials/order-final-summary.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('checkout/_partials/order-final-summary.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '153453243159f9b7a4916333-81430456');
content_59f9b7a49ca337_10842470($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "checkout/_partials/order-final-summary.tpl" */?>
  <?php }?>

  <div id="payment-confirmation">
    <div class="ps-shown-by-js">
      <button type="submit" <?php if (!$_smarty_tpl->tpl_vars['selected_payment_option']->value) {?> disabled <?php }?> class="btn btn-primary center-block">
        <?php echo smartyTranslate(array('s'=>'Order with an obligation to pay','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>

      </button>
      <?php if ($_smarty_tpl->tpl_vars['show_final_summary']->value) {?>
        <article class="alert alert-danger mt-2 js-alert-payment-conditions" role="alert" data-alert="danger">
          <?php echo smartyTranslate(array('s'=>'Please make sure you\'ve chosen a [1]payment method[/1] and accepted the [2]terms and conditions[/2].','sprintf'=>array('[1]'=>'<a href="#checkout-payment-step">','[/1]'=>'</a>','[2]'=>'<a href="#conditions-to-approve">','[/2]'=>'</a>'),'d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>

        </article>
      <?php }?>
    </div>
    <div class="ps-hidden-by-js">
      <?php if ($_smarty_tpl->tpl_vars['selected_payment_option']->value&&$_smarty_tpl->tpl_vars['all_conditions_approved']->value) {?>
        <label for="pay-with-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selected_payment_option']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Order with an obligation to pay','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>
</label>
      <?php }?>
    </div>
  </div>

  <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayPaymentByBinaries'),$_smarty_tpl);?>


  <div class="modal fade" id="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo smartyTranslate(array('s'=>'Close','d'=>'Shop.Theme.Global'),$_smarty_tpl);?>
">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="js-modal-content"></div>
      </div>
    </div>
  </div>

    </div>
  </section>

<?php }} ?>
<?php /* Smarty version Smarty-3.1.19, created on 2017-11-01 19:01:40
         compiled from "C:\xampp\htdocs\mebooks\themes\classic\templates\checkout\_partials\order-final-summary.tpl" */ ?>
<?php if ($_valid && !is_callable('content_59f9b7a49ca337_10842470')) {function content_59f9b7a49ca337_10842470($_smarty_tpl) {?>
<section id="order-summary-content" class="page-content page-order-confirmation">
  <div class="row">
    <div class="col-md-12">
      <h4 class="h4 black"><?php echo smartyTranslate(array('s'=>'Please check your order before payment','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>
</h4>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <h4 class="h4">
      <?php echo smartyTranslate(array('s'=>'Addresses','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>

        <span class="step-edit step-to-addresses js-edit-addresses"><i class="material-icons edit">mode_edit</i> <?php echo smartyTranslate(array('s'=>'edit','d'=>'Shop.Theme.Actions'),$_smarty_tpl);?>
</span>
      </h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card noshadow">
        <div class="card-block">
          <h4 class="h5 black addresshead"><?php echo smartyTranslate(array('s'=>'Your Delivery Address','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>
</h4>
          <?php echo $_smarty_tpl->tpl_vars['customer']->value['addresses'][$_smarty_tpl->tpl_vars['cart']->value['id_address_delivery']]['formatted'];?>

        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card noshadow">
        <div class="card-block">
          <h4 class="h5 black addresshead"><?php echo smartyTranslate(array('s'=>'Your Invoice Address','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>
</h4>
          <?php echo $_smarty_tpl->tpl_vars['customer']->value['addresses'][$_smarty_tpl->tpl_vars['cart']->value['id_address_invoice']]['formatted'];?>

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <h4 class="h4">
      <?php echo smartyTranslate(array('s'=>'Shipping Method','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>

        <span class="step-edit step-to-delivery js-edit-delivery"><i class="material-icons edit">mode_edit</i> <?php echo smartyTranslate(array('s'=>'edit','d'=>'Shop.Theme.Actions'),$_smarty_tpl);?>
</span>
      </h4>

      <div class="col-md-12 summary-selected-carrier">
        <div class="row">
          <div class="col-md-2">
            <div class="logo-container">
              <?php if ($_smarty_tpl->tpl_vars['selected_delivery_option']->value['logo']) {?>
                <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selected_delivery_option']->value['logo'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selected_delivery_option']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
              <?php } else { ?>
                &nbsp;
              <?php }?>
            </div>
          </div>
          <div class="col-md-4">
            <span class="carrier-name"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selected_delivery_option']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span>
          </div>
          <div class="col-md-4">
            <span class="carrier-delay"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selected_delivery_option']->value['delay'], ENT_QUOTES, 'UTF-8');?>
</span>
          </div>
          <div class="col-md-2">
            <span class="carrier-price"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selected_delivery_option']->value['price'], ENT_QUOTES, 'UTF-8');?>
</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    
      <?php /*  Call merged included template "checkout/_partials/order-final-summary-table.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('checkout/_partials/order-final-summary-table.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('products'=>$_smarty_tpl->tpl_vars['cart']->value['products'],'products_count'=>$_smarty_tpl->tpl_vars['cart']->value['products_count'],'subtotals'=>$_smarty_tpl->tpl_vars['cart']->value['subtotals'],'totals'=>$_smarty_tpl->tpl_vars['cart']->value['totals'],'labels'=>$_smarty_tpl->tpl_vars['cart']->value['labels'],'add_product_link'=>true), 0, '153453243159f9b7a4916333-81430456');
content_59f9b7a49fe722_00941164($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "checkout/_partials/order-final-summary-table.tpl" */?>
    
  </div>
</section>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.19, created on 2017-11-01 19:01:40
         compiled from "C:\xampp\htdocs\mebooks\themes\classic\templates\checkout\_partials\order-final-summary-table.tpl" */ ?>
<?php if ($_valid && !is_callable('content_59f9b7a49fe722_00941164')) {function content_59f9b7a49fe722_00941164($_smarty_tpl) {?>
<div id="order-items" class="col-md-12">

  
    <h3 class="card-title h3"><?php echo smartyTranslate(array('s'=>'Order items','d'=>'Shop.Theme.Checkout'),$_smarty_tpl);?>
</h3>
  

  <div class="order-confirmation-table">

    
      <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
        <div class="order-line row">
          <div class="col-sm-2 col-xs-3">
            <span class="image">
              <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['medium']['url'], ENT_QUOTES, 'UTF-8');?>
" />
            </span>
          </div>
          <div class="col-sm-4 col-xs-9 details">
            <?php if ($_smarty_tpl->tpl_vars['add_product_link']->value) {?><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" target="_blank"><?php }?>
              <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span>
            <?php if ($_smarty_tpl->tpl_vars['add_product_link']->value) {?></a><?php }?>
            <?php if (count($_smarty_tpl->tpl_vars['product']->value['customizations'])) {?>
              <?php  $_smarty_tpl->tpl_vars["customization"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["customization"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value['customizations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["customization"]->key => $_smarty_tpl->tpl_vars["customization"]->value) {
$_smarty_tpl->tpl_vars["customization"]->_loop = true;
?>
                <div class="customizations">
                  <a href="#" data-toggle="modal" data-target="#product-customizations-modal-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customization']->value['id_customization'], ENT_QUOTES, 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Product customization','d'=>'Shop.Theme.Catalog'),$_smarty_tpl);?>
</a>
                </div>
                <div class="modal fade customization-modal" id="product-customizations-modal-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customization']->value['id_customization'], ENT_QUOTES, 'UTF-8');?>
" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"><?php echo smartyTranslate(array('s'=>'Product customization','d'=>'Shop.Theme.Catalog'),$_smarty_tpl);?>
</h4>
                      </div>
                      <div class="modal-body">
                        <?php  $_smarty_tpl->tpl_vars["field"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["field"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customization']->value['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["field"]->key => $_smarty_tpl->tpl_vars["field"]->value) {
$_smarty_tpl->tpl_vars["field"]->_loop = true;
?>
                          <div class="product-customization-line row">
                            <div class="col-sm-3 col-xs-4 label">
                              <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['label'], ENT_QUOTES, 'UTF-8');?>

                            </div>
                            <div class="col-sm-9 col-xs-8 value">
                              <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=='text') {?>
                                <?php if ((int)$_smarty_tpl->tpl_vars['field']->value['id_module']) {?>
                                  <?php echo $_smarty_tpl->tpl_vars['field']->value['text'];?>

                                <?php } else { ?>
                                  <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['text'], ENT_QUOTES, 'UTF-8');?>

                                <?php }?>
                              <?php } elseif ($_smarty_tpl->tpl_vars['field']->value['type']=='image') {?>
                                <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['image']['small']['url'], ENT_QUOTES, 'UTF-8');?>
">
                              <?php }?>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            <?php }?>
            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"unit_price"),$_smarty_tpl);?>

          </div>
          <div class="col-sm-6 col-xs-12 qty">
            <div class="row">
              <div class="col-xs-5 text-sm-right text-xs-left"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price'], ENT_QUOTES, 'UTF-8');?>
</div>
              <div class="col-xs-2"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['quantity'], ENT_QUOTES, 'UTF-8');?>
</div>
              <div class="col-xs-5 text-xs-right bold"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['total'], ENT_QUOTES, 'UTF-8');?>
</div>
            </div>
          </div>
        </div>
      <?php } ?>

      <hr>

      <table>
        <?php  $_smarty_tpl->tpl_vars['subtotal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subtotal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subtotals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subtotal']->key => $_smarty_tpl->tpl_vars['subtotal']->value) {
$_smarty_tpl->tpl_vars['subtotal']->_loop = true;
?>
          <?php if ($_smarty_tpl->tpl_vars['subtotal']->value['type']!=='tax') {?>
            <tr>
              <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subtotal']->value['label'], ENT_QUOTES, 'UTF-8');?>
</td>
              <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subtotal']->value['value'], ENT_QUOTES, 'UTF-8');?>
</td>
            </tr>
          <?php }?>
        <?php } ?>
        <?php if ($_smarty_tpl->tpl_vars['subtotals']->value['tax']['label']!==null) {?>
          <tr class="sub">
            <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subtotals']->value['tax']['label'], ENT_QUOTES, 'UTF-8');?>
</td>
            <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subtotals']->value['tax']['value'], ENT_QUOTES, 'UTF-8');?>
</td>
          </tr>
        <?php }?>
        <tr class="font-weight-bold">
          <td><span class="text-uppercase"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['totals']->value['total']['label'], ENT_QUOTES, 'UTF-8');?>
</span> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['labels']->value['tax_short'], ENT_QUOTES, 'UTF-8');?>
</td>
          <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['totals']->value['total']['value'], ENT_QUOTES, 'UTF-8');?>
</td>
        </tr>
      </table>
    

  </div>
</div>
<?php }} ?>
