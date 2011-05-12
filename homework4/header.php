<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WishList</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
<div id="header-wrapper">
<?php
	if (isset($_SESSION['username'])) //If a user is logged in, show a welcome message on their left
	{
?>
	<div id="welcome">Welcome, <?=$_SESSION['username']?></div>
<?php
	}

function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
?>
	<div id="header">
		<div id="logo">
			<h1><a href="index.php"><span>My</span>Wishlist</a></h1>
		</div>

	<div id="menu"> <!-- Navigation panel -->
    	<ul>
        <li <? if (curPageName()=="index.php") {echo("class=\"current_page_item\"");} ?> > <a href="index.php">Къща</a></li>
        <li <? if (curPageName()=="categories.php") {echo("class=\"current_page_item\"");} ?> ><a href="categories.php">Категории</a> </li>	
		<li <? if (curPageName()=="admin.php") {echo("class=\"current_page_item\"");} ?> > <a href="admin.php">Администрация</a></li>
        <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] > -1){ //user is logged?>
		<li><a href="login.php?logout=1">Излизане</a></li>
		<?php } ?>
		</ul>
	</div> <!--menu-->

    </div> <!--header-->
</div> <!--header-wrapper-->

