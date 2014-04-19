<?php /* Smarty version Smarty-3.1.16, created on 2014-04-18 07:42:16
         compiled from "C:\wamp\www\slots\tpl\Ajax\reservation\save_successful.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7635350d7581d97d2-00219741%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1df96d9f3629ad14cdc006026c0aa5819a569ff' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\Ajax\\reservation\\save_successful.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7635350d7581d97d2-00219741',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ReferenceNumber' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5350d758247016_30418204',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5350d758247016_30418204')) {function content_5350d758247016_30418204($_smarty_tpl) {?>
<div>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"dialog-success.png"),$_smarty_tpl);?>
<br/>
	<div><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReservationCreated'),$_smarty_tpl);?>
</div>
	<div><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'YourReferenceNumber','args'=>$_smarty_tpl->tpl_vars['ReferenceNumber']->value),$_smarty_tpl);?>
</div>

	<input type="button" id="btnSaveSuccessful" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Close'),$_smarty_tpl);?>
" class="button" />

</div><?php }} ?>
