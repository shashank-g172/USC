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

class ResourceParticipationRule implements IReservationValidationRule
{
	/**
	 * @param ReservationSeries $reservationSeries
	 * @return ReservationRuleResult
	 */
	public function Validate($reservationSeries)
	{
		$errorMessage = new StringBuilder();
		foreach ($reservationSeries->AllResources() as $resource)
		{
			if (!$resource->HasMaxParticipants())
			{
				continue;
			}

			foreach ($reservationSeries->Instances() as $instance)
			{
				$numberOfParticipants = count($instance->Participants());

				Log::Debug('ResourceParticipationRule Resource=%s,InstanceId=%s,MaxParticipants=%s,CurrentParticipants=%s',
						   $resource->GetName(), $instance->ReservationId(), $resource->GetMaxParticipants(),
						   $numberOfParticipants);
				if ($numberOfParticipants > $resource->GetMaxParticipants())
				{
					$errorMessage->AppendLine(Resources::GetInstance()->GetString('MaxParticipantsError',
																				  array($resource->GetName(), $resource->GetMaxParticipants())));
					continue;
				}
			}
		}

		$message = $errorMessage->ToString();
		if (strlen($message) > 0)
		{
			return new ReservationRuleResult(false, $message);
		}
		return new ReservationRuleResult();
	}
}

?>