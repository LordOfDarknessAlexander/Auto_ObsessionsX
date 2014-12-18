var db = null;
function html5_storage_support() 
{
  try 
  {
    return 'localStorage' in window && window['localStorage'] == null;
  } 
  catch (e) 
  {
    return false;
  }
}

if (!window.localStorage) {
  Object.defineProperty(window, "localStorage", new (function () {
    var aKeys = [], oStorage = {};
    Object.defineProperty(oStorage, "getItem", {
      value: function (sKey) { return sKey ? this[sKey] : null; },
      writable: false,
      configurable: false,
      enumerable: false
    });
    Object.defineProperty(oStorage, "key", {
      value: function (nKeyId) { return aKeys[nKeyId]; },
      writable: false,
      configurable: false,
      enumerable: false
    });
    Object.defineProperty(oStorage, "setItem", {
      value: function (sKey, sValue) {
        if(!sKey) { return; }
        document.cookie = escape(sKey) + "=" + escape(sValue) + "; expires=Tue, 19 Jan 2038 03:14:07 GMT; path=/";
      },
      writable: false,
      configurable: false,
      enumerable: false
    });
    Object.defineProperty(oStorage, "length", {
      get: function () { return aKeys.length; },
      configurable: false,
      enumerable: false
    });
    Object.defineProperty(oStorage, "removeItem", {
      value: function (sKey) {
        if(!sKey) { return; }
        document.cookie = escape(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
      },
      writable: false,
      configurable: false,
      enumerable: false
    });
    this.get = function () {
      var iThisIndx;
      for (var sKey in oStorage) {
        iThisIndx = aKeys.indexOf(sKey);
        if (iThisIndx === -1) { oStorage.setItem(sKey, oStorage[sKey]); }
        else { aKeys.splice(iThisIndx, 1); }
        delete oStorage[sKey];
      }
      for (aKeys; aKeys.length > 0; aKeys.splice(0, 1)) { oStorage.removeItem(aKeys[0]); }
      for (var aCouple, iKey, nIdx = 0, aCouples = document.cookie.split(/\s*;\s*/); nIdx < aCouples.length; nIdx++) {
        aCouple = aCouples[nIdx].split(/\s*=\s*/);
        if (aCouple.length > 1) {
          oStorage[iKey = unescape(aCouple[0])] = unescape(aCouple[1]);
          aKeys.push(iKey);
        }
      }
      return oStorage;
    };
    this.configurable = false;
    this.enumerable = true;
  })());
}


//CHECK TO SEE IF THE BROWSER IS COMPATIBLE 
if (!html5_storage_support) 
{
  alert("This Might Be a Good Time to Upgrade Your Browser or Turn On Jeavascript");
} 
else 
{
  
	//OPEN AND OR CREATE THE DATABASE ON THE USERS MACHINE
	db = openDatabase("MyContacts", "1", "My Personal Contacts", 100000);
  
	function storeMyContact(id) 
	{
		var fullname	= document.getElementById('fullname').innerHTML;
		var phone		= document.getElementById('phone').innerHTML;
		var email		= document.getElementById('email').innerHTML;
		localStorage.setItem('mcFull',fullname);
		localStorage.setItem('mcPhone',phone);
		localStorage.setItem('mcEmail',email);
	}
  //GET STORED VALUES FROM KEYS TO DEFINE JAVASCRIPT VALUES OR DEFINE IF THEY DO NOT EXIST
  function getMyContact() 
  {
    if ( localStorage.getItem('mcFull')) 
    {
      var fullname	= localStorage.getItem('mcFull');
      var phone		= localStorage.getItem('mcPhone');
      var email		= localStorage.getItem('mcEmail');
    }
    else 
    {
      var fullname	= 'Click And Enter A Name';
      var phone		= 'Click And Enter A Phone Number';
      var email		= 'Click And Enter An Email Address';
    }
    document.getElementById('fullname').innerHTML = fullname;
    document.getElementById('phone').innerHTML = phone;
    document.getElementById('email').innerHTML = email;
  }
 
  function store()
  {
     var fullname = document.getElementById("fullname");
     localStorage.setItem("fullname", fullname.value);
     
     var phone = document.getElementById("phone");
     localStorage.setItem("phone", phone.value);
     
     var email = document.getElementById("email");
     localStorage.setItem("email", email.value);
     
     console.log("full Name " + fullname.value + "Phone " + phone.value + "email" + email.value);

  }
	
  function clearLocal() 
  {
    clear: localStorage.clear(); 
    return false;
  }
}