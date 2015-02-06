$("#sub").click(function()
{
	var data = $("#saveData : input").serializeArray();
	$.post{("$#myForm").attr("action"), data, function(info)
	{
		$("#result").html(info);
	});
});