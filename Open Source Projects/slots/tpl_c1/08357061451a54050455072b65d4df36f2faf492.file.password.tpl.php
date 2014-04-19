<?php /* Smarty version Smarty-3.1.16, created on 2014-04-18 07:45:24
         compiled from "C:\wamp\www\slots\tpl\password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150105350d8144e48a2-94800658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08357061451a54050455072b65d4df36f2faf492' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\password.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150105350d8144e48a2-94800658',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ResetPasswordSuccess' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5350d814842c12_75951601',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5350d814842c12_75951601')) {function content_5350d814842c12_75951601($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('validation_group', array('class'=>"error")); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['validation_group'][0][0]->ValidationGroup(array('class'=>"error"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['validator'][0][0]->Validator(array('id'=>"currentpassword",'key'=>"InvalidPassword"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['validator'][0][0]->Validator(array('id'=>"passwordmatch",'key'=>"PwMustMatch"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['validator'][0][0]->Validator(array('id'=>"passwordcomplexity",'key'=>"PwComplexity"),$_smarty_tpl);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['validation_group'][0][0]->ValidationGroup(array('class'=>"error"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>



<?php if ($_smarty_tpl->tpl_vars['ResetPasswordSuccess']->value) {?>
<div class="success">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'PasswordChangedSuccessfully'),$_smarty_tpl);?>

</div>
<?php }?>

<div id="registrationbox">
	<form class="register" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>
">
		<div class="registrationHeader"><h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ChangePassword"),$_smarty_tpl);?>
</h3></div>
		<p>
			<label class="reg"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"CurrentPassword"),$_smarty_tpl);?>
<br/>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('type'=>"password",'name'=>"CURRENT_PASSWORD",'class'=>"input",'size'=>"20"),$_smarty_tpl);?>

			</label>
		</p>

		<p>
			<label class="reg"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"NewPassword"),$_smarty_tpl);?>
<br/>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('type'=>"password",'name'=>"PASSWORD",'class'=>"input",'value'=>'','size'=>"20"),$_smarty_tpl);?>

			</label>
		</p>

		<p>
			<label class="reg"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"PasswordConfirmation"),$_smarty_tpl);?>
<br/>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('type'=>"password",'name'=>"PASSWORD_CONFIRM",'class'=>"input",'value'=>'','size'=>"20"),$_smarty_tpl);?>

			</label>
		</p>

		<p class="regsubmit">
			<button type="submit" name="<?php echo Actions::CHANGE_PASSWORD;?>
" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ChangePassword'),$_smarty_tpl);?>
"
					class="button"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ChangePassword'),$_smarty_tpl);?>
</button>
		</p>
	</form>
</div>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['setfocus'][0][0]->SetFocus(array('key'=>'CURRENT_PASSWORD'),$_smarty_tpl);?>

<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
