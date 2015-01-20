<?php
require_once '../include/html.php';
//require_once './secure.php';
//if page is being accessed without proper authority, exit and display login, else render page
//secureLogin();
html::simpleHead('Security');
?>
<p>Here's some stuff we do to make the user feel secure!</p>
<?php html::footer();?>