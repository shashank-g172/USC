<?php
/**
Copyright 2012-2014 Nick Korbel

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

require_once(ROOT_DIR . 'lib/Application/Reservation/ReservationAuthorization.php');

interface IPrivacyFilter
{
	/**
	 * @param UserSession $currentUser
	 * @param ReservationView|null $reservationView
	 * @param int|null $ownerId
	 * @return bool
	 */
	public function CanViewUser(UserSession $currentUser, $reservationView = null, $ownerId = null);

	/**
	 * @param UserSession $currentUser
	 * @param ReservationView|null $reservationView
	 * @param int|null $ownerId
	 * @return bool
	 */
	public function CanViewDetails(UserSession $currentUser, $reservationView = null, $ownerId = null);
}

class PrivacyFilter implements IPrivacyFilter
{
	private $cache = array();

	/**
	 * @var IReservationAuthorization
	 */
	private $reservationAuthorization;

	public function __construct(IReservationAuthorization $reservationAuthorization)
	{
		$this->reservationAuthorization = $reservationAuthorization;
	}

	public function CanViewUser(UserSession $currentUser, $reservationView = null, $ownerId = null)
	{
		$hideUserDetails = Configuration::Instance()->GetSectionKey(ConfigSection::PRIVACY,
																	ConfigKeys::PRIVACY_HIDE_USER_DETAILS,
																	new BooleanConverter());

		return $this->CanView($hideUserDetails, $currentUser, $ownerId, $reservationView);
	}

	public function CanViewDetails(UserSession $currentUser, $reservationView = null, $ownerId = null)
	{
		$hideReservationDetails = Configuration::Instance()->GetSectionKey(ConfigSection::PRIVACY,
																		   ConfigKeys::PRIVACY_HIDE_RESERVATION_DETAILS,
																		   new BooleanConverter());

		return $this->CanView($hideReservationDetails, $currentUser, $ownerId, $reservationView);
	}

	private function CanView($hideFlagEnabled, $userSession, $ownerId, $reservationView)
	{
		if (!$hideFlagEnabled || $userSession->IsAdmin)
		{
			return true;
		}

		if ($ownerId != null && $userSession->UserId == $ownerId)
		{
			return true;
		}

		if ($reservationView != null && is_a($reservationView, 'ReservationView'))
		{
			return $this->IsAuthorized($reservationView, $userSession);
		}

		return false;
	}

	/**
	 * @param ReservationView $reservationView
	 * @param UserSession $userSession
	 * @return bool
	 */
	private function IsAuthorized(ReservationView $reservationView, UserSession $userSession)
	{
		if (!$this->IsCached($reservationView, $userSession))
		{
			$this->Cache($reservationView, $userSession,
						 $this->reservationAuthorization->CanViewDetails($reservationView, $userSession));
		}

		return $this->GetCachedValue($reservationView, $userSession);
	}

	/**
	 * @param ReservationView $reservationView
	 * @param UserSession $userSession
	 * @return bool
	 */
	private function IsCached(ReservationView $reservationView, UserSession $userSession)
	{
		return array_key_exists($reservationView->ReferenceNumber . $userSession->UserId, $this->cache);
	}

	/**
	 * @param ReservationView $reservationView
	 * @param UserSession $userSession
	 * @param bool $canView
	 */
	private function Cache(ReservationView $reservationView, UserSession $userSession, $canView)
	{
		$this->cache[$reservationView->ReferenceNumber . $userSession->UserId] = $canView;
	}

	/**
	 * @param ReservationView $reservationView
	 * @param UserSession $userSession
	 * @return bool
	 */
	private function GetCachedValue(ReservationView $reservationView, UserSession $userSession)
	{
		return $this->cache[$reservationView->ReferenceNumber . $userSession->UserId];
	}
}

?>