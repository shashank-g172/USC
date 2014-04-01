<?php /* Smarty version Smarty-3.1.16, created on 2014-03-31 23:10:04
         compiled from "C:\wamp\www\slots\tpl\dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:302975339f5cc281aa9-45523129%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffbc0ad528bf75578ad8060a5b5089c7be9476df' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\dashboard.tpl',
      1 => 1396091096,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '302975339f5cc281aa9-45523129',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
    'dashboardItem' => 0,
    'Path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5339f5cc8f8c62_44274613',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5339f5cc8f8c62_44274613')) {function content_5339f5cc8f8c62_44274613($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/dashboard.css,css/jquery.qtip.min.css'), 0);?>


<ul id="dashboardList">
<?php  $_smarty_tpl->tpl_vars['dashboardItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dashboardItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dashboardItem']->key => $_smarty_tpl->tpl_vars['dashboardItem']->value) {
$_smarty_tpl->tpl_vars['dashboardItem']->_loop = true;
?>
    <li><?php echo $_smarty_tpl->tpl_vars['dashboardItem']->value->PageLoad();?>
</li>
<?php } ?>
</ul>

<script type="text/javascript" src="scripts/js/jquery.qtip.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
scripts/dashboard.js"></script>

<script type="text/javascript">
$(document).ready(function() {

	var dashboardOpts = {
		reservationUrl: "<?php echo Pages::RESERVATION;?>
?<?php echo QueryStringKeys::REFERENCE_NUMBER;?>
=",
		summaryPopupUrl: "ajax/respopup.php"
	};

	var dashboard = new Dashboard(dashboardOpts);
	dashboard.init();
});
</script>

<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
