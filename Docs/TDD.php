<?php
//The contents of this document is for 851 Entertainment staff and authorized affiliates
//It's content is subject to trade secret and not to be publicly accessed!
require_once '../html.php';
//
function br(){?>
<br>
<?php
}

function te($tag){
    //tag end </$str>?>&lt;/<?php echo $tag?>&gt;
<?php
}
function htmlCmt($str){
    //?>&lt;!--<?php echo $str;?>--&gt;
<?php
}
//
function eW3(){
    echo a::W3;
}
function eW3S(){
    echo a::W3Schools;
}
function ePHP(){
    echo a::PHP;
}
class a{
    //class representing common html Anchor elements used through out docs
    const PHP = "http://php.net/",
        W3 = "http://www.w3.org/",
        W3Schools = "http://www.w3schools.com/";
    //websites
    //public static function google(){<a href='www.google.ca'>Google</a>}
    public static function php(){?>
<a href='<?php ePHP();?>'>PHP</a><?php
    }
    public static function phpMySQLi(){?>
<a href='<?php ePHP();?>manual/en/book.mysqli.php'>mySQLi</a><?php
    }
    public static function mySQL(){?>
<a href='http://dev.mysql.com/doc/refman/5.6/en/'>mySQL</a><?php
    }
    public static function w3SQL(){?>
<a href='<?php eW3S();?>sql/sql_quickref.asp'>W3 SQL</a><?php
    }
    public static function phpDOM(){?>
<a href='<?php ePHP();?>manual/en/book.dom.php'>DOM</a><?php
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
<a href='<?php eW3S();?>cssref/'>CSS</a><?php
    }
    public static function html5(){?>
<a href='http://dev.w3.org/html5/html-author/'>HTML5</a><?php
    }
    public static function xml(){?>
<a href='<?php eW3();?>XML/'>XML</a><?php
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
<a href='<?php eW3();?>TR/PNG/'>PNG</a><?php
    }
    public static function jpg(){?>
<a href='<?php eW3();?>Graphics/JPEG/'>JPG</a><?php
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
<meta name='author' content='Tyler Drury'>
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

b.good{color:green;}
b.ok{color:yellow;}
b.bad{color:red;}
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
        <a href='#security'>Security</a>
        <ol>
            <li><a href='#httpVars'>HTTP Variables</a></li>
            <ol>
                <li><a href='#get'>$_GET</a></li>
                <li><a href='#post'>$_POST</a></li>
                <li><a href='#session'>$_SESSION</a></li>
                <li><a href='#cookie'>$_COOKIE</a></li>
            </ol>
            <li><a href='#ssl'>Secure Sockets Layer(SSL)</a></li>
            <li><a href='#xss'>Cross-Site Attacks(XSS)</a></li>
            <li><a href='#sqlInj'>SQL Injection</a></li>
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
        <ol>
            <li><a href='#mainDB'>finalpost</a></li>
            <li><a href='#usersDB'>aoUsersDB</a></li>
            <li><a href='#carSalesDB'>aoSalesDB</a></li>
            <li><a href='#lossDB'>aoAuctionLossDB</a></li>
        </ol>
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
<h4 id='cfn'>Variables, Operators, Functions, Classes and Namespaces</h4><hr>
<pre>   As Object Oriented Programming(OOP) is not everyone's background,
it can be difficult to make sense of the various mechanism,
especially when various object oriented languages impliment diffrent features.
Before discussing how to express code,
it is usefull to understand the concepts involded and how to
visually and logically seperate these concepts,
so that developers can instictually read/write code without
having to first desipher it physical for and the authors intent,
as it should <b>intrinsic to the form expressed</b> in the code itself.

First, some definitions:
    Variable(data/POD)-this is not always the same for all languages,
        as some (like Obj-C, Javascript and Python) implement plain old data as being derived
        from a base class/object proto type.
    Operator-built in(some time can be overrided) constructs,
        which differ from functions in syntax and semantics,
        commonly repressenting arithmetic and logical expressions,
        which(usually) take <i>left-hand side</i> and <i>right-hand side</i>,
        operands instead of a common seperated argument list
    Function-A unique memory location which repressents a stack of commands which operates on data,
        either declared anonymously(lambdas/closures) or bound to a textual identifier.
<p class='tip'>    In javascript functions can be 'new'ed to mimic classes/objects,
which copies the code and allocates a new portion of memory for it,
increasing memory consumption(by duplicating executable source).
<b>DO NOT</b> <i>new</i> functions unless syntactically and contextually appropriate.
</p>
    Class-Encapsulates a single related collection of data and functions,
        which may(or may not, in the case of class which entierly contain static methods)
        be instansiated 
    Namespace-Encapsulates related collections of data, functions, classes and other namespaces.
        Namespace are never instansiated (and often best used to represent <i>static classes/interfaces</i>).
    Class-Encapsulates a related collection of data and functions which,
when an instance is initialized/allocated/returned,
possess a unique memory location(in part or in whole).
<p class='tip'> The HTML and CSS 'class' attribute/selector is not the same as
that of the OOP concept(as neither are programing languages)</p>
    Namespace-Encapsulates related variables, functions, classes and other namespaces,
        which is never instansiated, has static duration(in compiled languages,
        these are a compile-time construct, used in name mangling)
</pre>
<h4 id='cfnDU'>Declaration and Usage</h4><hr>
<pre>   All gloabally accessable classes are declared (unless prefixed with a namespace, eg: aoVehicle, pasGet, dbConnect),
with CamelCase(starting with a capital).
    Functions and variables that are private or protected(or for languages like JS which have no protection, those with the intent of being used as such)

js:<code><p class='good'>
//declares a function, which returns a new object,
//adopting a class like structure
function makeStuff(args){
    //doc string! this is where info about this function goes
    //this in an example of a class ctor/generator
    //Static constants are owned by this generator,
    //as they should only be assign once and only one 
    this.PUB_VAR = 0;
    this._VAR = 0;
    //
    return {
        pub:args[0],    //short doc string about var
        _prot:'protected',
        _priv:'private',
        //Declare all function AFTER data members,
        //as it makes no sense to have functions
        //operating on variables which do no exist/are no declared
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
    },
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
    }
};</p></code>
    This is not a true namespace or static interface, as the code is initialized,
its members are accessed with dot (.) notation, as its a global object(more akin to a static class),
and not accessible (in other scripts) until the script has been parsed by the browser.
    Technically javascript's dynamic nature allows the modification any of the fields in the previous script,
so these naming conventions are purely synatictical and are enforced as a human readbility concern,
as the programmer must be able to properly, clearly and easily express their intent.
<hr>
PHP:
    Variables in PHP begin with an &amp;(functions do not).
    To distinguish related groups of functions, variables or classes at
global scope either prefix them with a short abbreviation of the namespace(aoSomeFunc(){}, class aoVehicle{}, $aoUserDB = new dbConnect();),
or declared them as a static member of a class (eg, pasGet::, a::, html::, css::)
<code><p class='good'>&lt;?php
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
}
?&gt;</p></code><p class='tip'>    PHP allows for a namespace mechanism, which is only supported in v5 or greater.
As the current webhost(GoDaddy) does not use that language version,
the feature is not used in any studio scripts and will not be mentioned or referenced in examples.</p>
    One fundemental aspect of OOP and the concept of <i>classes</i> is the encapsulation of data,
along with functions which either return(get) or modify(set) data contained
within an instansiated object or statically allocated class members/functions.
<p class='tip'>    With dynamic languages(generally) functions and their bindings,
This is known as reflection and allows for run-time introspection and mutation
of a program's source code, essentailly allowing for the potential for 'sentient'
programs which can modify their behaviour based on an AI and input from its execution environment.
</p>    Getters and Setters which are public are prefixed with 'get' and 'set', respectively,
along with a clear, conciece, name relating to (and ideally being a shortened version) of the member being accessed or modified.
<p class='tip'>    Typing less is always better! Programming should be easy and quick while maintaining
clearity and functionality.
    Make internal class or local function vars very descriptive,
as these as less frequently accessed/readed(as they are local to their enclosed structure)
and are(usually) not accessed from outside the containing scope.
    While, with more frequent, globally accessible interfaces shorter and more concise,
as they are more fequently used(and easier to remember, by their sharp, short names),
resulting in less typing.
</p>
    Protected and private (non-static/const) members are declared <i>camelCased</i>,
except further prefixed with an underscore(_), as convention dictates.
Not only is this easier to read, but also means,
with the auto complete functionality of modern text editers,
when accessing local vars, one needs to type no fewer than 2 keys,
as the (_) will first display ALL vars to select from without having to
remeber what its specific name begins with!

Example, declaring getter and setters,
JavaScript:<code><p class='good'>
var thing = {
    _stuff:0,
    getStuff:function(){
        //copy returns the value 0
        return this._stuff;
    },
    _setStuff:function(value){
        //modifies the value at the memory address bound to the identifier
        //repressented by this._stuff.
        this._stuff = value;
        //in some cases either an instance of the object,
        //or the memory address of _stuff may be desirable to return,
        //to allow for 'chaining' function calls, like with jQuery!
    }
};</p></code>
PHP:<code><p class='good'>
class thing{
    private _stuff;
    function __construct($i){
        $this->_stuff = $i;
    }
    function getStuff(){
        //copy returns the value of stuff
        return this->_stuff;
    }
    function &amp;getStuff(){
        //the memory address of stuff
        return &amp;this->_stuff;
    }
    protected function _setStuff($value){
        //preform optional validation of data being assigned,
        //for added security
        this->_stuff = $value;
    }
}</p></code></pre>
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
Supports transparency.
Compression is more effective the larger the image, and the more frequently
pixels are repeated.
Solid colors are best, as they require only a single hash entry in the compressed file.</pre>
<h4 id='jpg'><?php a::jpg();?></h4><hr>
<pre>    JPEG/JPG (Joint Photographic Experts Group) is a lossy compression method for images.
Used for images which do not require alpha/transparency or large images,
where maintaining detail/resolution/integrity is not important.
Good for maintaining collections of large images with relatively low memory overhead.</pre>
</pre>
    <h3 id='audio'>Audio</h3><hr>
<pre>    All audio files adopt the MP3 format.</pre>

<h2 id='strStyles'>String Formatting</h2><hr>
<pre>    Html/xml makes extensive use of quotes and double quotes for the
declaration of strings.<br>
As html is often embedded inside other strings it quickly
become difficult to read.
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
<pre>    PHP differentiates between single and double quoted <a href='http://php.net/language.types.string'>strings</a> with
certain distinctions. Also see nowdoc and heredoc,
but these are less frequently used.
<p class='tip'>    Since these styles of string are support by v5 or higher,
all 8.5:1 games/sites/app will not use them,
as the host only support v4 of PHP.</p>
    Single quoted strings require the escaping of special characters, /, ', etc
They are to be used in simple strings which do not contain embedded data(html/json)
and do not require the substitution of variables.</pre>
<code>&lt;?php
<p class='good'>$str = 'simple string'; //keep it simple, nothing complex</p>
<p class='bad'>$str = 'this \' must be escaped';</p>
<p class='good'>$str = '{"id":"string"}';</p>
//as with JavaScript,
//using double quotes looks the same and should be avoided
<p class='bad'>$str = "{\"id\":\"string\"}";</p>
?&gt;
</code>
<pre>    Double quoted strings may contain single quotes without escaping,
and support the direct substitution of variables.</pre>
<code>
<p class='bad'>$str = "simple string";  //double quote for 'complex strings', nothing special here</p>
<p class='good'>$str = "this ' doesn't need escapin'!";</p>
</code>
<pre>    When embedding dynamic variables into a string this format is preferred
<code class='php'>
&lt;?php<b class='good'>
$str = 'guid'; //simple string
echo "&lt;button id='$str'&gt;This can't be real&lt;/button&gt;";   //embedded string in a button
$str = "SELECT $str FROM table";   //embedded string as an sql statement, $str will be replaced by the literal value(not including the quotes)
</b>?&gt;</code>
    While this is acceptable, in PHP, html elements should rarely be expressed as strings then echo'ed out to the browser(as this is slow and overly complex),
rather, it's preferred to inject the html directly as the site like so.
<code class='php'>
&lt;?php
$str = 'guid';
?&gt;<p class='good'>&lt;button id='&lt;?php
    echo $str;
?&gt;'&gt;This can't be real&lt;/button&gt;</p>&lt;?php
//enter php mode and continue on with script!
?&gt;</code>
<?php $str = 'guid';?>
<button id='<?php echo $str;?>'>text</button>
<p class='tip'>
    By closing the php tag(with ?&gt;) the script will revert to pure html, allowing to create functions and other PHP constructs which output elements.
</p></pre>
<h3 id='jsonH'><?php a::json();?></h3><hr>
<pre>    The <a href = 'http://json.org/'>json standard</a> requires the use of double quotes for expressing all string data
This makes for rather cumbersome syntax which is less flexible.</pre><code class='php'>
&lt;?php
<p class='bad'>var jsonStr = "{\"id\":\"string data\"}";</p>
<p class='good'>var jsonStr = '{"id":"string"}';</p>
</code>
<p class='tip'>    In php and javascript, use json_encode() or JSON.stringify() to convert complex data objects into valid JSON strings</p>
<code class='php'>
<p class='bad'>$jsonStr = "{\"id\":\"string data\"}";</p>
<p class='good'>$jsonStr = '{"id":"string"}';</p>
<pre><p class='tip'>    To create properly formated JSON strings in PHP,
create an assosiative array, then use json_encode() to convert to an object string!</p>
//prefered way to generate a json string from an 'object':
$obj = array('val0'=>0,'val1'=>'second');
$jsonStr = json_encode($obj);
?&gt;</pre></code>

<h3 id='security'>Security</h3><hr>
<pre>   On-line, security is a major concern.
Users expect their private data to remain that way,
especially when maintaining a database including,
home addresses, contact/personal information,
email accounts/passwords, credit card numbers, etc.
    Leaking confidential information due to a subtle security gap,
which could have easily been avoided,
is all that's needed to destroy a company and the lively hood
    Not all users are friendly!
In fact, it is best to designing a site with the expectation
that the majority of users will attempt to exploit the site.
    While most human users are generally friendly,
seeking to interact legitimately with the site,
consuming its services and contributing,
a single individual can execute many hostile programs(or bots),
which continually search the web for vulnerable sites autonomously.
<p class='tip'>    When referring to an 'untrusted source',
it is commonly meant as ANY external source of data,
which is not self contained(locally declared) within the currently executing script.
    Retrieving data from the server with a php request is a good example.
Even though the source is known and trusted, there is still
the potential that (either due to programmer error or a malicious attack),
returned values could be embedded with hazardous data.</p>
</pre>
    <h4 id='httpVars'>HTTP Variables</h4>
<pre>
</pre>
    <h5 id='get'><a href="http://php.net/manual/en/reserved.variables.get.php">$_GET</a></h5>
<pre>   Variables can be passed to a script's $_GET superglobal via the browser's URL,
as a series of name value pairs following the script's extension,
beginning with (?) and values separated with by (=).
<p class='tip'>Sensitive Data, such as usernames, passwords, credit card info
should NEVER be passed via the URL, as these values are NOT encrypted
and are visual accessible simply by viewing the URL and can be easily intercepted by malicious entities</p>
<code>
    LocalHost/myscript.php?arg0=val?arg1=976
</code>
    Variables passed to the script are likewise accessed in
the script using $_GET, passing the same identifier expressed in the URL.

<code class='php'>&lt;?php
//all vars will be UTF-8 encoded string literals
if(isset($_GET) && !empty($_GET) ){
    $a0 = $_GET['arg0'];    //'val'
    $a1 = $_GET['arg1'];    //'976' NOT the integer 967
    //validation/filtering should be preformed appropriately
    //before using these values!
}
//else no args being passed to the script
?&gt;</code>
<p class='tip'>Pro tip:
    With .htaccess files, using URL rewritting can use RegExes
to validate input parameters and to restrict the format of the URL,
which prevents the user from brute forcing additional arguments
should the presented url not match the expected pattern,
immediately navigating the user to a 404 error page(or custom error page),
preventing all execution of the script, before anything bad happens</p>
    Since any string may be entered into the URL of a browser,
malicious entities can brute force hostile values(via bots or manually),
simply by embedding unescaped characters into the URL.
    Variables passed via $_GET should ALWAYS be validated when access by the script receiving the arguments,
before the values are used in a script. Should validation(using PHP built in validation, or custom Regular Expressions) fail of any arguments,
scripts should gracefully and safely terminate execution, WITHOUT further access or use of the invalid data.
</pre>
    <h5 id='post'><a href="http://php.net/manual/en/reserved.variables.post.php">$_POST</a></h5>
<pre>   $_POST variables are passed to a script, via a jQuery Ajax HTTP request
as an object containing generic javascript variables.
    Variables passed via $_POST should ALWAYS be validated when access by the script receiving the arguments,
These arguments are encrypted upon transmission and is not externally visible.
</pre>
    <h5 id='session'><a href="http://php.net/manual/en/reserved.variables.session.php">$_SESSION</a></h5>
<pre>   $_SESSION is an array of data unique to a managed by the server,
with each visitor having a (bound to the session ID of the visitor).
    Before accessing $_SESSION variables, the PHP function <i>session_start()</i> must be called.
    $_SESSION may contain user specific data, such as entries pulled from the database
containing user data which(due to the overhead over continually making SQL calls),
is more convenient to get the values once and store in memory to be quickly accessed until the browser leaves the page.
<code class='php'>&lt;?php
require_once 'dbConnect.php';
//
session_start();
//
$res = $AO_DB->query(
    "SELECT user_id, fname, uname FROM $U WHERE ($E = '$e' AND $PW = SHA1('$p') )"
);

if($res->num_rows == 1){
    $a = $res->fetch_assoc();   //associative array of name:value pairs
    //convert id from string to int, also saves space
    $a['user_id'] = int($a['user_id']);
    $SESSION = $a;
    $res->close();
    exit();
} 
?&gt;</code>
</pre>
    <h5 id='cookie'><a href="http://php.net/manual/en/reserved.variables.cookies.php">$_COOKIE</a></h5>
<pre>   Like $_SESSION variables, $_COOKIEs are unique to a visitor and only accessible to that user.
<p class='tip'>$_COOKIEs are a popular target of bots and hackers,
care should be taken NOT to store sensitive user information as cookies.</p>

</pre>
    <h4 id='ssl'>Secure Sockets Layer(SSL)</h4>
<pre>   The Secure Sockets Layer is a standard security feature which
provides a secure connection between browsers(client) and websites(server),
allowing the secure transmission of private client data online.
    Site secured with SSl display a padlock in the browser's URL bar
and possibly a green address bar, if secured by an EV Certificate.
    This technology provides protection for customers,
ensuring their online transaction information remains confidential,
such as credit card details, passwords or any personal information
which much be passed from browser to server.
    
<p class='tip'>    All personal information transferred online
is a target for malicious entities which scour the web for intimate
information, proper protection must be ensured at all levels in order
to protect the integrity and confidentiality of customer information.
If a website is NOT encrypted with SSL, any moderately skilled hacker
can intercept traffic and steal personal information.</p>
    SSL may be managed via web host(goDaddy).
</pre>
    <h4 id='xss'>Cross-Site Attacks(XSS)</h4>
<pre>   A type of injection attack, where malicious data
supplied by a user is incorrectly filtered then
inserted into a webpage through a form, hyperlink, or other user input,
which are then executed, causing the browser to re-navigate to a hostile page,
or to access secure PHP variables(such as SESSION and COOKIE superglobals).
    This small JavaScript object is all that is needed to properly
escape strings being add to the html dynamically.

#1 Escape HTML before inserting data into element's content<hr>
<code class='html'>
&lt;body&gt;
&lt;div&gt;<b class='bad'>Escape data inserted here</b><?php te('div');?>
<?php te('body');?>
</code>
#2 Escape common HTML attributes
<code class='html'>
&lt;div attr=&#x27;<b class='bad'>Escape data inserted here</b>&#x27;&gt;
<?php te('div');?>
</code>
#3 Escape javascript(in html scripts tags, or php) when inserting data values
<code class='html'>
&lt;body&gt;
    &lt;!--inside quoted strings--&gt;
    &lt;script&gt;alert(&#x27;<b class='bad'>Escape data inserted here</b>&#x27;);<?php te('script');?>

    &lt;!--on the right hand side of a quoted expression--&gt;
    &lt;script&gt;x = &#x27;<b class='bad'>Escape data inserted here</b>&#x27;;<?php te('script');?>

    &lt;!--inside quoted event handler--&gt;
    &lt;div onmouseover = &quot;x = &#x27;<b class='bad'>Escape data inserted here</b>&#x27;&quot;<?php te('div');?>
<?php te('body');?>
</code>
#4 Escape URL's before inserting into HTML URL parameters
<code class='html'>
&lt;!--When receiving untrusted data to be put into an HTTP GET parameter value--&gt;
&lt;a href=&quot;http://www.somesite.com?test=<b class='bad'>Escape data inserted here</b>&quot;&gt;untrusted link!<?php te('a');?>
</code>
<p class='tip'>    This is a prime example why standards should always be adhered to.
    Even though HTML supports unquoted attributes, <b>it is incredibly unsafe!</b>
    Unquoted attributes can be broken out of with characters including [space] % * + , - / ; &lt; = &gt; ^ and |.
    Entity encoding is useless in this context!
    <b class='good'>Always use double quotes when expressing URL paths in HTML</b>.</p>
#5 Escape CSS and Strictly Validate before inserting untrusted data
<code class='css'>
&lt;!--property value--&gt;
&lt;style&gt;selector{
    property : <b class='bad'>Escape data inserted here</b>;
}<?php te('style');?>

&lt;!--property value--&gt;
&lt;style&gt;selector{
    property:&quot;<b class='bad'>Escape data inserted here</b>&quot;;
}<?php te('style');?>

&lt;!--property value--&gt;
&lt;span style=&quot;property : <b class='bad'>Escape data inserted here</b>&quot;&gt;text<?php te('span');?>
</code>
    There are several API's provided for escaping data on both server and client side scripting.

<code class='js'>
//js
var html = {
    //js  object used to securely escape strings
    _entityMap : {
        '&' : '&amp;',
        '<' : '&lt;',
        '>' : '&gt;',
        '"' : '&quot;',
        //
        "'" : '&#39;',
        "/" : '&#x2F;'
    },
    escapeStr:function(str) {
        function rpl(s){
            //returns a char matched by str.replace
            //as an escaped html entity
            return html._entityMap[s];
        }
        var ret = String(str).replace(
            /[&<>"'\/]/g, rpl
        );
        return ret;
    }
};
</code>
    Here are some helpful site about XSS attacks and how to prevent them.
</pre><ul>
    <li><a id='xssPrev' href="https://www.owasp.org/index.php/XSS_(Cross_Site_Scripting)_Prevention_Cheat_Sheet#XSS_Prevention_Rules">XSS Prevention</a></li>
    <li><a id='xssDomPrev' href="https://www.owasp.org/index.php/DOM_based_XSS_Prevention_Cheat_Sheet">DOM based XSS Prevention</a></li>
</ul>
    <h4 id='sqlInj'>SQL Injection Attacks</h4>
<pre>   This type of attack is common and extremely dangerous.
It consists of 'injecting' data into a web application which implements SQL
queries. The main source of this attack is from untrusted input,
most generally from forms submitted by untrusted sources.
These attack may also arise from another source,
such as data stored on the database itself.
    Developers often trust data entered them self (believing it correct),
leading to subtle issues which are difficult to find.
    <p class='tip'>IMPORTANT! All entries stored in a database should ALWAYS be treated as hostile,
until properly validated.
Similar to the 'would rather have and not need, than need and not have' principle</p>
    When successful, the SQL query is manipulated to preform operations
not intended by the developer.
<code class='php'>
&lt;?php
<b class='bad'>$uid = $_POST['user_id'];</b>
$db = new dbConnect();

$result = $db->query(
    <b class='bad'>"SELECT * FROM table WHERE user_id = $uid"</b>
);
?&gt;</code>
    This example has several severe issues.
    Firstly, $_POST may not even exist and the value being passed has not been validated.
Secondly the value 
    Secondly, an untrusted third party is telling the script which
user ID to use, which may not even be a valid ID to begin with.
    This data may contain hidden form fields,
which are believed to be safe, or additional SQL commands.
<p class='tip'>Ideally data used in query strings should come
from a trusted source(such as constants or functions local to the script),
unless absolutely necessary!</p>
    Lastly the value value at the index 'user_id' has not been escaped,
    or bound as a parameter(to a prepared statement).
<p class='tip'>Additionally, SQL prepared statements may be used for added security,
but as this feature is NOT natively supported by v4,
8.1:5E sites to not take advantage of this security feature, yet!</p>
    These are common mistakes, which may be easily overlooked!
The following is an example of what could go wrong.
<code class='php'>
&lt;?php
<b class='bad'>$uid = "'' OR ''=''";</b>
//subbing into the query string
$result = $db->query(
    "SELECT * FROM table WHERE user_id ='' OR ''=''"
);
?&gt;
</code>
    When accessing or storing values in a database it is reasonable
(with names for example) that the entries may contain quotes. This would allow
an attacker to take advantage an embed hostile commands,
when the value is later used in a query,
the additional commands are(unknowingly) executed, if not properly escaped.
    The following is an example of what could go wrong.
<code class='php'>
&lt;?php
<b class='bad'>$uid = "";</b>
//subbing into the query string
$result = $db->query(
    "SELECT name FROM table WHERE user_id =$uid"
);
if($result){
    //
    $n = $result->fet_assoc()['name'];  //
    //$n = "''; DROP TABLE table";
    $result = $db->query(
        "SELECT * FROM table WHERE user_id = ''; DROP TABLE table"
    );
}
?&gt;
</code>
    This effectively bypasses the user_id,
instead returning all entries from table, for all users
allowing the attacker access to all private information,
then continues on, executing the command to destroy the table.
<code class='php'>
&lt;?php<b class='good'>
//preform a regular expression check to see if
//if the value is formatted as a 32 bit unsigned integer(as either bin, oct, dec, or hex),
//the function will escape the string passed to it
$uid = isUInt32($_POST['user_id']) ? intval($_POST['user_id']) : 0;
//if intval fails to convert to te string, 0 is returned
$db = new dbConnect();
//code fails here,
//no query is executed, disaster averted!
if($uid > 0){
    $result = $db->query(
        "SELECT * FROM table WHERE user_id = $uid"
    );
}
</b>?&gt;</code>
</pre>    
<ol>
    <li><a href='http://phpsecurity.readthedocs.org/en/latest/Injection-Attacks.html#disclosure-of-stored-data'>SQL Injection</a></li>
</ol>
<hr>
<h4>Regular Expressions</h4>
<pre>
    Both <a href="http://php.net/manual/en/reference.pcre.pattern.syntax.php">PHP</a> and <a href="http://www.w3schools.com/jsref/jsref_obj_regexp.asp">JavaScript</a> support expressing and manipulating string data using Regular Expressions.
Regular Expressions describe patterns within a sequence of characters.
The most common use is to preform pattern-matching and search-and-replace operations on text.
    RegEx's are most commonly used to validate the structure of data passed to a script via GET or POST,
as the server converts all parameters passed to it into strings,
for transfer over the web. These strings must re-validated by the script before use,
to ensure malicious entities haven't embedded hostile data into the parameters.
</pre>
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
<pre>   Processing in-game funds is managed by the server in PHP.
If the user is not a registered user, processing is off-loaded 
to the browser to simulate the interaction(as guests do not have access to the databases).
    An Ajax POST request is made to the server (from js),
where the transaction is validated and processed by the server,
before updating the user's table entry with the script returning their new funds,
which then uses jQuery to update the DOM to display the new values.
</pre>
<h3>Repairs and upgrades</h3><hr>
<pre>    Vehicle upgrades and repairs are represented by bitfields,

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
    {1000,1000,1000,1000}   //field fully upgraded

Hex Visual:
    {0x0,0x0,0x0,0x0}       //new
    {0x8,0x8,0x8,0x8}       //maxed

    The repair bit field contains 2 bytes(16-bits) representing
one repair for each part in each field. It takes on the structure:
    {drivetrain,body,interior,documents}
  
    When fully upgraded all bits are full(0xF) and the field values appear as such

{1111,1111,1111,1111}(bin)
    OR
{0xF,0xF,0xF,0xF}(hex)

    To access values in php or javascript a combination of bitshift and masking is required.

Bandwidth for a single user's vehicle(24-bytes)
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
<br>
<h3>TODO >>>>> The software is not adjusting the pricing to reflect the adjusted condition of the vehicle. See below for an example:</h3>
If a car shows in the spreadsheet I provided for $100000 that is the value of the vehicle at 100% condition
If the software adjusts the condition to 31%, the software needs to adjust the value accordingly. So that vehicle needs to be $31000. That number is what we need to create the variables for the AI bidders.
Our AI bidders are still bidding way to high. We should have them bidding from 75% to 125% of the adjusted value. 

</pre>
    <h3 id='store'>Store</h3><hr>
<pre>    The Auto-Obsessions' store processes user transitions via <a href=''>PayPal javescript API</a>.
Upon completion of the transaction, the user is updated.
</pre>
<h2 id='aodb'>Databases</h2><hr>
<pre>   Auto-Obsession implements several databases (with mySQLi) for maintaining user and application data.

aoMembersDB:contains the static vehicle table, aoCars, and the dynamic user's table, aoUsers, which contains all relevant registered user data .
aoUsersDB: contains a table for each user to maintain their car collection(garage), which has an entry for each car.
aoCarSalesDB: contains all data regarding the user's vehicle sales(existing, pending and expired).
aoAuctionLossDB: tracks the id's of the vehicles a user has lost and may no longer bid on.

<h3 id='mainDB'>aoMembersDB</h3>
    This database contains two distinct tables, both the vehicle and the user tables reside here.
    The vehicle table, named 'aoCars', is a static table which does not change during the execution.
Should only be changed when the site is down for maintenance.

Table:
<code class='sql'>
    --cars.sql
    --structure passed when using CREATE TABLE
    `car_id` int unsigned NOT NULL PRIMARY KEY,
    `make` varchar(30) NOT NULL,
    `year` int NOT NULL,
    `model` varchar(50) NOT NULL,
    `price` int unsigned NOT NULL,
    `info` char(255) NOT NULL
</code>
    car_id:represents the unique id of the vehicle, constructed from combining {make | year | model}.
    make:manufacturer which produced this vehicle
    year:year of production
    model:
    price:sale value of the vehicle
    info:a short description detailing the history/background of the vehicle.
    
    The user's table, named 'users' is a dynamic table containing all registered
users. These entries are updated frequently as the user progresses through the game.
Entries are added and removed via either register.php or disband.php,
which the user may register or disband their account, respectively.

<h3 id='usersDB'>aoUsersDB</h3>
    Dynamic database, containing a table entry for each registered user,
which each contain a collection of vehicles which each user has purchased,
and the unique upgrades and repairs purchased for each.
<code class='sql'>
    `car_id` int unsigned NOT NULL PRIMARY KEY,
    `drivetrain` int unsigned,
    `body` int unsigned,
    `interior` int unsigned,
    `docs` int unsigned,
    `repairs` int unsigned
</code>
    car_id:car owned by user(make, year and model can be derived from this)
    drivetrain:bitfield representing mods made to
    body:bitfield representing mods made to the car's exterior
    interior:bitfield representing mods made to the car's 
    docs:bitfield representing updates made to car's documentation
    repairs:4 groups of 4 bits(16-bits),
representing the repairs made to each component of each upgrade slot.
<h3 id='carSalesDB'>aoCarSalesDB</h3>
    Dynamic database containing a table for each user,
with entries containing the sales posted to the auction house by a user.
<code class='sql'>
    `car_id` int unsigned NOT NULL PRIMARY KEY,
    `price` float NOT NULL
</code>
    car_id:vehicle being posted for sale
    price:either the current price being bid(if active),
or the final, winning bid, if expired

<h3 id='lossDB'>aoAuctionLossDB</h3>
    Dynamic database containing a table for each user,
with entries containing the vehicle ids for each
auction a user has lost.
<code class='sql'>
    `car_id` int unsigned NOT NULL PRIMARY KEY
</code>
    Retains only the id of vehicles which are no longer available to select,
as the user has already failed to purchase the vehicle.
</pre>
<h2 id='aodb'>GameFlow UML</h2><hr>
<pre>
<img src='AOUML.jpg'><br>
UML Diagram depicts the transitions that exist in the game. Auto-Obsession is a User based website and game and the following is intended to help guide the programmers of 
the game to understand the screen transitional flow that should live in the totality of the project.
</pre>

<?php html::footer()?>