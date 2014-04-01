<?php /* Smarty version Smarty-3.1.16, created on 2014-03-31 23:31:17
         compiled from "C:\wamp\www\slots\lang\en_us\AccountCreation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:239865339fac53656a0-41476393%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f1227684da59463568bec557e93afb64b22bf3c' => 
    array (
      0 => 'C:\\wamp\\www\\slots\\lang\\en_us\\AccountCreation.tpl',
      1 => 1391287724,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '239865339fac53656a0-41476393',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'To' => 0,
    'EmailAddress' => 0,
    'FullName' => 0,
    'Phone' => 0,
    'Organization' => 0,
    'Position' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5339fac5516011_23889547',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5339fac5516011_23889547')) {function content_5339fac5516011_23889547($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('..\..\tpl\Email\emailheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<p><?php echo $_smarty_tpl->tpl_vars['To']->value;?>
,</p>

<p>A new user has registered with the following information:<br/>
Email: <?php echo $_smarty_tpl->tpl_vars['EmailAddress']->value;?>
<br/>
Name: <?php echo $_smarty_tpl->tpl_vars['FullName']->value;?>
<br/>
Phone: <?php echo $_smarty_tpl->tpl_vars['Phone']->value;?>
<br/>
Organization: <?php echo $_smarty_tpl->tpl_vars['Organization']->value;?>
<br/>
Position: <?php echo $_smarty_tpl->tpl_vars['Position']->value;?>
</p>

<?php echo $_smarty_tpl->getSubTemplate ('..\..\tpl\Email\emailfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
