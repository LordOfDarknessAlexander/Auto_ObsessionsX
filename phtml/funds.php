<div id="AddFunds">
    <h1>AddFunds</h1>
    <input type="button" id="addFundsBackButton" onmouseover="addFundsBackButton()" onclick="startGame()">
    <form id='cash'
        action="https://www.sandbox.paypal.com/webapps/adaptivepayment/flow/pay"
        target="PPDGFrame"
        class="standard">
    <!--label>Purchase Tokens</label-->
    <label>Purchase Cash</label><br>
    <ul>
        <!--doesn't work if is type='button' Also, stylings no longer work :(-->
        <li><input type='button' id="addAllowanceBtn" value="Get Credits"></li><br>
        <li><input type="image" id="addMinorFundsBtn" value="chump change"></li><br>
        <li><input type="image" id="addMediumFundsBtn" value="stack of bills"></li><br>
        <li><input type="image" id="addMajorFundsBtn" value="Pile 'o Cash"></li>
        
        <!--label for="buy">Buy Now:</label>
        <input type="image" id="submitBtn" value="Pay with PayPal" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif"-->
        <input id="type" type="hidden" name="expType" value="light">
        <!--replace 'insert_pay_key' with Vendor's-->
        <input id="paykey" type="hidden" name="paykey" value="insert_pay_key">
    </ul>
    </form>
    
    <form id='tokens'>
    <!--form id='tokens'
        action="https://www.sandbox.paypal.com/webapps/adaptivepayment/flow/pay"
        target="PPDGFrame"
        class="standard"-->
        <label>Purchase Tokens</label><br>
        <input type='image' id="add3TokenBtn" value="3 Tokens: $1.19"><br>
        <input type="image" id="add5TokensBtn" value="5 tokens $1.99"><br>
        <input type="image" id="add10TokensBtn" value="10 tokens $2.49"><br>
        <input type="image" id="add20TokensBtn" value="20 tokens $3.99"><br>
    
        <!--label for="buy">Buy Now:</label>
        <input type="image" id="submitBtn" value="Pay with PayPal" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif"-->
        <input id="type" type="hidden" name="expType" value="light">
        <!--replace 'insert_pay_key' with Vendor's-->
        <input id="paykey" type="hidden" name="paykey" value="insert_pay_key">
    </form>


    <script type="text/javascript" charset="utf-8">
    var minorFundsPPFlow = payRequest(1.99, {trigger: 'addMinorFundsBtn'});
    </script>
    <script type="text/javascript" charset="utf-8">
    var mediumFundsPPFlow = payRequest(4.99, {trigger:'addMediumFundsBtn'});
    </script>
    <script type="text/javascript" charset="utf-8">
    var majorFundsPPFlow = payRequest(9.99, {trigger:'addMajorFundsBtn'});
    </script>
    
    <label id='userCash'><!--display user's currency--></label>
</div>