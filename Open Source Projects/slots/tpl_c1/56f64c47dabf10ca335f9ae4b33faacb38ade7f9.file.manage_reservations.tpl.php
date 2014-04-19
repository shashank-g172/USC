<?php /* Smarty version Smarty-3.1.16, created on 2014-04-18 07:47:20
         compiled from "C:\wamp\www\slots\tpl\Admin\Reservations\manage_reservations.tpl" */ ?>
<?php /*%%SmartyHeaderCode:245535350d8887c2d08-40983110%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56f64c47dabf10ca335f9ae4b33faacb38ade7f9' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\Admin\\Reservations\\manage_reservations.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '245535350d8887c2d08-40983110',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'StartDate' => 0,
    'EndDate' => 0,
    'UserNameFilter' => 0,
    'UserIdFilter' => 0,
    'Schedules' => 0,
    'ScheduleId' => 0,
    'Resources' => 0,
    'ResourceId' => 0,
    'ReservationStatusId' => 0,
    'ReferenceNumber' => 0,
    'CsvExportUrl' => 0,
    'AttributeList' => 0,
    'label' => 0,
    'reservations' => 0,
    'reservation' => 0,
    'rowCss' => 0,
    'CanUpdateResourceStatus' => 0,
    'StatusReasons' => 0,
    'Timezone' => 0,
    'attribute' => 0,
    'PageInfo' => 0,
    'Path' => 0,
    'reason' => 0,
    'ResourceStatusFilterId' => 0,
    'ResourceStatusReasonFilterId' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5350d889b8dcf7_90566970',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5350d889b8dcf7_90566970')) {function content_5350d889b8dcf7_90566970($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:\\wamp\\www\\slots\\lib\\Common/../../lib/external/Smarty/plugins\\function.cycle.php';
?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'scripts/css/colorbox.css,css/admin.css,css/jquery.qtip.min.css'), 0);?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ManageReservations'),$_smarty_tpl);?>
</h1>

<fieldset>
	<legend style="font-weight:bold;font-size:12pt;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Filter'),$_smarty_tpl);?>
</legend>
	<table id="filterTable">
		<tr>
			<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Between'),$_smarty_tpl);?>
</td>
			<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'User'),$_smarty_tpl);?>
</td>
			<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Schedule'),$_smarty_tpl);?>
</td>
			<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Resource'),$_smarty_tpl);?>
</td>
			<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Status'),$_smarty_tpl);?>
</td>
			<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReferenceNumber'),$_smarty_tpl);?>
</td>
			<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceStatus'),$_smarty_tpl);?>
</td>
			<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Reason'),$_smarty_tpl);?>
</td>
		</tr>
		<tr>
			<td>
				<input id="startDate" type="text" class="textbox" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['StartDate']->value),$_smarty_tpl);?>
" size="10"/>
				<input id="formattedStartDate" type="hidden" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['StartDate']->value,'key'=>'system'),$_smarty_tpl);?>
"/>
				-
				<input id="endDate" type="text" class="textbox" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['EndDate']->value),$_smarty_tpl);?>
" size="10"/>
				<input id="formattedEndDate" type="hidden" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['EndDate']->value,'key'=>'system'),$_smarty_tpl);?>
"/>
			</td>
			<td>
				<input id="userFilter" type="text" class="textbox" value="<?php echo $_smarty_tpl->tpl_vars['UserNameFilter']->value;?>
" size="30" />
				<input id="userId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['UserIdFilter']->value;?>
" />
			</td>
			<td>
				<select id="scheduleId" class="textbox">
					<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllSchedules'),$_smarty_tpl);?>
</option>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['object_html_options'][0][0]->ObjectHtmlOptions(array('options'=>$_smarty_tpl->tpl_vars['Schedules']->value,'key'=>'GetId','label'=>"GetName",'selected'=>$_smarty_tpl->tpl_vars['ScheduleId']->value),$_smarty_tpl);?>

				</select>
			</td>
			<td>
				<select id="resourceId" class="textbox">
					<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllResources'),$_smarty_tpl);?>
</option>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['object_html_options'][0][0]->ObjectHtmlOptions(array('options'=>$_smarty_tpl->tpl_vars['Resources']->value,'key'=>'GetId','label'=>"GetName",'selected'=>$_smarty_tpl->tpl_vars['ResourceId']->value),$_smarty_tpl);?>

				</select>
			</td>
			<td>
				<select id="statusId" class="textbox">
					<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllReservations'),$_smarty_tpl);?>
</option>
					<option value="<?php echo ReservationStatus::Pending;?>
" <?php if ($_smarty_tpl->tpl_vars['ReservationStatusId']->value==ReservationStatus::Pending) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'PendingReservations'),$_smarty_tpl);?>
</option>
				</select>
			</td>
			<td>
				<input id="referenceNumber" type="text" class="textbox" value="<?php echo $_smarty_tpl->tpl_vars['ReferenceNumber']->value;?>
" />
			</td>
			<td>
				<select id="resourceStatusIdFilter" class="textbox">
					<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'All'),$_smarty_tpl);?>
</option>
					<option value="<?php echo ResourceStatus::AVAILABLE;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Available'),$_smarty_tpl);?>
</option>
					<option value="<?php echo ResourceStatus::UNAVAILABLE;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Unavailable'),$_smarty_tpl);?>
</option>
					<option value="<?php echo ResourceStatus::HIDDEN;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Hidden'),$_smarty_tpl);?>
</option>
				</select>
			</td>
			<td>
				<select id="resourceReasonIdFilter" class="textbox">
				</select>
			</td>
		</tr>
	</table>
	<div id="reservationFilterButtons">
		<button id="filter" class="button"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"search.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Filter'),$_smarty_tpl);?>
</button>
		<a href="#" id="clearFilter"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Reset'),$_smarty_tpl);?>
</a>
	</div>
</fieldset>

<div>&nbsp;</div>

<p>
	<a href="<?php echo $_smarty_tpl->tpl_vars['CsvExportUrl']->value;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ExportToCSV'),$_smarty_tpl);?>
</a>
</p>
<table class="list" id="reservationTable">
	<tr>
		<th class="id">&nbsp;</th>
		<th style="max-width: 120px;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'User'),$_smarty_tpl);?>
</th>
		<th style="max-width: 120px;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Resource'),$_smarty_tpl);?>
</th>
		<th style="max-width: 120px;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Title'),$_smarty_tpl);?>
</th>
		<th style="max-width: 120px;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Description'),$_smarty_tpl);?>
</th>
		<th class="date"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'BeginDate'),$_smarty_tpl);?>
</th>
		<th class="date"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'EndDate'),$_smarty_tpl);?>
</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Duration'),$_smarty_tpl);?>
</th>
		<th class="date"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Created'),$_smarty_tpl);?>
</th>
		<th class="date"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'LastModified'),$_smarty_tpl);?>
</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReferenceNumber'),$_smarty_tpl);?>
</th>
		<?php  $_smarty_tpl->tpl_vars['label'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['label']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AttributeList']->value->GetLabels(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['label']->key => $_smarty_tpl->tpl_vars['label']->value) {
$_smarty_tpl->tpl_vars['label']->_loop = true;
?>
		<th><?php echo $_smarty_tpl->tpl_vars['label']->value;?>
</th>
		<?php } ?>
		<th class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</th>
		<th class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Approve'),$_smarty_tpl);?>
</th>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['reservation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reservation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['reservations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reservation']->key => $_smarty_tpl->tpl_vars['reservation']->value) {
$_smarty_tpl->tpl_vars['reservation']->_loop = true;
?>
	<?php echo smarty_function_cycle(array('values'=>'row0,row1','assign'=>'rowCss'),$_smarty_tpl);?>

	<?php if ($_smarty_tpl->tpl_vars['reservation']->value->RequiresApproval) {?>
		<?php $_smarty_tpl->tpl_vars['rowCss'] = new Smarty_variable('pending', null, 0);?>
	<?php }?>
	<tr class="<?php echo $_smarty_tpl->tpl_vars['rowCss']->value;?>
 editable">
		<td class="id"><?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReservationId;?>
</td>
		<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fullname'][0][0]->DisplayFullName(array('first'=>$_smarty_tpl->tpl_vars['reservation']->value->FirstName,'last'=>$_smarty_tpl->tpl_vars['reservation']->value->LastName,'ignorePrivacy'=>true),$_smarty_tpl);?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceName;?>

			<div><?php if ($_smarty_tpl->tpl_vars['reservation']->value->ResourceStatusId==ResourceStatus::AVAILABLE) {?>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"status.png"),$_smarty_tpl);?>

				<?php if ($_smarty_tpl->tpl_vars['CanUpdateResourceStatus']->value) {?>
					<a class="update changeStatus" href="#" resourceId="<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceId;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Available'),$_smarty_tpl);?>
</a>
				<?php } else { ?>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Available'),$_smarty_tpl);?>

				<?php }?>
			<?php } elseif ($_smarty_tpl->tpl_vars['reservation']->value->ResourceStatusId==ResourceStatus::UNAVAILABLE) {?>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"status-away.png"),$_smarty_tpl);?>

				<?php if ($_smarty_tpl->tpl_vars['CanUpdateResourceStatus']->value) {?>
					<a class="update changeStatus" href="#" resourceId="<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceId;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Unavailable'),$_smarty_tpl);?>
</a>
				<?php } else { ?>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Unavailable'),$_smarty_tpl);?>

				<?php }?>
			<?php } else { ?>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"status-busy.png"),$_smarty_tpl);?>

				<?php if ($_smarty_tpl->tpl_vars['CanUpdateResourceStatus']->value) {?>
					<a class="update changeStatus"  href="#" resourceId="<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceId;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Hidden'),$_smarty_tpl);?>
</a>
				<?php } else { ?>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Hidden'),$_smarty_tpl);?>

				<?php }?>
			<?php }?>
			<?php if (array_key_exists($_smarty_tpl->tpl_vars['reservation']->value->ResourceStatusReasonId,$_smarty_tpl->tpl_vars['StatusReasons']->value)) {?>
				<span class="reservationResourceStatusReason"><?php echo $_smarty_tpl->tpl_vars['StatusReasons']->value[$_smarty_tpl->tpl_vars['reservation']->value->ResourceStatusReasonId]->Description();?>
</span>
			<?php }?>
			</div>
		</td>
		<td><?php echo $_smarty_tpl->tpl_vars['reservation']->value->Title;?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['reservation']->value->Description;?>
</td>
		<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->StartDate,'timezone'=>$_smarty_tpl->tpl_vars['Timezone']->value,'key'=>'res_popup'),$_smarty_tpl);?>
</td>
		<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->EndDate,'timezone'=>$_smarty_tpl->tpl_vars['Timezone']->value,'key'=>'res_popup'),$_smarty_tpl);?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['reservation']->value->GetDuration()->__toString();?>
</td>
		<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->CreatedDate,'timezone'=>$_smarty_tpl->tpl_vars['Timezone']->value,'key'=>'general_datetime'),$_smarty_tpl);?>
</td>
		<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->ModifiedDate,'timezone'=>$_smarty_tpl->tpl_vars['Timezone']->value,'key'=>'general_datetime'),$_smarty_tpl);?>
</td>
		<td class="referenceNumber"><?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReferenceNumber;?>
</td>
		<?php  $_smarty_tpl->tpl_vars['attribute'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attribute']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AttributeList']->value->GetAttributes($_smarty_tpl->tpl_vars['reservation']->value->SeriesId); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->key => $_smarty_tpl->tpl_vars['attribute']->value) {
$_smarty_tpl->tpl_vars['attribute']->_loop = true;
?>
		<td><?php echo $_smarty_tpl->tpl_vars['attribute']->value->Value();?>
</td>
		<?php } ?>
		<td align="center"><a href="#" class="update delete"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'cross-button.png'),$_smarty_tpl);?>
</a></td>
		<td align="center">
			<?php if ($_smarty_tpl->tpl_vars['reservation']->value->RequiresApproval) {?>
				<a href="#" class="update approve"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'tick-button.png'),$_smarty_tpl);?>
</a>
			<?php } else { ?>
				-
			<?php }?>
		</td>
	</tr>
	<?php } ?>
</table>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['pagination'][0][0]->CreatePagination(array('pageInfo'=>$_smarty_tpl->tpl_vars['PageInfo']->value),$_smarty_tpl);?>


<div id="deleteInstanceDialog" class="dialog" style="display:none;" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
">
	<form id="deleteInstanceForm" method="post">
		<div class="delResResponse"></div>
		<div class="error" style="margin-bottom: 25px;">
			<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</h3>
		</div>
		<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cross-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</button>
		<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SERIES_UPDATE_SCOPE'),$_smarty_tpl);?>
 value="<?php echo SeriesUpdateScope::ThisInstance;?>
" />
		<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REFERENCE_NUMBER'),$_smarty_tpl);?>
 value="" class="referenceNumber" />
	</form>
</div>

<div id="deleteSeriesDialog" class="dialog" style="display:none;" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
">
	<form id="deleteSeriesForm" method="post">
		<div class="error" style="margin-bottom: 25px;">
			<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</h3>
		</div>
		<button type="button" class="button saveSeries btnUpdateThisInstance">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>

			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ThisInstance'),$_smarty_tpl);?>

		</button>
		<button type="button" class="button saveSeries btnUpdateAllInstances">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disks-black.png"),$_smarty_tpl);?>

			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllInstances'),$_smarty_tpl);?>

		</button>
		<button type="button" class="button saveSeries btnUpdateFutureInstances">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-arrow.png"),$_smarty_tpl);?>

			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'FutureInstances'),$_smarty_tpl);?>

		</button>
		<button type="button" class="button cancel">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>

			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>

		</button>
		<input type="hidden" id="hdnSeriesUpdateScope" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SERIES_UPDATE_SCOPE'),$_smarty_tpl);?>
 />
		<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REFERENCE_NUMBER'),$_smarty_tpl);?>
 value="" class="referenceNumber" />
	</form>
</div>

<div id="statusDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CurrentStatus'),$_smarty_tpl);?>
">
	<form id="statusForm" method="post">
		<div>
			<select id="resourceStatusId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_STATUS_ID'),$_smarty_tpl);?>
 class="textbox">
				<option value="<?php echo ResourceStatus::AVAILABLE;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Available'),$_smarty_tpl);?>
</option>
				<option value="<?php echo ResourceStatus::UNAVAILABLE;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Unavailable'),$_smarty_tpl);?>
</option>
				<option value="<?php echo ResourceStatus::HIDDEN;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Hidden'),$_smarty_tpl);?>
</option>
			</select>
		</div>
		<div>
			<label for="resourceReasonId"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Reason'),$_smarty_tpl);?>
</label><br/>
			<select id="resourceReasonId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_STATUS_REASON_ID'),$_smarty_tpl);?>
 class="textbox">
			</select>
		</div>
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			<button type="button" class="button saveAll"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disks-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllReservationResources'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
			<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_STATUS_UPDATE_SCOPE'),$_smarty_tpl);?>
 id="statusUpdateScope" value="" />
			<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REFERENCE_NUMBER'),$_smarty_tpl);?>
 id="statusUpdateReferenceNumber" value="" />
			<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_ID'),$_smarty_tpl);?>
 id="statusResourceId" value="" />
		</div>
	</form>
</div>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"admin-ajax-indicator.gif",'class'=>"indicator",'style'=>"display:none;"),$_smarty_tpl);?>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.qtip.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.colorbox-min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/reservations.js"),$_smarty_tpl);?>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"autocomplete.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"reservationPopup.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"approval.js"),$_smarty_tpl);?>


<script type="text/javascript">

$(document).ready(function() {

	var updateScope = {};
	updateScope['btnUpdateThisInstance'] = '<?php echo SeriesUpdateScope::ThisInstance;?>
';
	updateScope['btnUpdateAllInstances'] = '<?php echo SeriesUpdateScope::FullSeries;?>
';
	updateScope['btnUpdateFutureInstances'] = '<?php echo SeriesUpdateScope::FutureInstances;?>
';

	var actions = {};

	var resOpts = {
		autocompleteUrl: "<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
ajax/autocomplete.php?type=<?php echo AutoCompleteType::User;?>
",
		reservationUrlTemplate: "<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
reservation.php?<?php echo QueryStringKeys::REFERENCE_NUMBER;?>
=[refnum]",
		popupUrl: "<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
ajax/respopup.php",
		updateScope: updateScope,
		actions: actions,
		deleteUrl: '<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
ajax/reservation_delete.php?<?php echo QueryStringKeys::RESPONSE_TYPE;?>
=json',
		resourceStatusUrl: '<?php echo $_SERVER['SCRIPT_NAME'];?>
?<?php echo QueryStringKeys::ACTION;?>
=changeStatus'
	};

	var approvalOpts = {
		url: '<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
ajax/reservation_approve.php'
	};

	var approval = new Approval(approvalOpts);

	var reservationManagement = new ReservationManagement(resOpts, approval);
	reservationManagement.init();

	<?php  $_smarty_tpl->tpl_vars['reservation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reservation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['reservations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reservation']->key => $_smarty_tpl->tpl_vars['reservation']->value) {
$_smarty_tpl->tpl_vars['reservation']->_loop = true;
?>

		reservationManagement.addReservation(
			{
				id: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReservationId;?>
',
				referenceNumber: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReferenceNumber;?>
',
				isRecurring: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->IsRecurring;?>
',
				resourceStatusId: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceStatusId;?>
',
				resourceStatusReasonId: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceStatusReasonId;?>
',
				resourceId: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceId;?>
'
			}
		);
	<?php } ?>

	<?php  $_smarty_tpl->tpl_vars['reason'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reason']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['StatusReasons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reason']->key => $_smarty_tpl->tpl_vars['reason']->value) {
$_smarty_tpl->tpl_vars['reason']->_loop = true;
?>
		reservationManagement.addStatusReason('<?php echo $_smarty_tpl->tpl_vars['reason']->value->Id();?>
', '<?php echo $_smarty_tpl->tpl_vars['reason']->value->StatusId();?>
', '<?php echo strtr($_smarty_tpl->tpl_vars['reason']->value->Description(), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
');
	<?php } ?>

	reservationManagement.initializeStatusFilter('<?php echo $_smarty_tpl->tpl_vars['ResourceStatusFilterId']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['ResourceStatusReasonFilterId']->value;?>
');
});
</script>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"startDate",'AltId'=>"formattedStartDate"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"endDate",'AltId'=>"formattedEndDate"),$_smarty_tpl);?>


<div id="approveDiv" style="display:none;text-align:center; top:15%;position:relative;">
<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Approving'),$_smarty_tpl);?>
...</h3>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"reservation_submitting.gif"),$_smarty_tpl);?>

</div>
<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
