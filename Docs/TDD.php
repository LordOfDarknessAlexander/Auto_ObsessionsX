<?php
//The contents of this document is for 851 Entertainment staff and authorized affiliates
//It's content is subject to trade secret and not to be publicly accessed!
require_once '../include/html.php';

class a{
    //class representing common html Anchor elements used through out docs
    //websites
    //public static function google(){<a href='www.google.ca'>Google</a>}
    public static function php(){?>
<a href='www.php.php'>PHP</a>
<?php
    }
    //public static function python(){<a href=''>Python</a>}
    //public static function perl(){<a href=''>Perl</a>}
    //public static function javascript(){<a href=''>JavaScript</a>}
    //public static function json(){<a href='http://json.org/'>JSON</a>}
    //public static function css(){<a href='http://www.w3schools.com/cssref/'>CSS</a>}
    //public static function html(){<a href=''>HTML</a>}
    //browsers
    //public static chrome(){<a <a href='www.google.com/chrome/‎'>Google Chrome</a>}
    //public static friefox(){<a href=''>Mozilla Firefox</a>}
    //public static safari(){<a href=''>Safari</a>}
    //public static opera(){<a href=''>Opera</a>}
    //public static explorer(){<a href=''>Internet Explorer</a>}
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
    color:lightgrey;
}
p.good{color:green;}
p.ok{color:yello;}
p.bad{color:red;}
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
            <li><a href='#text'>Text</a></li>
            <li><a href='#imgs'>Images</a></li>
            <li><a href='#audio'>Audio</a></li>
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
</ol>
<hr><h2>Standards</h2><hr>
<h3 id='fileFormats'>File formats:</h3><hr>
    <h4 id='text'>Text</h4>
    All files should be UTF-8 encoded.<br>
    PHP:<br>
    HTML:<br>
    XML:<br>
    JavaScript:<br>
    CSS:<br>
    <h4 id='imgs'>Images</h4>
	All large image resources, such as backgrounds, car photos assume the JPG format.<br>
		Logos for advertising are currently 385x85 .png, as they are small images where retention of resolution is important.<br>
			IMPORTANT! Any logos which are registered trademarks much be licensed appropriately before hosting final page, to avoid legal action.
    <h4 id='audio'>Audio</h4>
    All audio files are MP3.

<h3 id=''>String Formatting</h3><hr>
    Html/xml makes extensive use of quotes and double quotes for the
declaration of strings will be 
As html is often embedded inside other strings it quickly
become difficult to read
ALWAYS USE SINGLE QUOTES IN HTML, unless absolutely necessary(then the use of an html entity would be preffered)

<h3 id='jsH'>javascript</h3><hr>
    use single quoted string. json
    
<p class='good'>var str = '{"id":"string"}';</p>
<p class='bad'>var str = "{\"id\":\"string\"}";</p>
    The exception is if it has html or url paths embedded.
"images/defaultBtn.png";   requires only single slash
<br>
This method can clearly distinguish the embedded quotes when expressed as a string:<br>
<p class='good'>var htmlStr = "&lt;button id='" + id + "'&gt;text&lt;/button&gt;";</p><br>
Oppossed to using double quote inside double quotes:
<p class='bad'>var htmlStr = "&lt;button id=\"" + id + "\"&gt;text&lt;/button&gt;";</p><br>

<h3 id='phpH'>PHP</h3><hr>
    <a href='http://php.net/language.types.string'>PHP</a> differentiates single and double quoted strings with
certain distinctions.<br>
    Single quoted string require the escaping of special characters, /, ', etc
They are to be used in simple strings which do not contain embedded data(html/json)
and do not require the substitution of variables.

<p class='good'>$str = 'simple string'; //keep it simple, nothing complex</p>
<p class='bad'>$str = 'this \' must be escaped';</p>
<p class='good'>$str = '{"id":"string"}';</p>

    Double quoted string may contain single quotes without escaping,
and support the direct substitution of variables.
<p class='bad'>$str = "simple string";  //double quote for 'complex strings', nothing special here</p>
<p class='good'>$str = "this ' doesn't need escapin'!";</p><br>
When embedding dynamic variables into a string this format is preffered
<p class='good'>
&lt;?php<br>
$str = 'guid'; //simple string<br>
echo "&lt;button id='$str'&gt;This can't be real&lt;/button&gt;";   //embeded string in a button<br>
$str = "SELECT $str FROM table";   //embeded string as an sql statement, $str will be replaced by the literal value(not including the qutoes)<br>
?&gt;</p>
<h3 id='jsonH'>JSON</h3><hr>
    The <a href = 'http://json.org/'>json standard</a> requires the use of double quotes for expressing all string data
This makes for rather cumbersome syntax which is less flexible.

<p class='bad'>"{\"id\":\"string data\"}" //ugly</p>
<p class='good'>'{"id":"string"}';   //better</p>
    
tip:
    In php and javascript, use json_encode() or JSON.stringify() to convert complex data objects into valid JSON strings
<hr><h2>Game Mechanics</h2><hr>
<h3 id='carLC'>Vehicle Life Cycle</h3><hr>
<h4 id='buying'>Auction/Buying<h4><hr>
<h4 id='owning'>Garage-life/Owning</h4><hr>
<h4 id='selling'>Making money/Selling</h4><hr>
<h3>Repairs and upgrades</h3><hr>
    Vehicle upgrades and repairs are represented by bitfields, minimizing bandwidth from sql queries and sending data with php/ajax by overlaying complex abstractions atop collections of bits(more specificly chars, shorts and ints) 
    <br>
    Each field is represented by 4(8-bit) bytes taking the form {XXXX,FFFF}<br>
    Each group of 4 bits represents a single part of the car. The X's and reserved and not used<br>
    
    Each bit represents one of 5 stages:<br>
        0x0(no upgrade)
        0x1(stage 1)
        0x2(stage 2)
        0x4(stage 3)
        0x8(stage 4)
    <br>
    Binary Visual:<br>
        {0000,0000,0000,0000}    //new part<br>
        {1000,1000,1000,1000}   //field fully upgraded<br>
    <br>
    Hex Visual:<br>
        {0x0,0x0,0x0,0x0}       //new<br>
        {0x8,0x8,0x8,0x8}       //maxed<br>
   <br> 
    The repair bit field contains 2 bytes(16-bits) representing
one repair for each part in each field. It takes on the structure<br>
    {drivetrain,body,interior,documents}
    <br>    
    When fully upgraded all bits are full(0xF) and the field values appear as such
    <br>
    {1111,1111,1111,1111}(bin) OR {0xF,0xF,0xF,0xF}(hex)
    <br>
    To access values in php or javascript a combination of bitshift and masking is required.
    <br>
    Bandwidth for single user's vehicle(24-bytes)<br>
        id uint(4)
        dt uint(4)
        body uint(4)
        interior uint(4)
        docs uint(4)
        repairs uint(4)
    <br>
    pending updates/overhaul could be reduced to (16-bytes)<br>
        id uint(4)
        dt/body uint(4)
        interior/docs uint(4)
        repairs uint(4)
    <br>
    <h3 id='ai'>AI</h3><hr>
    The AI drives the user's bidding experienece. To bypass the complexity of interacting peer to peer, randomized AI are implimented to simulate and engaging user experience.
    <h3 id='store'>Store</h3><hr>
    The Auto-Obsessions' store processes user transations via <a href=''>PayPal javescript API</a>
<?php html::footer()?>