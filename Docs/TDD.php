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
<a href='http://php.net/'>PHP</a><?php
    }
    public static function phpMySQLi(){?>
<a href='http://php.net/manual/en/book.mysqli.php'>mySQLi</a><?php
    }
    public static function mySQL(){?>
<a href='http://dev.mysql.com/doc/refman/5.6/en/'>mySQL</a><?php
    }
    public static function w3SQL(){?>
<a href='http://www.w3schools.com/sql/sql_quickref.asp'>W3 SQL</a><?php
    }
    public static function phpDOM(){?>
<a href='http://php.net/manual/en/book.dom.php'>DOM</a><?php
    }
    //public static function python(){<a href=''>Python</a>}
    //public static function perl(){<a href=''>Perl</a>}
    public static function javascript(){
        //links to ECMAScript Spec?>
<a href='http://www.ecma-international.org/ecma-262/5.1/'>JavaScript</a><?php
    }
    public static function json(){?>
<a href='http://json.org/'>JSON</a><?php
    }
    public static function jQuery(){?>
<a href='https://jquery.com/'>jQuery</a><?php
    }
    public static function css(){?>
<a href='http://www.w3schools.com/cssref/'>CSS</a><?php
    }
    public static function html5(){?>
<a href='http://dev.w3.org/html5/html-author/'>HTML5</a><?php
    }
    public static function xml(){?>
<a href='http://www.w3.org/XML/'>XML</a><?php
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
<a href='http://www.w3.org/TR/PNG/'>PNG</a><?php
    }
    public static function jpg(){?>
<a href='http://www.w3.org/Graphics/JPEG/'>JPG</a><?php
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
    <li><a href='#standards'>Standards and Conventions</a>
    <li>
        <a href='#fileFormats'>File Formats</a>
        <ol>
            <li>
                <a href='#text'>Text</a>
                <ol>
                    <li><a href='#textHTML'>HTML</a></li>
                    <li><a href='#textJS'>JavaScript</a></li>
                    <li><a href='#textCSS'>CSS</a></li>
                    <li><a href='#textXML'>XML</a></li>
                    <li><a href='#textPHP'>PHP</a></li>                
                </ol>
            </li>
            <li>
                <a href='#imgs'>Images</a>
                <ol>
                    <li><a href='#imgAR'>Aspect Ratios</a></li>
                    <li><a href='#imgFD'>Formats and Dimensions</a></li>
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
        <a href='#aoGM'>Game Mechanics</a>
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
<hr><h2 id='standards'>Standards and Conventions</h2><hr>
<pre>   <p class='good'>GREEN</p> code segments and text adhere to standard pratices and conventions, which should be used.
<p class='bad'>RED</p> segments are examples which styles, formats, safe coding conduct are broken and <i>should not</i> be used in code,
the author will be responsible for making sure the code they write is in-line with this standard,
else be subjected to gruesome torture and horrific other various crimes against both humanity and nature until they comply :)
<h3>TIP</h3><p class='tip'>Helpful tips or tricks are displayed in a grey box with white text like this!<br></p></pre>
    <h2 id='fileFormats'>File Formats</h2><hr>
    <pre>    While programs may be written in a single language, in the industry it is rare.
In many web application(or in general most computer programs) require several diffrent languages and resource types
interacting together to bring the user a fully immersive experience.
This can quickly become confusing and overwhelming when switching between 3 or more in a large project,
    This project employes 5 text, 2 image and 1 audio file formats to accomplish the desired user experience.</pre>
    <h3 id='text'>Text</h3><hr>
<pre>    In web development there are several layers of various languages, each has its own (independent) standard and specific purpose.
Thus consistency in style across all file types is important for the readability and maintainability of code.
<p class='tip'>All text files (unless otherwise specified) should be encoded using UTF-8, without BOM</p>
</pre>
<pre id='textHTML'><?php a::html5();?>-Expresses raw (strucutred) data(does not DO anything!), extension (.html),
pages should be embedded within PHP(this project does not use raw HTML files),
as PHP is more powerful and flexible than HTML on its own
</pre>
<pre id='textXML'><?php a::xml();?>-extension (.xml), is purely a markup language (with no functionality),
intended for the expression of an application's data.
As xml closely adheres to html(with subtly yet important differences),
xml files should follow the same styles/formating as html pages.
</pre>
<pre id='textJS'>
<?php a::javascript();?>-Controls local browser functionality,
MIME type application/javascript, extension (.js).
May be embeded within a php page, to allow for server side off-load of
processing or file/database io and textual replacement when dispatched to a browser.
The inclusion of jQuery allows for the dynamic manipulation of the page's DOM at run-time by the brwoser,
Changes made this way are to the version existing within the browser, not the source on the server!
</pre>
<pre id='textCSS'><?php a::css();?>-For the display/styling/animating of HTML elements displayed by a browser.
MIME type text/css, extension (.css).
As with js files, may be embeded within a php page,
to take advantage of server-side data transforms upon page dispatched.
This can be useful (for example) to bind jQuery selectors by providing an interface across the (3)seperate file types,
which reduce typing and spelling/syntax errors in the jQuery selector strings.
</pre>
<pre id='textPHP'><?php a::php();?>-Sever-side scripting language, which provides:
database(<?php a::phpMySQLi();?>) and <?php a::phpDOM();?>(x[ht]ml) interfaces,
preprocessing facilities for html(as well as other text file types, .js, .css, etc),
allows for a file include mechanism(include/require) in other languages(which do not natively support this mechanism),
the ability to express(easily) functions, classes and objects in aconventional OOP manner,
which may be a feature the processed file does not natively support!
and provides an interface from which javascript may asynchronously request server processes,
using <?php a::jQuery();?> AJAX($.ajax), or with the higher level interface using jq.get and jq.post(located in js/jqLib.php)
</pre>
<p class='tip'>
    Keeping coherent style should reduce to the lowest common denominator of all languages involved.
</p>
<h4 id='dfn'>Directory Structure and File Name</h4><hr>
<pre>   Directories and files are camelCased, like so
root\
    images\
        defaultBtn.png
        someBackground.png
        randomLargeImage.jpg
    audio\
        ambientSound0.mp3
    css\
        main.css
    js\
        main.js
    index.php
</pre>
<h4 id='cfn'>Classes, Functions, Variables and Namespaces</h4><hr>
<pre>   As Object Oriented Programming(OOP) is not the background of everyone,
First, some definitions:
    Variable(data/POD)-
    Function-A single memory location which repressents a stack of commands which operate on data,
either anonymous or bound to a textual identifier.
In javascript functions can be 'new'ed to mimic classes/objects.
    Class-A declaration of a related collection of data and functions which,
when an instance is initialized/allocated/returned,
possess a unique memory location(in part or in whole).
    Namespace-A collection of related variables, functions, and classes,
which is (typically)never allocated, and has static duration(in compiled languages, these are a compiler construct)
<p class='tip'>The HTML and CSS 'class' attribute/selector is not the same as
that of the OOP concept(as neither are programing languages)</p>
</pre>
<h4 id='cfnDU'>Declaration and Usage</h4><hr>
<pre>   All gloabally accessable classes are declared (unless prefixed with a namespace, eg: aoVehicle, pasGet, dbConnect),
with CamelCase(starting with a capital).
    Functions and variables that are private or protected(or for languages like JS which have no protection, those with the intent of being used as such)

js:<code><p class='good'>
//declares a function, which returns a new object,
//adopting a class like structure
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
}</p></code>
    There is no namespace mechanic in JavaScript! The two conventional ways are by declaring a global object,
initialized with declared fields, or a function with locally and/or externally declared fields.
Use of global objects are prefered, as fields declared and set within the function add to overhead,
as the variables will be initialized and assigned on each invocation of the function.
<code><p class='good'>
var ao = {
    //global object encapsulating a related collection of data or functions.
    //May also be conceptualized as a Dictionary or Map of generic bindings to named fields
    _PRIV_STR:'private const string',
    publicInt:7,    //public non-const integer
    otherData:{
        ...
    }
    //
    _privDoStuff(){
        //private/protected function which should only be called by this object (or its children),
        //from within its other functions
        return;
    },
    doStuff:function(args){
        //public accesser, which calls a private/protected method
        this._privDoStuff();
        return;
    },
};</p></code>
    This is not a true namespace or static interface, as the code is initialized,
its members are accessed with dot (.) notation, as its a global object(more akin to a static class),
and not accessible (in other scripts) until the script has been parsed by the browser.
    Technically javascript's dynamic nature allows the modification any of the fields in the previous script,
so these naming conventions are purely synatictical and are enforced as a human readbility concern,
as the programmer must be able to properly, clearly and easily express their intent.
<hr>
PHP:
    Variables in PHP begin with a &amp;(functions do not).
    To distinguish related groups of functions, variables or classes at
global scope either prefix them with a short abbreviation of the namespace(aoSomeFunc(){}, class aoVehicle{}, $aoUserDB = new dbConnect();),
or declared them as a static member of a class (eg, pasGet::, a::, html::, css::)
<code><p class='good'>
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
    protected function _getPriv(){
        return $self->_priv;
    }
}</p></code>
<p class='tip'>PHP allows for a namespace mechanism, which is only supported in v5 or greater.
As the current webhost(GoDaddy) does not that language version,
the feature is not used in any studio scripts and will not be mentioned or referenced in examples.</p>
</pre>
    <h3 id='imgs'>Images</h3><hr>
<pre><h4 id='imgAR'>Aspect Ratios:</h4>    The aspect ratio is an important relation between its size and height and is calculated and expressed as, w/h, or w:h,
and is expressed in the lowest common denominator.
    This relation is useful when preforming calculations and transforms on the image,
as well as applyin more complex matrix operations(for displaying images using GPU programming).
<p class='tip'>Common Aspect Ratios:
    Computer Monitors-4:3 for standards and 16:9 for widescreens,
    Mobile-4:3, 3:2, 4:5, 5:3, 16:9(exclussively iPhone5 or Greater)
    Blackberry-1:1 and 16:9
    Tablets(iPad and Android)-4:3
    
For mobile the inverses must also be taken into account,
if landscape and portrait are considered.
</p>
    It is helpful(to avoid image stretch) to have image resources adopt the same aspect ratio as the display rendering them,
    but as various devices have varying aspect ratios
but an aspect ratio of 1:1 can also be acceptable,
as the preportions are scaled so stretching appears relatively undistorted.
<h4 id='imgFD'>Image Formats and Dimensions:</h4>    All large (non-transparent)image resources, such as backgrounds, car photos assume the JPG format.
Logos for advertising are currently 385x85 .png, as they are small images where retention of resolution is important.
    Since the previous project did not have standardized image sizes the image library is uncessicarily bloated and chaotic,
as a result file range from very small(32kb), to very large(2mb) and various aspect ratios (most common aspect resolutions 4/3 (1.33) or 3/2(1.5) ).
    This results in transfer for images being extremely slow, as many very large images have to be transfered, quite frequently, on screen transions, across manny pages.
increasing bandwidth, slowing execution drastically(eg. the garage or auction select screens).
    After reducing file size from the original source,
storage of the vehicle image library reduced from ~246mb(0.24gb) to less than 28mb(0.03gb at 720p),
resulting in a ~81% reduction(of it original size) which,
is a reduction of 215mb which does not need to be stored and transfered,
at no loss to resolution or image quality!

    As a result all vehicle images shall be a height of 720.
If issues with resoulton arise, increase to full 1080 resolution and/or widescreen aspect ratio,
or reduce to 640, for increased preformance!

The resulting images sizes then become:
    (4/3 = 853x640)
    (3/2 = 960x640)
    (16/9 = 1152x648)
<hr>
    (4/3 = 960x720)
    (3/2 = 1080x720)
    (16/9 = 1280x720)
<hr>full HD:
    (4/3 = 1440x1080)
    (3/2 = 1620x1080)
    (16/9 = 1920x1080)
<hr>
    One of these resolutions must be selected, then artist department must edit them to prevent strentching,
as the various aspect ratios cause distortions in the preportions of the vehicles.
<p class='tip'>For all future entries, an aspect ratio of 4/3 is prefered, as it is the most universal.</p>
    The current vehicle port on the site currently consumes 60% width and height of the browser.
Should be standardized to either a constant aspect resolution(preferred) at either,
4:3 (either 40%,30% or 80%,60%) or 3:2 (60%,40%) to maintain aspect resolution.
<p class='tip'>IMPORTANT! Any logos which are registered trademarks much be licensed appropriately before hosting final page, to avoid legal action.</p>    
    Small images should be between 32 pixels high or greater and 128 pixles in height or less.
    Medium sized images, a min of 128 height and max of 256 pixels is preferred.
    Large images with heights over 256 should be no larger than 2048, as this is(roughly) larger than most display sizes.
</pre>
<h4 id='png'><?php a::png();?></h4><hr>
<pre>    PNG(Portable Network Graphics) is a lossless compression method for images.
Most useful for small to medium sized images where data integrity and resolution must be maintained.
Supports transparency.</pre>
<h4 id='jpg'><?php a::jpg();?></h4><hr>
<pre>    JPEG/JPG (Joint Photographic Experts Group) is a lossy compression compression method for images.
Should be used with large images(where maintaining detail/resolution/integrity is not important.
Good for maintaining collections of large images with relatively low memory overhead.</pre>
</pre>
    <h3 id='audio'>Audio</h3><hr>
<pre>    All audio files adopt the MP3 format.</pre>

<h2 id='strStyles'>String Formatting</h2><hr>
<pre>    Html/xml makes extensive use of quotes and double quotes for the
declaration of strings.<br>
As html is often embedded inside other strings it quickly
become difficult to read
ALWAYS USE SINGLE QUOTES IN HTML, unless absolutely necessary(then the use of an html entity would be preferred)
</pre>
<h3 id='jsH'><?php a::javascript();?></h3><hr>
<pre>   Supports single and double quoted strings,
use single quotes for any string which does not have (') or (\) embeded and for JSON strings.
Use double quote strings to represent URL paths and X(HT)ML nodes strings</pre>
<code>
<p class='good'>var str = '{"id":"string"}';</p>
<p class='bad'>var str = "{\"id\":\"string\"}";</p>
</code>
<pre>   The exception is if it has html or url paths embedded.
"images/defaultBtn.png";   requires only single slashes.

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
And as with before, using double quotes looks the same:
<p class='bad'>$str = "{\"id\":\"string\"}";</p>
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
<hr><h2 id='aoGM'>Game Mechanics</h2><hr>
<pre>   Auto-Obsessions implements several high level API to simulate the experience of owning, moding and auctioning cars.
</pre>
<h3 id='carLC'>Vehicle Life Cycle</h3><hr>
<pre>    The user's experience consists of engaging in auctions, repairing/moding car then ultimately selling them for a profit.</pre>
<h3 id='buying'>Auction</h3><hr>
<pre>    Here, the users bids against randomized AI to compete in a bidding war for a car.
A static table(aoCars) exists in the core database(finalpost),
purchasing a car copies the data from aoCars(entries are never removed from aoCars), into the user's table, where they may freely mod their new ride.
</pre>
<h3 id='owning'>Garage-life</h3><hr>
<pre>   At this point users may View, Upgrade, or Sell vehicles they have previously purchased.
View a car does not change any.
</pre>
<h3 id='selling'>Making money</h3><hr>
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
<img src='AOUML.jpg'><br>
UML Diagram depicts the transitions that exist in the game. Auto-Obsession is a User based website and game and the following is intended to help guide the programmers of 
the game to understand the screen transitional flow that should live in the totality of the project.
</pre>

<?php html::footer()?>