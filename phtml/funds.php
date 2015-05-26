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
    //const SANDBOX = true; 
    
    function storePath(){
        //FALSE on server AND when live,
        //TRUE when site's under developement or testing locally(with xampp)
        ?>https://www.<?php
        //if(pp::SANDBOX){
            //><--sandbox.<?php
        //}?>paypal.com/cgi-bin/webscr?<?php
    }
    public static function eSP(){
        //echo store path
        echo "https://www.paypal.com/cgi-bin/webscr";
    }
    public static function form($id, $storeKey, $path){
        //form attributes?><form id='<?php
            echo $id;
        ?>' action='<?php
            pp::eSP();
        ?>' method='post' target='_top'><?php
            ic();
            hi($storeKey);
            fi($path);
        ?>
        </form>
<?php
    }
    function minorFundsPath(){pp::storePath();?>cmd=_express-checkout&amp;token=EC-5XT8625765497150M<?php
    }
}
function hi($str){
    //hidden ui input
    ?><input type='hidden' name='hosted_button_id' value='<?php
    echo $str;
?>'>
<?php
}
function fi($str){
    //form input button?><input type='image' name='submit' src="images/store/<?php
        echo $str;
    ?>.png" alt='PayPal - The safer, easier way to pay online!'>
<?php
}
function ic(){
    ?><input type='hidden' name='cmd' value='_s-xclick'>
<?php
}
//html::header();
?>

<div id='AddFunds'>
    <?php backBtn(); homeBtn();?>
    <div id='cash'>
<?php
        pp::form('c50','FL8LXKLA32L7L', "cash/fifty");
        pp::form('c200','67Y652AAYHX2N', "cash/twoHundred");
        pp::form('c500','KMZPZHDR3RVYQ', "cash/fiveHundred");
        pp::form('c1000','KC3TWE84J7S42', "cash/oneMil");
?>
    </div>
    <div id='tokens'>
<?php
        pp::form('t3','XZCKNKNJHAA2S', "tokens/three");
        pp::form('t5','NCPWY2FWXBD9L', "tokens/five");
        pp::form('t10','FM7WWV76Q54YG', "tokens/ten");
        pp::form('t20','KTV2Q8T8MMY5U', "tokens/twenty");
?>
    </div>
</div>
<?php
//html::footer();
?>