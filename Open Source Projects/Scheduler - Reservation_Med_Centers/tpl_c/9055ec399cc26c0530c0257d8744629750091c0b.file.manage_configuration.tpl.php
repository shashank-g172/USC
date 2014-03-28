<?php /* Smarty version Smarty-3.1.16, created on 2014-03-17 04:26:37
         compiled from "C:\xampp\htdocs\booked\tpl\Admin\Configuration\manage_configuration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1407053266b6d4181f4-17165252%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9055ec399cc26c0530c0257d8744629750091c0b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\booked\\tpl\\Admin\\Configuration\\manage_configuration.tpl',
      1 => 1391287728,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1407053266b6d4181f4-17165252',
  'function' => 
  array (
    'list_settings' => 
    array (
      'parameter' => 
      array (
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'SCRIPT_NAME' => 0,
    'ConfigFiles' => 0,
    'file' => 0,
    'SelectedFile' => 0,
    'selected' => 0,
    'settings' => 0,
    'setting' => 0,
    'rowCss' => 0,
    'name' => 0,
    'TimezoneValues' => 0,
    'TimezoneOutput' => 0,
    'Languages' => 0,
    'IsPageEnabled' => 0,
    'IsConfigFileWritable' => 0,
    'HelpUrl' => 0,
    'Settings' => 0,
    'SectionSettings' => 0,
    'section' => 0,
    'SettingNames' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53266b6d826913_24595113',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53266b6d826913_24595113')) {function content_53266b6d826913_24595113($_smarty_tpl) {?>

<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/admin.css,scripts/css/colorbox.css'), 0);?>


<form id="frmConfigFile" method="GET" action="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'File'),$_smarty_tpl);?>
:
	<select name="cf" id="cf" class="textbox">
	<?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ConfigFiles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->_loop = true;
?>
		<?php $_smarty_tpl->tpl_vars['selected'] = new Smarty_variable('', null, 0);?>
		<?php if ($_smarty_tpl->tpl_vars['file']->value->Location==$_smarty_tpl->tpl_vars['SelectedFile']->value) {?><?php $_smarty_tpl->tpl_vars['selected'] = new Smarty_variable("selected='selected'", null, 0);?><?php }?>
		<option value="<?php echo $_smarty_tpl->tpl_vars['file']->value->Location;?>
" <?php echo $_smarty_tpl->tpl_vars['selected']->value;?>
><?php echo $_smarty_tpl->tpl_vars['file']->value->Name;?>
</option>
	<?php } ?>
	</select>
</form>

<?php if (!is_callable('smarty_function_cycle')) include 'C:\xampp\htdocs\booked\lib\Common/../../lib/external/Smarty/plugins\function.cycle.php';
if (!is_callable('smarty_function_html_options')) include 'C:\xampp\htdocs\booked\lib\Common/../../lib/external/Smarty/plugins\function.html_options.php';
?><?php if (!function_exists('smarty_template_function_list_settings')) {
    function smarty_template_function_list_settings($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['list_settings']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
	<?php  $_smarty_tpl->tpl_vars['setting'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['setting']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['settings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['setting']->key => $_smarty_tpl->tpl_vars['setting']->value) {
$_smarty_tpl->tpl_vars['setting']->_loop = true;
?>
		<?php echo smarty_function_cycle(array('values'=>',row1','assign'=>'rowCss'),$_smarty_tpl);?>

		<?php $_smarty_tpl->tpl_vars["name"] = new Smarty_variable($_smarty_tpl->tpl_vars['setting']->value->Name, null, 0);?>
    <li class="<?php echo $_smarty_tpl->tpl_vars['rowCss']->value;?>
"><span class="label"><?php echo $_smarty_tpl->tpl_vars['setting']->value->Key;?>
</span>
		<?php if ($_smarty_tpl->tpl_vars['setting']->value->Key==ConfigKeys::DEFAULT_TIMEZONE) {?>
            <select name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="textbox">
				<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['TimezoneValues']->value,'output'=>$_smarty_tpl->tpl_vars['TimezoneOutput']->value,'selected'=>$_smarty_tpl->tpl_vars['setting']->value->Value),$_smarty_tpl);?>

            </select>
			<?php } elseif ($_smarty_tpl->tpl_vars['setting']->value->Key==ConfigKeys::LANGUAGE) {?>
            <select name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="textbox">
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['object_html_options'][0][0]->ObjectHtmlOptions(array('options'=>$_smarty_tpl->tpl_vars['Languages']->value,'key'=>'GetLanguageCode','label'=>'GetDisplayName','selected'=>strtolower($_smarty_tpl->tpl_vars['setting']->value->Value)),$_smarty_tpl);?>

            </select>
			<?php } elseif ($_smarty_tpl->tpl_vars['setting']->value->Type==ConfigSettingType::String) {?>
            <input type="text" size="50" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['setting']->value->Value, ENT_QUOTES, 'UTF-8', true);?>
" class="textbox"/>
			<?php } else { ?>
            <label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"True"),$_smarty_tpl);?>
<input type="radio" value="true" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['setting']->value->Value=='true') {?>
                                                checked="checked"<?php }?> /></label>
            <label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"False"),$_smarty_tpl);?>
<input type="radio" value="false"
                                                 name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['setting']->value->Value=='false') {?> checked="checked"<?php }?> /></label>
		<?php }?>
    </li>
	<?php } ?>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ManageConfiguration'),$_smarty_tpl);?>
</h1>

<?php if (!$_smarty_tpl->tpl_vars['IsPageEnabled']->value) {?>
<div class="warning">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ConfigurationUiNotEnabled'),$_smarty_tpl);?>

</div>
<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['IsConfigFileWritable']->value) {?>
<div class="warning">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ConfigurationFileNotWritable'),$_smarty_tpl);?>

</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['IsPageEnabled']->value&&$_smarty_tpl->tpl_vars['IsConfigFileWritable']->value) {?>

	<?php $_smarty_tpl->tpl_vars['HelpUrl'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['ScriptUrl']->value)."/help.php?ht=admin", null, 0);?>
<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ConfigurationUpdateHelp','args'=>$_smarty_tpl->tpl_vars['HelpUrl']->value),$_smarty_tpl);?>
</h3>

<div id="updatedMessage" class="success" style="display:none">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ConfigurationUpdated'),$_smarty_tpl);?>

</div>

<div id="configSettings">

    <input type="button" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
" class='button save'/>

    <form id="frmConfigSettings" method="post" ajaxAction="<?php echo ConfigActions::Update;?>
" action="<?php echo $_SERVER['SCRIPT_NAME'];?>
">
		<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GeneralConfigSettings'),$_smarty_tpl);?>
</h3>
		<fieldset>
		<ul class="no-style config-settings">
			<?php smarty_template_function_list_settings($_smarty_tpl,array('settings'=>$_smarty_tpl->tpl_vars['Settings']->value));?>

        </ul>
		</fieldset>

		<?php  $_smarty_tpl->tpl_vars['settings'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['settings']->_loop = false;
 $_smarty_tpl->tpl_vars['section'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SectionSettings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['settings']->key => $_smarty_tpl->tpl_vars['settings']->value) {
$_smarty_tpl->tpl_vars['settings']->_loop = true;
 $_smarty_tpl->tpl_vars['section']->value = $_smarty_tpl->tpl_vars['settings']->key;
?>
            <h3><?php echo $_smarty_tpl->tpl_vars['section']->value;?>
</h3>
            <fieldset>
                <ul class="no-style config-settings">
					<?php smarty_template_function_list_settings($_smarty_tpl,array('settings'=>$_smarty_tpl->tpl_vars['settings']->value));?>

                </ul>
            </fieldset>
		<?php } ?>

        <input type="hidden" name="setting_names" value="<?php echo $_smarty_tpl->tpl_vars['SettingNames']->value;?>
"/>
    </form>
    <input type="button" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
" class='button save'/>

</div>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.colorbox-min.js"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/configuration.js"),$_smarty_tpl);?>


<script type="text/javascript">

    $(document).ready(function ()
    {
        var config = new Configuration();
        config.init();
    });

</script>

<div id="modalDiv" style="display:none;text-align:center; top:15%;position:relative;">
    <h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Working'),$_smarty_tpl);?>
...</h3>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"reservation_submitting.gif"),$_smarty_tpl);?>

</div>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
