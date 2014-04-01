<?php /* Smarty version Smarty-3.1.16, created on 2014-03-31 23:18:21
         compiled from "C:\wamp\www\slots\tpl\Reservation\participation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166475339f7bd2eb030-95297329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b362a6c639905bf9faa8bfbd908df81c5349fe4' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\Reservation\\participation.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166475339f7bd2eb030-95297329',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5339f7bd4313c5_32190511',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5339f7bd4313c5_32190511')) {function content_5339f7bd4313c5_32190511($_smarty_tpl) {?>
<div id="reservationParticipation">
	<ul class="no-style">
		<li>
			<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ParticipantList"),$_smarty_tpl);?>
<br/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Add'),$_smarty_tpl);?>
 <input type="text" id="participantAutocomplete" class="input" style="width:250px;"/>
				or
				<button id="promptForParticipants" type="button" class="button" style="display:inline">
					<img src="img/user-plus.png"/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SelectUser'),$_smarty_tpl);?>

				</button>
				<button id="promptForGroupParticipants" type="button" class="button" style="display:inline">
					<img src="img/users.png"/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Groups'),$_smarty_tpl);?>

				</button>
			</label>

			<div id="participantList">
				<ul></ul>
			</div>
			<div id="participantDialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddParticipants'),$_smarty_tpl);?>
" class="dialog"></div>
			<div id="participantGroupDialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddParticipants'),$_smarty_tpl);?>
" class="dialog"></div>
		</li>
		<li>
			<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"InvitationList"),$_smarty_tpl);?>
<br/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Add'),$_smarty_tpl);?>
 <input type="text" id="inviteeAutocomplete" class="input" style="width:250px;"/>
				or
				<button id="promptForInvitees" type="button" class="button" style="display:inline">
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"user-plus.png"),$_smarty_tpl);?>

				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SelectUser'),$_smarty_tpl);?>

				</button>
				<button id="promptForGroupInvitees" type="button" class="button" style="display:inline">
					<img src="img/users.png"/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Groups'),$_smarty_tpl);?>

				</button>
			</label>

			<div id="inviteeList">
				<ul></ul>
			</div>
			<div id="inviteeDialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InviteOthers'),$_smarty_tpl);?>
" class="dialog"></div>
			<div id="inviteeGroupDialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'InviteOthers'),$_smarty_tpl);?>
" class="dialog"></div>
		</li>
	</ul>
</div><?php }} ?>
