<?php /* Smarty version Smarty-3.1.16, created on 2014-03-21 23:14:41
         compiled from "C:\xampp\htdocs\booked\tpl\Reservation\view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12822532cb9d1e3a272-85646743%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '723ed37e64601a67a884a292f2a4ed1eaaa3e612' => 
    array (
      0 => 'C:\\xampp\\htdocs\\booked\\tpl\\Reservation\\view.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12822532cb9d1e3a272-85646743',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ReferenceNumber' => 0,
    'ShowUserDetails' => 0,
    'ReservationUserName' => 0,
    'ResourceName' => 0,
    'AvailableResources' => 0,
    'AdditionalResourceIds' => 0,
    'resource' => 0,
    'Accessories' => 0,
    'accessory' => 0,
    'StartDate' => 0,
    'StartPeriods' => 0,
    'period' => 0,
    'SelectedStart' => 0,
    'EndDate' => 0,
    'EndPeriods' => 0,
    'SelectedEnd' => 0,
    'RepeatType' => 0,
    'RepeatOptions' => 0,
    'IsRecurring' => 0,
    'RepeatInterval' => 0,
    'RepeatMonthlyType' => 0,
    'RepeatWeekdays' => 0,
    'day' => 0,
    'DayNames' => 0,
    'RepeatTerminationDate' => 0,
    'ShowReservationDetails' => 0,
    'ReservationTitle' => 0,
    'Description' => 0,
    'ShowParticipation' => 0,
    'Participants' => 0,
    'participant' => 0,
    'Invitees' => 0,
    'invitee' => 0,
    'IAmParticipating' => 0,
    'IAmInvited' => 0,
    'Attributes' => 0,
    'attribute' => 0,
    'Path' => 0,
    'ReturnUrl' => 0,
    'Attachments' => 0,
    'attachment' => 0,
    'ReservationId' => 0,
    'ReservationAction' => 0,
    'UserId' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_532cb9d2851140_17867610',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_532cb9d2851140_17867610')) {function content_532cb9d2851140_17867610($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('TitleKey'=>'ViewReservationHeading','TitleArgs'=>$_smarty_tpl->tpl_vars['ReferenceNumber']->value,'cssFiles'=>'css/reservation.css'), 0);?>

<div id="reservationbox" class="readonly">
	<div id="reservationFormDiv">
		<div class="reservationHeader">
			<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ViewReservationHeading",'args'=>$_smarty_tpl->tpl_vars['ReferenceNumber']->value),$_smarty_tpl);?>
</h3>
		</div>
		<div id="reservationDetails">
			<ul class="no-style">
				<li>
					<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'User'),$_smarty_tpl);?>
</label>
				<?php if ($_smarty_tpl->tpl_vars['ShowUserDetails']->value) {?>
					<?php echo $_smarty_tpl->tpl_vars['ReservationUserName']->value;?>

				<?php } else { ?>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Private'),$_smarty_tpl);?>

				<?php }?>
				</li>
				<li>
					<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Resources'),$_smarty_tpl);?>
</label> <?php echo $_smarty_tpl->tpl_vars['ResourceName']->value;?>

					<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AvailableResources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
?>
						<?php if (is_array($_smarty_tpl->tpl_vars['AdditionalResourceIds']->value)&&in_array($_smarty_tpl->tpl_vars['resource']->value->Id,$_smarty_tpl->tpl_vars['AdditionalResourceIds']->value)) {?>
							,<?php echo $_smarty_tpl->tpl_vars['resource']->value->Name;?>

						<?php }?>
					<?php } ?>
				</li>
				<li>
					<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Accessories'),$_smarty_tpl);?>
</label>
					<?php  $_smarty_tpl->tpl_vars['accessory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['accessory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Accessories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['accessory']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['accessory']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['accessory']->key => $_smarty_tpl->tpl_vars['accessory']->value) {
$_smarty_tpl->tpl_vars['accessory']->_loop = true;
 $_smarty_tpl->tpl_vars['accessory']->iteration++;
 $_smarty_tpl->tpl_vars['accessory']->last = $_smarty_tpl->tpl_vars['accessory']->iteration === $_smarty_tpl->tpl_vars['accessory']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['accessoryLoop']['last'] = $_smarty_tpl->tpl_vars['accessory']->last;
?>
						(<?php echo $_smarty_tpl->tpl_vars['accessory']->value->QuantityReserved;?>
)
						<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['accessoryLoop']['last']) {?>
							<?php echo $_smarty_tpl->tpl_vars['accessory']->value->Name;?>

						<?php } else { ?>
							<?php echo $_smarty_tpl->tpl_vars['accessory']->value->Name;?>
,
						<?php }?>
					<?php } ?>
				</li>
				<li class="section">
					<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'BeginDate'),$_smarty_tpl);?>
</label> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['StartDate']->value),$_smarty_tpl);?>

					<input type="hidden" id="formattedBeginDate" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['StartDate']->value,'key'=>'system'),$_smarty_tpl);?>
"/>
					<?php  $_smarty_tpl->tpl_vars['period'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['period']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['StartPeriods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['period']->key => $_smarty_tpl->tpl_vars['period']->value) {
$_smarty_tpl->tpl_vars['period']->_loop = true;
?>
						<?php if ($_smarty_tpl->tpl_vars['period']->value==$_smarty_tpl->tpl_vars['SelectedStart']->value) {?>
							<?php echo $_smarty_tpl->tpl_vars['period']->value->Label();?>
 <br/>
							<input type="hidden" id="BeginPeriod" value="<?php echo $_smarty_tpl->tpl_vars['period']->value->Begin();?>
"/>
						<?php }?>
					<?php } ?>
				</li>
				<li>
					<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'EndDate'),$_smarty_tpl);?>
</label> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['EndDate']->value),$_smarty_tpl);?>

					<input type="hidden" id="formattedEndDate" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['EndDate']->value,'key'=>'system'),$_smarty_tpl);?>
" />
					<?php  $_smarty_tpl->tpl_vars['period'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['period']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['EndPeriods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['period']->key => $_smarty_tpl->tpl_vars['period']->value) {
$_smarty_tpl->tpl_vars['period']->_loop = true;
?>
						<?php if ($_smarty_tpl->tpl_vars['period']->value==$_smarty_tpl->tpl_vars['SelectedEnd']->value) {?>
							<?php echo $_smarty_tpl->tpl_vars['period']->value->LabelEnd();?>
 <br/>
							<input type="hidden" id="EndPeriod" value="<?php echo $_smarty_tpl->tpl_vars['period']->value->End();?>
"/>
						<?php }?>
					<?php } ?>
				</li>
				<li>
						<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReservationLength'),$_smarty_tpl);?>
</label>

						<div class="durationText">
							<span id="durationDays">0</span> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'days'),$_smarty_tpl);?>
,
							<span id="durationHours">0</span> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'hours'),$_smarty_tpl);?>

						</div>
					</li>
				<li>
					<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'RepeatPrompt'),$_smarty_tpl);?>
</label> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['RepeatOptions']->value[$_smarty_tpl->tpl_vars['RepeatType']->value]['key']),$_smarty_tpl);?>

				<?php if ($_smarty_tpl->tpl_vars['IsRecurring']->value) {?>
					<div class="repeat-details">
						<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'RepeatEveryPrompt'),$_smarty_tpl);?>
</label> <?php echo $_smarty_tpl->tpl_vars['RepeatInterval']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['RepeatOptions']->value[$_smarty_tpl->tpl_vars['RepeatType']->value]['everyKey'];?>

						<?php if ($_smarty_tpl->tpl_vars['RepeatMonthlyType']->value!='') {?>
							(<?php echo $_smarty_tpl->tpl_vars['RepeatMonthlyType']->value;?>
)
						<?php }?>
						<?php if (count($_smarty_tpl->tpl_vars['RepeatWeekdays']->value)>0) {?>
							<br/><label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'RepeatDaysPrompt'),$_smarty_tpl);?>
</label> <?php  $_smarty_tpl->tpl_vars['day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RepeatWeekdays']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day']->key => $_smarty_tpl->tpl_vars['day']->value) {
$_smarty_tpl->tpl_vars['day']->_loop = true;
?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['DayNames']->value[$_smarty_tpl->tpl_vars['day']->value]),$_smarty_tpl);?>
 <?php } ?>
						<?php }?>
						<br/><label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'RepeatUntilPrompt'),$_smarty_tpl);?>
</label> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['RepeatTerminationDate']->value),$_smarty_tpl);?>

					</div>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['ShowReservationDetails']->value) {?>
					</li>
					<li class="section">
						<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReservationTitle'),$_smarty_tpl);?>
</label>
						<?php if ($_smarty_tpl->tpl_vars['ReservationTitle']->value!='') {?>
							<?php echo $_smarty_tpl->tpl_vars['ReservationTitle']->value;?>

						<?php } else { ?>
							<span class="no-data"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
</span>
						<?php }?>
					</li>

					<li>
						<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReservationDescription'),$_smarty_tpl);?>
</label>
						<?php if ($_smarty_tpl->tpl_vars['Description']->value!='') {?>
							<br/><?php echo nl2br($_smarty_tpl->tpl_vars['Description']->value);?>

						<?php } else { ?>
							<span class="no-data"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
</span>
						<?php }?>
					</li>
				<?php }?>
		</div>

		<?php if ($_smarty_tpl->tpl_vars['ShowParticipation']->value) {?>
		<div id="reservationParticipation">
			<ul class="no-style">
				<?php if ($_smarty_tpl->tpl_vars['ShowUserDetails']->value) {?>
					<li class="section">
						<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ParticipantList'),$_smarty_tpl);?>
</label>
						<?php  $_smarty_tpl->tpl_vars['participant'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['participant']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Participants']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['participant']->key => $_smarty_tpl->tpl_vars['participant']->value) {
$_smarty_tpl->tpl_vars['participant']->_loop = true;
?>
							<br/><?php echo $_smarty_tpl->tpl_vars['participant']->value->FullName;?>

						<?php }
if (!$_smarty_tpl->tpl_vars['participant']->_loop) {
?>
							<span class="no-data"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
</span>
						<?php } ?>
					</li>

					<li>
						<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InvitationList'),$_smarty_tpl);?>
</label>
						<?php  $_smarty_tpl->tpl_vars['invitee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['invitee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Invitees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['invitee']->key => $_smarty_tpl->tpl_vars['invitee']->value) {
$_smarty_tpl->tpl_vars['invitee']->_loop = true;
?>
							<br/><?php echo $_smarty_tpl->tpl_vars['invitee']->value->FullName;?>

						<?php }
if (!$_smarty_tpl->tpl_vars['invitee']->_loop) {
?>
							<span class="no-data"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
</span>
						<?php } ?>
					</li>
				<?php }?>
				<li>
					<?php if ($_smarty_tpl->tpl_vars['IAmParticipating']->value) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CancelParticipation'),$_smarty_tpl);?>
?
						</li>
						<li>
						<?php if ($_smarty_tpl->tpl_vars['IsRecurring']->value) {?>
							<button value="<?php echo InvitationAction::CancelAll;?>
" class="button participationAction"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"user-minus.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllInstances'),$_smarty_tpl);?>
</button>
							<button value="<?php echo InvitationAction::CancelInstance;?>
" class="button participationAction"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"user-minus.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ThisInstance'),$_smarty_tpl);?>
</button>
						<?php }?>
						<button value="<?php echo InvitationAction::CancelInstance;?>
" class="button participationAction"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"user-minus.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CancelParticipation'),$_smarty_tpl);?>
</button>
					<?php }?>

					<?php if ($_smarty_tpl->tpl_vars['IAmInvited']->value) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Attending'),$_smarty_tpl);?>
?
						</li>
						<li>
						<button value="<?php echo InvitationAction::Accept;?>
" class="button participationAction"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"ticket-plus.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Yes'),$_smarty_tpl);?>
</button>
						<button value="<?php echo InvitationAction::Decline;?>
" class="button participationAction"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"ticket-minus.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'No'),$_smarty_tpl);?>
</button>
					<?php }?>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('id'=>"indicator",'src'=>"admin-ajax-indicator.gif",'style'=>"display:none;"),$_smarty_tpl);?>

				</li>
			</ul>
		</div>
		<?php }?>
		<div style="clear:both;">&nbsp;</div>

		<?php if ($_smarty_tpl->tpl_vars['ShowReservationDetails']->value) {?>
			<?php if (count($_smarty_tpl->tpl_vars['Attributes']->value)>0) {?>
			<div class="customAttributes">
				<span><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AdditionalAttributes'),$_smarty_tpl);?>
</span>
				<ul>
				<?php  $_smarty_tpl->tpl_vars['attribute'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attribute']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Attributes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->key => $_smarty_tpl->tpl_vars['attribute']->value) {
$_smarty_tpl->tpl_vars['attribute']->_loop = true;
?>
					<li class="customAttribute">
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"AttributeControl",'attribute'=>$_smarty_tpl->tpl_vars['attribute']->value,'readonly'=>true),$_smarty_tpl);?>

					</li>
				<?php } ?>
				</ul>
			</div>
			<div style="clear:both;">&nbsp;</div>
			<?php }?>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['ShowReservationDetails']->value) {?>
			<div style="float:left;">
				
					<a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
export/<?php echo Pages::CALENDAR_EXPORT;?>
?<?php echo QueryStringKeys::REFERENCE_NUMBER;?>
=<?php echo $_smarty_tpl->tpl_vars['ReferenceNumber']->value;?>
">
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"calendar-plus.png"),$_smarty_tpl);?>

					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddToOutlook'),$_smarty_tpl);?>
</a>
				
			</div>
		<?php }?>
		<div style="float:right;">
			
				&nbsp
			
			<button type="button" class="button" onclick="window.location='<?php echo $_smarty_tpl->tpl_vars['ReturnUrl']->value;?>
'">
				<img src="img/slash.png"/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Close'),$_smarty_tpl);?>

			</button>
					<button type="button" class="button">
				<img src="img/printer.png" />
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Print'),$_smarty_tpl);?>

			</button>
		</div>

		<?php if ($_smarty_tpl->tpl_vars['ShowReservationDetails']->value) {?>
			<?php if (count($_smarty_tpl->tpl_vars['Attachments']->value)>0) {?>
				<div style="clear:both">&nbsp;</div>
				<div class="res-attachments">
				<span class="heading"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Attachments'),$_smarty_tpl);?>
</span>
					<?php  $_smarty_tpl->tpl_vars['attachment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attachment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Attachments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attachment']->key => $_smarty_tpl->tpl_vars['attachment']->value) {
$_smarty_tpl->tpl_vars['attachment']->_loop = true;
?>
						<a href="attachments/<?php echo Pages::RESERVATION_FILE;?>
?<?php echo QueryStringKeys::ATTACHMENT_FILE_ID;?>
=<?php echo $_smarty_tpl->tpl_vars['attachment']->value->FileId();?>
&<?php echo QueryStringKeys::REFERENCE_NUMBER;?>
=<?php echo $_smarty_tpl->tpl_vars['ReferenceNumber']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['attachment']->value->FileName();?>
</a>&nbsp;
					<?php } ?>
				</div>
			<?php }?>
		<?php }?>
		<input type="hidden" id="referenceNumber" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'reference_number'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->tpl_vars['ReferenceNumber']->value;?>
"/>
	</div>
</div>

<div id="dialogSave" style="display:none;">
	<div id="creatingNotification" style="position:relative; top:170px;">
	
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'UpdatingReservation'),$_smarty_tpl);?>
...<br/>
	
		<img src="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
img/reservation_submitting.gif" alt="Creating reservation"/>
	</div>
	<div id="result" style="display:none;"></div>
</div>

<div style="display: none">
	<form id="reservationForm" method="post" enctype="application/x-www-form-urlencoded">
		<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'reservation_id'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->tpl_vars['ReservationId']->value;?>
"/>
		<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'reference_number'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->tpl_vars['ReferenceNumber']->value;?>
"/>
		<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'reservation_action'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->tpl_vars['ReservationAction']->value;?>
"/>
		<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SERIES_UPDATE_SCOPE'),$_smarty_tpl);?>
 id="hdnSeriesUpdateScope" value="<?php echo SeriesUpdateScope::FullSeries;?>
"/>
	</form>
</div>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"participation.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"approval.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/moment.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"date-helper.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"reservation.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"autocomplete.js"),$_smarty_tpl);?>


	<script type="text/javascript">

	$(document).ready(function() {

		var participationOptions = {
			responseType: 'json'
		};

		var participation = new Participation(participationOptions);
		participation.initReservation();

		var approvalOptions = {
			responseType: 'json',
			url: "<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
ajax/reservation_approve.php"
		};

		var approval = new Approval(approvalOptions);
		approval.initReservation();

		var scopeOptions = {
				instance: '<?php echo SeriesUpdateScope::ThisInstance;?>
',
				full: '<?php echo SeriesUpdateScope::FullSeries;?>
',
				future: '<?php echo SeriesUpdateScope::FutureInstances;?>
'
			};

		var reservationOpts = {
			returnUrl: '<?php echo $_smarty_tpl->tpl_vars['ReturnUrl']->value;?>
',
			scopeOpts: scopeOptions,
			deleteUrl: 'ajax/reservation_delete.php',
			userAutocompleteUrl: "ajax/autocomplete.php?type=<?php echo AutoCompleteType::User;?>
",
			changeUserAutocompleteUrl: "ajax/autocomplete.php?type=<?php echo AutoCompleteType::MyUsers;?>
"
		};
		var reservation = new Reservation(reservationOpts);
		reservation.init('<?php echo $_smarty_tpl->tpl_vars['UserId']->value;?>
');

		var options = {
				target: '#result',   // target element(s) to be updated with server response
				beforeSubmit: reservation.preSubmit,  // pre-submit callback
				success: reservation.showResponse  // post-submit callback
			};

			$('#reservationForm').submit(function() {
				$(this).ajaxSubmit(options);
				return false;
			});
	});

	</script>
<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
