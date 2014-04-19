<?php /* Smarty version Smarty-3.1.16, created on 2014-04-18 07:46:02
         compiled from "C:\wamp\www\slots\tpl\Admin\Resources\manage_resources.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8195350d83a3b2114-24530338%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15676e84a5893991979dacb9435175a5f4278086' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\Admin\\Resources\\manage_resources.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8195350d83a3b2114-24530338',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Resources' => 0,
    'resource' => 0,
    'id' => 0,
    'StatusReasons' => 0,
    'Schedules' => 0,
    'ResourceTypes' => 0,
    'GroupLookup' => 0,
    'AdminGroups' => 0,
    'AttributeList' => 0,
    'attributes' => 0,
    'attribute' => 0,
    'scheduleId' => 0,
    'scheduleName' => 0,
    'adminGroup' => 0,
    'resourceType' => 0,
    'txtMinDuration' => 0,
    'txtMaxDuration' => 0,
    'txtBufferTime' => 0,
    'txtStartNotice' => 0,
    'txtEndNotice' => 0,
    'txtMaxCapacity' => 0,
    'reason' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5350d83ccc7270_57338110',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5350d83ccc7270_57338110')) {function content_5350d83ccc7270_57338110($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'C:\\wamp\\www\\slots\\lib\\Common/../../lib/external/Smarty/plugins\\modifier.truncate.php';
?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/admin.css'), 0);?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ManageResources'),$_smarty_tpl);?>
</h1>

<div id="globalError" class="error" style="display:none"></div>
<div class="admin">
<div class="title">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllResources'),$_smarty_tpl);?>

</div>
<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Resources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
?>
	<?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable($_smarty_tpl->tpl_vars['resource']->value->GetResourceId(), null, 0);?>
	<div class="resourceDetails" resourceId="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
	<div style="float:left;max-width:50%;">
		<input type="hidden" class="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"/>

		<div style="float:left; text-align:center; width:110px;">
			<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasImage()) {?>
				<img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['resource_image'][0][0]->GetResourceImage(array('image'=>$_smarty_tpl->tpl_vars['resource']->value->GetImage()),$_smarty_tpl);?>
" alt="Resource Image" class="image"/>
				<br/>
				<a class="update imageButton" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Change'),$_smarty_tpl);?>
</a>
				|
				<a class="update removeImageButton" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Remove'),$_smarty_tpl);?>
</a>
			<?php } else { ?>
				<div class="noImage"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoImage'),$_smarty_tpl);?>
</div>
				<a class="update imageButton" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddImage'),$_smarty_tpl);?>
</a>
			<?php }?>
		</div>
		<div style="float:right;">
			<ul>
				<li>
					<h4><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['resource']->value->GetName(), ENT_QUOTES, 'UTF-8', true);?>
</h4>
					<a class="update renameButton" href="javascript:void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Rename'),$_smarty_tpl);?>
</a> |
					<a class="update deleteButton" href="javascript:void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</a>
				</li>
				<li>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Status'),$_smarty_tpl);?>

					<?php if ($_smarty_tpl->tpl_vars['resource']->value->IsAvailable()) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"status.png"),$_smarty_tpl);?>

						<a class="update changeStatus"
						   href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Available'),$_smarty_tpl);?>
</a>
					<?php } elseif ($_smarty_tpl->tpl_vars['resource']->value->IsUnavailable()) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"status-away.png"),$_smarty_tpl);?>

						<a class="update changeStatus"
						   href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Unavailable'),$_smarty_tpl);?>
</a>
					<?php } else { ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"status-busy.png"),$_smarty_tpl);?>

						<a class="update changeStatus"
						   href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Hidden'),$_smarty_tpl);?>
</a>
					<?php }?>
					<?php if (array_key_exists($_smarty_tpl->tpl_vars['resource']->value->GetStatusReasonId(),$_smarty_tpl->tpl_vars['StatusReasons']->value)) {?>
						<span class="resourceValue"><?php echo $_smarty_tpl->tpl_vars['StatusReasons']->value[$_smarty_tpl->tpl_vars['resource']->value->GetStatusReasonId()]->Description();?>
</span>
					<?php }?>
				</li>

				<li>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Schedule'),$_smarty_tpl);?>
 <span
					} class="resourceValue"><?php echo $_smarty_tpl->tpl_vars['Schedules']->value[$_smarty_tpl->tpl_vars['resource']->value->GetScheduleId()];?>
</span>
					<a class="update changeScheduleButton" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Move'),$_smarty_tpl);?>
</a>
				</li>
				<li>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceType'),$_smarty_tpl);?>

					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasResourceType()) {?>
						<span class="resourceValue"><?php echo $_smarty_tpl->tpl_vars['ResourceTypes']->value[$_smarty_tpl->tpl_vars['resource']->value->GetResourceTypeId()]->Name();?>
</span>
					<?php } else { ?>
						<span class="note"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoResourceTypeLabel'),$_smarty_tpl);?>
</span>
					<?php }?>
					<a class="update changeResourceType" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Edit'),$_smarty_tpl);?>
</a>
				</li>
				<li>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SortOrder'),$_smarty_tpl);?>

					<span class="resourceValue"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['resource']->value->GetSortOrder())===null||$tmp==='' ? "-" : $tmp);?>
</span>
					<a class="update changeSortOrder" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Edit'),$_smarty_tpl);?>
</a>
				</li>
				<li>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Location'),$_smarty_tpl);?>

					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasLocation()) {?>
						<span class="resourceValue"><?php echo $_smarty_tpl->tpl_vars['resource']->value->GetLocation();?>
</span>
					<?php } else { ?>
						<span class="note"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoLocationLabel'),$_smarty_tpl);?>
</span>
					<?php }?>
					<a class="update changeLocationButton" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Edit'),$_smarty_tpl);?>
</a>
				</li>
				<li>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Contact'),$_smarty_tpl);?>

					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasContact()) {?>
						<span class="resourceValue"><?php echo $_smarty_tpl->tpl_vars['resource']->value->GetContact();?>
</span>
					<?php } else { ?>
						<span class="note"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoContactLabel'),$_smarty_tpl);?>
</span>
					<?php }?>
				</li>
				<li>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Description'),$_smarty_tpl);?>

					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasDescription()) {?>
						<span class="resourceValue"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['resource']->value->GetDescription(),500,"...");?>
</span>
					<?php } else { ?>
						<span class="note"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoDescriptionLabel'),$_smarty_tpl);?>
</span>
					<?php }?>
					<a class="update descriptionButton" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Edit'),$_smarty_tpl);?>
</a>
				</li>
				<li>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Notes'),$_smarty_tpl);?>

					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasNotes()) {?>
						<span class="resourceValue"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['resource']->value->GetNotes(),500,"...");?>
</span>
					<?php } else { ?>
						<span class="note"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoNotesLabel'),$_smarty_tpl);?>
</span>
					<?php }?>
					<a class="update notesButton" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Edit'),$_smarty_tpl);?>
</a>
				</li>
				<li>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceAdministrator'),$_smarty_tpl);?>

					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasAdminGroup()) {?>
						<span class="resourceValue"><?php echo $_smarty_tpl->tpl_vars['GroupLookup']->value[$_smarty_tpl->tpl_vars['resource']->value->GetAdminGroupId()]->Name;?>
</span>
					<?php } else { ?>
						<span class="note"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoResourceAdministratorLabel'),$_smarty_tpl);?>
</span>
					<?php }?>
					<?php if (count($_smarty_tpl->tpl_vars['AdminGroups']->value)>0) {?>
						<a class="update adminButton" href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Edit'),$_smarty_tpl);?>
</a>
					<?php }?>
				</li>
				<li>
					<?php if ($_smarty_tpl->tpl_vars['resource']->value->GetIsCalendarSubscriptionAllowed()) {?>
						<a class="update disableSubscription"
						   href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'TurnOffSubscription'),$_smarty_tpl);?>
</a>
					<?php } else { ?>
						<a class="update enableSubscription"
						   href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'TurnOnSubscription'),$_smarty_tpl);?>
</a>
					<?php }?>
				</li>
			</ul>
		</div>
	</div>
	<div style="float:right;">
		<div>
			<h5><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'UsageConfiguration'),$_smarty_tpl);?>
</h5> <a class="update changeConfigurationButton"
															 href="javascript: void(0);"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ChangeConfiguration'),$_smarty_tpl);?>
</a>
		</div>
		<div style="float:left;width:400px;">
			<ul>
				<li>
					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasMinLength()) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMinLength','args'=>$_smarty_tpl->tpl_vars['resource']->value->GetMinLength()),$_smarty_tpl);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMinLengthNone'),$_smarty_tpl);?>

					<?php }?>
				</li>
				<li>
					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasMaxLength()) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMaxLength','args'=>$_smarty_tpl->tpl_vars['resource']->value->GetMaxLength()),$_smarty_tpl);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMaxLengthNone'),$_smarty_tpl);?>

					<?php }?>
				</li>
				<li>
					<?php if ($_smarty_tpl->tpl_vars['resource']->value->GetRequiresApproval()) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceRequiresApproval'),$_smarty_tpl);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceRequiresApprovalNone'),$_smarty_tpl);?>

					<?php }?>
				</li>
				<li>
					<?php if ($_smarty_tpl->tpl_vars['resource']->value->GetAutoAssign()) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourcePermissionAutoGranted'),$_smarty_tpl);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourcePermissionNotAutoGranted'),$_smarty_tpl);?>

					<?php }?>
				</li>
			</ul>
		</div>

		<div style="float:right;width:400px;">
			<ul>
				<li>
					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasMinNotice()) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMinNotice','args'=>$_smarty_tpl->tpl_vars['resource']->value->GetMinNotice()),$_smarty_tpl);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMinNoticeNone'),$_smarty_tpl);?>

					<?php }?>
				</li>
				<li>
					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasMaxNotice()) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMaxNotice','args'=>$_smarty_tpl->tpl_vars['resource']->value->GetMaxNotice()),$_smarty_tpl);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMaxNoticeNone'),$_smarty_tpl);?>

					<?php }?>
				</li>
				<li>
					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasBufferTime()) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceBufferTime','args'=>$_smarty_tpl->tpl_vars['resource']->value->GetBufferTime()),$_smarty_tpl);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceBufferTimeNone'),$_smarty_tpl);?>

					<?php }?>
				</li>
				<li>
					<?php if ($_smarty_tpl->tpl_vars['resource']->value->GetAllowMultiday()) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceAllowMultiDay'),$_smarty_tpl);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceNotAllowMultiDay'),$_smarty_tpl);?>

					<?php }?>
				</li>
				<li>
					<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasMaxParticipants()) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceCapacity','args'=>$_smarty_tpl->tpl_vars['resource']->value->GetMaxParticipants()),$_smarty_tpl);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceCapacityNone'),$_smarty_tpl);?>

					<?php }?>
				</li>
			</ul>
		</div>
	</div>
	<?php $_smarty_tpl->tpl_vars['attributes'] = new Smarty_variable($_smarty_tpl->tpl_vars['AttributeList']->value->GetAttributes($_smarty_tpl->tpl_vars['id']->value), null, 0);?>
	<?php if (count($_smarty_tpl->tpl_vars['attributes']->value)>0) {?>
		<div class="customAttributes">
			<form method="post" class="attributesForm" ajaxAction="<?php echo ManageResourcesActions::ActionChangeAttributes;?>
">
				<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AdditionalAttributes'),$_smarty_tpl);?>
 <a href="#"
															class="update changeAttributes"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Edit'),$_smarty_tpl);?>
</a>
				</h3>

				<div class="validationSummary">
					<ul>
					</ul>
					<div class="clear">&nbsp;</div>
				</div>
				<ul>
					<?php  $_smarty_tpl->tpl_vars['attribute'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attribute']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['attributes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->key => $_smarty_tpl->tpl_vars['attribute']->value) {
$_smarty_tpl->tpl_vars['attribute']->_loop = true;
?>
						<li class="customAttribute" attributeId="<?php echo $_smarty_tpl->tpl_vars['attribute']->value->Id();?>
">
							<div class="attribute-readonly"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"AttributeControl",'attribute'=>$_smarty_tpl->tpl_vars['attribute']->value,'readonly'=>true),$_smarty_tpl);?>
</div>
							<div class="attribute-readwrite hidden"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"AttributeControl",'attribute'=>$_smarty_tpl->tpl_vars['attribute']->value),$_smarty_tpl);?>

						</li>
					<?php } ?>
				</ul>
				<div class="attribute-readwrite hidden clear">
					<button type="button"
							class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
					<button type="button"
							class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
				</div>
			</form>
		</div>
		<div class="clear">&nbsp;</div>
	<?php }?>
	<div class="actions">&nbsp;</div>
	</div>
<?php } ?>
</div>

<div class="admin" style="margin-top:30px">
	<div class="title">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddNewResource'),$_smarty_tpl);?>

	</div>
	<div>
		<div id="addResourceResults" class="error" style="display:none;"></div>
		<form id="addResourceForm" method="post" ajaxAction="<?php echo ManageResourcesActions::ActionAdd;?>
">
			<table>
				<tr>
					<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Name'),$_smarty_tpl);?>
</th>
					<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Schedule'),$_smarty_tpl);?>
</th>
					<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourcePermissions'),$_smarty_tpl);?>
</th>
					<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceAdministrator'),$_smarty_tpl);?>
</th>
					<th>&nbsp;</th>
				</tr>
				<tr>
					<td><input type="text" class="textbox required" maxlength="85"
							   style="width:250px" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_NAME'),$_smarty_tpl);?>
 />
					</td>
					<td>
						<select class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_ID'),$_smarty_tpl);?>
 style="width:100px">
							<?php  $_smarty_tpl->tpl_vars['scheduleName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['scheduleName']->_loop = false;
 $_smarty_tpl->tpl_vars['scheduleId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Schedules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['scheduleName']->key => $_smarty_tpl->tpl_vars['scheduleName']->value) {
$_smarty_tpl->tpl_vars['scheduleName']->_loop = true;
 $_smarty_tpl->tpl_vars['scheduleId']->value = $_smarty_tpl->tpl_vars['scheduleName']->key;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['scheduleId']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['scheduleName']->value;?>
</option>
							<?php } ?>
						</select>
					</td>
					<td>
						<select class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'AUTO_ASSIGN'),$_smarty_tpl);?>
 style="width:170px">
							<option value="0"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ResourcePermissionNotAutoGranted"),$_smarty_tpl);?>
</option>
							<option value="1"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ResourcePermissionAutoGranted"),$_smarty_tpl);?>
</option>
						</select>
					</td>
					<td>
						<select class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_ADMIN_GROUP_ID'),$_smarty_tpl);?>
 style="width:170px">
							<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
</option>
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
					</td>
					<td>
						<button type="button"
								class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"plus-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddResource'),$_smarty_tpl);?>
</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<input type="hidden" id="activeId" value=""/>

<div id="imageDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddImage'),$_smarty_tpl);?>
">
	<form id="imageForm" method="post" enctype="multipart/form-data" ajaxAction="<?php echo ManageResourcesActions::ActionChangeImage;?>
">
		<input id="resourceImage" type="file" class="text" size="60" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_IMAGE'),$_smarty_tpl);?>
 />
		<br/>
		<span class="note">.gif, .jpg, or .png</span>
		<div class="admin-update-buttons">
			<button type="button"
					class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<div id="renameDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Rename'),$_smarty_tpl);?>
">
	<form id="renameForm" method="post" ajaxAction="<?php echo ManageResourcesActions::ActionRename;?>
">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Name'),$_smarty_tpl);?>
: <input id="editName" type="text" class="textbox required" maxlength="85"
									   style="width:250px" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_NAME'),$_smarty_tpl);?>
 />
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Rename'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<div id="scheduleDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'MoveToSchedule'),$_smarty_tpl);?>
">
	<form id="scheduleForm" method="post" ajaxAction="<?php echo ManageResourcesActions::ActionChangeSchedule;?>
">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'MoveToSchedule'),$_smarty_tpl);?>
:
		<select id="editSchedule" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_ID'),$_smarty_tpl);?>
>
			<?php  $_smarty_tpl->tpl_vars['scheduleName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['scheduleName']->_loop = false;
 $_smarty_tpl->tpl_vars['scheduleId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Schedules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['scheduleName']->key => $_smarty_tpl->tpl_vars['scheduleName']->value) {
$_smarty_tpl->tpl_vars['scheduleName']->_loop = true;
 $_smarty_tpl->tpl_vars['scheduleId']->value = $_smarty_tpl->tpl_vars['scheduleName']->key;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['scheduleId']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['scheduleName']->value;?>
</option>
			<?php } ?>
		</select>
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<div id="resourceTypeDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceType'),$_smarty_tpl);?>
">
	<form id="resourceTypeForm" method="post" ajaxAction="<?php echo ManageResourcesActions::ActionChangeResourceType;?>
">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceType'),$_smarty_tpl);?>
:
		<select id="editResourceType" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_TYPE_ID'),$_smarty_tpl);?>
>
			<option value="">-- <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
 --</option>
			<?php  $_smarty_tpl->tpl_vars['resourceType'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resourceType']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ResourceTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resourceType']->key => $_smarty_tpl->tpl_vars['resourceType']->value) {
$_smarty_tpl->tpl_vars['resourceType']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['resourceType']->key;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['resourceType']->value->Name();?>
</option>
			<?php } ?>
		</select>
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<div id="locationDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Location'),$_smarty_tpl);?>
">
	<form id="locationForm" method="post" ajaxAction="<?php echo ManageResourcesActions::ActionChangeLocation;?>
">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Location'),$_smarty_tpl);?>
:<br/>
		<input id="editLocation" type="text" class="textbox" maxlength="85"
			   style="width:250px" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_LOCATION'),$_smarty_tpl);?>
 /><br/>
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Contact'),$_smarty_tpl);?>
:<br/>
		<input id="editContact" type="text" class="textbox" maxlength="85"
			   style="width:250px" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_CONTACT'),$_smarty_tpl);?>
 />
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<div id="descriptionDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Description'),$_smarty_tpl);?>
">
	<form id="descriptionForm" method="post" ajaxAction="<?php echo ManageResourcesActions::ActionChangeDescription;?>
">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Description'),$_smarty_tpl);?>
:<br/>
		<textarea id="editDescription" class="textbox"
				  style="width:460px;height:150px;" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_DESCRIPTION'),$_smarty_tpl);?>
></textarea>
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<div id="notesDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Notes'),$_smarty_tpl);?>
">
	<form id="notesForm" method="post" ajaxAction="<?php echo ManageResourcesActions::ActionChangeNotes;?>
">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Notes'),$_smarty_tpl);?>
:<br/>
		<textarea id="editNotes" class="textbox"
				  style="width:460px;height:150px;" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_NOTES'),$_smarty_tpl);?>
></textarea>
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<div id="configurationDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'UsageConfiguration'),$_smarty_tpl);?>
">
	<form id="configurationForm" method="post" ajaxAction="<?php echo ManageResourcesActions::ActionChangeConfiguration;?>
">
		<div style="margin-bottom: 10px;">
			<fieldset>
				<legend><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Duration'),$_smarty_tpl);?>
</legend>
				<ul>
					<li>
						<label>
							<input type="checkbox" id="noMinimumDuration"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMinLengthNone'),$_smarty_tpl);?>

						</label>
						<span class="noMinimumDuration">
							<br/>
							<?php $_smarty_tpl->_capture_stack[0][] = array("txtMinDuration", "txtMinDuration", null); ob_start(); ?>
								<input type='text' id='minDurationDays' size='3' class='days textbox' maxlength='3'/>
								<input type='text' id='minDurationHours' size='2' class='hours textbox' maxlength='2'/>
								<input type='text' id='minDurationMinutes' size='2' class='minutes textbox'
									   maxlength='2'/>
								<input type='hidden' id='minDuration' class='interval' <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'MIN_DURATION'),$_smarty_tpl);?>
 />
							<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMinLength','args'=>$_smarty_tpl->tpl_vars['txtMinDuration']->value),$_smarty_tpl);?>

						</span>
					</li>
					<li>
						<label>
							<input type="checkbox" id="noMaximumDuration"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMaxLengthNone'),$_smarty_tpl);?>

						</label>
						<span class="noMaximumDuration">
							<br/>
							<?php $_smarty_tpl->_capture_stack[0][] = array("txtMaxDuration", "txtMaxDuration", null); ob_start(); ?>
								<input type='text' id='maxDurationDays' size='3' class='days textbox' maxlength='3'/>
								<input type='text' id='maxDurationHours' size='2' class='hours textbox' maxlength='2'/>
								<input type='text' id='maxDurationMinutes' size='2' class='minutes textbox'
									   maxlength='2'/>
								<input type='hidden' id='maxDuration' class='interval' <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'MAX_DURATION'),$_smarty_tpl);?>
 />
							<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMaxLength','args'=>$_smarty_tpl->tpl_vars['txtMaxDuration']->value),$_smarty_tpl);?>

						</span>
					</li>
					<li>
						<label>
							<input type="checkbox" id="noBufferTime"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceBufferTimeNone'),$_smarty_tpl);?>

						</label>
						<span class="noBufferTime">
							<br/>
							<?php $_smarty_tpl->_capture_stack[0][] = array("txtBufferTime", "txtBufferTime", null); ob_start(); ?>
								<input type='text' id='bufferTimeDays' size='3' class='days textbox' maxlength='3'/>
								<input type='text' id='bufferTimeHours' size='2' class='hours textbox' maxlength='2'/>
								<input type='text' id='bufferTimeMinutes' size='2' class='minutes textbox'
									   maxlength='2'/>
								<input type='hidden' id='bufferTime' class='interval' <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'BUFFER_TIME'),$_smarty_tpl);?>
 />
							<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceBufferTime','args'=>$_smarty_tpl->tpl_vars['txtBufferTime']->value),$_smarty_tpl);?>

						</span>
					</li>
					<li>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceAllowMultiDay'),$_smarty_tpl);?>

						<select id="allowMultiday" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ALLOW_MULTIDAY'),$_smarty_tpl);?>
>
							<option value="1"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Yes'),$_smarty_tpl);?>
</option>
							<option value="0"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'No'),$_smarty_tpl);?>
</option>
						</select>
					</li>
				</ul>
			</fieldset>
			<fieldset>
				<legend><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Access'),$_smarty_tpl);?>
</legend>
				<ul>
					<li>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceRequiresApproval'),$_smarty_tpl);?>

						<select id="requiresApproval" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REQUIRES_APPROVAL'),$_smarty_tpl);?>
>
							<option value="1"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Yes'),$_smarty_tpl);?>
</option>
							<option value="0"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'No'),$_smarty_tpl);?>
</option>
						</select>
					</li>
					<li>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourcePermissionAutoGranted'),$_smarty_tpl);?>

						<select id="autoAssign" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'AUTO_ASSIGN'),$_smarty_tpl);?>
>
							<option value="1"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Yes'),$_smarty_tpl);?>
</option>
							<option value="0"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'No'),$_smarty_tpl);?>
</option>
						</select>
					</li>
					<li>
						<label>
							<input type="checkbox" id="noStartNotice"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMinNoticeNone'),$_smarty_tpl);?>

						</label>
						<span class="noStartNotice">
							<br/>
							<?php $_smarty_tpl->_capture_stack[0][] = array("txtStartNotice", "txtStartNotice", null); ob_start(); ?>
								<input type='text' id='startNoticeDays' size='3' class='days textbox' maxlength='3'/>
								<input type='text' id='startNoticeHours' size='2' class='hours textbox' maxlength='2'/>
								<input type='text' id='startNoticeMinutes' size='2' class='minutes textbox'
									   maxlength='2'/>
								<input type='hidden' id='startNotice' class='interval' <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'MIN_NOTICE'),$_smarty_tpl);?>
 />
							<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMinNotice','args'=>$_smarty_tpl->tpl_vars['txtStartNotice']->value),$_smarty_tpl);?>

						</span>
					</li>
					<li>
						<label>
							<input type="checkbox" id="noEndNotice"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMaxNoticeNone'),$_smarty_tpl);?>

						</label>
						<span class="noEndNotice">
							<br/>
							<?php $_smarty_tpl->_capture_stack[0][] = array("txtEndNotice", "txtEndNotice", null); ob_start(); ?>
								<input type='text' id='endNoticeDays' size='3' class='days textbox' maxlength='3'/>
								<input type='text' id='endNoticeHours' size='2' class='hours textbox' maxlength='2'/>
								<input type='text' id='endNoticeMinutes' size='2' class='minutes textbox'
									   maxlength='2'/>
								<input type='hidden' id='endNotice' class='interval' <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'MAX_NOTICE'),$_smarty_tpl);?>
 />
							<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceMaxNotice','args'=>$_smarty_tpl->tpl_vars['txtEndNotice']->value),$_smarty_tpl);?>

						</span>
					</li>
				</ul>
			</fieldset>
			<fieldset>
				<legend><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Capacity'),$_smarty_tpl);?>
</legend>
				<ul>
					<li>
						<label>
							<input type="checkbox" id="unlimitedCapactiy"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceCapacityNone'),$_smarty_tpl);?>

						</label>
						<span class="unlimitedCapactiy">
							<br/>
							<?php $_smarty_tpl->_capture_stack[0][] = array("txtMaxCapacity", "txtMaxCapacity", null); ob_start(); ?>
								<input type='text' id='maxCapactiy' class='textbox' size='5'
									   maxlength='5' <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'MAX_PARTICIPANTS'),$_smarty_tpl);?>
 />
							<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceCapacity','args'=>$_smarty_tpl->tpl_vars['txtMaxCapacity']->value),$_smarty_tpl);?>

						</span>
					</li>
				</ul>
			</fieldset>
		</div>
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<div id="groupAdminDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'WhoCanManageThisResource'),$_smarty_tpl);?>
">
	<form method="post" id="groupAdminForm" ajaxAction="<?php echo ManageResourcesActions::ActionChangeAdmin;?>
">
		<select id="adminGroupId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_ADMIN_GROUP_ID'),$_smarty_tpl);?>
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
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<div id="deleteDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
">
	<form id="deleteForm" method="post" ajaxAction="<?php echo ManageResourcesActions::ActionDelete;?>
">
		<div class="error" style="margin-bottom: 25px;">
			<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</h3>
			<br/><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteResourceWarning'),$_smarty_tpl);?>
:
			<ul>
				<li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteResourceWarningReservations'),$_smarty_tpl);?>
</li>
				<li><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteResourceWarningPermissions'),$_smarty_tpl);?>
</li>
			</ul>
			<br/>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteResourceWarningReassign'),$_smarty_tpl);?>

		</div>

		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cross-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<div id="sortOrderDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SortOrder'),$_smarty_tpl);?>
">
	<form id="sortOrderForm" method="post" ajaxAction="<?php echo ManageResourcesActions::ActionChangeSort;?>
">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SortOrder'),$_smarty_tpl);?>
:
		<input type="text" id="editSortOrder" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_SORT_ORDER'),$_smarty_tpl);?>
 maxlength="3"
			   style="width:40px"/>
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<div id="statusDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Status'),$_smarty_tpl);?>
">
	<form id="statusForm" method="post" ajaxAction="<?php echo ManageResourcesActions::ActionChangeStatus;?>
">

		<select id="statusId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_STATUS_ID'),$_smarty_tpl);?>
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
		<br/>
		<br/>
		<label for="reasonId"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Reason'),$_smarty_tpl);?>
</label> <a href="#" id="addStatusReason"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Add'),$_smarty_tpl);?>
</a><br/>
		<select id="reasonId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_STATUS_REASON_ID'),$_smarty_tpl);?>
 class="textbox">
		</select>
		<div id="newStatusReason" class="hidden">
			<input type="text" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_STATUS_REASON'),$_smarty_tpl);?>
  />
		</div>
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"admin-ajax-indicator.gif",'class'=>"indicator",'style'=>"display:none;"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.watermark.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/resource.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>


<script type="text/javascript">

	$(document).ready(function ()
	{
		var actions = {
			enableSubscription: '<?php echo ManageResourcesActions::ActionEnableSubscription;?>
',
			disableSubscription: '<?php echo ManageResourcesActions::ActionDisableSubscription;?>
',
			removeImage: '<?php echo ManageResourcesActions::ActionRemoveImage;?>
'
		};

		var opts = {
			submitUrl: '<?php echo $_SERVER['SCRIPT_NAME'];?>
',
			saveRedirect: '<?php echo $_SERVER['SCRIPT_NAME'];?>
',
			actions: actions
		};

		var resourceManagement = new ResourceManagement(opts);
		resourceManagement.init();

		<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Resources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
?>
		var resource = {
			id: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetResourceId();?>
',
			name: "<?php echo strtr($_smarty_tpl->tpl_vars['resource']->value->GetName(), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
",
			location: "<?php echo strtr($_smarty_tpl->tpl_vars['resource']->value->GetLocation(), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
",
			contact: "<?php echo strtr($_smarty_tpl->tpl_vars['resource']->value->GetContact(), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
",
			description: "<?php echo strtr($_smarty_tpl->tpl_vars['resource']->value->GetDescription(), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
",
			notes: "<?php echo strtr($_smarty_tpl->tpl_vars['resource']->value->GetNotes(), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
",
			autoAssign: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetAutoAssign();?>
',
			requiresApproval: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetRequiresApproval();?>
',
			allowMultiday: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetAllowMultiday();?>
',
			maxParticipants: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMaxParticipants();?>
',
			scheduleId: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetScheduleId();?>
',
			minLength: {},
			maxLength: {},
			startNotice: {},
			endNotice: {},
			bufferTime: {},
			adminGroupId: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetAdminGroupId();?>
',
			sortOrder: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetSortOrder();?>
',
			resourceTypeId : '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetResourceTypeId();?>
',
			statusId: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetStatusId();?>
',
			reasonId: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetStatusReasonId();?>
'
		};

		<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasMinLength()) {?>
		resource.minLength = {
			value: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMinLength();?>
',
			days: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMinLength()->Days();?>
',
			hours: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMinLength()->Hours();?>
',
			minutes: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMinLength()->Minutes();?>
'
		};
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasMaxLength()) {?>
		resource.maxLength = {
			value: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMaxLength();?>
',
			days: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMaxLength()->Days();?>
',
			hours: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMaxLength()->Hours();?>
',
			minutes: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMaxLength()->Minutes();?>
'
		};
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasMinNotice()) {?>
		resource.startNotice = {
			value: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMinNotice();?>
',
			days: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMinNotice()->Days();?>
',
			hours: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMinNotice()->Hours();?>
',
			minutes: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMinNotice()->Minutes();?>
'
		};
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasMaxNotice()) {?>
		resource.endNotice = {
			value: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMaxNotice();?>
',
			days: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMaxNotice()->Days();?>
',
			hours: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMaxNotice()->Hours();?>
',
			minutes: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetMaxNotice()->Minutes();?>
'
		};
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['resource']->value->HasBufferTime()) {?>
		resource.bufferTime = {
			value: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetBufferTime();?>
',
			days: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetBufferTime()->Days();?>
',
			hours: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetBufferTime()->Hours();?>
',
			minutes: '<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetBufferTime()->Minutes();?>
'
		};
		<?php }?>

		resourceManagement.add(resource);
		<?php } ?>

		<?php  $_smarty_tpl->tpl_vars['reason'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reason']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['StatusReasons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reason']->key => $_smarty_tpl->tpl_vars['reason']->value) {
$_smarty_tpl->tpl_vars['reason']->_loop = true;
?>
			resourceManagement.addStatusReason('<?php echo $_smarty_tpl->tpl_vars['reason']->value->Id();?>
', '<?php echo $_smarty_tpl->tpl_vars['reason']->value->StatusId();?>
', '<?php echo strtr($_smarty_tpl->tpl_vars['reason']->value->Description(), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
');
		<?php } ?>
	});

</script>

<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
