<?php /* Smarty version Smarty-3.1.19, created on 2017-08-10 11:58:10
         compiled from "/home/admin/web/bikeonline-thai.com/public_html/shop/admin1123ybrq3/themes/default/template/helpers/modules_list/modal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:521542845598be7e2448091-38228552%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40201b3e71a65e2c55606b4c03c12b278ae9b923' => 
    array (
      0 => '/home/admin/web/bikeonline-thai.com/public_html/shop/admin1123ybrq3/themes/default/template/helpers/modules_list/modal.tpl',
      1 => 1502339865,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '521542845598be7e2448091-38228552',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_598be7e244a140_37036916',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_598be7e244a140_37036916')) {function content_598be7e244a140_37036916($_smarty_tpl) {?>
<div class="modal fade" id="modules_list_container">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title"><?php echo smartyTranslate(array('s'=>'Recommended Modules and Services'),$_smarty_tpl);?>
</h3>
			</div>
			<div class="modal-body">
				<div id="modules_list_container_tab_modal" style="display:none;"></div>
				<div id="modules_list_loader"><i class="icon-refresh icon-spin"></i></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.fancybox-quick-view').fancybox({
			type: 'ajax',
			autoDimensions: false,
			autoSize: false,
			width: 600,
			height: 'auto',
			helpers: {
				overlay: {
					locked: false
				}
			}
		});
	});
</script>
<?php }} ?>
