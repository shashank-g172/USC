function ResourceManagement(opts) {
	var options = opts;

	var elements = {
		activeId:$('#activeId'),

		renameDialog:$('#renameDialog'),
		imageDialog:$('#imageDialog'),
		scheduleDialog:$('#scheduleDialog'),
		locationDialog:$('#locationDialog'),
		descriptionDialog:$('#descriptionDialog'),
		notesDialog:$('#notesDialog'),
		deleteDialog:$('#deleteDialog'),
		configurationDialog:$('#configurationDialog'),
		groupAdminDialog:$('#groupAdminDialog'),
		sortOrderDialog:$('#sortOrderDialog'),
		resourceTypeDialog:$('#resourceTypeDialog'),
		statusDialog:$('#statusDialog'),

		renameForm:$('#renameForm'),
		imageForm:$('#imageForm'),
		scheduleForm:$('#scheduleForm'),
		locationForm:$('#locationForm'),
		descriptionForm:$('#descriptionForm'),
		notesForm:$('#notesForm'),
		deleteForm:$('#deleteForm'),
		configurationForm:$('#configurationForm'),
		groupAdminForm:$('#groupAdminForm'),
		attributeForm:$('.attributesForm'),
		sortOrderForm:$('#sortOrderForm'),
		statusForm:$('#statusForm'),
		resourceTypeForm:$('#resourceTypeForm'),

		statusReasons:$('#reasonId'),
		statusOptions:$('#statusId'),
		addStatusReason:$('#addStatusReason'),
		newStatusReason:$('#newStatusReason'),

		addForm:$('#addResourceForm')
	};

	var resources = {};
	var reasons = [];

	ResourceManagement.prototype.init = function () {
		$(".days").watermark('days');
		$(".hours").watermark('hrs');
		$(".minutes").watermark('mins');

		ConfigureAdminDialog(elements.renameDialog);
		ConfigureAdminDialog(elements.imageDialog);
		ConfigureAdminDialog(elements.scheduleDialog);
		ConfigureAdminDialog(elements.locationDialog);
		ConfigureAdminDialog(elements.descriptionDialog);
		ConfigureAdminDialog(elements.notesDialog);
		ConfigureAdminDialog(elements.deleteDialog);
		ConfigureAdminDialog(elements.configurationDialog);
		ConfigureAdminDialog(elements.groupAdminDialog);
		ConfigureAdminDialog(elements.sortOrderDialog);
		ConfigureAdminDialog(elements.resourceTypeDialog);
		ConfigureAdminDialog(elements.statusDialog);

		$('.resourceDetails').each(function () {
			var id = $(this).find(':hidden.id').val();
			var indicator = $('.indicator');

			$(this).find('a.update').click(function (e) {
				e.preventDefault();
				setActiveResourceId(id);
			});

			$(this).find('.imageButton').click(function (e) {
				showChangeImage(e);
			});

			$(this).find('.removeImageButton').click(function (e) {
				PerformAsyncAction($(this), getSubmitCallback(options.actions.removeImage), indicator);
			});

			$(this).find('.enableSubscription').click(function (e) {
				PerformAsyncAction($(this), getSubmitCallback(options.actions.enableSubscription), indicator);
			});

			$(this).find('.disableSubscription').click(function (e) {
				PerformAsyncAction($(this), getSubmitCallback(options.actions.disableSubscription), indicator);
			});

			$(this).find('.renameButton').click(function (e) {
				showRename(e);
			});

			$(this).find('.changeScheduleButton').click(function (e) {
				showScheduleMove(e);
			});

			$(this).find('.changeResourceType').click(function (e) {
				showResourceType(e);
			});

			$(this).find('.changeLocationButton').click(function (e) {
				showChangeLocation(e);
			});

			$(this).find('.descriptionButton').click(function (e) {
				showChangeDescription(e);
			});

			$(this).find('.notesButton').click(function (e) {
				showChangeNotes(e);
			});

			$(this).find('.adminButton').click(function (e) {
				showResourceAdmin(e);
			});

			$(this).find('.deleteButton').click(function (e) {
				showDeletePrompt(e);
			});

			$(this).find('.changeConfigurationButton').click(function (e) {
				showConfigurationPrompt(e);
			});

			$(this).find('.changeAttributes, .customAttributes .cancel').click(function (e) {
				var otherResources = $(".resourceDetails[resourceid!='" + id + "']");
				otherResources.find('.attribute-readwrite, .validationSummary').hide();
				otherResources.find('.attribute-readonly').show();
				var container = $(this).closest('.customAttributes');
				container.find('.attribute-readwrite').toggle();
				container.find('.attribute-readonly').toggle();
				container.find('.validationSummary').hide();
			});

			$(this).find('.changeSortOrder').click(function (e) {
				showSortPrompt(e);
			});

			$(this).find('.changeStatus').click(function (e) {
				showStatusPrompt(e);
			});
		});

		$(".save").click(function () {
			$(this).closest('form').submit();
		});

		$(".cancel").click(function () {
			$(this).closest('.dialog').dialog("close");
		});

		elements.statusOptions.change(function(e){
			populateReasonOptions(elements.statusOptions.val());
		});

		elements.addStatusReason.click(function(e){
			e.preventDefault();
			elements.newStatusReason.toggle();

			if (elements.newStatusReason.is(':visible')){
				elements.statusReasons.data('prev', elements.statusReasons.val());
				elements.statusReasons.val('');
			}
			else{
				elements.statusReasons.val(elements.statusReasons.data('prev'));
			}
		});

		var imageSaveErrorHandler = function (result) {
			alert(result);
		};

		var combineIntervals = function (form, options) {
			$('.interval', form).each(function () {
				var id = $(this).attr('id');
				var d = $('#' + id + 'Days').val();
				var h = $('#' + id + 'Hours').val();
				var m = $('#' + id + 'Minutes').val();
				$(this).val(d + 'd' + h + 'h' + m + 'm');
			});
		};

		var attributesHandler = function(responseText, form)
		{
			if (responseText.ErrorIds && responseText.Messages.attributeValidator)
			{
				var messages =  responseText.Messages.attributeValidator.join('</li><li>');
				messages = '<li>' + messages + '</li>';
				var validationSummary = $(form).find('.validationSummary');
				validationSummary.find('ul').empty().append(messages);
				validationSummary.show();
			}
		};

		var errorHandler = function (result) {
			$("#globalError").html(result).show();
		};

		ConfigureAdminForm(elements.imageForm, defaultSubmitCallback(elements.imageForm), null, imageSaveErrorHandler);
		ConfigureAdminForm(elements.renameForm, defaultSubmitCallback(elements.renameForm), null, errorHandler);
		ConfigureAdminForm(elements.scheduleForm, defaultSubmitCallback(elements.scheduleForm));
		ConfigureAdminForm(elements.locationForm, defaultSubmitCallback(elements.locationForm));
		ConfigureAdminForm(elements.descriptionForm, defaultSubmitCallback(elements.descriptionForm));
		ConfigureAdminForm(elements.notesForm, defaultSubmitCallback(elements.notesForm));
		ConfigureAdminForm(elements.addForm, defaultSubmitCallback(elements.addForm), null, handleAddError);
		ConfigureAdminForm(elements.deleteForm, defaultSubmitCallback(elements.deleteForm));
		ConfigureAdminForm(elements.configurationForm, defaultSubmitCallback(elements.configurationForm), null, errorHandler, {onBeforeSerialize:combineIntervals});
		ConfigureAdminForm(elements.groupAdminForm, defaultSubmitCallback(elements.groupAdminForm));
		ConfigureAdminForm(elements.resourceTypeForm, defaultSubmitCallback(elements.resourceTypeForm));
		$.each(elements.attributeForm, function(i,form){
			ConfigureAdminForm($(form), defaultSubmitCallback($(form)), null, attributesHandler, {validationSummary:null});
		});

		ConfigureAdminForm(elements.sortOrderForm, defaultSubmitCallback(elements.sortOrderForm));
		ConfigureAdminForm(elements.statusForm, defaultSubmitCallback(elements.statusForm));
	};

	ResourceManagement.prototype.add = function (resource) {
		resources[resource.id] = resource;
	};

	ResourceManagement.prototype.addStatusReason = function (id, statusId, description) {
		if (!(statusId in reasons))
		{
			reasons[statusId] = [];
		}

		reasons[statusId].push({id:id,description:description});
	};

	var getSubmitCallback = function (action) {
		return function () {
			return options.submitUrl + "?rid=" + getActiveResourceId() + "&action=" + action;
		};
	};

	var defaultSubmitCallback = function (form) {
		return function () {
			return options.submitUrl + "?action=" + form.attr('ajaxAction') + '&rid=' + getActiveResourceId();
		};
	};

	var setActiveResourceId = function (scheduleId) {
		elements.activeId.val(scheduleId);
	};

	var getActiveResourceId = function () {
		return elements.activeId.val();
	};

	var getActiveResource = function () {
		return resources[getActiveResourceId()];
	};

	var showChangeImage = function (e) {
		elements.imageDialog.dialog("open");
	};

	var showRename = function (e) {
		$('#editName').val(getActiveResource().name);
		elements.renameDialog.dialog("open");
	};

	var showScheduleMove = function (e) {
		$('#editSchedule').val(getActiveResource().scheduleId);
		elements.scheduleDialog.dialog("open");
	};

	var showResourceType = function (e) {
		$('#editResourceType').val(getActiveResource().resourceTypeId);
		elements.resourceTypeDialog.dialog("open");
	};

	var showChangeLocation = function (e) {
		$('#editLocation').val(getActiveResource().location);
		$('#editContact').val(getActiveResource().contact);
		elements.locationDialog.dialog("open");
	};

	var showChangeDescription = function (e) {
		$('#editDescription').val(HtmlDecode(getActiveResource().description));
		elements.descriptionDialog.dialog("open");
	};

	var showChangeNotes = function (e) {
		$('#editNotes').val(HtmlDecode(getActiveResource().notes));
		elements.notesDialog.dialog("open");
	};

	var showResourceAdmin = function (e) {
		$('#adminGroupId').val(getActiveResource().adminGroupId);
		elements.groupAdminDialog.dialog("open");
	};

	var showDeletePrompt = function (e) {
		elements.deleteDialog.dialog("open");
	};

	var showConfigurationPrompt = function (e) {
		elements.configurationDialog.find(':checkbox').change(function () {
			var id = $(this).attr('id');
			var span = elements.configurationDialog.find('.' + id);

			if ($(this).is(":checked")) {
				span.find(":text").val('');
				span.hide();
			}
			else {
				span.show();
			}
		});

		var resource = getActiveResource();

		setDaysHoursMinutes('#minDuration', resource.minLength, $('#noMinimumDuration'));
		setDaysHoursMinutes('#maxDuration', resource.maxLength, $('#noMaximumDuration'));
		setDaysHoursMinutes('#startNotice', resource.startNotice, $('#noStartNotice'));
		setDaysHoursMinutes('#endNotice', resource.endNotice, $('#noEndNotice'));
		setDaysHoursMinutes('#bufferTime', resource.bufferTime, $('#noBufferTime'));
		showHideConfiguration(resource.maxParticipants, $('#maxCapactiy'), $('#unlimitedCapactiy'));

		$('#allowMultiday').val(resource.allowMultiday);
		$('#requiresApproval').val(resource.requiresApproval);
		$('#autoAssign').val(resource.autoAssign);

		elements.configurationDialog.dialog("open");
	};

	var showAttributesPrompt = function (e) {
		var resource = getActiveResource();

		var attributeDiv = $('[resourceId="' + resource.id + '"]').find('.customAttributes');

		$.each(attributeDiv.find('li[attributeId]'), function(index, value){
			var id = $(value).attr('attributeId');
			var attrVal = $(value).find('.attributeValue').text();

			var attribute = $('#psiattribute\\[' + id + '\\]');

			if (attribute.is(':checkbox'))
			{
				if (attrVal.toLowerCase() == 'true')
				{
					attribute.attr('checked', 'checked');
				}
				else
				{
					attribute.removeAttr('checked');
				}
			}
			else
			{
				attribute.val(attrVal);
			}
		});
		elements.attributeDialog.dialog('open');
	};

	var showSortPrompt = function (e) {
		$('#editSortOrder').val(getActiveResource().sortOrder);
		elements.sortOrderDialog.dialog("open");
	};

	var showStatusPrompt = function (e) {
		var resource = getActiveResource();
		elements.statusOptions.val(resource.statusId);

		populateReasonOptions(resource.statusId);

		elements.statusReasons.val(resource.reasonId);

		elements.statusDialog.dialog("open");
	};

	function populateReasonOptions(statusId){
		elements.statusReasons.empty().append($('<option>', {value:'', text:'-'}));

		if (statusId in reasons)
		{
			$.each(reasons[statusId], function(i, v){
				elements.statusReasons.append($('<option>', {
						value: v.id,
						text : v.description
					}));
			});
		}
	}

	function setDaysHoursMinutes(elementPrefix, interval, attributeCheckbox) {
		$(elementPrefix + 'Days').val(interval.days);
		$(elementPrefix + 'Hours').val(interval.hours);
		$(elementPrefix + 'Minutes').val(interval.minutes);
		showHideConfiguration(interval.value, $(elementPrefix), attributeCheckbox);
	}

	function showHideConfiguration(attributeValue, attributeDisplayElement, attributeCheckbox) {
		attributeDisplayElement.val(attributeValue);
		var id = attributeCheckbox.attr('id');
		var span = elements.configurationDialog.find('.' + id);

		if (attributeValue == '' || attributeValue == undefined) {
			attributeCheckbox.attr('checked', true);
			span.hide();
		}
		else {
			attributeCheckbox.attr('checked', false);
			span.show();
		}
	}

	var showIndicator = function (formElement) {
		formElement.find('button').hide();
		formElement.append($('.indicator'));
		formElement.find('.indicator').show();
	};

	var handleAddError = function (result) {
		$('#addResourceResults').text(result).show();
	};
}