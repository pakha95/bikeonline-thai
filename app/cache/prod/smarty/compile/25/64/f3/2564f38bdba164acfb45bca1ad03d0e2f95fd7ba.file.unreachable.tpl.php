<?php /* Smarty version Smarty-3.1.19, created on 2017-08-10 12:19:32
         compiled from "/home/admin/web/bikeonline-thai.com/public_html/shop/themes/classic/templates/checkout/_partials/steps/unreachable.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1478498629598bece43356c9-09283246%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2564f38bdba164acfb45bca1ad03d0e2f95fd7ba' => 
    array (
      0 => '/home/admin/web/bikeonline-thai.com/public_html/shop/themes/classic/templates/checkout/_partials/steps/unreachable.tpl',
      1 => 1502339869,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1478498629598bece43356c9-09283246',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'identifier' => 0,
    'position' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_598bece433a176_07209424',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_598bece433a176_07209424')) {function content_598bece433a176_07209424($_smarty_tpl) {?>

  <section class="checkout-step -unreachable" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['identifier']->value, ENT_QUOTES, 'UTF-8');?>
">
    <h1 class="step-title h3">
      <span class="step-number"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['position']->value, ENT_QUOTES, 'UTF-8');?>
</span> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>

    </h1>
  </section>

<?php }} ?>
