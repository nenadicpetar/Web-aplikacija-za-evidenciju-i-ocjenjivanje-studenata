$('document').ready(function() {
    $('#dalje').click(function () {
        $('.informacije').each(function (element) {
            $(this).css("display", "table-row");
        })
    })
})