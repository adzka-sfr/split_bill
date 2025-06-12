<div class="row">
    <div class="col-12 text-center" id="data-value">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p>Loading data, please wait...</p>
    </div>
</div>

<script>
    $(document).ready(function() {
        // get data from database
        getData();
    });

    // function to get data from database
    function getData() {
        $.ajax({
            url: 'history/data1.php',
            type: 'POST',
            success: function(response) {
                $('#data-value').html(response);
            },
            error: function(xhr, status, error) {
                $('#data-value').html(`
                    <div class="alert alert-danger" role="alert">
                        <strong>Error!</strong> Unable to load data. Please try again later.
                    </div>
                `);
            }
        });
    }
</script>