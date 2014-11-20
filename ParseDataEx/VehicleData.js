
var mPrevDisplay;
var mPrevTab;
var mDataWritePoint;
var mNumDays;
var mDays;
var mDynamicCodeString;
var mFullDateStrings;
var mEvents;
var mMPLimits;

var TimesEnum = {
	ANY: 0,
	MORNING: 1,
	AFTERNOON: 2,
	EVENING: 3
};
	
	$(document).ready(function () {
        initialize();
    });
		
	function initialize()
	{	
		mDataWritePoint = document.getElementById('tabbed-data');
		if(loadXMLDoc('vehicles.xml') == false)
		{
			window.open("/pdf/2014Schedule.pdf", "_blank");
		}
		mPrevDisplay = document.getElementById('table_full');
		mPrevTab = document.getElementById('tab_full');
	}
   function toggle_visibility(id) 
   {
		var e = document.getElementById(id);
	   
		if(id == 'table_full')
		{
			for(var i = 1; i < mNumDays+1; ++i)
			{
				var d = document.getElementById('table_day' + i);
				d.style.display = 'block';
			}
		}
		else
		{		
			if(e != mPrevDisplay)
			{
				mPrevDisplay.style.display = 'none';
				if(mPrevDisplay.id == 'table_full')
				{
					for(var i = 1; i < mNumDays+1; ++i)
					{
						var d = document.getElementById('table_day' + i);
						d.style.display = 'none';
					}
				}
				
				e.style.display = 'block';
			}
		}
		mPrevDisplay = e;
   }
   function toggle_background(element) {
		if(element != mPrevTab)
		{
			element.style.background='deeppink';
			mPrevTab.style.background='white';
			mPrevTab = element;	
		}
   }
   function loadXMLDoc(url)
   {
		reader = createReader();
		var doc = openDoc(url, reader);
		if(typeof doc === 'undefined')
		{
			return false;	
		}
		showData(doc);
		return true;
   }
   
  	
	
	function createReader()
	{
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		      
		if(xmlhttp)
		{
		}
		else
		{
		  window.open("/pdf/2014Schedule.pdf", "_blank");
		}
		
        return xmlhttp;
    }

    function openDoc(url, reader)
    {
		reader.open("GET",url,false);
		reader.send();
		var doc=reader.responseXML;
      
		if(xmlhttp)
		{
			//alert ("new xml document created");
		}
		else
		{
		  alert("doc gronk!");
		}       
		return doc;  
	}
	
	function getFullDate(dd_mm_yyyy)
	{
		var ret;
		
		switch(parseInt(dd_mm_yyyy.substr(3, 2)))
		{
			case 1:
				ret = "January ";
				break;
			case 2:
				ret = "February ";
				break;
			case 3:
				ret = "March ";
				break;
			case 4:
				ret = "April ";
				break;
			case 5:
				ret = "May ";
				break;
			case 6:
				ret = "June ";
				break;
			case 7:
				ret = "July ";
				break;
			case 8:
				ret = "August ";
				break;
			case 9:
				ret = "September ";
				break;
			case 10:
				ret = "October ";
				break;
			case 11:
				ret = "November ";
				break;
			case 12:
				ret = "December ";
				break;
			default:
				ret = " ";
				alert("Invalid month date entry.");
				break;
		}
		
		ret = ret.concat(parseInt(dd_mm_yyyy.substr(0,2)));
		
		if(parseInt(dd_mm_yyyy.substr(0,1)) == 1)
		{
			ret = ret.concat("th, ");
		}
		else
		{
			switch(parseInt(dd_mm_yyyy.substr(1,1)))
			{
				case 1:
					ret = ret.concat("st, ");
					break;
				case 2:
					ret = ret.concat("nd, ");
					break;
				case 3:
					ret = ret.concat("rd, ");
					break;
				default:
					ret = ret.concat("th, ");
					break;	
			}
		}
		
		ret = ret.concat(parseInt(dd_mm_yyyy.substr(6)));
		
		return ret;
	}
	
	function showData(doc)
	{
		mDays = doc.getElementsByTagName('day');
		mNumDays = mDays.length;
		mDynamicCodeString = "<div id='tab_full' class ='tab tab-highlit'> <a class='tab-anchor' onclick='toggle_visibility(\"table_full\"); toggle_background(this)'> Full </a> </div>";
		mFullDateStrings = new Array();
		mEvents = new Array();
		mMPLimits = new Array();
		
		for(i = 0; i < mNumDays; ++i)
        {
			var dateString = mDays.item(i).getAttribute("date"); 
			mFullDateStrings[i] = getFullDate(dateString);
			mDynamicCodeString = mDynamicCodeString.concat("<div id='tab_day" + (i+1) + "' class = 'tab'> <a class='tab-anchor' onclick='toggle_visibility(\"table_day" + (i+1) + "\"); toggle_background(this)'>" + dateString + " </a> </div>");
		}
		
		mDynamicCodeString = mDynamicCodeString.concat("<div id='table_full' class='tab-display tab-display-hidden'> <h2> All Events </h2> </div>");
				
		for(j = 0; j < mNumDays; ++j)
        {
			var events = mDays.item(j).getElementsByTagName("event");
			
			mDynamicCodeString = mDynamicCodeString.concat("<div id='table_day" + (j+1) + "' class='tab-display'>" + "<h2>" + mFullDateStrings[j] + ": </h2>");
			
			for(k = 0; k < events.length; ++k)
			{			
				var strats = events.item(k).getElementsByTagName("strat");
				events.item(k).subtitle = "";
				events.item(k).outputString = "";
				events.item(k).type = events.item(k).getAttribute("type");
				events.item(k).highs = new Array();
				var highs = new Array();
				if(strats.length == 0)
				{
					events.item(k).subtitle="Stratified by entries";
				}
				else
				{
					for(l = 0; l < strats.length; ++l)
					{
						var stratid = strats.item(l).getAttribute("id");
						var low = strats.item(l).getAttribute("low");
						highs.push(strats.item(l).getAttribute("high"));
						
						if(highs[l] == "+")
						{
							events.item(k).subtitle = events.item(k).subtitle + stratid + ": " + low + "+ ";
						}
						else
						{
							events.item(k).subtitle = events.item(k).subtitle + stratid + ": " + low + " to " + highs[l] + " ";  
							if(mMPLimits.indexOf(highs[l]) == -1)
							{
								mMPLimits.push(highs[l]);
							}
							
						}
                    }           
				}  			

				var matchingEvent = -1;
				
				for(var m = 0; m < k; ++m)
				{
					if(events.item(m).getAttribute("name") == events.item(k).getAttribute("name") && events.item(m).subtitle == events.item(k).subtitle)
					{
						matchingEvent = m;
					}
				}
				
				if(matchingEvent == -1)
				{
					var eventName = events.item(k).getAttribute("name");
					events.item(k).type = events.item(k).getAttribute('type');
					events.item(k).outputString = " <h3 id=h3" + j + k + "> " + events.item(k).getAttribute('name') + " </h3> ";
				}
				
				var sessions = events.item(k).getElementsByTagName("session");         
				if(sessions.length != 1)
				{
				  alert("Opps!  Session gronk!");
				  return;
				} 
				events.item(k).time = sessions.item(0).getAttribute("time");
				
				if(matchingEvent == -1)
				{
					events.item(k).outputString = events.item(k).outputString + " <h4 id=h4" + j + k + "> " + events.item(k).time;
					for(var u = 0; u < highs.length; ++u)
					{
						events.item(k).highs.push(highs[u]);
					}
					events.item(k).visible = true;
					events.item(k).hasText = true;
				}
				else
				{
					events.item(matchingEvent).outputString = events.item(matchingEvent).outputString + " & " + events.item(k).time;
					events.item(matchingEvent).time = events.item(matchingEvent).time.concat(" & ", events.item(k).time);
					for(var u = 0; u < highs.length; ++u)
					{
						events.item(matchingEvent).highs.push(highs[u]);
					}
					events.item(k).hasText = false;
				} 
			}

			for(n = 0; n < events.length; ++n)
			{
				if(events.item(n).visible == true)
				{
					mDynamicCodeString = mDynamicCodeString.concat(events.item(n).outputString," </h4> <wbr>  <h5 class = 'subtitle' id=h5" + j + n + "> " + events.item(n).subtitle + " </h5> <wbr>");
				}
			}
			
			mDynamicCodeString = mDynamicCodeString.concat("</div>");
			
			//mDays.item(j).events = events;
			mEvents[j] = events;
		}
		
		addMPLimitOptions();
		mDataWritePoint.innerHTML = mDynamicCodeString;
	}		
	
	function addMPLimitOptions()
	{
		mMPLimits.sort(function(a, b){return b-a});
		
		var htmlString = "<option value = '1'>Any</option> <option value = '2'>Unlimited</option>";
		
		for(var i = 0; i < mMPLimits.length; ++i)
		{
			htmlString = htmlString.concat("<option value ='",(i + 3),"'>", mMPLimits[i],"</option>");
		}
		
		document.getElementById("mp_limit_select").innerHTML = htmlString;
	}
	
	function filter()
	{
		filterByType();
		filterByTime();
		filterByMPLimit();
		
		showVisibleEvents();
	}
	
	function filterByType()
	{
		var gameTypeSelect = document.getElementById("game_type_select");
		var reqType;
				
		switch(parseInt(gameTypeSelect.value))
		{
			case 1:
				reqType = "any";
			break;
			case 2:
				reqType = "mp pairs";
			break;
			case 3:
				reqType = "swiss teams";
			break;
			case 4:
				reqType = "ko";
			break;
			case 5:
				reqType = "compact ko";
			break;
		}
		
		for (var i = 0; i < mDays.length; ++i)
		{
			mDays.item(i).visible = false;
			
			for(var j = 0; j < mEvents[i].length; ++j)
			{
				if(reqType != "any" && mEvents[i].item(j).type != reqType)
				{
					mEvents[i].item(j).visible = false;
				}
				else
				{
					mEvents[i].item(j).visible = true;
					mDays.item(i).visible = true;
				}	
			}
		}
	}
	
	function filterByTime()
	{
		var startTimeSelect = document.getElementById("start_time_select");
		var timeOfDay;
				
		switch(parseInt(startTimeSelect.value))
		{
			case 1:
				timeOfDay = TimesEnum.ANY;
			break;
			case 2:
				timeOfDay = TimesEnum.MORNING;
			break;
			case 3:
				timeOfDay = TimesEnum.AFTERNOON;
			break;
			case 4:
				timeOfDay = TimesEnum.EVENING;
			break;
		}
		
		for (var i = 0; i < mDays.length; ++i)
		{
			if(mDays.item(i).visible == true)
			{
				mDays.item(i).visible = false;
				
				for(var j = 0; j < mEvents[i].length; ++j)
				{
					if(mEvents[i].item(j).visible == true && mEvents[i].item(j).hasText == true)
					{
						if(timeOfDay != TimesEnum.ANY && isTimeOfDay(mEvents[i].item(j).time, timeOfDay) == false)
						{
							mEvents[i].item(j).visible = false;
						}
						else
						{
							mDays.item(i).visible = true;
						}	
					}
				}
			}
		}
	}
	
	function filterByMPLimit()
	{
		var MPLimitHigh = document.getElementById("mp_limit_select");
		var chosenLimit;
		
		if(MPLimitHigh.value == 1)
		{
			chosenLimit = "any";
		}
		else if(MPLimitHigh.value == 2)
		{
			chosenLimit = "+";
		}
		else
		{
			chosenLimit = parseInt(MPLimitHigh.options[MPLimitHigh.value - 1].text);
		}
		
		for (var i = 0; i < mDays.length; ++i)
		{
			if(mDays.item(i).visible == true)
			{
				mDays.item(i).visible = false;
				
				for(var j = 0; j < mEvents[i].length; ++j)
				{
					if(mEvents[i].item(j).visible == true)
					{
						if(chosenLimit == "any" || mEvents[i].item(j).subtitle == "Stratified by entries")
						{
							mDays.item(i).visible = true;
							mEvents[i].item(j).visible = true;
						}
						else
						{
							mEvents[i].item(j).visible = false;
							for(var k = 0; k < mEvents[i].item(j).highs.length; ++k)
							{
								if(mEvents[i].item(j).highs[k] == chosenLimit)
								{
									mEvents[i].item(j).visible = true;
									mDays.item(i).visible = true;
								}
							}
						}	
					}
				}
			}
		}
	}
	
	
	function isTimeOfDay(time, timeOfDay)
	{
		if(timeOfDay == TimesEnum.ANY)
		{
			return true;
		}
		
		if(timeOfDay == TimesEnum.MORNING)
		{
			if(time.indexOf("a") > -1)
			{
				return true;
			}
			return false
		}
		
		var temp = time.replace(/:|a|p|m/g, '');
		
		if(time.indexOf("&") != -1)
		{
			temp = temp.substr(temp.indexOf("&") + 2);
		}
	
		if(parseInt(temp) < 600 && timeOfDay == TimesEnum.AFTERNOON)
		{
			return true;
		}
		if(parseInt(temp) > 600 && timeOfDay == TimesEnum.EVENING)
		{
			return true;
		}
	
		return false;
	}
	
	
	function showVisibleEvents()
	{
		for (var i = 0; i < mDays.length; ++i)
		{
			var table_display = document.getElementById("table_day" + (i+1));
			
			if(mDays.item(i).visible == true)
			{
				table_display.style.display = "block";
			
				for(var j = 0; j < mEvents[i].length; ++j)
				{
					if(mEvents[i].item(j).hasText == true)
					{
						var eventName = document.getElementById("h3" + i + j);
						var eventTime = document.getElementById("h4" + i + j);
						var eventSubtitle = document.getElementById("h5" + i + j)
						
						if(mEvents[i].item(j).visible == true)
						{
							eventName.style.display = "inline-block";
							eventTime.style.display = "inline-block";
							eventSubtitle.style.display = "inline-block";
						}
						else
						{
							eventName.style.display = "none";
							eventTime.style.display = "none";
							eventSubtitle.style.display = "none";
						}
					}
				}
			}	
			else
			{
				table_display.style.display = "none";
			}
		}	
	}
	
	


	
	
	