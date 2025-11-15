function selectRooms(selectedRooms, bookingRequestId) {
    var parentContainer = $('.parentContainer-' + bookingRequestId)
    $.each(selectedRooms, function (index, element) {
        var singleRoom = parentContainer.find(`[room=room-${element}]`).not(`:disabled`);
        if (singleRoom.hasClass('available')) {
            singleRoom.removeClass('btn--primary').addClass('btn--success selected');
            singleRoom.data('booked_status', 1);
        }
    });
}