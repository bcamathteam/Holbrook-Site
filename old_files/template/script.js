/*********************************************************************\
 * template/script.js - javascript form verification                 *
 * BCA Math Competition Site                                         *
 * Author: Rajesh Ramakrishnan                                       *
 * Creation Date: 2006-May-24                                        * 
\*********************************************************************/

//---------+
// Globals |
//---------+
var GlobalFocus;
var ErrorClass = "alert";
var ValidClass = "name";
  
//-----------------------------------------+
// Methods directly called in registration |
//-----------------------------------------+
function Update(YearVar, MonthVar, DayVar) {
    var DisplayedDays, i, DaysInMonth, NewDay;
    DaysInMonth = LengthOfMonth(+YearVar.options[YearVar.selectedIndex].text, MonthVar.selectedIndex+1);
	 DisplayedDays = DayVar.options.length;
    if ((NewDay = DayVar.selectedIndex) >= DaysInMonth) {
        NewDay = DaysInMonth - 1;
    }
    for (i = DisplayedDays; i > DaysInMonth; i--) {
		  //alert("Displayed Days:" + DisplayedDays + "; Days In Month: " + DaysInMonth);
        RemoveLastDay(DayVar);
    }
    for (i = DisplayedDays + 1; i <= DaysInMonth; i++) {
		  //alert("Displayed Days:" + DisplayedDays + "; Days In Month: " + DaysInMonth);
        AddLastDay(DayVar, i);
    }
    DayVar.selectedIndex = NewDay;
}

function Validate(fn,ln,ad,ci,zi,sc,ea,ph)
{
	if(!(IsFilled(fn))) {
		alert("Please enter a first name!");
		SetFocus(fn); SwapClass("name",ErrorClass);
		return false;
	} else { SwapClass("name",ValidClass); }
	if(!(IsFilled(ln))) {
		alert("Please enter a last name!");
		SetFocus(ln); SwapClass("name",ErrorClass);
		return false;
	} else { SwapClass("name",ValidClass); }
	if(!(IsAddress(ad))) {
		alert("Please enter a proper street address, with number and street name!");
		SetFocus(ad); SwapClass("home_addr",ErrorClass);
		return false;
	} else { SwapClass("home_addr",ValidClass); }
	if(!(IsFilled(ci))) {
		alert("Please enter a valid home city!");
		SetFocus(ci); SwapClass("home_csz",ErrorClass);
		return false;
	} else { SwapClass("home_csz",ValidClass); }
	if(!(IsZipCode(zi))) {
		alert("Please enter a valid zip code (5 or 5+4 digits)!");
		SetFocus(zi); SwapClass("home_csz",ErrorClass);
		return false;
	}	else { SwapClass("home_csz",ValidClass); }
	if(!(IsFilled(sc))) {
		alert("Please enter a valid school!");
		SetFocus(sc); SwapClass("school",ErrorClass);
		return false;
	} else { SwapClass("school",ValidClass); }
	if(!(IsEmail(ea))) {
		alert("Please enter a valid email address!");
		SetFocus(ea); SwapClass("email",ErrorClass);
		return false;	
	} else { SwapClass("email",ValidClass); }
   if(!(IsPhone(ph))) {
      alert("Please enter a valid phone number!");
      SetFocus(ph); SwapClass("phone",ErrorClass);
      return false;
   } else { SwapClass("phone",ValidClass); }
	return true;
}

function Ack() {
	return confirm("Is this information correct?  Clicking OK will take you to the payment page.");
}

//--------------------------+
// Subroutines for Validate |
//--------------------------+
function IsFilled(FieldVar) 
{
	if(trim(FieldVar.value)=="") return false;
	return true;
}
function IsAddress(FieldVar) 
{
	if(trim(FieldVar.value)=="") return false;
	return true;
}
function IsPhone(FieldVar)
{
	if(trim(FieldVar.value)=="") return false;
	return true;
}
function IsEmail(FieldVar)
{
   var email = /^[^@]+@[^@.]+\.[^@]*\w\w$/
	if(!(email.test(trim(FieldVar.value)))) return false;
	return true;
}
function IsZipCode(FieldVar)
{
   var zip = /\d{5}(-\d{4})?$/
	if(!(zip.test(trim(FieldVar.value)))) return false;
	return true;
}
function SwapClass(ObjectID, NewClass)
{
	var Element = document.getElementById(ObjectID);
	Element.className = NewClass;
}

function trim(str)
{
  return str.replace(/^\s+|\s+$/g, '')
};

function SetFocusCallback()
{
	GlobalFocus.focus();
	GlobalFocus.value="";
}
function SetFocus(FieldFocus)
{
	GlobalFocus = FieldFocus;
	setTimeout('SetFocusCallback()', 100);
}

//------------------------+
// Subroutines for Update |
//------------------------+
function LengthOfMonth(Year, Month) {
  with (new Date(Year,Month,1,12)) 
  	{ 
		setDate(0); 
		return getDate() 
	} 
}

function AddLastDay(DayVar, num)
{
  var NewOption = document.createElement('option');
  NewOption.text = num;
  NewOption.value = num;

  try {
    DayVar.add(NewOption, null); // FF
  }
  catch(ex) {
    DayVar.add(NewOption); // IE 
  }
}

function RemoveLastDay(DayVar)
{
  //alert(DayVar);
  if (DayVar.length > 0) //stupid check
  {
    DayVar.remove(DayVar.length - 1);
  }
  else
  {
	  alert("No more days to remove!");
  }
}
