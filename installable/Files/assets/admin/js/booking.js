function setTotalAmount() {
    var amount = 0;
    var couponAmount = 0;
    var taxTotalCharge = 0;
    var subtotal = $(document).find('.subTotal');
    
    $.each(subtotal, function (index, element) {
        amount += parseFloat($(element).attr('sub_total'));
    });
    
    $(document).find('.totalFare').text(amount + ' ' + curText);
    var taxTotalCharge = 0;
    var taxCharge = $('.formRoomSearch').data('tax-charge');
    var couponAmount = $('.formRoomSearch').data('coupon-amount') ?? 0;
    amount = (amount - couponAmount);
    taxTotalCharge =  amount * parseFloat(taxCharge) / 100;
    amount = (amount + taxTotalCharge).toFixed(2);
    $(document).find('[name="tax_charge"]').val(taxTotalCharge);
    $(document).find('.grandTotalFare').text(amount + ' ' + curText);
    $('[name=total_amount]').val(amount);
    $('.showTaxAmount').text(taxTotalCharge.toFixed(2) +' '+ curText);
}

function enableDisableBooking() {
    var roomDisabledStatus = false;
    var suitesDisabledStatus = false;
    var roomColumns = $('.room-column');
    var suiteColumns = $('.suite-column');
    var bookBtn = $(document).find('.btn-book');
    
    $.each(roomColumns, function (index, element) {
        var numberOfRooms = Number($(element).data('number_of_rooms'));

        if ($(element).find('.selected').length != numberOfRooms) {
            if ($(element).find('.selected').length < numberOfRooms) {
                lowFromLimit = true;
            }
            if ($(element).find('.selected').length > numberOfRooms) {
                limitCross = true;
            }
            $(element).siblings("td").first().removeClass('text-warning').addClass('text-danger');
            roomDisabledStatus = true;
        } else {
            if (needChanged) {
                $(element).siblings("td").first().removeClass('text-danger').addClass('text-warning');
            } else {
                $(element).siblings("td").first().removeClass('text-danger').removeClass('text-warning');
            }
        }
    });
    

    $.each(suiteColumns, function (index, element) {
        var numberOfSuites = Number($(element).data('number_of_suites'));
        if ($(element).find('.selected').length != numberOfSuites) {
            if ($(element).find('.selected').length < numberOfSuites) {
                lowFromLimit = true;
            }
            if ($(element).find('.selected').length > numberOfSuites) {
                limitCross = true;
            }
            $(element).siblings("td").first().removeClass('text-warning').addClass('text-danger');

            suitesDisabledStatus = true;
        } else {
            if (needChanged) {
                $(element).siblings("td").first().removeClass('text-danger').addClass('text-warning');
            } else {
                $(element).siblings("td").first().removeClass('text-danger').removeClass('text-warning');
            }
        }
    });
   
    if (!(roomDisabledStatus) && !(suitesDisabledStatus)) {
        bookBtn.attr("disabled", false);
    }else{
        bookBtn.attr("disabled", true);
    }
}

function updateOrderList() {
    let listedRooms = [];
    let roomInputs = '';
    let selectedRooms = $(document).find('.room-btn.selected');
    $.each(selectedRooms, function (i, selectedRoom) {

        var roomData = $(selectedRoom).data('room');
        var unitFare = parseFloat($(selectedRoom).data('unit_fare')).toFixed(2);
        var bookingDate = $(selectedRoom).data('date');
        var roomTypeId = $(selectedRoom).data('room_type_id');
        var discount = $(selectedRoom).data('discount');

        roomInputs += `<input type="hidden" value="${roomData.id}" name="room[${i}][id]">`;
        roomInputs += `<input type="hidden" value="${bookingDate}" name="room[${i}][date]">`;
        roomInputs += `<input type="hidden" value="${roomTypeId}" name="room[${i}][type_id]">`;
        roomInputs += `<input type="hidden" value="${unitFare}" name="room[${i}][unit_fare]">`;
        let index = listedRooms.findIndex(elem => elem.room_number == roomData.room_number);

        if (index == -1) {
            let object = {
                room_number: roomData.room_number,
                unit_fare: unitFare,
                total_fare: unitFare,
                discount: discount,
                room_type_id: roomTypeId,
                total_days: 1
            }
            listedRooms.push(object);
        } else {
            listedRooms[index].total_fare = parseFloat(listedRooms[index].total_fare) + parseFloat(unitFare);
            listedRooms[index].discount = parseFloat(listedRooms[index].discount) + parseFloat(discount);
            listedRooms[index].total_days += 1;
        }
    });

    let html = '';
    $.each(listedRooms, function (index, room) {       

        html += `<li class="orderListItem order-list-type-${room.room_type_id}
                list-group-item d-flex justify-content-between align-items-center
                room-${room.room_number}" data-room_number="${room.room_number}"><span>
                <span class="removeItem btn btn-sm btn--danger"><i class="las la-times me-0"></i></span>
                ${room.room_number}
                </span>
                <span class="totalDays">${room.total_days}</span>
                <span class="unitFare">${parseFloat(room.unit_fare).toFixed()} ${curText}</span>
                <span class="subTotal" sub_total="${parseFloat(room.total_fare).toFixed()}" discount="${parseFloat(room.discount).toFixed()}">${parseFloat(room.total_fare).toFixed()} ${curText}</span>
            </li>`;
    });

    html += `<li class="d-none input-fields">${roomInputs}</li>`;
    $(document).find('.orderItem li:not(:first)').remove();
    $(document).find('.orderItem').append(html);
    setTotalAmount();
    enableDisableBooking();
    $(document).find('.orderList').removeClass('d-none');
}


let confirmationModal = $(document).find('#confirmBookingModal');
let bookingForm = $(document).find('.booking-form');

$(document).on('click', '.confirmBookingBtn', function () {
    confirmationModal.modal('show');
});

$(document).on('click', '.btn-confirm', function () {
    confirmationModal.modal('hide');
    bookingForm.submit();
});

$(document).on('submit', '#bookingForm', function (e) {
    e.preventDefault();
    let formData = $(this).serialize();
    let url = $(this).attr('action');
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        success: function (response) {
            if (response.success) {
                notify('success', response.success);
                $(document).find('.bookingInfo').html('');
                $(document).find('.booking-wrapper').addClass('d-none');
                $(document).find('.orderListItem').remove();
                $(document).find('.orderList').addClass('d-none');
                $(document).find('.formRoomSearch').trigger('reset');
                $(document).find('#bookingForm').trigger('reset');
            } else {
                notify('error', response.error);
            }
        },
    });
});

$(document).on('click', '.room-btn', function () {
    let bookedStatus = $(this).data('booked_status');
    if (!bookedStatus) {
        $(this).removeClass('btn--primary').addClass('btn--success selected');
        $(this).data('booked_status', 1);
    } else {
        $(this).data('booked_status', 0);
        $(this).removeClass('btn--success selected').addClass('btn--primary');
    }
    updateOrderList();
});

$(document).on('click', '.removeItem', function () {
    let li = $(this).parents('li');
    var roomNumber = li.data('room_number');
    let allSelectedRooms = $(`[room=room-${roomNumber}].selected`);
    allSelectedRooms.removeClass('btn--success selected').addClass('btn--primary').data('booked_status', 0);
    updateOrderList();
});