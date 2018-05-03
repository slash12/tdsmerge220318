//datatable for view tshirt
$(document).ready(function () {
    $('#mtstbl').DataTable({
        "pageLength": 4,
        "autoWidth": false,
        "scrollX": true
    });
});

//js for toggle side menu admin
$(document).ready(function () {
    $("#sidebar").mCustomScrollbar({
        theme: "minimal",
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});

//init the dropdown of add tshirt form
$(document).ready(function () {
    $('.selectpicker').selectpicker();
});

//refresh script
function clrfrm() {
    location.reload();
}

//popover init
$(document).ready(function () {
    $('[data-toggle="popover"]').popover({
        // trigger: 'hover',
        delay: { "show": 100, "hide": 500 },
        placement: 'left',
        html: true
    });
});