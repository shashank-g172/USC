/**
 Copyright 2012-2014 Nick Korbel

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

var dateHelper = {
	oneDay: 86400000, //24*60*60*1000 => hours*minutes*seconds*milliseconds

	MoreThanOneDayBetweenBeginAndEnd:function (beginDateElement, beginTimeElement, endDateElement, endTimeElement) {

		var begin = this.GetDate(beginDateElement, beginTimeElement);
		var end = this.GetDate(endDateElement, endTimeElement);

		var timeBetweenDates = end.toDate().getTime() - begin.toDate().getTime();

		return timeBetweenDates > this.oneDay;
	},

	GetDate:function (dateElement, timeElement) {
		return moment(dateElement.val() + 'T' + timeElement.val(), 'YYYY-MM-DDTHH:mm:ss');
	},

	GetDateDifference:function (beginDateElement, beginTimeElement, endDateElement, endTimeElement) {
		var begin = this.GetDate(beginDateElement, beginTimeElement);
		var end = this.GetDate(endDateElement, endTimeElement);

		var difference = end.toDate().getTime() - begin.toDate().getTime();
		var days = difference / this.oneDay;
		var hours = (days % 1) * 24;

		var roundedHours = (hours % 1) ? hours.toPrecision(2) : hours;
		var roundedDays = Math.floor(days);

		return {RoundedHours: roundedHours, RoundedDays: roundedDays};
	}

};