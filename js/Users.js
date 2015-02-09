//pass any javascript object and get object in php by
//json_decode(stripslashes($_POST['theReturnOfThis']))
//an array is considered an object
//if the array is non-associative, it will be an array in php
//else if the array is associative, then it will be in object in php
function jsObj2phpObj(object)
{
	var json = "{";
	for(property in object)
	{
		var value = object[property];
		if(typeof(value) == "string")
		{
			json += '"' + property + '":' + jsObj2phpObj(value) + ',';
		}
		else
		{
			//if its an associative array
			if(!value[0])
			{
				json += '"' + property + '":' + jsObj2phpObj(value) + ',';
				
			}
			else
			{
				json += '"' + property + '":[';
				for(prop in value) json += '"' + value[prop] + '",';
				json = json.substr(0,json.length - 1) + "],";
			}
		}
		return json.substr(0,json.length - 1) + "}";
	}
}



/*
$("#sub").click(function()
{
	//var data = $("#saveData : input").serializeArray();
	$.post($("#userForm").attr("action"), $("#userForm : input").serializeArray(), function(info){
		$("#result").html(info);
	});
});

$("userForm").submit(function()
{
	return false;
});
*/
/*
$(document).ready(function()
{

	//var associative array
	var person = new Array();
	person['name'] = "Sean";
	//person['money] = "100";
	//person['mmarkers'] = "45";
	//person['tokens'] = "54";
	//person['prestige'] = "1";
	
	//Object
	obj = new Object;
	obj.car = "honda";
	obj.animal = ["Cat","Dog","Lizard"];
	
	

});
*/