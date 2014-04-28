<?php
/**
Copyright 2013-2014 Nick Korbel

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

class ResourcePermissionFilter implements IResourceFilter
{
	/**
	 * @var IPermissionService $permissionService
	 */
	private $permissionService;

	/**
	 * @var UserSession $user
	 */
	private $user;

	public function __construct(IPermissionService $permissionService, UserSession $user)
	{
		$this->permissionService = $permissionService;
		$this->user = $user;
	}

	public function ShouldInclude($resource)
	{
		return $this->permissionService->CanAccessResource($resource, $this->user);
	}
}