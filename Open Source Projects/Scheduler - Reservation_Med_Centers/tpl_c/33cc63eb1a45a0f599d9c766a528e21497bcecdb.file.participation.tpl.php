<?php /* Smarty version Smarty-3.1.16, created on 2014-03-18 18:34:01
         compiled from "C:\xampp\htdocs\booked\tpl\participation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1100053288389392a32-62752164%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33cc63eb1a45a0f599d9c766a528e21497bcecdb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\booked\\tpl\\participation.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1100053288389392a32-62752164',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Reservations' => 0,
    'result' => 0,
    'reservation' => 0,
    'referenceNumber' => 0,
    'Timezone' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_532883895bd792_90774071',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_532883895bd792_90774071')) {function content_532883895bd792_90774071($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/participation.css,css/jquery.qtip.min.css'), 0);?>

<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'OpenInvitations'),$_smarty_tpl);?>
 (<?php echo count($_smarty_tpl->tpl_vars['Reservations']->value);?>
)</h1>

<?php if (!empty($_smarty_tpl->tpl_vars['result']->value)) {?>
	<div><?php echo $_smarty_tpl->tpl_vars['result']->value;?>
</div>
<?php }?>

<div id="jsonResult" class="error hidden"></div>

<ul class="no-style participation">
<?php  $_smarty_tpl->tpl_vars['reservation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reservation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Reservations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['invitations']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['reservation']->key => $_smarty_tpl->tpl_vars['reservation']->value) {
$_smarty_tpl->tpl_vars['reservation']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['invitations']['index']++;
?>
	<?php $_smarty_tpl->tpl_vars['referenceNumber'] = new Smarty_variable($_smarty_tpl->tpl_vars['reservation']->value->ReferenceNumber, null, 0);?>
	<li class="actions row<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['invitations']['index']%2;?>
">
		<h3><?php echo $_smarty_tpl->tpl_vars['reservation']->value->Title;?>
</h3>
		<h3><a href="<?php echo Pages::RESERVATION;?>
?<?php echo QueryStringKeys::REFERENCE_NUMBER;?>
=<?php echo $_smarty_tpl->tpl_vars['referenceNumber']->value;?>
" class="reservation" referenceNumber="<?php echo $_smarty_tpl->tpl_vars['referenceNumber']->value;?>
">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->StartDate->ToTimezone($_smarty_tpl->tpl_vars['Timezone']->value),'key'=>'dashboard'),$_smarty_tpl);?>
 - <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->EndDate->ToTimezone($_smarty_tpl->tpl_vars['Timezone']->value),'key'=>'dashboard'),$_smarty_tpl);?>
</a></h3>
		<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['referenceNumber']->value;?>
" class="referenceNumber" />
		<button value="<?php echo InvitationAction::Accept;?>
" class="button participationAction"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"ticket-plus.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Accept"),$_smarty_tpl);?>
</button>
		<button value="<?php echo InvitationAction::Decline;?>
" class="button participationAction"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"ticket-minus.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Decline"),$_smarty_tpl);?>
</button>
	</li>
<?php }
if (!$_smarty_tpl->tpl_vars['reservation']->_loop) {
?>
	<li class="no-data"><h2><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
</h2></li>
<?php } ?>
</ul>

<div class="dialog" style="display:none;">

</div>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"admin-ajax-indicator.gif",'id'=>"indicator",'style'=>"display:none;"),$_smarty_tpl);?>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.qtip.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"reservationPopup.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"participation.js"),$_smarty_tpl);?>


<script type="text/javascript">

	$(document).ready(function() {

		var participationOptions = {
			responseType: 'json'
		};

		var participation = new Participation(participationOptions);
		participation.initParticipation();
	});

</script>

<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
