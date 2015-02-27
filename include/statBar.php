<div id='statBar'>             
	<label id='money'>Money: </label>
	<label id='tokens'>Tokens:</label>
	<label id='prestige'>Prestige:</label>
	<label id='m_marker'>Mile Markers:</label>  
	<?php

session_start();
echo '<h2>Welcome to Auto-Obsessions\' Game ';
if (isset($_SESSION['uname']))
{
	echo "{$_SESSION['uname']}";
}
echo '</h2>';

?>
<div id="status"></div>
</div> 