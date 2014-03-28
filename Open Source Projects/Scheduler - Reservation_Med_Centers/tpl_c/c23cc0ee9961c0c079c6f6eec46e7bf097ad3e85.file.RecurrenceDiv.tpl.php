<?php /* Smarty version Smarty-3.1.16, created on 2014-03-20 02:40:14
         compiled from "C:\xampp\htdocs\slots\tpl\Controls\RecurrenceDiv.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21496532a46fe4aed34-66521239%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c23cc0ee9961c0c079c6f6eec46e7bf097ad3e85' => 
    array (
      0 => 'C:\\xampp\\htdocs\\slots\\tpl\\Controls\\RecurrenceDiv.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21496532a46fe4aed34-66521239',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'prefix' => 0,
    'RepeatOptions' => 0,
    'k' => 0,
    'v' => 0,
    'RepeatEveryOptions' => 0,
    'RepeatTerminationDate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_532a46fe761339_96634922',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_532a46fe761339_96634922')) {function content_532a46fe761339_96634922($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'C:\\xampp\\htdocs\\slots\\lib\\Common/../../lib/external/Smarty/plugins\\function.html_options.php';
?>
<div id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatDiv">
	<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"RepeatPrompt"),$_smarty_tpl);?>
</label>
	<select id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatOptions" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'repeat_options'),$_smarty_tpl);?>
 class="pulldown input" style="width:250px">
	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RepeatOptions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
		<option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['v']->value['key']),$_smarty_tpl);?>
</option>
	<?php } ?>
	</select>

	<div id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatEveryDiv" style="display:none;" class="days weeks months years">
		<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"RepeatEveryPrompt"),$_smarty_tpl);?>
</label>
		<select id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatInterval" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'repeat_every'),$_smarty_tpl);?>
 class="pulldown input" style="width:55px">
		<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['RepeatEveryOptions']->value,'output'=>$_smarty_tpl->tpl_vars['RepeatEveryOptions']->value),$_smarty_tpl);?>

		</select>
		<span class="days"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['RepeatOptions']->value['daily']['everyKey']),$_smarty_tpl);?>
</span>
		<span class="weeks"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['RepeatOptions']->value['weekly']['everyKey']),$_smarty_tpl);?>
</span>
		<span class="months"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['RepeatOptions']->value['monthly']['everyKey']),$_smarty_tpl);?>
</span>
		<span class="years"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['RepeatOptions']->value['yearly']['everyKey']),$_smarty_tpl);?>
</span>
	</div>
	<div id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatOnWeeklyDiv" style="display:none;" class="weeks">
		<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"RepeatDaysPrompt"),$_smarty_tpl);?>
</label>
		<input type="checkbox"
			   id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatDay0" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'repeat_sunday'),$_smarty_tpl);?>
 /><label
			for="repeatDay0"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"DaySundayAbbr"),$_smarty_tpl);?>
</label>
		<input type="checkbox"
			   id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatDay1" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'repeat_monday'),$_smarty_tpl);?>
 /><label
			for="repeatDay1"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"DayMondayAbbr"),$_smarty_tpl);?>
</label>
		<input type="checkbox"
			   id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatDay2" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'repeat_tuesday'),$_smarty_tpl);?>
 /><label
			for="repeatDay2"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"DayTuesdayAbbr"),$_smarty_tpl);?>
</label>
		<input type="checkbox"
			   id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatDay3" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'repeat_wednesday'),$_smarty_tpl);?>
 /><label
			for="repeatDay3"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"DayWednesdayAbbr"),$_smarty_tpl);?>
</label>
		<input type="checkbox"
			   id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatDay4" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'repeat_thursday'),$_smarty_tpl);?>
 /><label
			for="repeatDay4"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"DayThursdayAbbr"),$_smarty_tpl);?>
</label>
		<input type="checkbox"
			   id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatDay5" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'repeat_friday'),$_smarty_tpl);?>
 /><label
			for="repeatDay5"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"DayFridayAbbr"),$_smarty_tpl);?>
</label>
		<input type="checkbox"
			   id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatDay6" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'repeat_saturday'),$_smarty_tpl);?>
 /><label
			for="repeatDay6"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"DaySaturdayAbbr"),$_smarty_tpl);?>
</label>
	</div>
	<div id="repeatOnMonthlyDiv" style="display:none;" class="months">
		<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPEAT_MONTHLY_TYPE'),$_smarty_tpl);?>
 value="<?php echo RepeatMonthlyType::DayOfMonth;?>
"
			   id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatMonthDay" checked="checked"/>
		<label for="repeatMonthDay"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"repeatDayOfMonth"),$_smarty_tpl);?>
</label>
		<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPEAT_MONTHLY_TYPE'),$_smarty_tpl);?>
 value="<?php echo RepeatMonthlyType::DayOfWeek;?>
"
			   id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatMonthWeek"/>
		<label for="repeatMonthWeek"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"repeatDayOfWeek"),$_smarty_tpl);?>
</label>
	</div>
	<div id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
repeatUntilDiv" style="display:none;">
		<label for="formattedEndRepeat"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"RepeatUntilPrompt"),$_smarty_tpl);?>
</label>
		<input type="text" id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
EndRepeat" class="dateinput" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['RepeatTerminationDate']->value),$_smarty_tpl);?>
"/>
		<input type="hidden" id="<?php echo $_smarty_tpl->tpl_vars['prefix']->value;?>
formattedEndRepeat" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'end_repeat_date'),$_smarty_tpl);?>

			   value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['RepeatTerminationDate']->value,'key'=>'system'),$_smarty_tpl);?>
"/>
	</div>
</div><?php }} ?>
