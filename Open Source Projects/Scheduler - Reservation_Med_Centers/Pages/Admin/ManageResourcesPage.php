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

require_once(ROOT_DIR . 'Pages/Admin/AdminPage.php');
require_once(ROOT_DIR . 'Presenters/Admin/ManageSchedulesPresenter.php');
require_once(ROOT_DIR . 'Domain/Access/ScheduleRepository.php');
require_once(ROOT_DIR . 'lib/Application/Attributes/namespace.php');

interface IUpdateResourcePage
{
	/**
	 * @return int
	 */
	public function GetResourceId();

	/**
	 * @return int
	 */
	public function GetScheduleId();

	/**
	 * @return string
	 */
	public function GetResourceName();

	/**
	 * @return UploadedFile
	 */
	public function GetUploadedImage();

	/**
	 * @return string
	 */
	public function GetLocation();

	/**
	 * @return string
	 */
	public function GetContact();

	/**
	 * @return string
	 */
	public function GetDescription();

	/**
	 * @return string
	 */
	public function GetNotes();

	/**
	 * @return string
	 */
	public function GetMinimumDuration();

	/**
	 * @return string
	 */
	public function GetMaximumDuration();

	/**
	 * @return string
	 */
	public function GetBufferTime();

	/**
	 * @return string
	 */
	public function GetAllowMultiday();

	/**
	 * @return string
	 */
	public function GetRequiresApproval();

	/**
	 * @return string
	 */
	public function GetAutoAssign();

	/**
	 * @return string
	 */
	public function GetStartNoticeMinutes();

	/**
	 * @return string
	 */
	public function GetEndNoticeMinutes();

	/**
	 * @return string
	 */
	public function GetMaxParticipants();

	/**
	 * @return int
	 */
	public function GetAdminGroupId();

	/**
	 * @return int
	 */
	public function GetSortOrder();

	/**
	 * @return int
	 */
	public function GetResourceTypeId();
}

interface IManageResourcesPage extends IUpdateResourcePage, IActionPage
{
	/**
	 * @param BookableResource[] $resources
	 */
	public function BindResources($resources);

	/**
	 * @param array $scheduleList array of (id, schedule name)
	 */
	public function BindSchedules($scheduleList);

	/**
	 * @abstract
	 * @param $adminGroups GroupItemView[]|array
	 * @return void
	 */
	public function BindAdminGroups($adminGroups);

	/**
	 * @abstract
	 * @param $attributeList IEntityAttributeList
	 */
	public function BindAttributeList($attributeList);

	/**
	 * @abstract
	 * @return AttributeFormElement[]|array
	 */
	public function GetAttributes();

	/**
	 * @param $resources AdminResourceJson[]
	 */
	public function SetResourcesJson($resources);

	/**
	 * @param $resourceTypes ResourceType[]
	 */
	public function BindResourceTypes($resourceTypes);

	/**
	 * @param $reasons ResourceStatusReason[]
	 */
	public function BindResourceStatusReasons($reasons);

	/**
	 * @return int
	 */
	public function GetStatusId();

	/**
	 * @return int
	 */
	public function GetStatusReasonId();

	/**
	 * @return string
	 */
	public function GetNewStatusReason();
}

class ManageResourcesPage extends ActionPage implements IManageResourcesPage
{
	/**
	 * @var ManageResourcesPresenter
	 */
	protected $presenter;

	public function __construct()
	{
		parent::__construct('ManageResources', 1);
		$this->presenter = new ManageResourcesPresenter(
			$this,
			new ResourceRepository(),
			new ScheduleRepository(),
			new ImageFactory(),
			new GroupRepository(),
			new AttributeService(new AttributeRepository())
		);
	}

	public function ProcessPageLoad()
	{
		$this->presenter->PageLoad();

		$this->Display('Admin/Resources/manage_resources.tpl');
	}

	public function BindResources($resources)
	{
		$this->Set('Resources', $resources);
	}

	public function BindSchedules($schedules)
	{
		$this->Set('Schedules', $schedules);
	}

	public function ProcessAction()
	{
		$this->presenter->ProcessAction();
	}

	public function GetResourceId()
	{
		return $this->GetQuerystring(QueryStringKeys::RESOURCE_ID);
	}

	public function GetScheduleId()
	{
		return $this->GetForm(FormKeys::SCHEDULE_ID);
	}

	public function GetResourceName()
	{
		return $this->GetForm(FormKeys::RESOURCE_NAME);
	}

	public function GetUploadedImage()
	{
		return $this->server->GetFile(FormKeys::RESOURCE_IMAGE);
	}

	public function GetLocation()
	{
		return $this->GetForm(FormKeys::RESOURCE_LOCATION);
	}

	public function GetContact()
	{
		return $this->GetForm(FormKeys::RESOURCE_CONTACT);
	}

	public function GetDescription()
	{
		return $this->GetForm(FormKeys::RESOURCE_DESCRIPTION);
	}

	public function GetNotes()
	{
		return $this->GetForm(FormKeys::RESOURCE_NOTES);
	}

	/**
	 * @return string
	 */
	public function GetMinimumDuration()
	{
		return $this->GetForm(FormKeys::MIN_DURATION);
	}

	/**
	 * @return string
	 */
	public function GetMaximumDuration()
	{
		return $this->GetForm(FormKeys::MAX_DURATION);
	}

	/**
	 * @return string
	 */
	public function GetBufferTime()
	{
		return $this->GetForm(FormKeys::BUFFER_TIME);
	}

	/**
	 * @return string
	 */
	public function GetAllowMultiday()
	{
		return $this->GetForm(FormKeys::ALLOW_MULTIDAY);
	}

	/**
	 * @return string
	 */
	public function GetRequiresApproval()
	{
		return $this->GetForm(FormKeys::REQUIRES_APPROVAL);
	}

	/**
	 * @return string
	 */
	public function GetAutoAssign()
	{
		return $this->GetForm(FormKeys::AUTO_ASSIGN);
	}

	/**
	 * @return string
	 */
	public function GetStartNoticeMinutes()
	{
		return $this->GetForm(FormKeys::MIN_NOTICE);
	}

	/**
	 * @return string
	 */
	public function GetEndNoticeMinutes()
	{
		return $this->GetForm(FormKeys::MAX_NOTICE);
	}

	/**
	 * @return string
	 */
	public function GetMaxParticipants()
	{
		return $this->GetForm(FormKeys::MAX_PARTICIPANTS);
	}

	/**
	 * @return int
	 */
	public function GetAdminGroupId()
	{
		return $this->GetForm(FormKeys::RESOURCE_ADMIN_GROUP_ID);
	}

	/**
	 * @param $adminGroups GroupItemView[]|array
	 * @return void
	 */
	function BindAdminGroups($adminGroups)
	{
		$this->Set('AdminGroups', $adminGroups);
		$groupLookup = array();
		foreach ($adminGroups as $group)
		{
			$groupLookup[$group->Id] = $group;
		}
		$this->Set('GroupLookup', $groupLookup);
	}

	public function ProcessDataRequest($dataRequest)
	{
		$this->presenter->ProcessDataRequest($dataRequest);
	}

	/**
	 * @param $attributeList IEntityAttributeList
	 */
	public function BindAttributeList($attributeList)
	{
		$this->Set('AttributeList', $attributeList);
	}

	/**
	 * @return AttributeFormElement[]|array
	 */
	public function GetAttributes()
	{
		return AttributeFormParser::GetAttributes($this->GetForm(FormKeys::ATTRIBUTE_PREFIX));
	}

	/**
	 * @return int
	 */
	public function GetSortOrder()
	{
		return $this->GetForm(FormKeys::RESOURCE_SORT_ORDER);
	}

	/**
	 * @param $resources AdminResourceJson[]
	 */
	public function SetResourcesJson($resources)
	{
		$this->SetJson($resources);
	}

	/**
	 * @param $resourceTypes ResourceType[]
	 */
	public function BindResourceTypes($resourceTypes)
	{
		$this->Set('ResourceTypes', $resourceTypes);
	}

	/**
	 * @return int
	 */
	public function GetResourceTypeId()
	{
		return $this->GetForm(FormKeys::RESOURCE_TYPE_ID);
	}

	/**
	 * @param $reasons ResourceStatusReason[]
	 */
	public function BindResourceStatusReasons($reasons)
	{
		$this->Set('StatusReasons', $reasons);
	}

	public function GetStatusId()
	{
		return $this->GetForm(FormKeys::RESOURCE_STATUS_ID);
	}

	public function GetStatusReasonId()
	{
		return $this->GetForm(FormKeys::RESOURCE_STATUS_REASON_ID);
	}

	/**
	 * @return string
	 */
	public function GetNewStatusReason()
	{
		return $this->GetForm(FormKeys::RESOURCE_STATUS_REASON);
	}
}