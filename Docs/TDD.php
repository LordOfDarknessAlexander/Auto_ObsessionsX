<?php
//The contents of this document is for 851 Entertainment staff and authorized affiliates
//It's content is subject to trade secret and not to be publicly accessed!
require_once '../include/html.php';
//
function br(){?>
<br>
<?php
}
//
class a{
    //class representing common html Anchor elements used through out docs
    //websites
    //public static function google(){<a href='www.google.ca'>Google</a>}
    public static function php(){?>
<a href='http://php.net/'>PHP</a>
<?php
    }
    //public static function python(){<a href=''>Python</a>}
    //public static function perl(){<a href=''>Perl</a>}
    public static function javascript(){
        //links to ECMAScript Spec?>
<a href='http://www.ecma-international.org/ecma-262/5.1/'>JavaScript</a>
<?php
    }
    public static function json(){?>
<a href='http://json.org/'>JSON</a>
<?php
    }
    public static function css(){?>
<a href='http://www.w3schools.com/cssref/'>CSS</a>
<?php
    }
    public static function html5(){?>
<a href='http://dev.w3.org/html5/html-author/'>HTML5</a>
<?php
    }
    public static function xml(){?>
<a href='http://www.w3.org/XML/'>XML</a>
<?php
    }
    //browsers
    //public static chrome(){
//<a <a href='www.google.com/chrome/‎'>Google Chrome</a>}
    //public static friefox(){
//<a href=''>Mozilla Firefox</a>}
    //public static safari(){
//<a href=''>Safari</a>}
    //public static opera(){
//<a href=''>Opera</a>}
    //public static explorer(){
//<a href=''>Internet Explorer</a>
    //}
    //image type specs
    public static function png(){?>
<a href='http://www.w3.org/TR/PNG/'>PNG</a>
<?php
    }
    public static function jpg(){?>
<a href='http://www.w3.org/Graphics/JPEG/'>JPG</a>
<?php
    }
};
//if(secure::adminLogin()){
html::docType();
?>
<html lang=en>
<head>
<?php
html::charset();
html::title('AO TDD');
?>
<style>
body{
    background-color:black;
    color:grey;
}
a{color:blue}
a:active{color:purple;}
a:hover{color:green;}

h1{color:red;}
h2{color:red;}
h3{color:red;}
h4{color:red;}

p.good{color:green;}
p.ok{color:yellow;}
p.bad{color:red;}
p.tip{color:white;background-color:grey;}
</style>
</head>
<body>
<h1>Auto-Obsessions' Technical Design Document(under construction)</h1>
<h2>Abstract</h2><hr>
This document describes the technical standards used in the development of the Auto-Obsessions site.
<h2>Table of contents</h2><hr>
<ol>
    <li>
        <a href='#fileFormats'>File Formats</a>
        <ol>
            <li>
                <a href='#text'>Text</a>
                <ol>
                    <li><a href=''>HTML</a></li>
                    <li><a href=''>JavaScript</a></li>
                    <li><a href=''>CSS</a></li>
                    <li><a href=''>XML</a></li>
                    <li><a href=''>PHP</a></li>                
                </ol>
            </li>
            <li>
                <a href='#imgs'>Images</a>
                <ol>
                    <li><a href='#png'>PNG</a></li>
                    <li><a href='#jpg'>JPG</a></li>
                </ol>
            </li>
            <li>
                <a href='#audio'>Audio</a>
                <ol>
                    <li><a href=''>Sound Effects</a></li>
                    <li><a href=''>Ambient</a></li>
                </ol>
            </li>
        </ol>
    </li>
    <li>
        <a href='#strStyles'>String Formatting</a>
        <ol>
            <li><a href='#jsH'>JavaScript</a></li>
            <li><a href='#phpH'>PHP</a></li>
        </ol>
    </li>
    <li>
        <a href=''>Game Mechanics</a>
        <ol>
            <li>
                <a href='#carLC'>Vehicle Life Cycle</a>
                <ol>
                    <li><a href='#buying'>Buying</a></li>
                    <li><a href='#upgrading'>Upgrading</a></li>
                    <li><a href='#selling'>Selling</a></li>
                </ol>
            </li>
            <li><a href=''>Repairs and Upgrades</a></li>
            <li><a href='#ai'>AI</a></li>
            <li><a href='#store'>Store</a></li>
        </ol>
    </li>
    <li>
        <a href='#aodb'>Databases</a>
    </li>
</ol>
<hr><h2>Standards</h2><hr>
<pre>   Code segments and text in <p class='good'>GREEN</p> adhere to the standard and should be used.
Examples, styles and formats which break the standard and should not be used are in <p class='bad'>RED</p> and the author will be responsible for making sure the code they write is in-line with this standard,
else be subjected to gruesome torture.
<p class='tip'>Helpful tips or tricks are displayed in a grey box with white text like this!<br></p></pre>
    <h3 id='fileFormats'>File formats:</h3><hr>
    <pre></pre>
    <h4 id='text'>Text</h4><hr>
<pre>    In web development there are several layers of various languages, each has its own (independent) standard and specific purpose.
This can quickly become confusing and overwhelming when switching between 3 or more in a large project,
so consistency in style across all file types is important for the readability and maintainability of code.
<!--All files should be UTF-8 encoded, without BOM.</pre><br>--></pre>
<?php a::html5();?>: for expression of raw (strucutred) data, extension (.html), pages should be embedded within PHP, as it is more powerful and flexible than html on its own<br>
<?php a::xml();?>: XML, extension (.xml), is purely a markup language (with no functionality),
intended for the expression of an application's data.
As xml closely adheres to html(with subtly yet important differences) xml files should follow the same stylings as html pages.<br>
<?php a::javascript();?>: for local browser functionality, MIME type application/javascript, extension (.js), may be embeded within a php page.<br>
<?php a::css();?>: for data display/styling. MIME type text/css, extension (.css), may be embeded within a php page.<br>
<?php a::php();?>: Sever-side scripting language and database interface.<br>
</pre>
    Keeping coherent style should reduce to the lowest common denominator of all languages involved.
</pre>
<h5 id='dfn'>Directory structure and file name</h5><hr>
<pre>   Directories and files are camelCased, like so
root\
    images\
        defaultBtn.png
        someBackground.png
        randomLargeImage.jpg
    audio\
        ambient.mp3
    css\
        main.css
    js\
        main.js
    index.php
</pre>
<h5 id='cfn'>Classes, functions and variables</h5><hr>
<pre>   All classes are (unless prefixed with a namespace, eg: ao, pas).
Functions and variables that are private or protected(or for languages like JS which have no protection, those with the intent of being used as such)

js:<code><p class='good'>
//declares a function, which returns an object
function makeStuff(args){
    //doc string, about this class ctor/generator
    //Static constants are owned by this generator,
    //as they should only be assign once and only one 
    this.PUB_VAR = 0;
    this._VAR = 0;
    //
    return {
        pub:args[0],
        _prot:'protected',
        _priv:'private',
        //
        getProt:function(){
            return this._prot;
        }
        _getPriv:function(){
            return this._priv;
        }
    };
}</p>
</code>
php:<code><p class='good'>
class Stuff{
    //doc string, about this class
    //data always comes first in class declarations!
    public pub;
    protected _prot;
    private _priv;
    //
    public static CONST PUB_VAR = 0;
    protected static CONST _VAR = 0;
    //
    //then declare functionality after
    //
    public function getProt(){
        return $self->_prot;
    }
    protected function getPriv(){
        return $self->_priv;
    }
}</p></pre>
</code>
    <h4 id='imgs'>Images</h4><hr>
<pre>	All large image resources, such as backgrounds, car photos assume the JPG format.
Logos for advertising are currently 385x85 .png, as they are small images where retention of resolution is important.
    IMPORTANT! Any logos which are registered trademarks much be licensed appropriately before hosting final page, to avoid legal action.</pre>
<h4 id='png'><?php a::png();?></h4><hr>
<pre>PNG(Portable Network Graphics) is a lossless compression method for images.
Most useful for small to medium sized images where data integrity and resolution must be maintained.</pre>
<h4 id='jpg'><?php a::jpg();?></h4><hr>
<pre>JPEG/JPG (Joint Photographic Experts Group) is a lossy compression compression method for images.
Should be used with large images(where maintaining detail/resolution/integrity is not important.
Good for maintaining collections of large images with relatively low memory overhead.</pre>
</pre>
    <h4 id='audio'>Audio</h4><hr>
<pre>    All audio files adopt the MP3 format.</pre>

<h3 id='#strStyles'>String Formatting</h3><hr>
<pre>    Html/xml makes extensive use of quotes and double quotes for the
declaration of strings.<br>
As html is often embedded inside other strings it quickly
become difficult to read
ALWAYS USE SINGLE QUOTES IN HTML, unless absolutely necessary(then the use of an html entity would be preferred)
</pre>
<h3 id='jsH'><?php a::javascript();?></h3><hr>
<pre>   use single quoted string. json</pre>
<code>
<p class='good'>var str = '{"id":"string"}';</p>
<p class='bad'>var str = "{\"id\":\"string\"}";</p>
</code>
<pre>   The exception is if it has html or url paths embedded.
"images/defaultBtn.png";   requires only single slash.

This method can clearly distinguish the embedded quotes when expressed as a string:</pre>
<code>
<p class='good'>var htmlStr = "&lt;button id='" + id + "'&gt;text&lt;/button&gt;";</p>
</code>
Opposed to using double quote inside double quotes:
<code>
<p class='bad'>var htmlStr = "&lt;button id=\"" + id + "\"&gt;text&lt;/button&gt;";</p>
</code>
<h3 id='phpH'><?php a::php();?></h3><hr>
<pre>    PHP differentiates between single and double quoted <a href='http://php.net/language.types.string'>strings</a> (also see nowdoc and heredoc, but these are less frequently used) with
certain distinctions.
    Single quoted strings require the escaping of special characters, /, ', etc
They are to be used in simple strings which do not contain embedded data(html/json)
and do not require the substitution of variables.</pre>
<code>
<p class='good'>$str = 'simple string'; //keep it simple, nothing complex</p>
<p class='bad'>$str = 'this \' must be escaped';</p>
<p class='good'>$str = '{"id":"string"}';</p>
</code>
    Double quoted strings may contain single quotes without escaping,
and support the direct substitution of variables.
<code>
<p class='bad'>$str = "simple string";  //double quote for 'complex strings', nothing special here</p>
<p class='good'>$str = "this ' doesn't need escaping'!";</p><br>
</code>
When embedding dynamic variables into a string this format is preferred
<code>
<p class='good'>
&lt;?php<br>
$str = 'guid'; //simple string<br>
echo "&lt;button id='$str'&gt;This can't be real&lt;/button&gt;";   //embedded string in a button<br>
$str = "SELECT $str FROM table";   //embedded string as an sql statement, $str will be replaced by the literal value(not including the quotes)<br>
?&gt;</p>
</code>
While this is acceptable, in PHP, html elements should rarely be expressed as strings then echo'ed out to the browser(as this is slow and overly complex),
rather, it's preferred to inject the html directly as the site like so.
<code>
<p class='good'>
&lt;?php<br>
$str = 'guid';<br>
?&gt;<br>
&lt;button id='&lt;?php echo $str;?&gt;'&gt;This can't be real&lt;/button&gt;<br>
&lt;?php<br>
enter php mode and continue on with script!<br>
?&gt;</p>
</code>
<?php $str = 'guid';?>
<button id='<?php echo $str;?>'>text</button><br>
<p class='tip'>
By closing the php tag(with ?&gt;) the script will revert to pure html, allowing to create functions and other PHP constructs which output elements.
</p>
<h3 id='jsonH'><?php a::json();?></h3><hr>
    The <a href = 'http://json.org/'>json standard</a> requires the use of double quotes for expressing all string data
This makes for rather cumbersome syntax which is less flexible.
<code>
<p class='bad'>"{\"id\":\"string data\"}" //ugly</p>
<p class='good'>'{"id":"string"}';   //better</p>
</code>
<p class='tip'>
    In php and javascript, use json_encode() or JSON.stringify() to convert complex data objects into valid JSON strings
</p>
<hr><h2>Game Mechanics</h2><hr>
<pre>   Auto-Obsessions implements several high level API to simulate the experience of owning, moding and auctioning cars.
</pre>
<h3 id='carLC'>Vehicle Life Cycle</h3><hr>
<pre>    The user's experience consists of engaging in auctions, repairing/moding car then ultimately selling them for a profit.</pre>
<h4 id='buying'>Auction</h4><hr>
<pre>    Here, the users bids against randomized AI to compete in a bidding war for a car.
A static table(aoCars) exists in the core database(finalpost),
purchasing a car copies the data from aoCars(entries are never removed from aoCars), into the user's table, where they may freely mod their new ride.
</pre>
<h4 id='owning'>Garage-life</h4><hr>
<pre>   At this point users may View, Upgrade, or Sell vehicles they have previously purchased.
View a car does not change any.
</pre>
<h4 id='selling'>Making money</h4><hr>
<pre>   An Ajax POST request is made to the server (from js),
, with the script returning their new funds.
</pre>
<h3>Repairs and upgrades</h3><hr>
<pre>    Vehicle upgrades and repairs are represented by bitfields,
minimizing bandwidth from sql queries and sending data with php/ajax by overlaying complex abstractions atop collections of bits(more specifically chars, shorts and ints) 
    <br>
    Each field is represented by 4(8-bit) bytes taking the form {XXXX,FFFF}.
    Each group of 4 bits represents a single part of the car.
    The X's aRE reserved and not used.
    
    Each bit represents one of 5 stages:
        0x0(no upgrade)
        0x1(stage 1)
        0x2(stage 2)
        0x4(stage 3)
        0x8(stage 4)

    Binary Visual:
        {0000,0000,0000,0000}    //new part
        {1000,1000,1000,1000}   //field fully upgraded<br>

    Hex Visual:
        {0x0,0x0,0x0,0x0}       //new
        {0x8,0x8,0x8,0x8}       //maxed<br>

    The repair bit field contains 2 bytes(16-bits) representing
one repair for each part in each field. It takes on the structure:
    {drivetrain,body,interior,documents}
  
    When fully upgraded all bits are full(0xF) and the field values appear as such

    {1111,1111,1111,1111}(bin)
    OR
    {0xF,0xF,0xF,0xF}(hex)

    To access values in php or javascript a combination of bitshift and masking is required.

    Bandwidth for single user's vehicle(24-bytes)
        id uint(4)
        dt uint(4)
        body uint(4)
        interior uint(4)
        docs uint(4)
        repairs uint(4)

    pending updates/overhaul could be reduced to (16-bytes)
        id uint(4)
        dt/body uint(4)
        interior/docs uint(4)
        repairs uint(4)
</pre>
    <h3 id='ai'>AI</h3><hr>
<pre>   The AI drives the user's bidding experience.
To bypass the complexity of interacting peer to peer, randomized AI are implemented to simulate an engaging user experience.
</pre>
    <h3 id='store'>Store</h3><hr>
<pre>    The Auto-Obsessions' store processes user transitions via <a href=''>PayPal javescript API</a>.
Upon completion of the transaction, the user is updated.
</pre>
<h2 id='aodb'>Databases</h2><hr>
<pre>   Auto-Obsession implements several databases (with mySQLi) for maintaining user and application data.

finalpost:contains the static vehicle table, aoCars, and the dynamic user's table, aoUsers, which contains all relevant registered user data (TODO:rename finalpost).
aoUsersDB: contains a table for each user to maintain their car collection(garage), which has an entry for each car.
aoCarSalesDB: contains all data regarding the user's vehicle sales(existing, pending and expired).
aoAuctionLossDB: tracks the id's of the vehicles a user has lost and may no longer bid on.
</pre>
<h2 id='aodb'>GameFlow UML</h2><hr>
<pre>
<img alt='UML' title='Auto-Obsession UML' height='650' src='AOUML.jpg' width='960'><br>
UML Diagram depicts the transitions that exist in the game. Auto-Obsession is a User based website and game and the following is intended to help guide the programmers of 
the game to understand the screen transitional flow that should live in the totality of the project.
</pre>

<?php html::footer()?>