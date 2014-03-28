<?php /* Smarty version Smarty-3.1.16, created on 2014-03-18 18:36:27
         compiled from "C:\xampp\htdocs\booked\tpl\Admin\Attributes\manage_attributes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149615328841b9dc169-99358776%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71d16324b7a02c436695511123c76858f794fae9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\booked\\tpl\\Admin\\Attributes\\manage_attributes.tpl',
      1 => 1391287728,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149615328841b9dc169-99358776',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Types' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5328841be10c75_95646498',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5328841be10c75_95646498')) {function content_5328841be10c75_95646498($_smarty_tpl) {?>

<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/admin.css'), 0);?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CustomAttributes'),$_smarty_tpl);?>
</h1>

<div id="customAttributeHeader">

<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Category'),$_smarty_tpl);?>
:
	<select id="attributeCategory">
		<option value="<?php echo CustomAttributeCategory::RESERVATION;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CategoryReservation'),$_smarty_tpl);?>
</option>
		<option value="<?php echo CustomAttributeCategory::USER;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'User'),$_smarty_tpl);?>
</option>
		<option value="<?php echo CustomAttributeCategory::RESOURCE;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Resource'),$_smarty_tpl);?>
</option>
		<option value="<?php echo CustomAttributeCategory::RESOURCE_TYPE;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceType'),$_smarty_tpl);?>
</option>
	</select>
</label>

<a href="#" id="addAttributeButton"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'plus-circle-frame.png'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddAttribute'),$_smarty_tpl);?>
</a>
</div>

<div id="addAttributeDialog" class="dialog attributeDialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddAttribute'),$_smarty_tpl);?>
">

	<form id="addAttributeForm" ajaxAction="<?php echo ManageAttributesActions::AddAttribute;?>
" method="post">
		<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Type'),$_smarty_tpl);?>
:</span>
		<select <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ATTRIBUTE_TYPE'),$_smarty_tpl);?>
 id="attributeType">
			<option value="<?php echo CustomAttributeTypes::SINGLE_LINE_TEXTBOX;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['Types']->value[CustomAttributeTypes::SINGLE_LINE_TEXTBOX]),$_smarty_tpl);?>
</option>
			<option value="<?php echo CustomAttributeTypes::MULTI_LINE_TEXTBOX;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['Types']->value[CustomAttributeTypes::MULTI_LINE_TEXTBOX]),$_smarty_tpl);?>
</option>
			<option value="<?php echo CustomAttributeTypes::SELECT_LIST;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['Types']->value[CustomAttributeTypes::SELECT_LIST]),$_smarty_tpl);?>
</option>
			<option value="<?php echo CustomAttributeTypes::CHECKBOX;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['Types']->value[CustomAttributeTypes::CHECKBOX]),$_smarty_tpl);?>
</option>
		</select>

		<div class="textBoxOptions">
			<div class="attributeLabel">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DisplayLabel'),$_smarty_tpl);?>
:</span>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('name'=>'ATTRIBUTE_LABEL','class'=>"required"),$_smarty_tpl);?>

			</div>
			<div class="attributeRequired">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Required'),$_smarty_tpl);?>
:</span>
				<input type="checkbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ATTRIBUTE_IS_REQUIRED'),$_smarty_tpl);?>
 />
			</div>
			<div class="attributeUnique">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AppliesTo'),$_smarty_tpl);?>
:</span>
				<a href="#" class="appliesTo"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'All'),$_smarty_tpl);?>
</a>
				<input type="hidden" class="appliesToId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ATTRIBUTE_ENTITY'),$_smarty_tpl);?>
 id="addAttributeEntityId" />
			</div>
			<div class="attributeValidationExpression">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ValidationExpression'),$_smarty_tpl);?>
:</span>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('name'=>'ATTRIBUTE_VALIDATION_EXPRESSION'),$_smarty_tpl);?>

			</div>
			<div class="attributePossibleValues" style="display:none">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'PossibleValues'),$_smarty_tpl);?>
:</span>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('name'=>'ATTRIBUTE_POSSIBLE_VALUES','class'=>"required"),$_smarty_tpl);?>
 <span class="note">(<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CommaSeparated'),$_smarty_tpl);?>
)</span>
			</div>
			<div class="attributeSortOrder">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SortOrder'),$_smarty_tpl);?>
:</span>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('name'=>'ATTRIBUTE_SORT_ORDER','maxlength'=>3,'width'=>"40px"),$_smarty_tpl);?>

			</div>
		</div>

		<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"plus-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Add'),$_smarty_tpl);?>
</button>
		<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>

		<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ATTRIBUTE_CATEGORY'),$_smarty_tpl);?>
  id="addCategory" value="" />
	</form>
</div>

<div id="deleteDialog" class="dialog" style="display:none;" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
">
	<form id="deleteForm"  ajaxAction="<?php echo ManageAttributesActions::DeleteAttribute;?>
" method="post">
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
	</form>
</div>

<div id="editAttributeDialog" class="dialog attributeDialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'EditAttribute'),$_smarty_tpl);?>
">

	<form id="editAttributeForm" ajaxAction="<?php echo ManageAttributesActions::UpdateAttribute;?>
" method="post">
		<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Type'),$_smarty_tpl);?>
:</span>
		<span class='editAttributeType'
			  id="editType<?php echo CustomAttributeTypes::SINGLE_LINE_TEXTBOX;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['Types']->value[CustomAttributeTypes::SINGLE_LINE_TEXTBOX]),$_smarty_tpl);?>
</span>
		<span class='editAttributeType'
			  id="editType<?php echo CustomAttributeTypes::MULTI_LINE_TEXTBOX;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['Types']->value[CustomAttributeTypes::MULTI_LINE_TEXTBOX]),$_smarty_tpl);?>
</span>
		<span class='editAttributeType'
			  id="editType<?php echo CustomAttributeTypes::SELECT_LIST;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['Types']->value[CustomAttributeTypes::SELECT_LIST]),$_smarty_tpl);?>
</span>
		<span class='editAttributeType'
			  id="editType<?php echo CustomAttributeTypes::CHECKBOX;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['Types']->value[CustomAttributeTypes::CHECKBOX]),$_smarty_tpl);?>
</span>

		<div class="textBoxOptions">
			<div class="attributeLabel">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DisplayLabel'),$_smarty_tpl);?>
:</span>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('name'=>'ATTRIBUTE_LABEL','class'=>"required",'id'=>'editAttributeLabel'),$_smarty_tpl);?>

			</div>
			<div class="attributeRequired">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Required'),$_smarty_tpl);?>
:</span>
				<input type="checkbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ATTRIBUTE_IS_REQUIRED'),$_smarty_tpl);?>
 id='editAttributeRequired'/>
			</div>
			<div class="attributeUnique">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AppliesTo'),$_smarty_tpl);?>
:</span>
				<a href="#" class="appliesTo"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'All'),$_smarty_tpl);?>
</a>
				<input type="hidden" class="appliesToId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ATTRIBUTE_ENTITY'),$_smarty_tpl);?>
 id='editAttributeEntityId' />
			</div>
			<div class="attributeValidationExpression">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ValidationExpression'),$_smarty_tpl);?>
:</span>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('name'=>'ATTRIBUTE_VALIDATION_EXPRESSION','id'=>'editAttributeRegex'),$_smarty_tpl);?>

			</div>
			<div class="attributePossibleValues" style="display:none">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'PossibleValues'),$_smarty_tpl);?>
:</span>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('name'=>'ATTRIBUTE_POSSIBLE_VALUES','class'=>"required",'id'=>"editAttributePossibleValues"),$_smarty_tpl);?>
 <span
					class="note">(<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CommaSeparated'),$_smarty_tpl);?>
)</span>
			</div>
			<div class="attributeSortOrder">
				<span class="wideLabel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'SortOrder'),$_smarty_tpl);?>
:</span>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('name'=>'ATTRIBUTE_SORT_ORDER','maxlength'=>3,'width'=>"40px",'id'=>"editAttributeSortOrder"),$_smarty_tpl);?>

			</div>
		</div>

		<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
		<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
	</form>
</div>
<div style="clear:both"></div>

<div id="attributeList">
</div>

<div id="entityChoices">
</div>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"admin-ajax-indicator.gif",'class'=>"indicator",'id'=>"indicator",'style'=>"display:none;"),$_smarty_tpl);?>


<input type="hidden" id="activeId" value=""/>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/attributes.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>


<script type="text/javascript">

	$(document).ready(function () {
	var attributeOptions = {
		submitUrl: '<?php echo $_SERVER['SCRIPT_NAME'];?>
',
		changeCategoryUrl: '<?php echo $_SERVER['SCRIPT_NAME'];?>
?<?php echo QueryStringKeys::DATA_REQUEST;?>
=attributes&<?php echo QueryStringKeys::ATTRIBUTE_CATEGORY;?>
=',
		singleLine: '<?php echo CustomAttributeTypes::SINGLE_LINE_TEXTBOX;?>
',
		multiLine: '<?php echo CustomAttributeTypes::MULTI_LINE_TEXTBOX;?>
',
		selectList: '<?php echo CustomAttributeTypes::SELECT_LIST;?>
',
		checkbox: '<?php echo CustomAttributeTypes::CHECKBOX;?>
',
		allText: "<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>strtr('All', array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ))),$_smarty_tpl);?>
",
		categories: {
			reservation: <?php echo CustomAttributeCategory::RESERVATION;?>
,
			resource: <?php echo CustomAttributeCategory::RESOURCE;?>
,
			user: <?php echo CustomAttributeCategory::USER;?>
,
			resource_type: <?php echo CustomAttributeCategory::RESOURCE_TYPE;?>

		},
		resourcesUrl: 'manage_resources.php?<?php echo QueryStringKeys::DATA_REQUEST;?>
=all',
		usersUrl: 'manage_users.php?<?php echo QueryStringKeys::DATA_REQUEST;?>
=all',
		resourceTypesUrl: 'manage_resource_types.php?<?php echo QueryStringKeys::DATA_REQUEST;?>
=all'
	};

	var attributeManagement = new AttributeManagement(attributeOptions);
	attributeManagement.init();
	});
</script>
<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
