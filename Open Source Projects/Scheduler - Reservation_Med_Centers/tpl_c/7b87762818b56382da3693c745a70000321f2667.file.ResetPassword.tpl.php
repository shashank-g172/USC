<?php /* Smarty version Smarty-3.1.16, created on 2014-03-22 00:24:38
         compiled from "C:\xampp\htdocs\booked\lang\en_us\ResetPassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10717532cca36d64ec9-67131663%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b87762818b56382da3693c745a70000321f2667' => 
    array (
      0 => 'C:\\xampp\\htdocs\\booked\\lang\\en_us\\ResetPassword.tpl',
      1 => 1391287724,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10717532cca36d64ec9-67131663',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TemporaryPassword' => 0,
    'ScriptUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_532cca36e537d0_07193517',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_532cca36e537d0_07193517')) {function content_532cca36e537d0_07193517($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('..\..\tpl\Email\emailheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


Here is your temporary Booked Scheduler password: <?php echo $_smarty_tpl->tpl_vars['TemporaryPassword']->value;?>


<br/>

Your old password will no longer work.
<br/>
<br/>

Please <a href="<?php echo $_smarty_tpl->tpl_vars['ScriptUrl']->value;?>
">Log in to Booked Scheduler</a> and change your password as soon as possible.

<?php echo $_smarty_tpl->getSubTemplate ('..\..\tpl\Email\emailfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
