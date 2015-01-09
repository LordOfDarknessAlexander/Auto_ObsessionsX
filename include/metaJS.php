<!--?php
//this script generates the <script> tags to be included in the <head> of the page's html document
function incJS($str){
	//script generator
	echo "<script type='text/javascript' src='js/".$str.".js'></script>";
}
$paths = array(
	"jquery.2.1.1.min",
	"payRequest",
	"Vector",
	"GameMode",
	"Users",
	"requestAnimationFrame"
);
foreach($paths as $p){incJS($p);}
?-->
<script type="text/javascript" src="https://www.paypalobjects.com/js/external/dg.js"></script>
<script type="text/javascript" src="js/jquery.2.1.1.min.js"></script>
<script type="text/javascript" src="js/payRequest.js"></script>
<script type="text/javascript" src="js/Vector.js"></script>
<script type="text/javascript" src="js/GameMode.js"></script>
<script type="text/javascript" src="js/Users.js"></script>
<script type="text/javascript" src="js/requestAnimationFrame.js"></script>