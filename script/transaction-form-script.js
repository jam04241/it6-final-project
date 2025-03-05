
    $(document).ready(function() {
        $('#transaction-information').DataTable({
            "paging": true, // Enable pagination
            "searching": true, // Enable search box
            "ordering": true, // Enable sorting
            "info": true, // Show info text
            "lengthMenu": [5, 10, 25, 50], // Dropdown to select the number of entries to show
        });
    });

