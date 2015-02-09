<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<!-- Include JS File Here -->
<link href="style.css" rel="stylesheet"/>
<!-- Include JS File Here -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$("#btn").click(function(){
var vname = $("#fname").val();
var vmoney = $("#money").val();
var vmmarker = $("#mmarker").val();
var vtoken = $("#token").val();
var vprestige = $("#prestige").val();
if(vname=='' && vmoney=='')
{
alert("Please fill out the form");
}
else if(vname=='' && vemail!==''){alert('Name field is required')}
else if(vmoney='' && vname!==''){alert('Email field is required')}
else{
$.post("jquery_post.php", //Required URL of the page on server
{ // Data Sending With Request To Server
name:vname,
money:vmoney,
m_marker:vmmarker,
token:vtoken,
prestige:vprestige,
},
function(response,status){ // Required Callback Function
alert("*----Received Data----*\n\nResponse : " + response+"\n\nStatus : " + status);//"response" receives - whatever written in echo of above PHP script.
$("#form")[0].reset();
});
}
});
});
</script>
</head>
<body>
<div id="main">
<h2>jQuery Ajax $.post() Method</h2>
<hr>
<form id="form" method="post">
<div id="namediv"><label>Name</label>
<input type="text" name="fname" id="fname" placeholder="Name"/><br></div>
<div id="moneydiv"><label>Money</label>
<input type="text" name="money" id="money" placeholder="Money"/></div>
</form>
<button id="btn">Send Data</button>
</div>
</body>
</html>