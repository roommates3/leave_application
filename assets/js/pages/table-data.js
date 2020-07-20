$(document).ready(function() {
    $('#example').DataTable({
        language: {
            searchPlaceholder: 'Search records',
            sSearch: '',
            sLengthMenu: 'Show _MENU_',
            sLength: 'dataTables_length',
            oPaginate: {
                sFirst: '<i class="fas fa-chevron-circle-left    "></i>',
                sPrevious: '<i class="fas fa-chevron-circle-left  "></i>',
                sNext: '<i class="fas fa-chevron-circle-right    "></i>',
                sLast: '<i class="fas fa-chevron-circle-right    "></i>' 
        }
        }
    });
    $('.dataTables_length select').addClass('browser-default');
});