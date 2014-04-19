function ReservationManagement(opts, approval)
{
	var options = opts;

	var elements = {
		userFilter: $("#userFilter"),
		startDate: $("#formattedStartDate"),
		endDate: $("#formattedEndDate"),
		userId: $("#userId"),
		scheduleId: $("#scheduleId"),
		resourceId: $("#resourceId"),
		statusId: $('#statusId'),
		referenceNumber: $("#referenceNumber"),
		reservationTable: $("#reservationTable"),
		updateScope: $('#hdnSeriesUpdateScope'),
		resourceStatusIdFilter: $('#resourceStatusIdFilter'),
		resourceReasonIdFilter: $('#resourceReasonIdFilter'),

		deleteInstanceDialog: $('#deleteInstanceDialog'),
		deleteSeriesDialog: $('#deleteSeriesDialog'),

		deleteInstanceForm: $('#deleteInstanceForm'),
		deleteSeriesForm: $('#deleteSeriesForm'),

		statusForm: $('#statusForm'),
		statusDialog: $('#statusDialog'),
		statusReasons:$('#resourceReasonId'),
		statusOptions:$('#resourceStatusId'),
		statusResourceId:$('#statusResourceId'),
		statusReferenceNumber:$('#statusUpdateReferenceNumber'),

		filterButton:$('#filter'),
		clearFilterButton:$('#clearFilter'),
		filterTable:$('#filterTable'),

		referenceNumberList: $(':hidden.referenceNumber')
	};

	var reservations = {};
	var reasons = {};

	ReservationManagement.prototype.init = function()
	{
		ConfigureAdminDialog(elements.deleteInstanceDialog);
		ConfigureAdminDialog(elements.deleteSeriesDialog);
		ConfigureAdminDialog(elements.statusDialog);

		$(".save").click(function() {
			$(this).closest('form').submit();
		});

		$(".cancel").click(function() {
			$(this).closest('.dialog').dialog("close");
		});

		elements.userFilter.userAutoComplete(options.autocompleteUrl, selectUser);

		elements.userFilter.change(function() {
			if ($(this).val() == '')
			{
				elements.userId.val('');
			}
		});

		elements.reservationTable.delegate('a.update', 'click', function(e) {
			e.preventDefault();
			e.stopPropagation();

			var tr = $(this).parents('tr');
			var referenceNumber = tr.find('.referenceNumber').text();
			var reservationId = tr.find('.id').text();
			setActiveReferenceNumber(referenceNumber);
			setActiveReservationId(reservationId);
			elements.referenceNumberList.val(referenceNumber);
		});

		elements.reservationTable.delegate('.editable', 'click', function() {
			$(this).addClass('clicked');
			var td = $(this).find('.referenceNumber');
			viewReservation(td.text());
		});

		elements.reservationTable.find('.editable').each(function() {
			var refNum = $(this).find('.referenceNumber').text();
			$(this).attachReservationPopup(refNum, options.popupUrl);
		});

		elements.reservationTable.delegate('.delete', 'click', function() {
			showDeleteReservation(getActiveReferenceNumber());
		});

		elements.reservationTable.delegate('.approve', 'click', function() {
			approveReservation(getActiveReferenceNumber());
		});

		elements.reservationTable.delegate('.changeStatus', 'click', function() {
			showChangeResourceStatus(getActiveReferenceNumber(), $(this).attr('resourceId'));
		});

		elements.statusOptions.change(function(e){
			populateReasonOptions(elements.statusOptions.val(), elements.statusReasons);
		});

		elements.resourceStatusIdFilter.change(function(e){
			populateReasonOptions(elements.resourceStatusIdFilter.val(), elements.resourceReasonIdFilter);
			if (opts.resourceReasonFilter)
			{
				elements.resourceReasonIdFilter.val(opts.resourceReasonFilter)
			}
		});

		elements.deleteSeriesForm.find('.saveSeries').click(function() {
			var updateScope = opts.updateScope[$(this).attr('id')];
			elements.updateScope.val(updateScope);
			elements.deleteSeriesForm.submit();
		});

		elements.statusDialog.find('.saveAll').click(function(){
			$('#statusUpdateScope').val('all');
			$(this).closest('form').submit();
		});

		elements.filterButton.click(filterReservations);
		elements.clearFilterButton.click(function(e){
			e.preventDefault();
			elements.filterTable.find('input,select').val('')
		});

		var deleteReservationResponseHandler = function(response, form)
		{
			form.find('.delResResponse').empty();
			if (!response.deleted)
			{
				form.find('.delResResponse').text(response.errors.join('<br/>'));
			}
            else
            {
                window.location.reload();
            }
		};

		ConfigureAdminForm(elements.deleteInstanceForm, getDeleteUrl, null, deleteReservationResponseHandler, {dataType: 'json'});
		ConfigureAdminForm(elements.deleteSeriesForm, getDeleteUrl, null, deleteReservationResponseHandler, {dataType: 'json'});
		ConfigureAdminForm(elements.statusForm, getUpdateStatusUrl, function(){elements.statusDialog.dialog('close');window.location.reload();});
	};

	ReservationManagement.prototype.addReservation = function(reservation)
	{
		if (!(reservation.referenceNumber in reservations))
		{
			reservation.resources = {};
			reservations[reservation.referenceNumber] = reservation;
		}

		reservations[reservation.referenceNumber].resources[reservation.resourceId] = {id: reservation.resourceId, statusId: reservation.resourceStatusId, descriptionId: reservation.resourceStatusReasonId};

	};

	ReservationManagement.prototype.addStatusReason = function (id, statusId, description) {
		if (!(statusId in reasons))
		{
			reasons[statusId] = [];
		}

		reasons[statusId].push({id:id,description:description});
	};

	ReservationManagement.prototype.initializeStatusFilter = function(statusId, reasonId)
	{
		elements.resourceStatusIdFilter.val(statusId);
		elements.resourceStatusIdFilter.trigger('change');
		elements.resourceReasonIdFilter.val(reasonId);
	};

	function getDeleteUrl()
	{
		return opts.deleteUrl;
	}

	function getUpdateStatusUrl()
	{
		return opts.resourceStatusUrl.replace('[refnum]', getActiveReferenceNumber());
	}

	function setActiveReferenceNumber(referenceNumber)
	{
		this.referenceNumber = referenceNumber;
	}

	function getActiveReferenceNumber()
	{
		return this.referenceNumber;
	}

	function setActiveReservationId(reservationId)
	{
		this.reservationId = reservationId;
	}

	function getActiveReservationId()
	{
		return this.reservationId;
	}

	function showDeleteReservation(referenceNumber)
	{
		if (reservations[referenceNumber].isRecurring == '1')
		{
			elements.deleteSeriesDialog.dialog('open');
		}
		else
		{
			elements.deleteInstanceDialog.dialog('open');
		}
	}

	function showChangeResourceStatus(referenceNumber, resourceId)
	{
		if (Object.keys(reservations[referenceNumber].resources).length > 1)
		{
			elements.statusDialog.find('.saveAll').show();
		}
		else
		{
			elements.statusDialog.find('.saveAll').hide();
		}

		var statusId = reservations[referenceNumber].resources[resourceId].statusId;
		elements.statusOptions.val(statusId);
		elements.statusResourceId.val(resourceId);
		elements.statusReferenceNumber.val(referenceNumber);
		populateReasonOptions(statusId, elements.statusReasons);
		elements.statusReasons.val(reservations[referenceNumber].resources[resourceId].descriptionId);

		elements.statusDialog.dialog('open');
	}

	function populateReasonOptions(statusId, reasonsElement)
	{
		reasonsElement.empty().append($('<option>', {value:'', text:'-'}));

		if (statusId in reasons)
		{
			$.each(reasons[statusId], function(i, v){
				reasonsElement.append($('<option>', {
						value: v.id,
						text : v.description
					}));
			});
		}
	}

	function selectUser(ui, textbox){
		elements.userId.val(ui.item.value);
		textbox.val(ui.item.label);
	}

	function filterReservations()
	{
		var reasonId = '';
		if (elements.resourceReasonIdFilter.val())
		{
			reasonId = elements.resourceReasonIdFilter.val();
		}
		var filterQuery =
				'sd=' + elements.startDate.val() +
				'&ed=' + elements.endDate.val() +
				'&sid=' + elements.scheduleId.val() +
				'&rid=' + elements.resourceId.val() +
				'&uid=' + elements.userId.val() +
				'&un=' + elements.userFilter.val() +
				'&rn=' + elements.referenceNumber.val() +
				'&rsid=' + elements.statusId.val() +
				'&rrsid=' + elements.resourceStatusIdFilter.val() +
				'&rrsrid=' + reasonId;

		window.location = document.location.pathname + '?' + encodeURI(filterQuery);
	}

	function viewReservation(referenceNumber)
	{
		window.location = options.reservationUrlTemplate.replace('[refnum]', referenceNumber);
	}

	function approveReservation(referenceNumber)
	{
		$.colorbox({inline:true, href:"#approveDiv", transition:"none", width:"75%", height:"75%", overlayClose: false});
		$('#approveDiv').show();
		approval.Approve(referenceNumber);
	}
}