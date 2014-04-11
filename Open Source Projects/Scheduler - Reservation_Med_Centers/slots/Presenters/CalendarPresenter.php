<?php
/**
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
 */

require_once(ROOT_DIR . 'lib/Config/namespace.php');
require_once(ROOT_DIR . 'lib/Common/namespace.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Schedule/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Reservation/namespace.php');

class CalendarPresenter
{
	/**
	 * @var ICalendarPage
	 */
	private $page;

	/**
	 * @var ICalendarFactory
	 */
	private $calendarFactory;

	/**
	 * @var IReservationViewRepository
	 */
	private $reservationRepository;

	/**
	 * @var IScheduleRepository
	 */
	private $scheduleRepository;

	/**
	 * @var IResourceService
	 */
	private $resourceService;

	/**
	 * @var ICalendarSubscriptionService
	 */
	private $subscriptionService;

	/**
	 * @var IPrivacyFilter
	 */
	private $privacyFilter;

	public function __construct(ICalendarPage $page,
								ICalendarFactory $calendarFactory,
								IReservationViewRepository $reservationRepository,
								IScheduleRepository $scheduleRepository,
								IResourceService $resourceService,
								ICalendarSubscriptionService $subscriptionService,
								IPrivacyFilter $privacyFilter)
	{
		$this->page = $page;
		$this->calendarFactory = $calendarFactory;
		$this->reservationRepository = $reservationRepository;
		$this->scheduleRepository = $scheduleRepository;
		$this->resourceService = $resourceService;
		$this->subscriptionService = $subscriptionService;
		$this->privacyFilter = $privacyFilter;
	}

	public function PageLoad($userSession, $timezone)
	{
		$type = $this->page->GetCalendarType();

		$year = $this->page->GetYear();
		$month = $this->page->GetMonth();
		$day = $this->page->GetDay();

		$defaultDate = Date::Now()
					   ->ToTimezone($timezone);

		if (empty($year))
		{
			$year = $defaultDate->Year();
		}
		if (empty($month))
		{
			$month = $defaultDate->Month();
		}
		if (empty($day))
		{
			$day = $defaultDate->Day();
		}

		$schedules = $this->scheduleRepository->GetAll();
		$showInaccessible = Configuration::Instance()
							->GetSectionKey(ConfigSection::SCHEDULE, ConfigKeys::SCHEDULE_SHOW_INACCESSIBLE_RESOURCES, new BooleanConverter());
		$resources = $this->resourceService->GetAllResources($showInaccessible, $userSession);

		$selectedSchedule = $this->GetSchedule($schedules);
		$selectedResourceId = $this->page->GetResourceId();

		if (!empty($selectedResourceId))
		{
			$subscriptionDetails = $this->subscriptionService->ForResource($selectedResourceId);
		}
		else
		{
			$subscriptionDetails = $this->subscriptionService->ForSchedule($selectedSchedule->GetId());
		}

		$calendar = $this->calendarFactory->Create($type, $year, $month, $day, $timezone);
		$reservations = $this->reservationRepository->GetReservationList($calendar->FirstDay(), $calendar->LastDay(),
																		 null, null, $selectedSchedule->GetId(),
																		 $selectedResourceId);
		$calendar->AddReservations(CalendarReservation::FromScheduleReservationList(
									   $reservations,
									   $resources,
									   $userSession,
									   $this->privacyFilter));
		$this->page->BindCalendar($calendar);

		$this->page->BindFilters(new CalendarFilters($schedules, $resources, $selectedSchedule->GetId(), $selectedResourceId));

		$this->page->SetDisplayDate($calendar->FirstDay());
		$this->page->SetScheduleId($selectedSchedule->GetId());
		$this->page->SetResourceId($selectedResourceId);

		$this->page->SetFirstDay($selectedSchedule->GetWeekdayStart());

		$this->page->BindSubscription($subscriptionDetails);
	}

	/**
	 * @param array|Schedule[] $schedules
	 * @return Schedule
	 */
	private function GetSchedule($schedules)
	{
		$default = null;
		$scheduleId = $this->page->GetScheduleId();

		/** @var $schedule Schedule */
		foreach ($schedules as $schedule)
		{
			if (!empty($scheduleId) && $schedule->GetId() == $scheduleId)
			{
				return $schedule;
			}

			if ($schedule->GetIsDefault())
			{
				$default = $schedule;
			}
		}

		return $default;
	}
}

class CalendarFilters
{
	const FilterSchedule = 'schedule';
	const FilterResource = 'resource';

	/**
	 * @var array|CalendarFilter[]
	 */
	private $filters = array();

	/**
	 * @param array|Schedule[] $schedules
	 * @param array|ResourceDto[] $resources
	 * @param int $selectedScheduleId
	 * @param int $selectedResourceId
	 */
	public function __construct($schedules, $resources, $selectedScheduleId, $selectedResourceId)
	{
		foreach ($schedules as $schedule)
		{
			if ($this->ScheduleContainsNoResources($schedule, $resources))
			{
				continue;
			}

			$filter = new CalendarFilter(self::FilterSchedule, $schedule->GetId(), $schedule->GetName(), (empty($selectedResourceId) && $selectedScheduleId == $schedule->GetId()));

			foreach ($resources as $resource)
			{
				if ($resource->GetScheduleId() == $schedule->GetId())
				{
					$filter->AddSubFilter(new CalendarFilter(self::FilterResource, $resource->GetResourceId(), $resource->GetName(), ($selectedResourceId == $resource->GetResourceId())));
				}
			}

			$this->filters[] = $filter;
		}
	}

	/**
	 * @return bool
	 */
	public function IsEmpty()
	{
		return empty($this->filters);
	}

	/**
	 * @return array|CalendarFilter[]
	 */
	public function GetFilters()
	{
		return $this->filters;
	}

	/**
	 * @param Schedule $schedule
	 * @param ResourceDto[] $resources
	 * @return bool
	 */
	private function ScheduleContainsNoResources(Schedule $schedule, $resources)
	{
		foreach ($resources as $resource)
		{
			if ($resource->GetScheduleId() == $schedule->GetId())
			{
				return false;
			}
		}

		return true;
	}
}

class CalendarFilter
{
	/**
	 * @var array|CalendarFilter[]
	 */
	private $filters = array();

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var bool
	 */
	private $selected;

	/**
	 * @return string
	 */
	public function Name()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function Id()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function Type()
	{
		return $this->type;
	}

	/**
	 * @return bool
	 */
	public function Selected()
	{
		return $this->selected;
	}

	public function __construct($type, $id, $name, $selected)
	{
		$this->type = $type;
		$this->id = $id;
		$this->name = $name;
		$this->selected = $selected;
	}

	public function AddSubFilter(CalendarFilter $subfilter)
	{
		$this->filters[] = $subfilter;
	}

	/**
	 * @return array|CalendarFilter[]
	 */
	public function GetFilters()
	{
		return $this->filters;
	}

}

?>