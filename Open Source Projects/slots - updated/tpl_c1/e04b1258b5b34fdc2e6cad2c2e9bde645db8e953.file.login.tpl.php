<?php /* Smarty version Smarty-3.1.16, created on 2014-04-14 23:25:16
         compiled from "C:\wamp\www\slots\tpl\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10446534c6e5c7c51e6-56689613%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e04b1258b5b34fdc2e6cad2c2e9bde645db8e953' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\login.tpl',
      1 => 1396294053,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10446534c6e5c7c51e6-56689613',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ShowLoginError' => 0,
    'ShowUsernamePrompt' => 0,
    'ShowPasswordPrompt' => 0,
    'ShowPersistLoginPrompt' => 0,
    'ResumeUrl' => 0,
    'ShowRegisterLink' => 0,
    'ShowScheduleLink' => 0,
    'ShowForgotPasswordPrompt' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_534c6e5ce10df1_24860854',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_534c6e5ce10df1_24860854')) {function content_534c6e5ce10df1_24860854($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader_login.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php if ($_smarty_tpl->tpl_vars['ShowLoginError']->value) {?>
<div id="loginError">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'LoginError'),$_smarty_tpl);?>

</div>
<?php }?>
<div id="wrapper">
	<div id="sur_header">
		<h2>Welcome to the Surgery Assist website</h2><br>
	<br>
	<br>	<p><strong>SurgeryAssist</strong> is an innovative solution to surgeons and outpatient surgery centers current scheduling problems. This site will enable doctors and their assistants to browse and book rooms for outpatient surgeries across surgery centers that offer these facilities across the greater Los Angeles area.</p> 
<br>
<p> We offer a hassle free, easy to comprehend service to ensure a smooth booking process. We hope that you will find this website useful and convenient.</div>
<div id="loginbox">
	<!--This "$smarty.server.SCRIPT_NAME" sets up the form to post back to the same page that it is on.-->
	<form name="login" id="login" class="login" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>
">
		<div>
			<?php if ($_smarty_tpl->tpl_vars['ShowUsernamePrompt']->value) {?>
			<p>
				<label class="login"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'UsernameOrEmail'),$_smarty_tpl);?>
<br/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('name'=>"EMAIL",'class'=>"input",'size'=>"20",'tabindex'=>"10"),$_smarty_tpl);?>
</label>
			</p>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['ShowPasswordPrompt']->value) {?>
			<p>
				<label class="login"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Password'),$_smarty_tpl);?>
<br/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('type'=>"password",'name'=>"PASSWORD",'class'=>"input",'value'=>'','size'=>"20",'tabindex'=>"20"),$_smarty_tpl);?>
</label>
			</p>
			<?php }?>


			<?php if ($_smarty_tpl->tpl_vars['ShowPersistLoginPrompt']->value) {?>
			<p class="stayloggedin">
				<label class="login"><input type="checkbox" name="<?php echo FormKeys::PERSIST_LOGIN;?>
" value="true"
											tabindex="30"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'RememberMe'),$_smarty_tpl);?>
</label>

			</p>
			<?php }?>

			<p class="loginsubmit">
				<button type="submit" name="<?php echo Actions::LOGIN;?>
" class="button" tabindex="100" value="submit"><img
						src="img/door-open-in.png"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'LogIn'),$_smarty_tpl);?>
 </button>
				<input type="hidden" name="<?php echo FormKeys::RESUME;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ResumeUrl']->value;?>
"/>
			</p>
		</div>
		<div style="clear:both;">&nbsp;</div>
	<?php if ($_smarty_tpl->tpl_vars['ShowRegisterLink']->value) {?>
		<h4 class="DoctorRegister" align="center">
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_link'][0][0]->PrintLink(array('href'=>"docsign.php",'key'=>"CreateDocAccount"),$_smarty_tpl);?>

		</h4>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['ShowRegisterLink']->value) {?>
		<h4 class="SurgeryCenterRegister" align="center">
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_link'][0][0]->PrintLink(array('href'=>"scsign.php",'key'=>"CreateSCAccount"),$_smarty_tpl);?>

		</h4>
	<?php }?>
	
	
	<h4 align="center">
		<br>
		<?php if ($_smarty_tpl->tpl_vars['ShowScheduleLink']->value) {?>
		<a href="view-schedule.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ViewSchedule'),$_smarty_tpl);?>
</a>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['ShowScheduleLink']->value&&$_smarty_tpl->tpl_vars['ShowForgotPasswordPrompt']->value) {?>|<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['ShowForgotPasswordPrompt']->value) {?>
		<a href="forgot.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ForgotMyPassword'),$_smarty_tpl);?>
</a>
		<?php }?>
	</h4>


	</form>
</div>
</div>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['setfocus'][0][0]->SetFocus(array('key'=>'EMAIL'),$_smarty_tpl);?>


<script type="text/javascript">
	var url = 'index.php?<?php echo QueryStringKeys::LANGUAGE;?>
=';
	$(document).ready(function () {
		$('#languageDropDown').change(function()
		{
			window.location.href = url + $(this).val();
		});

		var langCode = readCookie('<?php echo CookieKeys::LANGUAGE;?>
');

		if (!langCode) {
		}
	});
</script>
<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
