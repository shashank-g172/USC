<?php /* Smarty version Smarty-3.1.16, created on 2014-03-29 12:22:20
         compiled from "C:\wamp\www\slots\tpl\Install\install.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19295336bafcd54cd2-81381866%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a311f603597c99aeb051a0f8f323cad73324f53' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\Install\\install.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19295336bafcd54cd2-81381866',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ShowInvalidPassword' => 0,
    'InstallPasswordMissing' => 0,
    'ShowUpToDateMessage' => 0,
    'ShowPasswordPrompt' => 0,
    'ShowDatabasePrompt' => 0,
    'ConfigPath' => 0,
    'dbname' => 0,
    'dbuser' => 0,
    'dbhost' => 0,
    'ShowInstallOptions' => 0,
    'ShowUpgradeOptions' => 0,
    'installresults' => 0,
    'result' => 0,
    'InstallCompletedSuccessfully' => 0,
    'Path' => 0,
    'UpgradeCompletedSuccessfully' => 0,
    'TargetVersion' => 0,
    'InstallFailed' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5336bafd805031_50423899',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5336bafd805031_50423899')) {function content_5336bafd805031_50423899($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InstallApplication'),$_smarty_tpl);?>
</h1>

<div>
    <form class="register" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>
">

        <?php if ($_smarty_tpl->tpl_vars['ShowInvalidPassword']->value) {?>
            <div class="error"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'IncorrectInstallPassword'),$_smarty_tpl);?>
</div>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['InstallPasswordMissing']->value) {?>
            <div class='error'>
                <p><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SetInstallPassword'),$_smarty_tpl);?>
</p>
                <p><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InstallPasswordInstructions','args'=>((string)$_smarty_tpl->tpl_vars['ConfigPath']->value).",".((string)$_smarty_tpl->tpl_vars['ConfigSetting']->value).",".((string)$_smarty_tpl->tpl_vars['SuggestedInstallPassword']->value)),$_smarty_tpl);?>
</p>
            </div>
        <?php }?>

		<?php if ($_smarty_tpl->tpl_vars['ShowUpToDateMessage']->value) {?>
			<div class="error" style="margin-bottom: 10px;">
				<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoUpgradeNeeded'),$_smarty_tpl);?>
</h3>
			</div>
		<?php }?>

        <?php if ($_smarty_tpl->tpl_vars['ShowPasswordPrompt']->value) {?>
            <ul class="no-style">
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ProvideInstallPassword'),$_smarty_tpl);?>
</li>
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InstallPasswordLocation','args'=>((string)$_smarty_tpl->tpl_vars['ConfigPath']->value).",".((string)$_smarty_tpl->tpl_vars['ConfigSetting']->value)),$_smarty_tpl);?>
</li>
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('type'=>"password",'name'=>"INSTALL_PASSWORD",'class'=>"textbox",'size'=>"20"),$_smarty_tpl);?>

                    <button type="submit" name="" class="button" value="submit"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Next'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"arrow_large_right.png"),$_smarty_tpl);?>
</button>
                </li>
            </ul>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['ShowDatabasePrompt']->value) {?>
            <ul class="no-style">
                <li>1) <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'VerifyInstallSettings','args'=>$_smarty_tpl->tpl_vars['ConfigPath']->value),$_smarty_tpl);?>

                    <ul class="no-style" style="margin-left: 20px;">
                        <li><b><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DatabaseName'),$_smarty_tpl);?>
:</b> <?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
</li>
                        <li><b><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DatabaseUser'),$_smarty_tpl);?>
:</b> <?php echo $_smarty_tpl->tpl_vars['dbuser']->value;?>
</li>
                        <li><b><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DatabaseHost'),$_smarty_tpl);?>
:</b> <?php echo $_smarty_tpl->tpl_vars['dbhost']->value;?>
</li>
                    </ul>
                </li>
                <li>&nbsp;</li>
                <li>2) <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DatabaseCredentials'),$_smarty_tpl);?>
</li>
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'MySQLUser'),$_smarty_tpl);?>
</li>
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('name'=>"INSTALL_DB_USER",'class'=>"textbox",'size'=>"20"),$_smarty_tpl);?>
</li>
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Password'),$_smarty_tpl);?>
</li>
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('type'=>"password",'name'=>"INSTALL_DB_PASSWORD",'class'=>"textbox",'size'=>"20"),$_smarty_tpl);?>
</li>
                <li>&nbsp;</li>
				<?php if ($_smarty_tpl->tpl_vars['ShowInstallOptions']->value) {?>
					<li>3)<i><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InstallOptionsWarning'),$_smarty_tpl);?>
</i></li>
					<li><input type="checkbox" name="create_database" /> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CreateDatabase'),$_smarty_tpl);?>
 (<?php echo $_smarty_tpl->tpl_vars['dbname']->value;?>
) <span style="color:Red;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DataWipeWarning'),$_smarty_tpl);?>
</span></li>
					<li><input type="checkbox" name="create_user" /> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CreateDatabaseUser'),$_smarty_tpl);?>
 (<?php echo $_smarty_tpl->tpl_vars['dbuser']->value;?>
)</li>
					<li><input type="checkbox" name="create_sample_data" /> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'PopulateExampleData'),$_smarty_tpl);?>
</li>
					<li>
						<br/><button type="submit" name="run_install" class="button" value="submit"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'RunInstallation'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"arrow_large_right.png"),$_smarty_tpl);?>
<br/>
					</li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['ShowUpgradeOptions']->value) {?>
					<li>3) <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'UpgradeNotice','args'=>((string)$_smarty_tpl->tpl_vars['CurrentVersion']->value).",".((string)$_smarty_tpl->tpl_vars['TargetVersion']->value)),$_smarty_tpl);?>
</li>
					<li>
						<br/><button type="submit" name="run_upgrade" class="button" value="submit"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'RunUpgrade'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"arrow_large_right.png"),$_smarty_tpl);?>
<br/>
					</li>
				<?php }?>
            </ul>
        <?php }?>

        <ul class="no-style">
            <?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['result']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['installresults']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value) {
$_smarty_tpl->tpl_vars['result']->_loop = true;
?>
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Executing'),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->tpl_vars['result']->value->taskName;?>
</li>
                <?php if ($_smarty_tpl->tpl_vars['result']->value->WasSuccessful()) {?>
                    <li style="background-color: #9acd32"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Success'),$_smarty_tpl);?>
</li>
                <?php } else { ?>
                    <li style="border: solid red 5px;padding:10px;">
                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'StatementFailed'),$_smarty_tpl);?>

                        <ul class='no-style'>
                            <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SQLStatement'),$_smarty_tpl);?>
 <pre><?php echo $_smarty_tpl->tpl_vars['result']->value->sqlText;?>
</pre></li>
                            <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ErrorCode'),$_smarty_tpl);?>
 <pre><?php echo $_smarty_tpl->tpl_vars['result']->value->sqlErrorCode;?>
</pre></li>
                            <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ErrorText'),$_smarty_tpl);?>
 <pre><?php echo $_smarty_tpl->tpl_vars['result']->value->sqlErrorText;?>
</pre></li>
                        </ul>
                    </li>
                <?php }?>
            <?php } ?>
			<li>&nbsp;</li>
            <li>
                <?php if ($_smarty_tpl->tpl_vars['InstallCompletedSuccessfully']->value) {?>
                    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InstallationSuccess'),$_smarty_tpl);?>
<br/>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
<?php echo Pages::REGISTRATION;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Register'),$_smarty_tpl);?>
</a> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'RegisterAdminUser','args'=>((string)$_smarty_tpl->tpl_vars['ConfigPath']->value)),$_smarty_tpl);?>
<br/><br/>
					<a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
<?php echo Pages::LOGIN;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Login'),$_smarty_tpl);?>
</a> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'LoginWithSampleAccounts'),$_smarty_tpl);?>

				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['UpgradeCompletedSuccessfully']->value) {?>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InstalledVersion','args'=>$_smarty_tpl->tpl_vars['TargetVersion']->value),$_smarty_tpl);?>

					<h3><a href="configure.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InstallUpgradeConfig'),$_smarty_tpl);?>
</a></h3>
				<?php }?>
                <?php if ($_smarty_tpl->tpl_vars['InstallFailed']->value) {?>
                    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InstallationFailure'),$_smarty_tpl);?>

                <?php }?>
            </li>
        </ul>


    </form>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
