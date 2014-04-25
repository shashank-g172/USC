<?php
/**
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
*/


class ConfigKeys
{
    const ADMIN_EMAIL = 'admin.email';
    const ADMIN_EMAIL_NAME = 'admin.email.name';
    const ALLOW_REGISTRATION = 'allow.self.registration';
	const CSS_EXTENSION_FILE = 'css.extension.file';
    const DEFAULT_PAGE_SIZE = 'default.page.size';
    const DISABLE_PASSWORD_RESET = 'disable.password.reset';
    const ENABLE_EMAIL = 'enable.email';
	const HOME_URL = 'home.url';
	const INACTIVITY_TIMEOUT = 'inactivity.timeout';
    const LANGUAGE = 'default.language';
	const LOGOUT_URL = 'logout.url';
    const NAME_FORMAT = 'name.format';
    const SCRIPT_URL = 'script.url';
    const DEFAULT_TIMEZONE = 'default.timezone';
    const REGISTRATION_ENABLE_CAPTCHA = 'registration.captcha.enabled';
    const REGISTRATION_REQUIRE_ACTIVATION = 'registration.require.email.activation';
    const REGISTRATION_AUTO_SUBSCRIBE_EMAIL = 'registration.auto.subscribe.email';
	const REGISTRATION_NOTIFY = 'registration.notify.admin';

    const VERSION = 'version';

    const SCHEDULE_SHOW_INACCESSIBLE_RESOURCES = 'show.inaccessible.resources';
    const SCHEDULE_RESERVATION_LABEL = 'reservation.label';
    const SCHEDULE_HIDE_BLOCKED_PERIODS = 'hide.blocked.periods';

    const DATABASE_TYPE = 'type';
    const DATABASE_USER = 'user';
    const DATABASE_PASSWORD = 'password';
    const DATABASE_HOSTSPEC = 'hostspec';
    const DATABASE_NAME = 'name';

    const PLUGIN_AUTHENTICATION = 'Authentication';
    const PLUGIN_AUTHORIZATION = 'Authorization';
    const PLUGIN_PERMISSION = 'Permission';
    const PLUGIN_POSTREGISTRATION = 'PostRegistration';
    const PLUGIN_PRERESERVATION = 'PreReservation';
    const PLUGIN_POSTRESERVATION = 'PostReservation';

    const RESERVATION_START_TIME_CONSTRAINT = 'start.time.constraint';
    const RESERVATION_UPDATES_REQUIRE_APPROVAL = 'updates.require.approval';
    const RESERVATION_PREVENT_PARTICIPATION = 'prevent.participation';
    const RESERVATION_PREVENT_RECURRENCE = 'prevent.recurrence';
    const RESERVATION_REMINDERS_ENABLED = 'enable.reminders';

    const IMAGE_UPLOAD_DIRECTORY = 'image.upload.directory';
    const IMAGE_UPLOAD_URL = 'image.upload.url';

    const CACHE_TEMPLATES = 'cache.templates';

    const USE_LOCAL_JQUERY = 'use.local.jquery';

    const INSTALLATION_PASSWORD = 'install.password';

    const ICS_SUBSCRIPTION_KEY = 'subscription.key';

    const PRIVACY_HIDE_USER_DETAILS = 'hide.user.details';
    const PRIVACY_HIDE_RESERVATION_DETAILS = 'hide.reservation.details';
    const PRIVACY_VIEW_RESERVATIONS = 'view.reservations';
    const PRIVACY_VIEW_SCHEDULES = 'view.schedules';

    const NOTIFY_CREATE_RESOURCE_ADMINS = 'resource.admin.add';
    const NOTIFY_CREATE_APPLICATION_ADMINS = 'application.admin.add';
    const NOTIFY_CREATE_GROUP_ADMINS = 'group.admin.add';

    const NOTIFY_UPDATE_RESOURCE_ADMINS = 'resource.admin.update';
    const NOTIFY_UPDATE_APPLICATION_ADMINS = 'application.admin.update';
    const NOTIFY_UPDATE_GROUP_ADMINS = 'group.admin.update';

    const NOTIFY_DELETE_RESOURCE_ADMINS = 'resource.admin.delete';
    const NOTIFY_DELETE_APPLICATION_ADMINS = 'application.admin.delete';
    const NOTIFY_DELETE_GROUP_ADMINS = 'group.admin.delete';

	const UPLOAD_ENABLE_RESERVATION_ATTACHMENTS = 'enable.reservation.attachments';
	const UPLOAD_RESERVATION_ATTACHMENTS = 'reservation.attachment.path';
	const UPLOAD_RESERVATION_EXTENSIONS = 'reservation.attachment.extensions';

	const PAGES_ENABLE_CONFIGURATION = 'enable.configuration';

	const API_ENABLED = 'enabled';
	const RECAPTCHA_ENABLED = 'enabled';
	const RECAPTCHA_PUBLIC_KEY = 'public.key';
	const RECAPTCHA_PRIVATE_KEY = 'private.key';
	const DEFAULT_FROM_ADDRESS = 'default.from.address';

	const REPORTS_ALLOW_ALL = 'allow.all.users';

	const APP_TITLE = 'app.title';

	const SCHEDULE_PER_USER_COLORS = 'use.per.user.colors';

	const PASSWORD_UPPER_AND_LOWER = 'upper.and.lower';
	const PASSWORD_LETTERS = 'minimum.letters';
	const PASSWORD_NUMBERS = 'minimum.numbers';
}

class ConfigSection
{
    const API = 'api';
    const DATABASE = 'database';
	const EMAIL = 'email';
    const ICS = 'ics';
	const PAGES = 'pages';
	const PASSWORD = 'password';
    const PLUGINS = 'plugins';
    const PRIVACY = 'privacy';
	const REPORTS = 'reports';
    const RESERVATION = 'reservation';
    const RESERVATION_NOTIFY = 'reservation.notify';
    const SCHEDULE = 'schedule';
	const UPLOADS = 'uploads';
	const RECAPTCHA = 'recaptcha';
	const USERS = 'users';
}

?>