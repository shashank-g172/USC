<?php /* Smarty version Smarty-3.1.16, created on 2014-03-18 18:33:25
         compiled from "C:\xampp\htdocs\booked\tpl\Calendar\calendar.common.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26055532883656b3ad3-05891245%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96708ce708d00edbf0bd4f4ad822967b250c54bd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\booked\\tpl\\Calendar\\calendar.common.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26055532883656b3ad3-05891245',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'IsAccessible' => 0,
    'IsSubscriptionAllowed' => 0,
    'IsSubscriptionEnabled' => 0,
    'SubscriptionUrl' => 0,
    'Calendar' => 0,
    'reservation' => 0,
    'view' => 0,
    'DisplayDate' => 0,
    'ScheduleId' => 0,
    'ResourceId' => 0,
    'DayNames' => 0,
    'DayNamesShort' => 0,
    'MonthNames' => 0,
    'MonthNamesShort' => 0,
    'TimeFormat' => 0,
    'DateFormat' => 0,
    'FirstDay' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_532883658af356_23026552',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_532883658af356_23026552')) {function content_532883658af356_23026552($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['IsAccessible']->value) {?>
	<div class="calendar-subscription">
	<?php if ($_smarty_tpl->tpl_vars['IsSubscriptionAllowed']->value&&$_smarty_tpl->tpl_vars['IsSubscriptionEnabled']->value) {?>
		<a id="subscribeTocalendar" href="<?php echo $_smarty_tpl->tpl_vars['SubscriptionUrl']->value;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"calendar-share.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SubscribeToCalendar'),$_smarty_tpl);?>
</a>
		<br/>URL: <span class="note"><?php echo $_smarty_tpl->tpl_vars['SubscriptionUrl']->value;?>
</span>
	<?php } else { ?>
		<span class="note"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SubscriptionsAreDisabled'),$_smarty_tpl);?>
</span>
	<?php }?>
	</div>

	<div id="calendar"></div>

	<div id="dayDialog" class="dialog">
		<a href="#" id="dayDialogCreate"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick.png"),$_smarty_tpl);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CreateReservation'),$_smarty_tpl);?>
</a>
		<a href="#" id="dayDialogView"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"search.png"),$_smarty_tpl);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ViewDay'),$_smarty_tpl);?>
</a>
		<a href="#" id="dayDialogCancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</a>
	</div>

<?php } else { ?>
<div class="error"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoResourcePermission'),$_smarty_tpl);?>
</div>
<?php }?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.qtip.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"reservationPopup.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"calendar.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/fullcalendar.min.js"),$_smarty_tpl);?>


<script type="text/javascript">
$(document).ready(function() {

	var reservations = [];
	<?php  $_smarty_tpl->tpl_vars['reservation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reservation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Calendar']->value->Reservations(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reservation']->key => $_smarty_tpl->tpl_vars['reservation']->value) {
$_smarty_tpl->tpl_vars['reservation']->_loop = true;
?>
		reservations.push({
			id: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReferenceNumber;?>
',
			title: '<?php echo strtr($_smarty_tpl->tpl_vars['reservation']->value->DisplayTitle, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
			start: '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['format_date'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->StartDate,'key'=>'fullcalendar'),$_smarty_tpl);?>
',
			end: '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['format_date'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->EndDate,'key'=>'fullcalendar'),$_smarty_tpl);?>
',
			url: '<?php echo Pages::RESERVATION;?>
?rn=<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReferenceNumber;?>
',
			allDay: false,
			color: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->Color;?>
',
			textColor: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->TextColor;?>
',
			className: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->Class;?>
'
		});
	<?php } ?>

	var options = {
					view: '<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
',
					year: <?php echo $_smarty_tpl->tpl_vars['DisplayDate']->value->Year();?>
,
					month: <?php echo $_smarty_tpl->tpl_vars['DisplayDate']->value->Month();?>
,
					date: <?php echo $_smarty_tpl->tpl_vars['DisplayDate']->value->Day();?>
,
					dayClickUrl: '<?php echo Pages::CALENDAR;?>
?ct=<?php echo CalendarTypes::Day;?>
&sid=<?php echo $_smarty_tpl->tpl_vars['ScheduleId']->value;?>
&rid=<?php echo $_smarty_tpl->tpl_vars['ResourceId']->value;?>
',
					dayNames: <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js_array'][0][0]->CreateJavascriptArray(array('array'=>$_smarty_tpl->tpl_vars['DayNames']->value),$_smarty_tpl);?>
,
					dayNamesShort: <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js_array'][0][0]->CreateJavascriptArray(array('array'=>$_smarty_tpl->tpl_vars['DayNamesShort']->value),$_smarty_tpl);?>
,
					monthNames: <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js_array'][0][0]->CreateJavascriptArray(array('array'=>$_smarty_tpl->tpl_vars['MonthNames']->value),$_smarty_tpl);?>
,
					monthNamesShort: <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js_array'][0][0]->CreateJavascriptArray(array('array'=>$_smarty_tpl->tpl_vars['MonthNamesShort']->value),$_smarty_tpl);?>
,
					timeFormat: '<?php echo $_smarty_tpl->tpl_vars['TimeFormat']->value;?>
',
					dayMonth: '<?php echo $_smarty_tpl->tpl_vars['DateFormat']->value;?>
',
					firstDay: <?php echo $_smarty_tpl->tpl_vars['FirstDay']->value;?>
,
					reservationUrl: '<?php echo Pages::RESERVATION;?>
?sid=<?php echo $_smarty_tpl->tpl_vars['ScheduleId']->value;?>
&rid=<?php echo $_smarty_tpl->tpl_vars['ResourceId']->value;?>
',
					reservable: true
				};

	var calendar = new Calendar(options, reservations);
	calendar.init();
});
</script><?php }} ?>
