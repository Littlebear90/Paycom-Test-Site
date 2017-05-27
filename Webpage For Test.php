<!doctype html>
<html>
<head>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="app.css">
</head>

<body>

	<!--<?php
		$toDo = array("Buy Milk", "Get Eggs", "Acquire Sugar");
		//for($i=0;$i<sizeof($toDo);$i++){echo $toDo[$i] . "<br>";}
		for($i=0;$i<sizeof($toDo);$i++){
			echo "<input type=\"checkbox\" name=\"item".$i."\" value=\"".$toDo[$i]."\">$toDo[$i] EDIT DELETE<br>";
		}
	?>-->

	<!--<?php include("class_toDoItem.php");?>
	<?php 
		$item = new toDoItem();
		$item->set_item("Buy Milk");
		echo "You need to ". $item->get_item();
	?>-->

	<?php
		
	?>
	<script src="jquery-3.2.1.js"></script>
	<script src="app.js"></script>
</body>
</html>