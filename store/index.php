<?php 
require_once 'AO_UI.php';
    //function paypalBtn($id, $val){
    //inserts a button into a form implementing the 'PayPal' api
    //<input type='image' id='<echo $id>' value='<echo $val>'><br>
    //}
    function paypalPath(){?>'https://www.sandbox.paypal.com/webapps/adaptivepayment/flow/pay'<?php
    }
class pp{
    //encapsulates variables and functions related to the paypal store API
    const SANDBOX = true; 
    
    function storePath(){
        //FALSE on server AND when live,
        //TRUE when site's under developement or testing locally(with xampp)
        ?>https://www.<?php
        //if(pp::SANDBOX){
            ?><!--sandbox.--><?php
        }?>paypal.com/cgi-bin/webscr<?php
    }
}
function ic(){
    ?><input type="hidden" name="cmd" value="_s-xclick">
<?php
}
?>

<div id='AddFunds'>
  <!--  <h1>AddFunds</h1>  -->
    <?php backBtn();?>
	<?php homeBtn();?>
    <!--button id='addFundsBackButton'>Back</button-->
	<!--a href='<php //pp::minorFundsPath();>'><input type='image' id='addMinorFundsBtn' value='chump change'></a-->
    <div id='cash'>
        <form id='c50' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="FL8LXKLA32L7L">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>
        <form id='c200' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="67Y652AAYHX2N">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>
        <form id='c500' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="KMZPZHDR3RVYQ">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>
        <form id='c1000' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="KC3TWE84J7S42">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>
    </div>
    <div id='tokens'>
        <form id='t3' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="XZCKNKNJHAA2S">
            <input type="image" src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif' name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>
        <form id='t5' action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="NCPWY2FWXBD9L">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>
        
        <form id='t10' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="FM7WWV76Q54YG">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>

        <form id='t20' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="KTV2Q8T8MMY5U">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>
    </div>
</div>