/*
	Function Name: checkLength
	Arguments: text,min?,max?
	Returns:
		false if text has fewer than min characters
		false if text has more than max characters
		true otherwise
*/
function checkLength(text, min, max){
	min = min || 1;
	max = max || 10000;

	if (text.length < min || text.length > max) {
		return false;
	}
	return true;
}

/*
	Function Name: compareValues
	Arguments: val1, val2
	Returns:
		0 if two values are equal
		-1 if val1 is greater than val2
		1 if val2 is greater than val1
*/
function compareValues(val1, val2)
{
	if (val1 > val2) 
	{
		return -1;
	} 
	else if(val2 > val1) 
	{
		return 1;
	} 
	else 
	{
		return 0;
	}
}

/*
	Function Name: checkEmail
	Arguments: email
	Returns:
		false if email has fewer than 6 characters
		false if email does not contain @ symbol 
		false if email does not contain a period (.)
		true otherwise
*/
function checkEmail(email)
{
	if (!checkLength(email, 6)) 
	{
		return false;
	} 
	else if (email.indexOf("@") == -1) 
	{
		return false;
	} 
	else if (email.indexOf(".") == -1) 
	{
		return false;
	}
	/* THIS LAST ELSE IF FROM CHALLENGE */
	else if (email.lastIndexOf(".") < email.lastIndexOf("@")) 
	{
		return false;
	}
	return true;
}


function validate(form)
{
	//registered name
	var firstName = form.FirstName.value;
	var midInit = form.MidInit.value;
	var lastName = form.LastName.value;
	//location info
	var city = form.City.value;
	var state = form.State.value;
	var country = form.Country.value;
	var zipCode = form.Zip.value;
	//personal info
	var email = form.Email.value;
	var userName = form.Username.value;
	var password1 = form.Password1.value;
	var password2 = form.Password2.value;
	//
	var errors = [];
	
	if (!checkLength(firstName)) 
	{	//user errors.append, array is being indexed outside outside its bounds(.length -1)!
		//javascript resizes the array, apparently. This is bad practice,
		//as it may cause security issues with other languages
		//eg. allocate array of 3 ints
		//[0,1,2](<-end of array)[array@length of 3], accessing data in another piece of memory,
		//which may be uninitialized or already allocated as a different object
		errors[errors.length] = "You must enter a first name.";
	}

	if (!checkLength(midInit, 1, 1)) 
	{
		errors[errors.length] = "You must enter a one-letter middle initial.";
	}

	if (!checkLength(lastName)) 
	{
		errors[errors.length] = "You must enter a last name.";
	}

	if (!checkLength(city)) 
	{
		errors[errors.length] = "You must enter a city.";
	}

	if (!checkLength(state, 2, 2)) 
	{
		errors[errors.length] = "You must enter a state abbreviation.";
	}

	if (!checkLength(country)) 
	{
		errors[errors.length] = "You must enter a country.";
	}

	if (!checkLength(zipCode, 5, 10)) 
	{
		errors[errors.length] = "You must enter a valid zip code.";
	}

	if (!checkLength(userName)) 
	{
		errors[errors.length] = "You must enter a username.";
	}

	if (!checkEmail(email)) 
	{
		errors[errors.length] = "You must enter a valid email address.";
	}

	if (!checkLength(password1)) 
	{
		errors[errors.length] = "You must enter a password.";
	} else if (compareValues(password1, password2) !== 0) 
	{
		errors[errors.length] = "Passwords don't match.";
	}

	if (errors.length > 0) 
	{
		reportErrors(errors);
		return false;
	}

	return true;
}

function reportErrors(errors)
{
	var msg = "There were some problems...\n";
	var numError;
	for (var i = 0; i<errors.length; i++) 
	{
		numError = i + 1;
		msg += "\n" + numError + ". " + errors[i];
	}
	alert(msg);
}
