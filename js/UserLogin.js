var count = 2;
function userLogin() 
{
	
	//usernames
	var userName = document.login.username.value;
	//passwords
	var pw = document.login.pword.value;
	var valid = false;
	//Username array
	var userNames = ["Philip", "George", "Sarah", "Michael", "Dante"];  // as many as you like - no comma after final entry
	var pwArray = ["Password1", "Password2", "Password3", "Password4", "Dante666"];  // the corresponding passwords;
	
	for (var i=0; i <userNames.length; i++) 
	{
		if ((userName == userNames[i]) && (pw == pwArray[i])) 
		{
			valid = true;
			break;
		}
	}
	
	if (valid) 
	{
		alert ("Login was successful");
		//window.location = "http://www.google.com";
	    userNames[i] == userText;
	    userLogged = true;
	   // localStorage.setItem('mcFull',fullname);

	  // startGame();
	   
		return false;
	}

var t = " tries";
	if (count == 1) 
	{
		t = " try";
	}

	if (count >= 1) 
	{
		alert ("Invalid username and/or password.  You have " + count + t + " left.");
		document.login.username.value = "";
		document.login.pword.value = "";
		setTimeout("document.login.username.focus()", 25);
		setTimeout("document.login.username.select()", 25);
		count --;
	}

	else 
	{
		alert ("Still incorrect! You have no more tries left!");
		document.login.username.value = "No more tries allowed!";
		document.login.pword.value = "";
		document.login.username.disabled = true;
		document.login.pword.disabled = true;
		return false;
	}

}
