<?php /* Smarty version Smarty-3.1.16, created on 2014-03-31 23:17:46
         compiled from "C:\wamp\www\slots\tpl\Controls\Attributes\SingleLineTextbox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:147575339f79ab97a52-38057850%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0ead437b131e668508cb175e356ceb3127bcd93' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\tpl\\Controls\\Attributes\\SingleLineTextbox.tpl',
      1 => 1391287730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '147575339f79ab97a52-38057850',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'attributeName' => 0,
    'attribute' => 0,
    'align' => 0,
    'readonly' => 0,
    'class' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5339f79ad33579_11017450',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5339f79ad33579_11017450')) {function content_5339f79ad33579_11017450($_smarty_tpl) {?>
<label class="customAttribute" for="<?php echo $_smarty_tpl->tpl_vars['attributeName']->value;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attribute']->value->Label(), ENT_QUOTES, 'UTF-8', true);?>
:</label>
<?php if ($_smarty_tpl->tpl_vars['align']->value=='vertical') {?>
<br/>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['readonly']->value) {?>
<span class="attributeValue <?php echo $_smarty_tpl->tpl_vars['class']->value;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attribute']->value->Value(), ENT_QUOTES, 'UTF-8', true);?>
</span>
<?php } else { ?>
<input type="text" id="<?php echo $_smarty_tpl->tpl_vars['attributeName']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['attributeName']->value;?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attribute']->value->Value(), ENT_QUOTES, 'UTF-8', true);?>
" class="customAttribute textbox <?php echo $_smarty_tpl->tpl_vars['class']->value;?>
" />
<?php }?><?php }} ?>
