﻿<?php
include "header.php";
?>

<div id="page">
	<div id="content">

<?php

session_start();

require_once "db.php";

	//Select all products
	
	$query = "SELECT * FROM items order by category";
	$result = db_query($query);
	$categories = array();
	$tempCategory='';
	while ($row = db_get_row($result))
	{
		$id = $row['id'];
		$name = htmlspecialchars($row['name']); 
		$info = $row['info'];
		$category = htmlspecialchars($row['Category']);
		$imgsrc = $row['picture'];
		$added = $row['added'];
		$id = $row['id'];
		if (!in_array($category, $categories)){
		array_push($categories, $category);}
		if ($tempCategory != $category){
		echo("<h1>".$category.":</h1>");
		$tempCategory=$category;
		}
?>
	
	<div class="post">
				<h2 class="title"><a href="#"><?=$name?> </a></h2>
                <span class="date"><?=$added?></span>&nbsp;<span class="links"><a href="categories.php" title=""><?=$category?></a></span></p>
				<div class="entry">
					<p><?=$info?></p>
				</div>
	</div>
<?php
	}
?>
	</div><!--end #content-->
	<div id="sidebar">
			<ul>
				<li>
					<a href = "categories.php"><h2>Категории</h2></a>
					<ul>
<?php foreach($categories as $category){ ?>
						<li><a href="#"><?=$category?></a></li>
<?php } ?>							
					</ul>
				</li>
			</ul>
	</div><!--end #sidebar-->
		<div style="clear: both;">&nbsp;</div>
</div> <!--end #page-->

<?php
	include "footer.php";
?>
