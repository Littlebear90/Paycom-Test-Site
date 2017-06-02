<!doctype html>
<html>
<head>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="app.css"><!--the css file for the webpage-->

	<title>To Do List</title><!--webpage title-->
</head>
<body>
	<!--Webpage written with php. The php starts with the class listItem and sets up the helper methods of the class. The initial data of the webpage is gathered from the file, "ToDoItems.txt",( which could be changed to a database later, for a more ideal To Do list that would keep its state rather than defaulting back to the orginial). Then after some short processing of the data retrieved from the file, the php then creates the initial page layout.--> 
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

		//This half of the php is responsible for creating initial webpage state using the array of "listItem objects"

		//$index variable used as part of the id attribute of the elements to ensure unique id's
		$index=2;

		//beginning of the layout table html
		echo"<table id=\"itemTable\">";

		//html for the To Do Cell
		echo"<tr id=\"1\"><td colspan=\"4\" align=\"center\" class=\"toDoCell\"><b>To Do</b></td></tr>";

			//the for each loop iterates through the array of "listItem" ojects
			foreach($itemArray as $element){

				//new table row
				echo"<tr id=\"".$index."\">";

					//The checkbox cell is created and given the completed status of the objects in its value attribute
					//If completed status is already done("true"), then the checkbox is defaulted to checked state
					echo"<td class=\"checkboxCell\"><input type=\"checkbox\" class=\"checkBox\" id=\"Checkbox-".$index."\" value=\"".$element->get_completed()."\"".(($element->get_completed() == "true")?" checked='checked'": "")." /></td>";

					//The item cell is created and given the text of the objects to render onto the webpage
					//If completed status is already done("true"), then the text will be grayed out and striked
					echo"<td class=\"tableItem\" id=\"Item-".$index."\"".(($element->get_completed() == "true")?"style='text-decoration:line-through; opacity:0.4'": "").">".$element->get_toDoItem()."</td>";

					//The delete button cell, renders the html for the "Delete" button
					echo"<td><input type=\"button\" class=\"deleteBtn\" id=\"Delete-".$index."\" value=\"Delete\"/></td>";

					//The edit button cell, renders the html for the "Edit" button
					echo"<td><input type=\"button\" class=\"editBtn\" id=\"Edit-".$index."\" value=\"Edit\" /></td>";

				//end table row
				echo"</tr>";

				//increment the index to keep the id attributes unique to each row
				$index++;
			}	

		//html for the Add Item cell
		echo"<tr id=\"".$index."\"><td colspan=\"4\" align=\"center\" class=\"addItemCell\">Add Item</td></tr>";

		//end of the layout table html
		echo"</table>";
	?>
	<script src="jquery-3.2.1.js"></script><!--jquery library-->
	<script src="app.js"></script><!--the javascript file for the webpage-->
</body>
</html>

