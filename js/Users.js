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