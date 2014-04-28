{*
Copyright 2011-2014 Nick Korbel

This file is part of Booked Scheduler.

Booked Scheduler is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Booked Scheduler is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Booked Scheduler.  If not, see <http://www.gnu.org/licenses/>.
*}
{include file='globalheader_login.tpl'}

{if $ShowLoginError}
<div id="loginError">
	{translate key='LoginError'}
</div>
{/if}
<div id="wrapper">
	<div id="sur_header">
		<h2>Welcome to the Surgery Assist website</h2><br>
	<br>
	<br>	<p><strong>SurgeryAssist</strong> is an innovative solution to surgeons and outpatient surgery centers current scheduling problems. This site will enable doctors and their assistants to browse and book rooms for outpatient surgeries across surgery centers that offer these facilities across the greater Los Angeles area.</p> 
<br>
<p> We offer a hassle free, easy to comprehend service to ensure a smooth booking process. We hope that you will find this website useful and convenient.</div>
<div id="loginbox">
	<!--This "$smarty.server.SCRIPT_NAME" sets up the form to post back to the same page that it is on.-->
	<form name="login" id="login" class="login" method="post" action="{$smarty.server.SCRIPT_NAME}">
		<div>
			{if $ShowUsernamePrompt}
			<p>
				<label class="login">{translate key='UsernameOrEmail'}<br/>
				{textbox name="EMAIL" class="input" size="20" tabindex="10"}</label>
			</p>
			{/if}

			{if $ShowPasswordPrompt}
			<p>
				<label class="login">{translate key='Password'}<br/>
				{textbox type="password" name="PASSWORD" class="input" value="" size="20" tabindex="20"}</label>
			</p>
			{/if}

{*			<p>
				<label class="login">{translate key='Language'}<br/>
					<select {formname key='LANGUAGE'} class="input-small" id="languageDropDown">
					{object_html_options options=$Languages key='GetLanguageCode' label='GetDisplayName' selected=$SelectedLanguage}
					</select>
			</p>
*}
			{if $ShowPersistLoginPrompt}
			<p class="stayloggedin">
				<label class="login"><input type="checkbox" name="{FormKeys::PERSIST_LOGIN}" value="true"
											tabindex="30"/> {translate key='RememberMe'}</label>

			</p>
			{/if}

			<p class="loginsubmit">
				<button type="submit" name="{Actions::LOGIN}" class="button" tabindex="100" value="submit"><img
						src="img/door-open-in.png"/> {translate key='LogIn'} </button>
				<input type="hidden" name="{FormKeys::RESUME}" value="{$ResumeUrl}"/>
			</p>
		</div>
		<div style="clear:both;">&nbsp;</div>
{*	{if $ShowRegisterLink}
		<h4 class="register">
				{html_link href="register.php" key="CreateAnAccount"}
		</h4>
	{/if}
*}	{if $ShowRegisterLink}
		<h4 class="DoctorRegister" align="center">
				{html_link href="docsign.php" key="CreateDocAccount"}
		</h4>
	{/if}
	{if $ShowRegisterLink}
		<h4 class="SurgeryCenterRegister" align="center">
				{html_link href="scsign.php" key="CreateSCAccount"}
		</h4>
	{/if}
	
	
	<h4 align="center">
		<br>
		{if $ShowScheduleLink}
		<a href="view-schedule.php">{translate key='ViewSchedule'}</a>
		{/if}
		{if $ShowScheduleLink && $ShowForgotPasswordPrompt}|{/if}
		{if $ShowForgotPasswordPrompt}
		<a href="forgot.php">{translate key='ForgotMyPassword'}</a>
		{/if}
	</h4>


	</form>
</div>
</div>


{setfocus key='EMAIL'}

<script type="text/javascript">
	var url = 'index.php?{QueryStringKeys::LANGUAGE}=';
	$(document).ready(function () {
		$('#languageDropDown').change(function()
		{
			window.location.href = url + $(this).val();
		});

		var langCode = readCookie('{CookieKeys::LANGUAGE}');

		if (!langCode) {
		}
	});
</script>
{include file='globalfooter.tpl'}