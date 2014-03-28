<?php /* Smarty version Smarty-3.1.16, created on 2014-03-17 04:21:49
         compiled from "C:\xampp\htdocs\booked\tpl\Ajax\respopup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:258553266a4d21c8b6-89369752%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1d1ca4d83b69daff3ab6d62cd9f1494f5af317c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\booked\\tpl\\Ajax\\respopup.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '258553266a4d21c8b6-89369752',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'authorized' => 0,
    'hideUserInfo' => 0,
    'fullName' => 0,
    'startDate' => 0,
    'endDate' => 0,
    'hideDetails' => 0,
    'title' => 0,
    'resources' => 0,
    'resource' => 0,
    'participants' => 0,
    'user' => 0,
    'accessories' => 0,
    'accessory' => 0,
    'summary' => 0,
    'attributes' => 0,
    'attribute' => 0,
    'ReservationId' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53266a4d5cec13_45248114',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53266a4d5cec13_45248114')) {function content_53266a4d5cec13_45248114($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'C:\\xampp\\htdocs\\booked\\lib\\Common/../../lib/external/Smarty/plugins\\modifier.truncate.php';
?>
<?php if ($_smarty_tpl->tpl_vars['authorized']->value) {?>
<div class="res_popup_details" style="margin:0">
	<div class="user">
		<?php if ($_smarty_tpl->tpl_vars['hideUserInfo']->value) {?>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Private'),$_smarty_tpl);?>

		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['fullName']->value;?>

		<?php }?>
	</div>
	<div class="dates"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['startDate']->value,'key'=>'res_popup'),$_smarty_tpl);?>
 - <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['endDate']->value,'key'=>'res_popup'),$_smarty_tpl);?>
</div>

	<?php if (!$_smarty_tpl->tpl_vars['hideDetails']->value) {?>
    <div class="title"><?php if ($_smarty_tpl->tpl_vars['title']->value!='') {?><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
<?php } else { ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoTitleLabel'),$_smarty_tpl);?>
<?php }?></div>
	<?php }?>

	<div class="resources">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Resources"),$_smarty_tpl);?>
 (<?php echo count($_smarty_tpl->tpl_vars['resources']->value);?>
):
	<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['resources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['resource']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['resource']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
 $_smarty_tpl->tpl_vars['resource']->iteration++;
 $_smarty_tpl->tpl_vars['resource']->last = $_smarty_tpl->tpl_vars['resource']->iteration === $_smarty_tpl->tpl_vars['resource']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['resource_loop']['last'] = $_smarty_tpl->tpl_vars['resource']->last;
?>
		<?php echo $_smarty_tpl->tpl_vars['resource']->value->Name();?>

		<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['resource_loop']['last']) {?>, <?php }?>
	<?php } ?>
	</div>

	<?php if (!$_smarty_tpl->tpl_vars['hideUserInfo']->value) {?>
	<div class="users">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Participants"),$_smarty_tpl);?>
 (<?php echo count($_smarty_tpl->tpl_vars['participants']->value);?>
):
	<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['participants']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['user']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['user']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
 $_smarty_tpl->tpl_vars['user']->iteration++;
 $_smarty_tpl->tpl_vars['user']->last = $_smarty_tpl->tpl_vars['user']->iteration === $_smarty_tpl->tpl_vars['user']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['participant_loop']['last'] = $_smarty_tpl->tpl_vars['user']->last;
?>
		<?php if (!$_smarty_tpl->tpl_vars['user']->value->IsOwner()) {?>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fullname'][0][0]->DisplayFullName(array('first'=>$_smarty_tpl->tpl_vars['user']->value->FirstName,'last'=>$_smarty_tpl->tpl_vars['user']->value->LastName),$_smarty_tpl);?>

		<?php }?>
		<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['participant_loop']['last']) {?>, <?php }?>
	<?php } ?>
	</div>
	<?php }?>

	<div class="accessories">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Accessories"),$_smarty_tpl);?>
 (<?php echo count($_smarty_tpl->tpl_vars['accessories']->value);?>
):
	<?php  $_smarty_tpl->tpl_vars['accessory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['accessory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['accessories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['accessory']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['accessory']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['accessory']->key => $_smarty_tpl->tpl_vars['accessory']->value) {
$_smarty_tpl->tpl_vars['accessory']->_loop = true;
 $_smarty_tpl->tpl_vars['accessory']->iteration++;
 $_smarty_tpl->tpl_vars['accessory']->last = $_smarty_tpl->tpl_vars['accessory']->iteration === $_smarty_tpl->tpl_vars['accessory']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['accessory_loop']['last'] = $_smarty_tpl->tpl_vars['accessory']->last;
?>
		<?php echo $_smarty_tpl->tpl_vars['accessory']->value->Name;?>
 (<?php echo $_smarty_tpl->tpl_vars['accessory']->value->QuantityReserved;?>
)
		<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['accessory_loop']['last']) {?>, <?php }?>
	<?php } ?>
	</div>

	<?php if (!$_smarty_tpl->tpl_vars['hideDetails']->value) {?>
		<div class="summary"><?php if ($_smarty_tpl->tpl_vars['summary']->value!='') {?><?php echo nl2br(smarty_modifier_truncate($_smarty_tpl->tpl_vars['summary']->value,300,"..."));?>
<?php } else { ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoDescriptionLabel'),$_smarty_tpl);?>
<?php }?></div>
		<?php if (count($_smarty_tpl->tpl_vars['attributes']->value)>0) {?>
			<br/>
			<?php  $_smarty_tpl->tpl_vars['attribute'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attribute']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['attributes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->key => $_smarty_tpl->tpl_vars['attribute']->value) {
$_smarty_tpl->tpl_vars['attribute']->_loop = true;
?>
				<div><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"AttributeControl",'attribute'=>$_smarty_tpl->tpl_vars['attribute']->value,'readonly'=>true),$_smarty_tpl);?>
</div>
			<?php } ?>
		<?php }?>
	<?php }?>
	<!-- <?php echo $_smarty_tpl->tpl_vars['ReservationId']->value;?>
 -->
</div>
<?php } else { ?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InsufficientPermissionsError'),$_smarty_tpl);?>

<?php }?><?php }} ?>
