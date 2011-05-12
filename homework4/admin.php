<div id="page">
<?php

session_start();

require_once "db.php";

//This file takes care of all the administration tasks in one place. Sometimes this is not a good practice, but in this case we only support limited and simple functionality
//Note the many consecutive checks for what data is submitted in the $_POST. Using these, we can determine the user intention and what they are trying to do on this particular load of the script.


//This function prints the edit and delete buttons for each product.
function print_control_block($id)
{

?>
	<div id = "toolset">
	<form method="post" action="admin.php"> <!-- We are using a separate form for each product. This is easier to process but user unfriendly. See the lecture for discussion on this -->
	<!--UPDATE PART-->
	<input type="hidden" name="edit_id" value="<?=$id?>"/> <!-- We need to know the id of the product -->
	<input type="submit" class="edit-but" name="to_edit" value="Edit"/> <!-- The value of the button is empty because we use a picture (see the CSS file) -->
	<!--DELETE PART-->
	<input type="hidden" name="del_id" value="<?=$id?>"/>
	<input type="submit" class="delete-but" name="delete" value="Delete"/> <!-- If we press the delete button, $_POST['delete'] will be set. If we press the edit one, then $_POST['edit'] will be set -->
	</form>
	</div>

<?php

}

//This function is not strictly necessary. We use it to print a product (obviously). This whole function is also in index.php, so we could put it in a separate include file.
function print_product($data)
{
	$id = $data['id'];
	$name = $data['name'];
	$info = $data['info'];
	$priority = $data['priority'];
	$imgsrc = $data['picture'];
	$added = $data['added'];
	$category = $data['Category'];
	
?>

		<div id="item">
		
		<?php print_control_block($id); ?>
		
			<table class="item-table">
				<tr><td><strong>Name:</strong> <?=$name?> <td rowspan="5"><img height = "50px" src="images/<?=$imgsrc?>"/></td></tr>
				<tr><td><strong>Category:</strong> <?=$category?> </td></tr>
				<tr><td><strong>Priority:</strong> <?=$priority?> </td></tr>
				<tr><td><strong>Added:</strong> <?=$added?> </td></tr>
			</table>
		</div>



<?php
}

//Here starts the real script. First we check if the user is logged in, and has the admin account

if (isset($_SESSION['uid']) && $_SESSION['ulevel'] == 1) //level 1 is the admin
{
	include "header.php"; //Remember that redirection in the "else" won't work if header.php is included before this point
	
	//process any POST requests
	
	//Trying to delete a product
	if (isset($_POST['delete']))
	{
		$del_id = db_escape($_POST['del_id']);
		$query = "DELETE FROM items WHERE id=".$del_id;
		
		db_query($query);
	}
	//Trying to add or edit a product. We share some functionality, so we combine these cases
	else if (isset($_POST['add']) || isset($_POST['edit']))
	{
		$name = db_escape($_POST['name']);
		$info = db_escape($_POST['info']);
		$category = db_escape($_POST['category']);
		$priority = db_escape($_POST['priority']);
		$picture = db_escape($_POST['picture']); //TODO: switch to FILE input. You can try it yourself. Now, the user would need to upload the file by FTP or using the filesystem and then provide the path to the filename of the picture. Note we use the folder "pics" to store the pictures".
			
		//Now we must diferentiate add from edit.
		if (isset($_POST['add']))
		{
			//Note: here we can use transactions. If the first query fails, the second shouldn't be executed; Consult the lecture to see an example
		
			$query = "INSERT INTO items (Category, name, priority, info, picture) VALUES ('$category', '$name', '$priority', '$info', '$picture')";
			db_query($query);
		}
		else
		{
			$edit_id = $_POST['edit_id'];
		
			$query = "UPDATE items SET name='$name', Category='$category', info='$info', priority=$priority, picture='$picture' WHERE id=$edit_id";
			db_query($query);
	
		}
	}
	//This is the case when the user pressed the edit button. Now we offer him a form with all the parameters of the product, easy for editing. Not very user friendly, but without using AJAX this is hard to do in a pretty way anyway.
	else if (isset($_POST['to_edit']))
	{
		//The code below is similar to print_product but this time we need to select one particular product based on id.
	
		$edit_id = db_escape($_POST['edit_id']);
		$query = "SELECT * FROM items WHERE id=$edit_id";
		$result = db_query($query);
		$row = db_get_row($result);
		
		$id = $row['id'];
		$category = $row['Category'];
		$name = $row['name'];
		$info = $row['info'];
		$priority = $row['priority'];
		$imgsrc = $row['picture'];
?>

		<div>
		<form method="post" action="admin.php">
			<input type="hidden" name="edit_id" value="<?=$edit_id?>"/>
			<table class="product-table-edit">
				<tr><td><strong>Name:</strong></td><td> <input type="text" name="name" value="<?=$name?>"> </td></tr>
				<tr><td><strong>Category:</strong></td><td> <input type="text" name="category" value="<?=$category?>">  </td></tr>
				<tr><td><strong>Priority:</strong></td><td> <input type="text" name="priority" value="<?=$priority?>">  </td></tr>
				<tr><td><strong>Information:</strong></td><td> <input type="text" name="info" value="<?=$info?>">  </td></tr>
				<tr><td><strong>Picture:</strong></td><td> <input type="text" name="picture" value="<?=$imgsrc?>">  </td></tr>
				<tr><td colspan="2"><input type="submit" name="edit" value="Save"/></td></tr> <!-- Pressing the edit button now will set $_POST['edit'] -->
			</table>
		</form>
		</div>

<?
	exit; //Exit because we shouldn't print other products now
	}
	
	//Finally, select all products and show them
	
	$query = "SELECT * FROM items";
	$result = db_query($query);
	
	while ($row = db_get_row($result))
	{
		print_product($row);
	}
	
	
?>
	<!-- Under the products list, show a form to add a new product. It is similar to the edit form -->

	<div id="item-add">
	<strong>Add a new wish</strong>
	<form method="post" action="admin.php">
		<table>
			<tr><td><strong>Name:</strong></td><td> <input type="text" name="name"> </td></tr>
			<tr><td><strong>Information:</strong></td><td> <input type="text" name="info">  </td></tr>
			<tr><td><strong>Priority:</strong></td><td> <input type="text" name="priority">  </td></tr>
			<tr><td><strong>Category:</strong></td><td> <input type="text" name="category">  </td></tr>
			<tr><td><strong>Picture:</strong></td><td> <input type="text" name="picture">  </td></tr>
			<tr><td colspan="2"><input type="submit" name="add" value="Add"/></td></tr> <!-- pressing this will set $_POST['add'] -->
		</table>
	</form>
	</div>
	

<?php
	
	include "footer.php";
}
else //Nobody is logged in, or it's not the admin user - we redirect to login
{
	header("Location: login.php");
	exit;
}

?>
</div>