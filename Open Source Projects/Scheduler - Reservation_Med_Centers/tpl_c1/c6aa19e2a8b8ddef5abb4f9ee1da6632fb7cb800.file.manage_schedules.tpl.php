<?php /* Smarty version Smarty-3.1.16, created on 2014-03-31 23:35:25
         compiled from "C:\wamp\www\slots\tpl\Admin\manage_schedules.tpl" */ ?>
<?php /*%%SmartyHeaderCode:240565339fbbd3fcdf0-54764289%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6aa19e2a8b8ddef5abb4f9ee1da6632fb7cb800' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\Admin\\manage_schedules.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '240565339fbbd3fcdf0-54764289',
  'function' => 
  array (
    'display_periods' => 
    array (
      'parameter' => 
      array (
      ),
      'compiled' => '',
    ),
    'display_slot_inputs' => 
    array (
      'parameter' => 
      array (
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'Schedules' => 0,
    'schedule' => 0,
    'dayOfWeek' => 0,
    'DayNames' => 0,
    'Today' => 0,
    'id' => 0,
    'daysVisible' => 0,
    'GroupLookup' => 0,
    'AdminGroups' => 0,
    'day' => 0,
    'Layouts' => 0,
    'period' => 0,
    'showReservable' => 0,
    'dayIndex' => 0,
    'dayName' => 0,
    'SourceSchedules' => 0,
    'suffix' => 0,
    'TimezoneValues' => 0,
    'TimezoneOutput' => 0,
    'adminGroup' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5339fbbeb986d7_95804546',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5339fbbeb986d7_95804546')) {function content_5339fbbeb986d7_95804546($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'C:\\wamp\\www\\slots\\lib\\Common/../../lib/external/Smarty/plugins\\function.html_options.php';
?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/admin.css'), 0);?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ManageSchedules'),$_smarty_tpl);?>
</h1>

<div class="admin">
    <div class="title">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllSchedules'),$_smarty_tpl);?>

    </div>
<?php  $_smarty_tpl->tpl_vars['schedule'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['schedule']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Schedules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['schedule']->key => $_smarty_tpl->tpl_vars['schedule']->value) {
$_smarty_tpl->tpl_vars['schedule']->_loop = true;
?>
	<?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable($_smarty_tpl->tpl_vars['schedule']->value->GetId(), null, 0);?>
	<?php $_smarty_tpl->tpl_vars['daysVisible'] = new Smarty_variable($_smarty_tpl->tpl_vars['schedule']->value->GetDaysVisible(), null, 0);?>
	<?php $_smarty_tpl->tpl_vars['dayOfWeek'] = new Smarty_variable($_smarty_tpl->tpl_vars['schedule']->value->GetWeekdayStart(), null, 0);?>
	<?php $_smarty_tpl->tpl_vars['dayName'] = new Smarty_variable($_smarty_tpl->tpl_vars['DayNames']->value[$_smarty_tpl->tpl_vars['dayOfWeek']->value], null, 0);?>
	<?php if ($_smarty_tpl->tpl_vars['dayOfWeek']->value==Schedule::Today) {?>
		<?php $_smarty_tpl->tpl_vars['dayName'] = new Smarty_variable($_smarty_tpl->tpl_vars['Today']->value, null, 0);?>
	<?php }?>
    <div class="scheduleDetails">
        <div style="float:left;">
            <input type="hidden" class="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"/>
            <input type="hidden" class="daysVisible" value="<?php echo $_smarty_tpl->tpl_vars['daysVisible']->value;?>
"/>
            <input type="hidden" class="dayOfWeek" value="<?php echo $_smarty_tpl->tpl_vars['dayOfWeek']->value;?>
"/>
            <h4><?php echo $_smarty_tpl->tpl_vars['schedule']->value->GetName();?>
</h4> <a class="update renameButton"
                                               href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Rename'),$_smarty_tpl);?>
</a><br/>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"LayoutDescription",'args'=>((string)$_smarty_tpl->tpl_vars['dayName']->value).", ".((string)$_smarty_tpl->tpl_vars['daysVisible']->value)),$_smarty_tpl);?>

            <a class="update changeButton" href="javascript:void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Change'),$_smarty_tpl);?>
</a><br/>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ScheduleAdministrator'),$_smarty_tpl);?>

			<?php if ($_smarty_tpl->tpl_vars['schedule']->value->HasAdminGroup()) {?>
				<?php echo $_smarty_tpl->tpl_vars['GroupLookup']->value[$_smarty_tpl->tpl_vars['schedule']->value->GetAdminGroupId()]->Name;?>

				<?php } else { ?>
                <span class="note"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoScheduleAdministratorLabel'),$_smarty_tpl);?>
</span>
			<?php }?>
			<?php if (count($_smarty_tpl->tpl_vars['AdminGroups']->value)>0) {?>
                <a class="update adminButton" href="javascript: void(0);"
                   adminId="<?php echo $_smarty_tpl->tpl_vars['schedule']->value->GetAdminGroupId();?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Edit'),$_smarty_tpl);?>
</a>
			<?php }?>
        </div>

        <div class="layout">

			<?php if (!function_exists('smarty_template_function_display_periods')) {
    function smarty_template_function_display_periods($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['display_periods']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
				<?php  $_smarty_tpl->tpl_vars['period'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['period']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Layouts']->value[$_smarty_tpl->tpl_vars['id']->value]->GetSlots($_smarty_tpl->tpl_vars['day']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['period']->key => $_smarty_tpl->tpl_vars['period']->value) {
$_smarty_tpl->tpl_vars['period']->_loop = true;
?>
					<?php if ($_smarty_tpl->tpl_vars['period']->value->IsReservable()==$_smarty_tpl->tpl_vars['showReservable']->value) {?>
						<?php echo $_smarty_tpl->tpl_vars['period']->value->Start->Format("H:i");?>
 - <?php echo $_smarty_tpl->tpl_vars['period']->value->End->Format("H:i");?>

						<?php if ($_smarty_tpl->tpl_vars['period']->value->IsLabelled()) {?>
							<?php echo $_smarty_tpl->tpl_vars['period']->value->Label;?>

						<?php }?>
                        ,
					<?php }?>
					<?php }
if (!$_smarty_tpl->tpl_vars['period']->_loop) {
?>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>

				<?php } ?>
			<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>


			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ScheduleLayout','args'=>$_smarty_tpl->tpl_vars['schedule']->value->GetTimezone()),$_smarty_tpl);?>
:<br/>
            <input type="hidden" class="timezone" value="<?php echo $_smarty_tpl->tpl_vars['schedule']->value->GetTimezone();?>
"/>

			<?php if (!$_smarty_tpl->tpl_vars['Layouts']->value[$_smarty_tpl->tpl_vars['id']->value]->UsesDailyLayouts()) {?>
                <input type="hidden" class="usesDailyLayouts" value="false"/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReservableTimeSlots'),$_smarty_tpl);?>

                <div class="reservableSlots" id="reservableSlots" ref="reservableEdit">
					<?php smarty_template_function_display_periods($_smarty_tpl,array('showReservable'=>true,'day'=>null));?>

                </div>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'BlockedTimeSlots'),$_smarty_tpl);?>

                <div class="blockedSlots" id="blockedSlots" ref="blockedEdit">
					<?php smarty_template_function_display_periods($_smarty_tpl,array('showReservable'=>false,'day'=>null));?>

                </div>
			<?php } else { ?>
                <input type="hidden" class="usesDailyLayouts" value="true"/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'LayoutVariesByDay'),$_smarty_tpl);?>
 - <a href="#" class="showAllDailyLayouts"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ShowHide'),$_smarty_tpl);?>
</a>
                <div class="allDailyLayouts">
				<?php  $_smarty_tpl->tpl_vars['day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day']->_loop = false;
 $_from = DayOfWeek::Days(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day']->key => $_smarty_tpl->tpl_vars['day']->value) {
$_smarty_tpl->tpl_vars['day']->_loop = true;
?>
					<?php echo $_smarty_tpl->tpl_vars['DayNames']->value[$_smarty_tpl->tpl_vars['day']->value];?>

					<div class="reservableSlots" id="reservableSlots_<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
" ref="reservableEdit_<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
">
						<?php smarty_template_function_display_periods($_smarty_tpl,array('showReservable'=>true,'day'=>$_smarty_tpl->tpl_vars['day']->value));?>

					</div>
					<div class="blockedSlots" id="blockedSlots_<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
" ref="blockedEdit_<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
">
						<?php smarty_template_function_display_periods($_smarty_tpl,array('showReservable'=>false,'day'=>$_smarty_tpl->tpl_vars['day']->value));?>

					</div>
                <?php } ?>
				</div>
			<?php }?>
        </div>
        <div class="actions">
			<div style="float:left;">
				<?php if ($_smarty_tpl->tpl_vars['schedule']->value->GetIsDefault()) {?>
                <span class="note"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ThisIsTheDefaultSchedule'),$_smarty_tpl);?>
</span> |
                <span class="note"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DefaultScheduleCannotBeDeleted'),$_smarty_tpl);?>
</span> |
				<?php } else { ?>
                <a class="update makeDefaultButton" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'MakeDefault'),$_smarty_tpl);?>
</a> |
                <a class="update deleteScheduleButton" href="#"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</a> |
			<?php }?>
            <a class="update changeLayoutButton" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ChangeLayout'),$_smarty_tpl);?>
</a> |
			<?php if ($_smarty_tpl->tpl_vars['schedule']->value->GetIsCalendarSubscriptionAllowed()) {?>
                <a class="update disableSubscription"
                   href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'TurnOffSubscription'),$_smarty_tpl);?>
</a>
				<?php } else { ?>
                <a class="update enableSubscription" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'TurnOnSubscription'),$_smarty_tpl);?>
</a>
			<?php }?>
			</div>
			<div style="float:right;text-align:center;">
				<?php if ($_smarty_tpl->tpl_vars['schedule']->value->GetIsCalendarSubscriptionAllowed()) {?>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"feed.png"),$_smarty_tpl);?>
 <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['schedule']->value->GetSubscriptionUrl()->GetAtomUrl();?>
">Atom</a> | <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['schedule']->value->GetSubscriptionUrl()->GetWebcalUrl();?>
">iCalendar</a>
				<?php }?>
			</div>
			<div class="clear"></div>
        </div>
    </div>
<?php } ?>
</div>

<div class="admin" style="margin-top:30px">
    <div class="title">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddSchedule'),$_smarty_tpl);?>

    </div>
    <div>
        <div id="addScheduleResults" class="error" style="display:none;"></div>
        <form id="addScheduleForm" method="post">
            <ul>
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Name'),$_smarty_tpl);?>
<br/> <input type="text" style="width:300px"
                                                     class="textbox required" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_NAME'),$_smarty_tpl);?>
 /></li>
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'StartsOn'),$_smarty_tpl);?>
<br/>
                    <select <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_WEEKDAY_START'),$_smarty_tpl);?>
 class="textbox">
                        <option value="<?php echo Schedule::Today;?>
"><?php echo $_smarty_tpl->tpl_vars['Today']->value;?>
</option>
					<?php  $_smarty_tpl->tpl_vars["dayName"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["dayName"]->_loop = false;
 $_smarty_tpl->tpl_vars["dayIndex"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['DayNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["dayName"]->key => $_smarty_tpl->tpl_vars["dayName"]->value) {
$_smarty_tpl->tpl_vars["dayName"]->_loop = true;
 $_smarty_tpl->tpl_vars["dayIndex"]->value = $_smarty_tpl->tpl_vars["dayName"]->key;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['dayIndex']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['dayName']->value;?>
</option>
					<?php } ?>
                    </select>
                </li>
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NumberOfDaysVisible'),$_smarty_tpl);?>
<br/><input type="text" class="textbox required" maxlength="3"
                                                                   size="3" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_DAYS_VISIBLE'),$_smarty_tpl);?>
 />
                </li>
                <li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'UseSameLayoutAs'),$_smarty_tpl);?>
<br/>
                    <select style="width:300px" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_ID'),$_smarty_tpl);?>
>
					<?php  $_smarty_tpl->tpl_vars['schedule'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['schedule']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['SourceSchedules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['schedule']->key => $_smarty_tpl->tpl_vars['schedule']->value) {
$_smarty_tpl->tpl_vars['schedule']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['schedule']->value->GetId();?>
"><?php echo $_smarty_tpl->tpl_vars['schedule']->value->GetName();?>
</option>
					<?php } ?>
                    </select>
                </li>
                <li style="padding-top:5px;">
                    <button type="button" class="button save"
                            value="submit"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"plus-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddSchedule'),$_smarty_tpl);?>
</button>
                </li>
            </ul>
        </form>
    </div>
</div>

<input type="hidden" id="activeId" value=""/>

<div id="deleteDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
">
    <form id="deleteForm" method="post">
        <div class="error" style="margin-bottom: 25px;">
            <h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</h3>
        </div>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'MoveResourcesAndReservations'),$_smarty_tpl);?>

        <select id="targetScheduleId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_ID'),$_smarty_tpl);?>
 class="required">
            <option value="">-- <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Schedule'),$_smarty_tpl);?>
 --</option>
		<?php  $_smarty_tpl->tpl_vars['schedule'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['schedule']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Schedules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['schedule']->key => $_smarty_tpl->tpl_vars['schedule']->value) {
$_smarty_tpl->tpl_vars['schedule']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['schedule']->value->GetId();?>
"><?php echo $_smarty_tpl->tpl_vars['schedule']->value->GetName();?>
</option>
		<?php } ?>
        </select>
        <br/><br/>
        <button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cross-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</button>
        <button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
    </form>
</div>
<div id="placeholderDialog" style="display:none">
    <form id="placeholderForm" method="post">
    </form>
</div>

<div id="renameDialog" class="dialog" style="display:none;">
    <form id="renameForm" method="post">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Name'),$_smarty_tpl);?>
: <input type="text" class="textbox required" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_NAME'),$_smarty_tpl);?>
 /><br/><br/>
        <button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
        <button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>

    </form>
</div>

<div id="changeSettingsDialog" class="dialog" style="display:none;">
    <form id="settingsForm" method="post">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'StartsOn'),$_smarty_tpl);?>
:
        <select id="dayOfWeek" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_WEEKDAY_START'),$_smarty_tpl);?>
 class="textbox">
            <option value="<?php echo Schedule::Today;?>
"><?php echo $_smarty_tpl->tpl_vars['Today']->value;?>
</option>
		<?php  $_smarty_tpl->tpl_vars["dayName"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["dayName"]->_loop = false;
 $_smarty_tpl->tpl_vars["dayIndex"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['DayNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["dayName"]->key => $_smarty_tpl->tpl_vars["dayName"]->value) {
$_smarty_tpl->tpl_vars["dayName"]->_loop = true;
 $_smarty_tpl->tpl_vars["dayIndex"]->value = $_smarty_tpl->tpl_vars["dayName"]->key;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['dayIndex']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['dayName']->value;?>
</option>
		<?php } ?>
        </select>
        <br/>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NumberOfDaysVisible'),$_smarty_tpl);?>
: <input type="text" class="textbox required" id="daysVisible" maxlength="3"
                                                size="3" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_DAYS_VISIBLE'),$_smarty_tpl);?>
 />
        <br/><br/>
        <button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
        <button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
    </form>
</div>

<div id="changeLayoutDialog" class="dialog" style="display:none;">

    <form id="changeLayoutForm" method="post">
        <div class="validationSummary">
            <ul><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['async_validator'][0][0]->AsyncValidator(array('id'=>"layoutValidator",'key'=>"ValidLayoutRequired"),$_smarty_tpl);?>

            </ul>
        </div>

        <div class="clear;display:block;" style="height:20px;">
            <label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'UseSameLayoutForAllDays'),$_smarty_tpl);?>
 <input type="checkbox" id="usesSingleLayout" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'USING_SINGLE_LAYOUT'),$_smarty_tpl);?>
></label>
        </div>

	<?php if (!function_exists('smarty_template_function_display_slot_inputs')) {
    function smarty_template_function_display_slot_inputs($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['display_slot_inputs']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
        <div class="clear" id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
			<?php $_smarty_tpl->tpl_vars['suffix'] = new Smarty_variable('', null, 0);?>
			<?php if ($_smarty_tpl->tpl_vars['day']->value!=null) {?>
				<?php $_smarty_tpl->tpl_vars['suffix'] = new Smarty_variable("_".((string)$_smarty_tpl->tpl_vars['day']->value), null, 0);?>
			<?php }?>
            <div style="float:left;">
                <h5><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReservableTimeSlots'),$_smarty_tpl);?>
</h5>
                <textarea class="reservableEdit"
                          id="reservableEdit<?php echo $_smarty_tpl->tpl_vars['suffix']->value;?>
" name="<?php echo FormKeys::SLOTS_RESERVABLE;?>
<?php echo $_smarty_tpl->tpl_vars['suffix']->value;?>
"></textarea>
            </div>
            <div style="float:right;">
                <h5><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'BlockedTimeSlots'),$_smarty_tpl);?>
</h5>
                <textarea class="blockedEdit" id="blockedEdit<?php echo $_smarty_tpl->tpl_vars['suffix']->value;?>
" name="<?php echo FormKeys::SLOTS_BLOCKED;?>
<?php echo $_smarty_tpl->tpl_vars['suffix']->value;?>
"></textarea>
            </div>
        </div>
	<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>

        <div class="clear" id="dailySlots">
            <div class="clear" id="tabs">
                <ul>
                    <li><a href="#tabs-0"><?php echo $_smarty_tpl->tpl_vars['DayNames']->value[0];?>
</a></li>
                    <li><a href="#tabs-1"><?php echo $_smarty_tpl->tpl_vars['DayNames']->value[1];?>
</a></li>
                    <li><a href="#tabs-2"><?php echo $_smarty_tpl->tpl_vars['DayNames']->value[2];?>
</a></li>
                    <li><a href="#tabs-3"><?php echo $_smarty_tpl->tpl_vars['DayNames']->value[3];?>
</a></li>
                    <li><a href="#tabs-4"><?php echo $_smarty_tpl->tpl_vars['DayNames']->value[4];?>
</a></li>
                    <li><a href="#tabs-5"><?php echo $_smarty_tpl->tpl_vars['DayNames']->value[5];?>
</a></li>
                    <li><a href="#tabs-6"><?php echo $_smarty_tpl->tpl_vars['DayNames']->value[6];?>
</a></li>
                </ul>
                <div id="tabs-0">
				<?php smarty_template_function_display_slot_inputs($_smarty_tpl,array('day'=>'0'));?>

                </div>
                <div id="tabs-1">
				<?php smarty_template_function_display_slot_inputs($_smarty_tpl,array('day'=>'1'));?>

                </div>
                <div id="tabs-2">
				<?php smarty_template_function_display_slot_inputs($_smarty_tpl,array('day'=>'2'));?>

                </div>
                <div id="tabs-3">
				<?php smarty_template_function_display_slot_inputs($_smarty_tpl,array('day'=>'3'));?>

                </div>
                <div id="tabs-4">
				<?php smarty_template_function_display_slot_inputs($_smarty_tpl,array('day'=>'4'));?>

                </div>
                <div id="tabs-5">
				<?php smarty_template_function_display_slot_inputs($_smarty_tpl,array('day'=>'5'));?>

                </div>
                <div id="tabs-6">
				<?php smarty_template_function_display_slot_inputs($_smarty_tpl,array('day'=>'6'));?>

                </div>
            </div>
        </div>

	<?php smarty_template_function_display_slot_inputs($_smarty_tpl,array('id'=>"staticSlots",'day'=>null));?>


        <div style="clear:both;height:0;">&nbsp</div>
        <div style="margin-top:5px;">
            <h5>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Timezone'),$_smarty_tpl);?>

                <select <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'TIMEZONE'),$_smarty_tpl);?>
 id="layoutTimezone" class="input">
				<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['TimezoneValues']->value,'output'=>$_smarty_tpl->tpl_vars['TimezoneOutput']->value),$_smarty_tpl);?>

                </select>
            </h5>
        </div>
        <div style="margin-top:2px;">
            <h5>
			<?php $_smarty_tpl->_capture_stack[0][] = array("layoutConfig", "layoutConfig", null); ob_start(); ?>
                <input type='text' value='30' id='quickLayoutConfig' size=5' />
			<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
			<?php $_smarty_tpl->_capture_stack[0][] = array("layoutStart", "layoutStart", null); ob_start(); ?>
                <input type='text' value='08:00' id='quickLayoutStart' size='10'/>
			<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
			<?php $_smarty_tpl->_capture_stack[0][] = array("layoutEnd", "layoutEnd", null); ob_start(); ?>
                <input type='text' value='18:00' id='quickLayoutEnd' size='10'/>
			<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'QuickSlotCreation','args'=>((string)$_smarty_tpl->tpl_vars['layoutConfig']->value).",".((string)$_smarty_tpl->tpl_vars['layoutStart']->value).",".((string)$_smarty_tpl->tpl_vars['layoutEnd']->value)),$_smarty_tpl);?>

                <a href="#" id="createQuickLayout"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Create'),$_smarty_tpl);?>
</a>
            </h5>
        </div>
        <div style="margin-top: 5px; padding-top:5px; border-top: solid 1px #f0f0f0;">
            <div>
                <button type="button"
                        class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
                <button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
            </div>
            <div>
                <p><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Format'),$_smarty_tpl);?>
: <span
                        style="font-family:courier new;">HH:MM - HH:MM <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'OptionalLabel'),$_smarty_tpl);?>
</span></p>

                <p><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'LayoutInstructions'),$_smarty_tpl);?>
</p>
            </div>
        </div>
    </form>
</div>


<div id="groupAdminDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'WhoCanManageThisSchedule'),$_smarty_tpl);?>
">
    <form method="post" id="groupAdminForm">
        <select id="adminGroupId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_ADMIN_GROUP_ID'),$_smarty_tpl);?>
 class="textbox">
            <option value="">-- <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
 --</option>
		<?php  $_smarty_tpl->tpl_vars['adminGroup'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['adminGroup']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AdminGroups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['adminGroup']->key => $_smarty_tpl->tpl_vars['adminGroup']->value) {
$_smarty_tpl->tpl_vars['adminGroup']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['adminGroup']->value->Id;?>
"><?php echo $_smarty_tpl->tpl_vars['adminGroup']->value->Name;?>
</option>
		<?php } ?>
        </select>
        <br/><br/>
        <button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
        <button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
    </form>
</div>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"admin-ajax-indicator.gif",'class'=>"indicator",'style'=>"display:none;"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/schedule.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>


<script type="text/javascript">

    $(document).ready(function ()
    {

        var opts = {
            submitUrl:'<?php echo $_SERVER['SCRIPT_NAME'];?>
',
            saveRedirect:'<?php echo $_SERVER['SCRIPT_NAME'];?>
',
            renameAction:'<?php echo ManageSchedules::ActionRename;?>
',
            changeSettingsAction:'<?php echo ManageSchedules::ActionChangeSettings;?>
',
            changeLayoutAction:'<?php echo ManageSchedules::ActionChangeLayout;?>
',
            addAction:'<?php echo ManageSchedules::ActionAdd;?>
',
            makeDefaultAction:'<?php echo ManageSchedules::ActionMakeDefault;?>
',
            deleteAction:'<?php echo ManageSchedules::ActionDelete;?>
',
            adminAction:'<?php echo ManageSchedules::ChangeAdminGroup;?>
',
            enableSubscriptionAction:'<?php echo ManageSchedules::ActionEnableSubscription;?>
',
            disableSubscriptionAction:'<?php echo ManageSchedules::ActionDisableSubscription;?>
'
        };

        var scheduleManagement = new ScheduleManagement(opts);
        scheduleManagement.init();
    });

</script>

<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
