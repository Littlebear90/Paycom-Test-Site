// The main function controls the events of the webpage
var main = function(){

	//the click event for checking a checkbox
	//using the "on" binding to ensure our dynamically created checkboxs get the click event
	$("table").on("click",".checkBox", checkBoxClick);

	//the click event for deleting an item
	//using the "on" binding to ensure our dynamically created delete buttons get the click event
	$("table").on("click",".deleteBtn",deleteButtonClick)

	//the click event for editing an item
	//using the "on" binding to ensure our dynamically created edit buttons get the click event
	$("table").on("click",".editBtn",editButtonClick)

	//the click event for adding an item
	$(".addItemCell").click(addItemClick);
}
$(document).ready(main);

//Function: gets the row number and then checks to see if the item already
// has css styling that would correspond to a "true" result from the php page
// if so, it then removes it and adds it depending on the value of the checkbox
var checkBoxClick = function(){
	rowNum=$(this).closest("tr").attr("id"); //get the row number

	//checks if the checkbox value is true if so it applies css that corresponds
	// with the php page rendering of the listItem as completed
	if($("#Checkbox-"+rowNum).val()=="true"){
		$("#Item-"+rowNum).css({"text-decoration":'',"opacity":''});
		$("#Checkbox-"+rowNum).attr({"value":"false"});
	}else{
		$("#Item-"+rowNum).css({"text-decoration":"line-through","opacity":"0.4"});
		$("#Checkbox-"+rowNum).attr({"value":"true"});		
	}	
};

//Function: gets the row number and then gets the text value that of the listItem
// then prompts the user with two confirmation messages to ensure the user really
// wants to delete the listItem from the "To Do" list
var deleteButtonClick = function(){
	rowNum=$(this).closest("tr").attr("id"); //get the row number
	id=$("#Item-"+rowNum).text(); //get the listItem text

	//confirmation messages prompt the user to ensure they really want to delete the item
	var confirmation = confirm("Are you sure you want to delete \"" + id + "\" from your To Do list?");
	if(confirmation == true){
		$(this).closest("tr").remove(); //removes the entire row from the list
	}
};

//Function: gets the row number and then gets the text value of the listItem
// then prompts the user to make their edits to the text. The orginal text is
// shown in the edit box so the user can make the needed edits
var editButtonClick = function(){
	rowNum=$(this).closest("tr").attr("id"); //gets the row number
	id=$("#Item-"+rowNum).text(); //get the listItem text

	//prompts the user so the user can make the wanted changes
	editItem = prompt("",id);
	if(editItem){
		$("#Item-"+rowNum).text(editItem);
		id=$("#Item-"+rowNum).text(); //the new edited text
	}
};

//Function: prompts the user for the new item, by default the completed status will be false.
// if the user does not hit cancel and tries to enter an empty string, they will be re-prompted
// indefinatly until they hit cancel or type in a new item. The new item is then added to the
// table right below the last entry.
var addItemClick = function(){
	var addItem = prompt("Enter the new task for your To Do list");
	//will indefinatly ask the user for input till they hit the cancel button or type in a string
	while(addItem===""){
		addItem=prompt("Please enter an item for your To Do list");
	}
	//double check that addItem is not null
	if(addItem){	
		rowNum=$(this).closest("tr").attr("id");//find the closest table row
		var rowNum = parseInt(rowNum);

		//adds the new item to the table above the "Add Item" button to ensure that it will always be added last to the list
		$("#itemTable tr:last").before("<tr id="+rowNum+"><td class='checkboxCell'><input type='checkbox' class='checkBox' id='Checkbox-"+rowNum+"' value='false' /></td><td class='tableItem' id='Item-"+rowNum+"'>"+addItem+"</td><td><input type='button' class='deleteBtn' id='Delete-"+rowNum+"'' value='Delete' /></td><td><input type='button' class='editBtn' id='Edit-"+rowNum+"'' value='Edit' /></td></tr>");

		//increment the row id so that no duplication of id attributes occur
		rowNum=rowNum+1;
		$(this).closest("tr").attr("id",rowNum);
	}
};
