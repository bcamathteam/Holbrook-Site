<%
'*********************************************************************'
'* template/functions.asp - Dynamic Registration Form Factories      *'
'* BCA Math Competition Site                                         *'
'* Author: Rajesh Ramakrishnan                                       *'
'* Creation Date: 2006-May-23                                        *' 
'*********************************************************************'
' To keep a persisted file log, keep the above banner and add a comment below this line if you are editing the page '
' Be sure to add an apostrophe at the end of the line, as non-VIM editors will try to match as quotes, not comments '


' Make 3 Drop-down boxes corresponding to YMD, with validation '
Function MakeDateWithValidation(YearVar, MonthVar, DayVar, StartYear, EndYear, YearMonthDelim, MonthDayDelim, MonthAbbreviated, MonthWithNumeric, TabIndex)
%><%
	Call MakeYearWithValidation(YearVar, MonthVar, DayVar, StartYear, EndYear, TabIndex)
%><%= YearMonthDelim %><% 
	Call MakeMonthWithValidation(YearVar, MonthVar, DayVar, StartYear, EndYear, TabIndex+1, MonthAbbreviated, MonthWithNumeric)
%><%= MonthDayDelim %><% 
	Call MakeDayWithValidation(YearVar, MonthVar, DayVar, StartYear, EndYear, TabIndex+2)
%><%
End Function

' Make Month Drop-down box, with Validation '
Function MakeMonthWithValidation(YearVar, MonthVar, DayVar, StartYear, EndYear, TabIndex, MonthAbbreviated, MonthWithNumeric) %>
<select name="<%= MonthVar %>" onChange="Update(<%= YearVar %>, <%= MonthVar %>, <%= DayVar %>)" tabindex="<%= TabIndex %>">
<%
    Dim i, TempMonthName, TempMonthNameDisplay
    For i = 1 to 12
        TempMonthName = MonthName(i, MonthAbbreviated) ' August vs Aug'

        If MonthWithNumericNumeric Then 
            TempMonthNameDisplay =  i & " - " & TempMonthName ' Month starts from January = 1 '
        Else
            TempMonthNameDisplay = TempMonthName
        End If

        If Month(Now) = i Then ' as a cute addendum, make the month match the current month '
%>	<option selected="selected" value="<%= i %>"><%= TempMonthNameDisplay %></option><%= vbCrLf %>
<%        Else
%>	<option value="<%= i %>"><%= TempMonthNameDisplay %></option><%= vbCrLf %>
<%        End If
    Next
%>
</select>
<%
End Function

' Make Year Drop-down box, with Validation '
Function MakeYearWithValidation(YearVar, MonthVar, DayVar, StartYear, EndYear, TabIndex) %>
<select name="<%= YearVar %>" onChange="Update(<%= YearVar %>, <%= MonthVar %>, <%= DayVar %>)" tabindex="<%= TabIndex %>">
<%
    Dim i
    For i = StartYear to EndYear ' Display all years from start to end ' 
        If Year(Now) = i Then
%>	<option selected="selected" value="<%= i %>"><%= i %></option><%= vbCrLf %>
<%        Else
%>	<option value="<%= i %>"><%= i %></option><%= vbCrLf %>
<%        End If
    Next
%>
</select>
<%
End Function

' Parse Error Code '
Function ParseErrorCode(ErrorCode)
	Dim Mantissa
	Mantissa = ErrorCode \ 10
	If Mantissa = 5 Then
		Response.Write( "Unable to verify payment." )
	ElseIf Mantissa = 4 Then
		Response.Write( "Payment Canceled." )
	ElseIf Mantissa = 3 Then
		Response.Write( "Unable to generate new student ID -- " )
	ElseIf Mantissa = 2 Then
		Response.Write( "Unable to add to registration database -- " )
   ElseIf Mantissa = 1 Then
      Response.Write( "Unable to check current registrants -- " )
	End If

	Mantissa = ErrorCode - 10 * Mantissa
   If Mantissa = 0 Then
      Response.Write( "Could not execute query. ")
   ElseIf Mantissa = 1 Then
      Response.Write( "Could not select database.")
   ElseIf Mantissa = 2 Then
      Response.Write( "Could not connect to server.")
   ElseIf Mantissa = 4 Then
		Response.Write( "Duplicate record exists.")
	End If

End Function

' Make Day Drop-down box, with Validation '
Function MakeDayWithValidation(YearVar, MonthVar, DayVar, StartYear, EndYear, TabIndex) %>
<select name="<%= DayVar %>" onChange="Update(<%= YearVar %>, <%= MonthVar %>, <%= DayVar %>)" tabindex="<%= TabIndex %>">
<%
    Dim i
    For i = 1 to 31 ' Display 31 days for now, so that users without javascript are not incapable of submitting '
        If Day(Now) = i Then 
%>	<option selected="selected" value="<%= i %>"><%= i %></option><%= vbCrLf %>
<%        Else
%>	<option value="<%= i %>"><%= i %></option><%= vbCrLf %>
<%        End If
    Next
%>
</select>
<%
End Function

' Make a list of 50 States '
Sub MakeState(Name, TabIndex) %>
<select name="<%= Name %>" tabindex="<%= TabIndex %>">
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ" selected>New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>
<% End Sub 

' Make Month Drop-Down - not validated'
Function MakeMonth(Name, IsAbbreviated, IncludeNumeric) %>
<select name="<%= Name %>">
<%
    Dim i, TempMonthName, TempMonthNameDisplay
    For i = 1 to 12
        TempMonthName = MonthName(i, IsAbbreviated)

        If IncludeNumeric Then
            TempMonthNameDisplay =  i & " - " & TempMonthName
        Else
            TempMonthNameDisplay = TempMonthName
        End If

        If Month(Now) = i Then
%>	<option selected value="<%= i %>"><%= TempMonthNameDisplay %></option><%= vbCrLf %>
<%        Else
%>	<option value="<%= i %>"><%= TempMonthNameDisplay %></option><%= vbCrLf %>
<%        End If
    Next

%>
</select>
<%
End Function
%>
