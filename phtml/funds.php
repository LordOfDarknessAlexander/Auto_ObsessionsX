<?php 
require_once 'AO_UI.php';
    //function paypalBtn($id, $val){
    //inserts a button into a form implementing the 'PayPal' api
    //<input type='image' id='<echo $id>' value='<echo $val>'><br>
    //}
?>

<div id='AddFunds'>
    <h1>AddFunds</h1>
    <?php backBtn();?>
	<?php homeBtn();?>
    <!--button id='addFundsBackButton'>Back</button-->
	
    <form id='cash'
        action='https://www.sandbox.paypal.com/webapps/adaptivepayment/flow/pay'
        target='PPDGFrame'
        class='standard'>
        <label>Purchase Cash</label><br>
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
    </form>
    
    <form id='tokens'>
    <action='https://www.sandbox.paypal.com/webapps/adaptivepayment/flow/pay'
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

    <script type='text/javascript' charset='utf-8'>
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