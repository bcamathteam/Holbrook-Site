<%@LANGUAGE="VBSCRIPT" CODEPAGE="1252"%>
<!--#include file="template/top.asp"--> 
  <!--<br>-->
  
<head>
<style type="text/css">
.auto-style1 {
	text-align: left;
}
</style>
</head>

  <h2 class="txt">
	Registration Step 1: Student Info
	</h2>
<!--<h3 class="txt">Registration Form</h3>-->
<p class="info">All fields are required. ENTER INFO CAREFULLY ! Your First 
name and Last name will&nbsp; appear exactly on the certificate as 
you have entered in 
these fields below. Be sure to select your grade form pulldown tab.&nbsp; Have your payment information ready before proceeding. The registration fee is non-refundable</p>
<p class="warn">Ensure that your internet security settings are at the "Medium-Low" level.  If you experience problems, use a different computer to register.
<br><br>If you have any questions, <a href="mailto:1mathteam1@bergen.org">Click here to email us [1mathteam1@bergen.org]</a>.<br></p>
<form method="post" action="doreg.php" onSubmit="return Validate(first_name, last_name, home_addr, home_city, home_zip, school, email, phone)">
  <table class="info">
    <tr>
      <td class="name" width="250" id="name">First Name</td>
      <td width="450">
          &nbsp;&nbsp;<input type="text" name="first_name" size="30" tabindex="1" maxlength="45">&nbsp;<img src="space.gif" height=0 width=2 border=0>
			 </td>
    </tr>
    <tr>
      <td class="name" width="250" id="name">Last Name<br></td>
      <td width="450">
			 &nbsp;&nbsp;<input type="text" name="last_name" size="30" tabindex="2" maxlength="45"></td>
    </tr>
    <tr>
      <td class="name" id="home_addr">Home Address </td>
      <td>
          &nbsp;&nbsp;<input type="text" name="home_addr" size="67" tabindex="3" maxlength="200">
      </td>
    </tr>
    <tr>
      <td class="name" id="home_csz">City, State, Zip </td>
      <td>
          &nbsp;&nbsp;<input type="text" name="home_city" size="25" tabindex="4" maxlength="60">,
          <% Call MakeState("home_state",5) %>
          <script lang="javascript">if (navigator.appVersion.indexOf("MSIE")!=-1){ document.write('<img src="images/space.gif" height=0 width=4 border=0>'); }</script><input type="text" name="home_zip" size="10" tabindex="6"></td>
    </tr>
    <tr>
		<td class="name" id="birth">Birth Date</td>
      <td>&nbsp;
          <% Call MakeDateWithValidation("birth_year", "birth_month", "birth_day", 1999, 2010, "--", "--", False, True, 7) %></td>
    </tr>
	 <tr>
	 	<td class="name" id="grade">Grade</td>
		<td class="auto-style1">&nbsp;&nbsp;<select name="grade" tabindex="10">
				<option value="4">4 - Fourth</option>
				<option value="5">5 - Fifth</option>
				<option value="6">6 - Sixth</option>
				<option value="7">7 - Seventh</option>
				<option value="8">8 - Eighth</option>
			</select> <b>&nbsp;&nbsp;&nbsp;&nbsp; (In October 2016)</b></td>
	 </tr> 
    <tr>
      <td class="name" id="school">School</td>
      <td>
          &nbsp;&nbsp;<input type="text" name="school" size="67" tabindex="11" maxlength="200">
      </td>
    </tr>	 
    <tr>
      <td class="name" id="email">Email Address</td>
      <td>
          &nbsp;&nbsp;<input type="text" name="email" size="67" tabindex="12" maxlength="100">
      </td>
    </tr>
    <tr>
      <td class="name" id="phone">Phone Number</td>
      <td>
          &nbsp;&nbsp;<input type="text" name="phone" size="67" tabindex="13" maxlength="14">
      </td>
    </tr>
  </table>
  <p class="minus1">&nbsp;<input type="checkbox" name="release" tabindex="13" checked> I allow my child's name and likeness to be used on BCA Math Competition press releases</p>
  <center>
    <input type="submit" name="submit" value="Continue to Step 2 >>" tabindex="14" size="100" >
  </center>
</form>
<!--#include file="template/bottom.asp"-->
