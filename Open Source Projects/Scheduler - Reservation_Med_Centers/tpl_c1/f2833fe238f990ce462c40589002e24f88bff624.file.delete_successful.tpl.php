<?php /* Smarty version Smarty-3.1.16, created on 2014-03-31 23:24:00
         compiled from "C:\wamp\www\slots\tpl\Ajax\reservation\delete_successful.tpl" */ ?>
<?php /*%%SmartyHeaderCode:79565339f910739016-79656695%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2833fe238f990ce462c40589002e24f88bff624' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\Ajax\\reservation\\delete_successful.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79565339f910739016-79656695',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5339f910864e47_12093820',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5339f910864e47_12093820')) {function content_5339f910864e47_12093820($_smarty_tpl) {?>
<div>
	<div><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReservationRemoved'),$_smarty_tpl);?>
</div>

	<input type="button" id="btnSaveSuccessful" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Close'),$_smarty_tpl);?>
" class="button" />

</div><?php }} ?>
