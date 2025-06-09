// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable({
        "columnDefs": [
            { "type": "html-num-fmt", "targets": 0 }
        ]
    });
});