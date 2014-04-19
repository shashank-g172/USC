<?php
/**
 * Copyright 2012-2014 Nick Korbel
 *
 * This file is part of Booked Scheduler.
 *
 * Booked Scheduler is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Booked Scheduler is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Booked Scheduler.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once(ROOT_DIR . 'Pages/Ajax/ReservationSavePage.php');
require_once(ROOT_DIR . 'Pages/Ajax/ReservationUpdatePage.php');
require_once(ROOT_DIR . 'Pages/Ajax/ReservationDeletePage.php');
require_once(ROOT_DIR . 'Pages/Ajax/ReservationApprovalPage.php');
require_once(ROOT_DIR . 'Presenters/Reservation/ReservationPresenterFactory.php');
require_once(ROOT_DIR . 'Presenters/Reservation/ReservationHandler.php');

require_once(ROOT_DIR . 'WebServices/Requests/ReservationRequest.php');


interface IReservationSaveController
{
	/**
	 * @param ReservationRequest $request
	 * @param WebServiceUserSession $session
	 * @return ReservationControllerResult
	 */
	public function Create($request, WebServiceUserSession $session);

	/**
	 * @param ReservationRequest $request
	 * @param WebServiceUserSession $session
	 * @param string $referenceNumber
	 * @param string $updateScope
	 * @return ReservationControllerResult
	 */
	public function Update($request, $session, $referenceNumber, $updateScope);

	/**
	 * @param WebServiceUserSession $session
	 * @param string $referenceNumber
	 * @return ReservationControllerResult
	 */
	public function Approve($session, $referenceNumber);

	/**
	 * @param WebServiceUserSession $session
	 * @param string $referenceNumber
	 * @param string $updateScope
	 * @return ReservationControllerResult
	 */
	public function Delete($session, $referenceNumber, $updateScope);
}

class ReservationSaveController implements IReservationSaveController
{
	/**
	 * @var IReservationPresenterFactory
	 */
	private $factory;

	public function __construct(IReservationPresenterFactory $presenterFactory)
	{
		$this->factory = $presenterFactory;
	}

	public function Create($request, WebServiceUserSession $session)
	{
		$facade = new ReservationRequestResponseFacade($request, $session);

		$validationErrors = $this->ValidateRequest($facade);

		if (count($validationErrors) > 0)
		{
			return new ReservationControllerResult(null, $validationErrors);
		}

		$presenter = $this->factory->Create($facade, $session);
		$reservation = $presenter->BuildReservation();
		$presenter->HandleReservation($reservation);

		return new ReservationControllerResult($facade->ReferenceNumber(), $facade->Errors());
	}

	public function Update($request, $session, $referenceNumber, $updateScope)
	{
		$facade = new ReservationUpdateRequestResponseFacade($request, $session, $referenceNumber, $updateScope);

		$validationErrors = $this->ValidateUpdateRequest($facade, $referenceNumber, $updateScope);

		if (count($validationErrors) > 0)
		{
			return new ReservationControllerResult(null, $validationErrors);
		}

		$presenter = $this->factory->Update($facade, $session);
		$reservation = $presenter->BuildReservation();
		$presenter->HandleReservation($reservation);

		return new ReservationControllerResult($facade->ReferenceNumber(), $facade->Errors());
	}

	/**
	 * @param WebServiceUserSession $session
	 * @param string $referenceNumber
	 * @return ReservationControllerResult
	 */
	public function Approve($session, $referenceNumber)
	{
		$facade = new ReservationApprovalRequestResponseFacade($referenceNumber, $session);
		$presenter = $this->factory->Approve($facade, $session);
		$presenter->PageLoad();
		return new ReservationControllerResult($referenceNumber, $facade->Errors());
	}

	public function Delete($session, $referenceNumber, $updateScope)
	{
		$facade = new ReservationDeleteRequestResponseFacade($referenceNumber, $updateScope);

		$validationErrors = $this->ValidateDeleteRequest($facade->GetReferenceNumber(),
														 $facade->GetSeriesUpdateScope());

		if (count($validationErrors) > 0)
		{
			return new ReservationControllerResult(null, $validationErrors);
		}

		$presenter = $this->factory->Delete($facade, $session);
		$reservation = $presenter->BuildReservation();
		$presenter->HandleReservation($reservation);

		return new ReservationControllerResult($referenceNumber, $facade->Errors());
	}

	/**
	 * @param ReservationRequestResponseFacade $request
	 * @return array|string[]
	 */
	private function ValidateRequest($request)
	{
		$errors = array();

		try
		{
			$resourceId = $request->GetResourceId();
			if (empty($resourceId))
			{
				$errors[] = 'Missing or invalid resourceId';
			}

			$startDate = $request->GetStartDate();
			$startTime = $request->GetStartTime();
			if (empty($startDate) || empty($startTime))
			{
				$errors[] = 'Missing or invalid startDateTime';
			}

			$endDate = $request->GetEndDate();
			$endTime = $request->GetEndTime();
			if (empty($endDate) || empty($endTime))
			{
				$errors[] = 'Missing or invalid endDateTime';
			}

			$repeatType = $request->GetRepeatType();
			if (!empty($repeatType) && !RepeatType::IsDefined($repeatType))
			{
				$errors[] = 'Invalid repeat type';
			}

			if ($repeatType == RepeatType::Monthly && !RepeatMonthlyType::IsDefined($request->GetRepeatMonthlyType()))
			{
				$errors[] = 'Missing or invalid repeatMonthlyType';
			}

			if (!empty($repeatType) && $repeatType != RepeatType::None)
			{
				$repeatInterval = $request->GetRepeatInterval();
				if (empty($repeatInterval))
				{
					$errors[] = 'Missing or invalid repeatInterval';
				}

				$repeatTerminationDate = $request->GetRepeatTerminationDate();
				if (empty($repeatTerminationDate))
				{
					$errors[] = 'Missing or invalid repeatTerminationDate';
				}
			}

			$accessories = $request->GetAccessories();
			if (!empty($accessories))
			{
				/** @var AccessoryFormElement $accessory */
				foreach ($accessories as $accessory)
				{
					if (empty($accessory->Id) || empty($accessory->Quantity) || $accessory->Quantity < 0)
					{
						$errors[] = 'Invalid accessory';
					}
				}
			}
		} catch (Exception $ex)
		{
			$errors[] = 'Could not process request.' . $ex;
		}

		return $errors;
	}

	/**
	 * @param ReservationUpdateRequestResponseFacade $request
	 * @return array|string[]
	 */
	private function ValidateUpdateRequest($request)
	{
		return array_merge($this->ValidateRequest($request),
						   $this->ValidateParams($request->GetReferenceNumber(), $request->GetSeriesUpdateScope()));
	}

	/**
	 * @param string $referenceNumber
	 * @param string $updateScope
	 * @return array|string[]
	 */
	private function ValidateDeleteRequest($referenceNumber, $updateScope)
	{
		return $this->ValidateParams($referenceNumber, $updateScope);
	}

	/**
	 * @param string $referenceNumber
	 * @param string $updateScope
	 * @return array|string[]
	 */
	private function ValidateParams($referenceNumber, $updateScope)
	{
		$errors = array();

		if (empty($referenceNumber))
		{
			$errors[] = "Missing or invalid referenceNumber: $referenceNumber";
		}

		if (!SeriesUpdateScope::IsValid($updateScope))
		{
			$errors[] = "Missing or invalid updateScope: $updateScope";
		}

		return $errors;
	}


}

class ReservationControllerResult
{
	/**
	 * @var string
	 */
	private $createdReferenceNumber;

	/**
	 * @var array|string[]
	 */
	private $errors = array();

	public function __construct($referenceNumber = null, $errors = array())
	{
		$this->createdReferenceNumber = $referenceNumber;
		$this->errors = $errors;
	}

	/**
	 * @param string $referenceNumber
	 */
	public function SetReferenceNumber($referenceNumber)
	{
		$this->createdReferenceNumber = $referenceNumber;
	}

	/**
	 * @return bool
	 */
	public function WasSuccessful()
	{
		return !empty($this->createdReferenceNumber) && count($this->errors) == 0;
	}

	/**
	 * @return string
	 */
	public function CreatedReferenceNumber()
	{
		return $this->createdReferenceNumber;
	}

	/**
	 * @return array|string[]
	 */
	public function Errors()
	{
		return $this->errors;
	}

	/**
	 * @param array|string[] $errors
	 */
	public function SetErrors($errors)
	{
		$this->errors = $errors;
	}
}

class ReservationRequestResponseFacade implements IReservationSavePage
{
	private $_createdReferenceNumber;
	private $_createdErrors = array();

	/**
	 * @var ReservationRequest
	 */
	private $request;
	/**
	 * @var WebServiceUserSession
	 */
	private $session;
	/**
	 * @var RecurrenceRequestResponse
	 */
	private $recurrenceRule;

	/**
	 * @param ReservationRequest $request
	 * @param WebServiceUserSession $session
	 */
	public function __construct($request, WebServiceUserSession $session)
	{
		$this->request = $request;
		$this->session = $session;
		$this->recurrenceRule = empty($request->recurrenceRule) ? RecurrenceRequestResponse::Null() : $request->recurrenceRule;
	}

	public function ReferenceNumber()
	{
		return $this->_createdReferenceNumber;
	}

	public function Errors()
	{
		return $this->_createdErrors;
	}

	public function SetSaveSuccessfulMessage($succeeded)
	{
		// no-op
	}

	public function ShowErrors($errors)
	{
		$this->_createdErrors = $errors;
	}

	public function ShowWarnings($warnings)
	{
		// no-op
	}

	public function GetRepeatType()
	{
		return $this->recurrenceRule->type;
	}

	public function GetRepeatInterval()
	{
		if (!empty($this->recurrenceRule->interval))
		{
			return intval($this->recurrenceRule->interval);
		}
		return null;
	}

	public function GetRepeatWeekdays()
	{
		$days = array();
		if (!empty($this->recurrenceRule->weekdays) && is_array($this->recurrenceRule->weekdays))
		{
			foreach ($this->recurrenceRule->weekdays as $day)
			{
				if ($day >= 0 && $day <= 6)
				{
					$days[] = $day;
				}
			}
		}
		return $days;
	}

	public function GetRepeatMonthlyType()
	{
		if (!empty($this->recurrenceRule->monthlyType))
		{
			return $this->recurrenceRule->monthlyType;
		}
		return null;
	}

	/**
	 * @param string $dateString
	 * @param string $format
	 * @return string|null
	 */
	private function GetDate($dateString, $format = Date::SHORT_FORMAT)
	{
		if (!empty($dateString))
		{
			return WebServiceDate::GetDate($dateString,
										   $this->session)->ToTimezone($this->session->Timezone)->Format($format);
		}
		return null;
	}

	public function GetRepeatTerminationDate()
	{
		return $this->GetDate($this->recurrenceRule->repeatTerminationDate, 'Y-m-d');
	}

	public function GetUserId()
	{
		if (!empty($this->request->userId))
		{
			return intval($this->request->userId);
		}
		return $this->session->UserId;
	}

	public function GetResourceId()
	{
		if (!empty($this->request->resourceId))
		{
			return intval($this->request->resourceId);
		}
		return null;
	}

	public function GetTitle()
	{
		return $this->request->title;
	}

	public function GetDescription()
	{
		return $this->request->description;
	}

	public function GetStartDate()
	{
		return $this->GetDate($this->request->startDateTime, 'Y-m-d');
	}

	public function GetEndDate()
	{
		return $this->GetDate($this->request->endDateTime, 'Y-m-d');
	}

	public function GetStartTime()
	{
		return $this->GetDate($this->request->startDateTime, 'H:i');
	}

	public function GetEndTime()
	{
		return $this->GetDate($this->request->endDateTime, 'H:i');
	}

	public function GetResources()
	{
		if (!empty($this->request->resources) && is_array($this->request->resources))
		{
			return $this->getIntArray($this->request->resources);
		}
		return array();
	}

	public function GetParticipants()
	{
		if (!empty($this->request->participants) && is_array($this->request->participants))
		{
			return $this->getIntArray($this->request->participants);
		}
		return array();
	}

	public function GetInvitees()
	{
		if (!empty($this->request->invitees) && is_array($this->request->invitees))
		{
			return $this->getIntArray($this->request->invitees);
		}
		return array();
	}

	public function SetReferenceNumber($referenceNumber)
	{
		$this->_createdReferenceNumber = $referenceNumber;
	}

	public function GetAccessories()
	{
		$accessories = array();
		if (!empty($this->request->accessories) && is_array($this->request->accessories))
		{
			foreach ($this->request->accessories as $accessory)
			{
				$accessories[] = AccessoryFormElement::Create($accessory->accessoryId, $accessory->quantityRequested);
			}
		}
		return $accessories;
	}

	public function GetAttributes()
	{
		$attributes = array();
		if (!empty($this->request->customAttributes) && is_array($this->request->customAttributes))
		{
			foreach ($this->request->customAttributes as $attribute)
			{
				$attributes[] = new AttributeFormElement($attribute->attributeId, $attribute->attributeValue);
			}
		}
		return $attributes;
	}

	public function GetAttachments()
	{
		return array();
	}

	private function getIntArray($values)
	{
		$ints = array();
		foreach ($values as $value)
		{
			$ints[] = intval($value);
		}

		return $ints;
	}

	/**
	 * @return bool
	 */
	public function HasStartReminder()
	{
		return !empty($this->request->startReminder);
	}

	/**
	 * @return string
	 */
	public function GetStartReminderValue()
	{
		return $this->request->startReminder->value;
	}

	/**
	 * @return string
	 */
	public function GetStartReminderInterval()
	{
		return $this->request->startReminder->interval;
	}

	/**
	 * @return bool
	 */
	public function HasEndReminder()
	{
		return !empty($this->request->endReminder);
	}

	/**
	 * @return string
	 */
	public function GetEndReminderValue()
	{
		return $this->request->endReminder->value;
	}

	/**
	 * @return string
	 */
	public function GetEndReminderInterval()
	{
		return $this->request->endReminder->interval;
	}
}

class ReservationUpdateRequestResponseFacade extends ReservationRequestResponseFacade implements IReservationUpdatePage
{
	/**
	 * @var string
	 */
	private $referenceNumber;

	/**
	 * @var SeriesUpdateScope|string
	 */
	private $updateScope;

	/**
	 * @param ReservationRequest $request
	 * @param WebServiceUserSession $session
	 * @param string $referenceNumber
	 * @param SeriesUpdateScope|string $updateScope
	 */
	public function __construct($request, WebServiceUserSession $session, $referenceNumber, $updateScope)
	{
		parent::__construct($request, $session);
		$this->referenceNumber = $referenceNumber;
		$this->updateScope = $updateScope;
	}

	/**
	 * @return string
	 */
	public function GetReferenceNumber()
	{
		return $this->referenceNumber;
	}

	/**
	 * @return SeriesUpdateScope
	 */
	public function GetSeriesUpdateScope()
	{
		if (empty($this->updateScope))
		{
			return SeriesUpdateScope::FullSeries;
		}
		return $this->updateScope;
	}

	public function GetRemovedAttachmentIds()
	{
		return array();
	}
}

class ReservationDeleteRequestResponseFacade implements IReservationDeletePage
{
	private $referenceNumber;
	private $updateScope;
	private $errors = array();

	public function __construct($referenceNumber, $updateScope)
	{
		$this->referenceNumber = $referenceNumber;
		$this->updateScope = $updateScope;
	}

	/**
	 * @param bool $succeeded
	 */
	public function SetSaveSuccessfulMessage($succeeded)
	{
		// no-op
	}

	/**
	 * @param array|string[] $errors
	 */
	public function ShowErrors($errors)
	{
		$this->errors = $errors;
	}

	/**
	 * @param array|string[] $warnings
	 */
	public function ShowWarnings($warnings)
	{
		// no-op
	}

	/**
	 * @return string
	 */
	public function GetReferenceNumber()
	{
		return $this->referenceNumber;
	}

	/**
	 * @return SeriesUpdateScope|string
	 */
	public function GetSeriesUpdateScope()
	{
		if (empty($this->updateScope))
		{
			return SeriesUpdateScope::FullSeries;
		}
		return $this->updateScope;
	}

	/**
	 * @return string
	 */
	public function ReferenceNumber()
	{
		return $this->referenceNumber;
	}

	/**
	 * @return array|string[]
	 */
	public function Errors()
	{
		return $this->errors;
	}
}

class ReservationApprovalRequestResponseFacade implements IReservationApprovalPage
{
	private $referenceNumber;
	private $errors = array();

	public function __construct($referenceNumber)
	{
		$this->referenceNumber = $referenceNumber;
	}

	/**
	 * @param bool $succeeded
	 */
	public function SetSaveSuccessfulMessage($succeeded)
	{
		// no-op
	}

	/**
	 * @param array|string[] $errors
	 */
	public function ShowErrors($errors)
	{
		$this->errors = $errors;
	}

	/**
	 * @return array|string[]
	 */
	public function Errors()
	{
		return $this->errors;
	}

	/**
	 * @param array|string[] $warnings
	 */
	public function ShowWarnings($warnings)
	{
		// no-op
	}

	/**
	 * @return string
	 */
	public function GetReferenceNumber()
	{
		return $this->referenceNumber;
	}
}