<?php /* Smarty version Smarty-3.0.7, created on 2011-05-10 22:04:55
         compiled from "templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:180424dc99a6700e315-29443463%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f90be83b235fb03cc225b11607032e9ddd415899' => 
    array (
      0 => 'templates\\index.tpl',
      1 => 1305057771,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180424dc99a6700e315-29443463',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>
<?php  $_smarty_tpl->tpl_vars['css'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cssFiles')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['css']->key => $_smarty_tpl->tpl_vars['css']->value){
?>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
" type="text/css" media="screen" />
<?php }} ?>

<?php  $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('jsFiles')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['js']->key => $_smarty_tpl->tpl_vars['js']->value){
?>
<script src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
" type="text/javascript" language="javascript" charset="utf-8"></script>
<?php }} ?>

</head>
<body>
<?php echo $_smarty_tpl->getVariable('message')->value;?>

<?php echo $_smarty_tpl->getVariable('message1')->value;?>

</body>
</html>