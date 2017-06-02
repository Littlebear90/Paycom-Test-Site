<!doctype html>
<html>
<head>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="app.css"><!--the css file for the webpage-->

	<title>To Do List</title><!--webpage title-->
</head>
<body>

	<!--Webpage written with php. The php starts with the class listItem and sets up the helper methods of the class. The initial data of the webpage is gathered from the file, "ToDoItems.txt",( which could be changed to a database later, for a more ideal To Do list that would keep its state rather than defaulting back to the orginial). Then after some short processing of the data retrieved from the file, the html creates the page--> 

	<?php
		//This class is for the objects we will be using, get and set methods initialized here		
		class listItem{
			var $listItem;	//The text of the "To Do" item
			var $completed;	//The completed state of the "To Do" item(represented as a string)

			//class object set methods
			function set_toDoItem($new_listItem){$this->listItem = $new_listItem;}
			function set_completed($new_completed){$this->completed = $new_completed;}
			//class object get methods
			function get_toDoItem(){return $this->listItem;}
			function get_completed(){return $this->completed;}			
		}

		//an array to file with "listItem objects"
		$itemArray = array();

		//This is the read in of the initial data for the webpage
		$lineArray = explode("\n", file_get_contents("ToDoItems.txt"));

		//Trim off the white space and new lines from our data elements
		$lineArray = array_map("trim", $lineArray);

		//This loop fills in the array for the "listItem objects" with the "listItem objects"
		for($i=0;$i<sizeof($lineArray);$i=$i+2){
			//new instance of the oject class
			$item = new listItem();

			//sets the object values($listItem and $completed)
			$item->set_toDoItem($lineArray[$i]);
			$item->set_completed($lineArray[$i+1]); //add one to the index to get the status of the item

			//pushes the new items into the array for the "listItem objects"
			$itemArray[]=$item;
		}
	?>
	<!--Using a php variable to ensure the table rows have unique id attributes-->
	<?php $index=2 ?>
	<!--Beginning of the table HTML-->
	<table id=itemTable>

		<!--Html for the "To Do" above the item list-->
		<tr id = "1"><td colspan="4" align="center" class="toDoCell"><b>To Do</b></td></tr>

		<!--Using a php foreach loop for the initial body HTML of the list-->
		<?php foreach ($itemArray as $element) : ?>

			<!--Table Row-->
			<tr id="<?php echo $index ?>">

				<!--Html for the checkbox that shows completed status of the item on the list.
					The php ternary statement decides if the item on the list has already been completed by using the get_completed method of the object, if true defaults to checked-->
				<td class="checkboxCell"><input type="checkbox" class="checkBox" id="Checkbox-<?php echo $index?>" value="<?php echo $element->get_completed()?>"<?php echo $element->get_completed() == "true" ? "checked='checked'" : "" ?></td>

				<!--Html for the text of the listItem object, uses same ternary statement from the checkbox to determine if the text should be striked and grayed out to represent a completed item-->
				<td class="tableItem" id="Item-<?php echo $index ?>"<?php echo $element->get_completed() == "true" ? "style='text-decoration:line-through; opacity:0.4'" : "" ?>><?php echo $element->get_toDoItem()?></td>

				<!--Html for the delete button-->
				<td><input type="button" class="deleteBtn" id="Delete-<?php echo $index ?>" value="Delete" /></td>

				<!--Html for the edit button-->
				<td><input type="button" class="editBtn" id="Edit-<?php echo $index ?>" value="Edit" /></td>

			</tr><!--end table row-->

			<!--Increment the index count to ensure each row has a unique id-->
			<?php $index++ ?>

		<?php endforeach; ?><!--ends the foreach loop-->
		
		<!--Html for the "Add Item" below the list-->
		<tr id="<?php echo $index ?>"><td colspan="4" align="center" class="addItemCell">Add Item</td></tr>
	</table>
	<script src="jquery-3.2.1.js"></script><!--jquery library-->
	<script src="app.js"></script><!--the javascript file for the webpage-->
</body>
</html>