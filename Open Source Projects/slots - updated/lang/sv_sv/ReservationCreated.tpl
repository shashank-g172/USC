{*
Copyright 2011-2014 Nick Korbel

This file is part of Booked SchedulerBooked SchedulereIt is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later versBooked SchedulerduleIt is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
alBooked SchedulercheduleIt.  If not, see <http://www.gnu.org/licenses/>.
*}
{include file='..\..\tpl\Email\emailheader.tpl'}

	Bokningsdetaljer:
	<br/>
	<br/>

	Er tid börjar: {formatdate date=$StartDate key=reservation_email}<br/>
	Välkommen till oss 10min innan bokad tid.<br/>

	Slutar: {formatdate date=$EndDate key=reservation_email}<br/>
	<br/>
	Bokning: {$ResourceName}<br/>
	<br/>
	Rubrik: {$Title}<br/>
	<br/>
	Beskrivning: {$Description|nl2br}<br/>

	{if count($RepeatDates) gt 0}
		<br/>
		Ni har reserverat följande tid / er:
		<br/>
	{/if}

	{foreach from=$RepeatDates item=date name=dates}
		{formatdate date=$date}<br/>
	{/foreach}

	{if $RequiresApproval}
		<br/>
		Innan er reservation övergår i bokning behöver den godkännas först.
	{/if}

	<br/>
	<a href="{$ScriptUrl}/{$ReservationUrl}">Visa Bokning</a> |
	<a href="{$ScriptUrl}/{$ICalUrl}">Lägg till i Outlook</a> |
	<a href="{$ScriptUrl}">Logga in i Bokningsprogrammet</a>

{include file='..\..\tpl\Email\emailfooter.tpl'}