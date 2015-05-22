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
        if(pp::SANDBOX){
            ?>sandbox.<?php
        }?>paypal.com/cgi-bin/webscr?<?php
    }
    function minorFundsPath(){pp::storePath();?>cmd=_express-checkout&amp;token=EC-5XT8625765497150M<?php
    }
}
?>

<div id='AddFunds'>
  <!--  <h1>AddFunds</h1>  -->
    <?php backBtn();?>
	<?php homeBtn();?>
    <!--button id='addFundsBackButton'>Back</button-->
	<!--a href='<?php //pp::minorFundsPath();?>'><input type='image' id='addMinorFundsBtn' value='chump change'></a-->
    <div id='cash'>
        <!--action=<?php //paypalPath();?>
        target='PPDGFrame'
        class='standard'>
        <label>Purchase Cash</label><br-->
        <ul>
            <!--doesn't work if is type='button' Also, stylings no longer work :(
            paypalBtn('addAllowance', 'Get Credits');
            paypalBtn(addMinorFundsBtn', 'chump change');
            paypalBtn('addMediumFundsBtn', 'stack of bills');
            paypalBtn('addMajorFundsBtn', 'Pile 'o Cash');
            -->
            <li><input type='button' id='addAllowanceBtn' value='Get Credits'></li><br>
            <li><input type='image' id='addMinorFundsBtn' value='chump change'></li><br>
            <li><input type='image' id='addMediumFundsBtn' value='stack of bills'></li><br>
            <li><input type='image' id='addMajorFundsBtn' value='Pile of Cash'></li>
            
            <!--label for='buy'>Buy Now:</label>
            <input type='image' id='submitBtn' value='Pay with PayPal' src='https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif'-->
            <input id='type' type='hidden' name='expType' value='light'>
            <!--replace 'insert_pay_key' with Vendor's-->
            <input id='paykey' type='hidden' name='paykey' value='insert_pay_key'>
        </ul>
    </div>
    <!--LIVE!
    <form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
        <input type='hidden' name='cmd' value='_s-xclick'>
        <input type='hidden' name='hosted_button_id' value='XZCKNKNJHAA2S'>
        <input type='image' src='http://851entertainment.com/Auto_ObsessionsX/images/defaultBtn.png' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
        <img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' width='1' height='1'>
    </form>
    -->
    <form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
        <input type='hidden' name='cmd' value='_s-xclick'>
        <input type='hidden' name='encrypted' value='-----BEGIN PKCS7-----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-----END PKCS7-----'>
        <input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
        <!---->
        <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    </form>

    <form id='tokens'
        action=<?php paypalPath();?>
        target='PPDGFrame'
        class='standard'>
        <label>Purchase Tokens</label><br>
        <input type='image' id='add3TokensBtn' value='3 Tokens: $1.19'><br>
        <input type='image' id='add5TokensBtn' value='5 tokens $1.99'><br>
        <input type='image' id='add10TokensBtn' value='10 tokens $2.49'><br>
        <input type='image' id='add20TokensBtn' value='20 tokens $3.99'><br>
    
        <!--label for='buy'>Buy Now:</label>
        <input type='image' id='submitBtn' value='Pay with PayPal' src='https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif'-->
        <input id='type' type='hidden' name='expType' value='light'>
        <!--replace 'insert_pay_key' with Vendor's-->
        <input id='paykey' type='hidden' name='paykey' value='insert_pay_key'>
    </form>

    <!--script type='text/javascript' charset='utf-8'>
    var minorFundsPPFlow = payRequest(1.99, {trigger: 'addMinorFundsBtn'});
    </script>
    <script type='text/javascript' charset='utf-8'>
    var mediumFundsPPFlow = payRequest(4.99, {trigger:'addMediumFundsBtn'});
    </script>
    <script type='text/javascript' charset='utf-8'>
    var majorFundsPPFlow = payRequest(9.99, {trigger:'addMajorFundsBtn'});
    </script>
    <!---->
    <!--script type='text/javascript' charset='utf-8'>
    var flowTokens3 = payRequest(1.19, {trigger: 'add3TokensBtn'});
    </script>
    <script type='text/javascript' charset='utf-8'>
    var flowTokens5 = payRequest(2.99, {trigger:'add5TokensBtn'});
    </script>
    <script type='text/javascript' charset='utf-8'>
    var flowTokens10 = payRequest(2.49, {trigger:'add10TokensBtn'});
    </script>
    <script type='text/javascript' charset='utf-8'>
    var flowTokens20 = payRequest(3.99, {trigger:'add20TokensBtn'});
    </script-->
</div>