<?php /* Smarty version Smarty-3.1.16, created on 2014-04-18 07:57:00
         compiled from "C:\wamp\www\slots\tpl\Reports\generate-report.tpl" */ ?>
<?php /*%%SmartyHeaderCode:300145350dacc1476d9-75257574%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '234114ebb4cdab88e027a2b1a8acb1442f4dde36' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\Reports\\generate-report.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '300145350dacc1476d9-75257574',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Resources' => 0,
    'resource' => 0,
    'Accessories' => 0,
    'accessory' => 0,
    'Schedules' => 0,
    'schedule' => 0,
    'Groups' => 0,
    'group' => 0,
    'Path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5350daccd36756_21354229',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5350daccd36756_21354229')) {function content_5350daccd36756_21354229($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>"css/reports.css,scripts/js/jqplot/jquery.jqplot.min.css"), 0);?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GenerateReport'),$_smarty_tpl);?>
</h1>
<a href="#" id="showHideCustom"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ShowHide'),$_smarty_tpl);?>
</a>
<fieldset id="customReportInput-container">
	<form id="customReportInput">
		<div id="custom-report-input">
			<div class="input-set" id="selectDiv">
				<span class="label"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Select'),$_smarty_tpl);?>
</span>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_RESULTS'),$_smarty_tpl);?>
 value="<?php echo Report_ResultSelection::FULL_LIST;?>
"
					   id="results_list" checked="checked"/>
				<label for="results_list"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'List'),$_smarty_tpl);?>
</label>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_RESULTS'),$_smarty_tpl);?>
 value="<?php echo Report_ResultSelection::TIME;?>
"
					   id="results_time"/>
				<label for="results_time"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'TotalTime'),$_smarty_tpl);?>
</label>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_RESULTS'),$_smarty_tpl);?>
 value="<?php echo Report_ResultSelection::COUNT;?>
"
					   id="results_count"/>
				<label for="results_count"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Count'),$_smarty_tpl);?>
</label>
			</div>

			<div class="input-set select-toggle" id="listOfDiv">
				<span class="label"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Usage'),$_smarty_tpl);?>
</span>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_USAGE'),$_smarty_tpl);?>
 value="<?php echo Report_Usage::RESOURCES;?>
" id="usage_resources"
					   checked="checked">
				<label for="usage_resources"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Resources'),$_smarty_tpl);?>
</label>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_USAGE'),$_smarty_tpl);?>
 value="<?php echo Report_Usage::ACCESSORIES;?>
"
					   id="usage_accessories">
				<label for="usage_accessories"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Accessories'),$_smarty_tpl);?>
</label>
			</div>

			<div class="input-set select-toggle" id="aggregateDiv" style="display:none;">
				<span class="label"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AggregateBy'),$_smarty_tpl);?>
</span>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_GROUPBY'),$_smarty_tpl);?>
 value="<?php echo Report_GroupBy::NONE;?>
"
					   id="groupby_none" checked="checked"/>
				<label for="groupby_none"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
</label>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_GROUPBY'),$_smarty_tpl);?>
 value="<?php echo Report_GroupBy::RESOURCE;?>
"
					   id="groupby_resource"/>
				<label for="groupby_resource"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Resource'),$_smarty_tpl);?>
</label>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_GROUPBY'),$_smarty_tpl);?>
 value="<?php echo Report_GroupBy::SCHEDULE;?>
"
					   id="groupby_schedule"/>
				<label for="groupby_schedule"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Schedule'),$_smarty_tpl);?>
</label>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_GROUPBY'),$_smarty_tpl);?>
 value="<?php echo Report_GroupBy::USER;?>
"
					   id="groupby_user"/>
				<label for="groupby_user"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'User'),$_smarty_tpl);?>
</label>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_GROUPBY'),$_smarty_tpl);?>
 value="<?php echo Report_GroupBy::GROUP;?>
"
					   id="groupby_group"/>
				<label for="groupby_group"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Group'),$_smarty_tpl);?>
</label>
			</div>
			<div class="input-set">
				<span class="label"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Range'),$_smarty_tpl);?>
</span>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_RANGE'),$_smarty_tpl);?>
 value="<?php echo Report_Range::ALL_TIME;?>
" id="range_all"
					   checked="checked"/>
				<label for="range_all"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllTime'),$_smarty_tpl);?>
</label>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_RANGE'),$_smarty_tpl);?>
 value="<?php echo Report_Range::CURRENT_MONTH;?>
" id="current_month"/>
				<label for="current_month"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CurrentMonth'),$_smarty_tpl);?>
</label>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_RANGE'),$_smarty_tpl);?>
 value="<?php echo Report_Range::CURRENT_WEEK;?>
" id="current_week"/>
				<label for="current_week"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CurrentWeek'),$_smarty_tpl);?>
</label>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_RANGE'),$_smarty_tpl);?>
 value="<?php echo Report_Range::TODAY;?>
" id="today"/>
				<label for="today" style="width:auto;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Today'),$_smarty_tpl);?>
</label>
				<input type="radio" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_RANGE'),$_smarty_tpl);?>
 value="<?php echo Report_Range::DATE_RANGE;?>
" id="range_within"/>
				<label for="range_within" style="width:auto;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Between'),$_smarty_tpl);?>
</label>
				<input type="input" class="textbox dateinput" id="startDate"/> -
				<input type="hidden" id="formattedBeginDate" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_START'),$_smarty_tpl);?>
/>
				<input type="input" class="textbox dateinput" id="endDate"/>
				<input type="hidden" id="formattedEndDate" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_END'),$_smarty_tpl);?>
 />
			</div>
			<div class="input-set">
				<span class="label"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'FilterBy'),$_smarty_tpl);?>
</span>
				<select class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_ID'),$_smarty_tpl);?>
>
					<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllResources'),$_smarty_tpl);?>
</option>
				<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Resources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetId();?>
"><?php echo $_smarty_tpl->tpl_vars['resource']->value->GetName();?>
</option>
				<?php } ?>
				</select>
				<select class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ACCESSORY_ID'),$_smarty_tpl);?>
 id="accessoryId">
					<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllAccessories'),$_smarty_tpl);?>
</option>
				<?php  $_smarty_tpl->tpl_vars['accessory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['accessory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Accessories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['accessory']->key => $_smarty_tpl->tpl_vars['accessory']->value) {
$_smarty_tpl->tpl_vars['accessory']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['accessory']->value->Id;?>
"><?php echo $_smarty_tpl->tpl_vars['accessory']->value->Name;?>
</option>
				<?php } ?>
				</select>
				<select class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_ID'),$_smarty_tpl);?>
>
					<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllSchedules'),$_smarty_tpl);?>
</option>
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

				<select class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'GROUP_ID'),$_smarty_tpl);?>
>
					<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllGroups'),$_smarty_tpl);?>
</option>
				<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['group']->value->Id;?>
"><?php echo $_smarty_tpl->tpl_vars['group']->value->Name;?>
</option>
				<?php } ?>
				</select>

				<div id="user-filter-div" class="link-filter">
					<a href="#" class="all"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllUsers'),$_smarty_tpl);?>
</a>
					<a href="#" class="selected filter-off"></a>
					<input id="user-filter" type="text" class="textbox filter-input filter-off"/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"minus-gray.png",'class'=>"clear filter-off"),$_smarty_tpl);?>

					<input id="user_id" class="filter-id" type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'USER_ID'),$_smarty_tpl);?>
/>
				</div>
			</div>
		</div>
		<input type="submit" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GetReport'),$_smarty_tpl);?>
" class="button" id="btnCustomReport" asyncAction=""/>
	</form>
</fieldset>

<div id="saveMessage" class="success" style="display:none">
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReportSaved'),$_smarty_tpl);?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
reports/<?php echo Pages::REPORTS_SAVED;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'MySavedReports'),$_smarty_tpl);?>
</a>
</div>

<div id="resultsDiv">
</div>

<div id="indicator" style="display:none; text-align: center;"><h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Working'),$_smarty_tpl);?>

	...</h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"admin-ajax-indicator.gif"),$_smarty_tpl);?>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("Reports/chart.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="dialog" id="userPopup">
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'User'),$_smarty_tpl);?>
<a href="#" id="browseUser">Browse</a>
</div>

<div class="dialog" id="groupPopup">
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Group'),$_smarty_tpl);?>
<input id="group_filter" type="text" class="textbox"/>
</div>


<div class="dialog" id="saveDialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SaveThisReport'),$_smarty_tpl);?>
">
	<label for="saveReportName"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Name'),$_smarty_tpl);?>
:</label>

	<form id="saveReportForm" action="" method="post">
		<input type="text" id="saveReportName" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REPORT_NAME'),$_smarty_tpl);?>
 class="textbox">
		<br/><br/>
		<button type="button"
				class="button save"
				id="btnSaveReport"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SaveThisReport'),$_smarty_tpl);?>
</button>
		<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
	</form>
</div>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"autocomplete.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"ajax-helpers.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"reports/generate-reports.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"reports/chart.js"),$_smarty_tpl);?>


<script type="text/javascript">
	$(document).ready(function () {
		var reportOptions = {
			userAutocompleteUrl:"<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
ajax/autocomplete.php?type=<?php echo AutoCompleteType::User;?>
",
			groupAutocompleteUrl:"<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
ajax/autocomplete.php?type=<?php echo AutoCompleteType::Group;?>
",
			customReportUrl:"<?php echo $_SERVER['SCRIPT_NAME'];?>
?<?php echo QueryStringKeys::ACTION;?>
=<?php echo ReportActions::Generate;?>
",
			printUrl:"<?php echo $_SERVER['SCRIPT_NAME'];?>
?<?php echo QueryStringKeys::ACTION;?>
=<?php echo ReportActions::PrintReport;?>
&",
			csvUrl:"<?php echo $_SERVER['SCRIPT_NAME'];?>
?<?php echo QueryStringKeys::ACTION;?>
=<?php echo ReportActions::Csv;?>
&",
			saveUrl:"<?php echo $_SERVER['SCRIPT_NAME'];?>
?<?php echo QueryStringKeys::ACTION;?>
=<?php echo ReportActions::Save;?>
"
		};

		var reports = new GenerateReports(reportOptions);
		reports.init();
	});
</script>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"startDate",'AltId'=>"formattedBeginDate"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"endDate",'AltId'=>"formattedEndDate"),$_smarty_tpl);?>


<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
