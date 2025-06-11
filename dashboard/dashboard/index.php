<!-- hidden -->
<input type="text" id="trip-id" value="-" style="display: none;">
<!-- hidden -->

<div class="row">
    <div class="col-12" id="data-value"></div>
</div>

<!-- Button Start -->
<div class="row">
    <div class="col-12 mb-1">
        <button style="width: 100%;" class="btn btn-primary btn-sm" id="btn-add-destination">Add Destination</button>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <button style="width: 100%;" class="btn btn-danger btn-sm" id="btn-new-trip">New Trip</button>
    </div>
</div>
<!-- Button End -->

<!-- Modal Start -->
<!-- modal to add trip -->
<div class="modal fade" id="modal-add-trip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New Trip</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trip Name</label>
                            <input class="form-control" type="text" name="trip-name" id="trip-name">
                            <span id="error-trip-name" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan nama trip</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Partisipan </label><span style="font-size: 10px;">(ex: partisipan1,partisipan2,etc)</span>
                            <input class="form-control" type="text" name="partisipan-name" id="partisipan-name">
                            <span id="error-partisipan-name" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan nama partisipan</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btn-start">Start!!!</button>
            </div>
        </div>
    </div>
</div>

<!-- modal to add destination -->
<div class="modal fade" id="modal-add-destination" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Destination</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="destination-name">Destination Name</label>
                            <input class="form-control" type="text" name="destination-name" id="destination-name">
                            <span id="error-destination-name" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan nama destination</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="payer-name">Payer Name</label>
                            <select class="form-control payer-select" name="payer-name" id="payer-name" style="width: 100%;">
                            </select>
                            <span id="error-payer-name" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Silahkan memilih payer</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btn-save-destination">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- modal to add transaction -->
<div class="modal fade" id="modal-add-transaction" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Add Transaction</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="destination-id" id="destination-id">
                <div class="row">
                    <div class="col-12">
                        <table>
                            <tr>
                                <td>Destination</td>
                                <td>:</td>
                                <th id="destination-name-tr"></th>
                            </tr>
                            <tr>
                                <td>Payer</td>
                                <td>:</td>
                                <th id="payer-name-tr"></th>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="item-name">Item</label>
                            <input class="form-control" type="text" name="item-name" id="item-name">
                            <span id="error-item-name" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan nama item</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="item-price">Price</label>
                            <input class="form-control" type="number" name="item-price" id="item-price" min="0" step="any" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            <span id="error-item-price" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan harga</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-2">
                        <label>Owner Type</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="owner-type" id="owner-type-all" value="all">
                            <label class="form-check-label" for="owner-type-all">All</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="owner-type" id="owner-type-not-all" value="not-all">
                            <label class="form-check-label" for="owner-type-not-all">Not All</label>
                        </div>
                        <br>
                        <span id="error-owner-type" style="color: #DC3545; display: none;">
                            <i class="fa-solid fa-circle-info"></i> Silahkan memilih owner type
                        </span>
                    </div>
                </div>
                <div class="row" id="owner-select-row" style="display: none;">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="item-owner">Owner</label>
                            <select class="form-control owner-select" name="item-owner[]" id="item-owner" multiple="multiple" style="width: 100%;"></select>
                            <span id="error-item-owner" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan nama owner</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btn-save-transaction">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- modal to add participant edit -->
<div class="modal fade" id="modal-add-participant-edit" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Add More Participant</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Partisipan </label><span style="font-size: 10px;">(ex: partisipan1,partisipan2,etc)</span>
                            <input class="form-control" type="text" name="partisipan-name-add" id="partisipan-name-add">
                            <span id="error-partisipan-name-add" style="color: #DC3545; display: none;"><i class="fa-solid fa-circle-info"></i> Silahkan memasukkan nama partisipan</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btn-add-participant">Add</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

<!-- modal to edit transaction -->
<div class="modal fade" id="modal-edit-transaction" aria-labelledby="modalEditTransactionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="modalEditTransactionLabel">Edit Transaction</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <input type="hidden" name="transaction-id-edit" id="transaction-id-edit">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="item-name-edit">Item</label>
                            <input class="form-control" type="text" name="item-name-edit" id="item-name-edit">
                            <span id="error-item-name-edit" style="color: #DC3545; display: none;">
                                <i class="fa-solid fa-circle-info"></i> Silahkan memasukkan nama item
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="item-price-edit">Price</label>
                            <input class="form-control" type="number" name="item-price-edit" id="item-price-edit" min="0" step="any" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            <span id="error-item-price-edit" style="color: #DC3545; display: none;">
                                <i class="fa-solid fa-circle-info"></i> Silahkan memasukkan harga
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="payer-name-edit">Add Owner</label>
                            <select class="form-control add-owner" name="owner-name-edit[]" multiple='multiple' id="owner-name-edit" style="width: 100%;"></select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 mt-2" id="list-owner-now"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btn-delete-transaction">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-update-transaction">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // get trip id
        getLastTripId();

        // add trip button click event
        $('#btn-new-trip').click(function() {
            // Show modal
            $('#modal-add-trip').modal('show');
        });

        // add destination button click event
        $('#btn-add-destination').click(function() {
            // Show modal
            $('#modal-add-destination').modal('show');
            getPayerNames('payer-name');
        });

        // start trip button click event
        $('#btn-start').click(function() {
            // Validate trip name
            const tripName = $('#trip-name').val().trim();
            if (tripName === '') {
                $('#error-trip-name').show();
                return;
            } else {
                $('#error-trip-name').hide();
            }

            // Validate partisipan name
            const partisipanName = $('#partisipan-name').val().trim();
            if (partisipanName === '') {
                $('#error-partisipan-name').show();
                return;
            } else {
                $('#error-partisipan-name').hide();
            }

            // send to data1.php using ajax
            $.ajax({
                url: 'dashboard/data1.php',
                type: 'POST',
                data: {
                    trip_name: tripName,
                    participants: partisipanName
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        // Close modal
                        $('#modal-add-trip').modal('hide');

                        // Show success message using sweetalert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Optionally, you can reload the page or redirect
                            location.reload();
                        });
                    } else if (data.status === 'not_logged_in') {
                        // Redirect to login page
                        Swal.fire({
                            icon: 'warning',
                            title: 'Not Logged In',
                            text: data.message,
                            confirmButtonText: 'Login',
                            preConfirm: () => {
                                // reload current page
                                location.reload();
                            }
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error starting trip:', error);
                }
            });

        });

        // save destination button click event
        $('#btn-save-destination').click(function() {


            // get trip id
            const tripId = $('#trip-id').val().trim();
            if (tripId === '-') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please start a trip first.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Validate destination name
            const destinationName = $('#destination-name').val().trim();
            if (destinationName === '') {
                $('#error-destination-name').show();
                return;
            } else {
                $('#error-destination-name').hide();
            }

            // Validate payer name
            const payerId = $('#payer-name').val().trim();
            if (payerId === '') {
                $('#error-payer-name').show();
                return;
            } else {
                $('#error-payer-name').hide();
            }

            // send to data5.php using ajax
            $.ajax({
                url: 'dashboard/data5.php',
                type: 'POST',
                data: {
                    trip_id: tripId,
                    destination_name: destinationName,
                    payer_id: payerId
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status === 'not_logged_in') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Not Logged In',
                            text: 'Please log in to continue.',
                            confirmButtonText: 'Login',
                            preConfirm: () => {
                                // reload current page
                                location.reload();
                            }
                        });
                    } else if (response.status === 'success') {
                        // Clear input fields
                        $('#destination-name').val('');
                        $('#payer-name').val('').trigger('change'); // Reset select2

                        // Hide error messages
                        $('#error-destination-name').hide();
                        $('#error-payer-name').hide();

                        // Show success message using sweetalert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Close modal
                            $('#modal-add-destination').modal('hide');
                            // Reload trip info
                            getTripInfo();
                        });

                    } else {
                        // Close modal
                        $('#modal-add-destination').modal('hide');

                        // Show success message using sweetalert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Optionally, you can reload the page or redirect
                            getTripInfo();
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error saving destination:', error);
                }
            });
        });

        // add participant button click event
        $('#btn-add-participant').click(function() {
            // Validate partisipan name
            const partisipanNameAdd = $('#partisipan-name-add').val().trim();
            if (partisipanNameAdd === '') {
                $('#error-partisipan-name-add').show();
                return;
            } else {
                $('#error-partisipan-name-add').hide();
            }

            // get trip id
            const tripId = $('#trip-id').val().trim();
            if (tripId === '-') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please start a trip first.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // send to data6.php using ajax
            $.ajax({
                url: 'dashboard/data6.php',
                type: 'POST',
                data: {
                    trip_id: tripId,
                    participant_name: partisipanNameAdd
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status === 'not_logged_in') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Not Logged In',
                            text: 'Please log in to continue.',
                            confirmButtonText: 'Login',
                            preConfirm: () => {
                                // reload current page
                                location.reload();
                            }
                        });
                    } else if (response.status === 'success') {
                        // Clear input fields
                        $('#partisipan-name-add').val('');

                        // Hide error messages
                        $('#error-partisipan-name-add').hide();

                        // Show success message using sweetalert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Close modal
                            $('#modal-add-participant-edit').modal('hide');
                            // Reload trip info
                            getTripInfo();
                        });

                    } else {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error adding participant:', error);
                }
            });
        });

        // Save transaction button click event
        $('#btn-save-transaction').click(function() {
            // get trip id
            const tripId = $('#trip-id').val().trim();
            // Validate item name
            const itemName = $('#item-name').val().trim();
            if (itemName === '') {
                $('#error-item-name').show();
                return;
            } else {
                $('#error-item-name').hide();
            }

            // Validate item price
            const itemPrice = $('#item-price').val().trim();
            if (itemPrice === '' || isNaN(itemPrice)) {
                $('#error-item-price').show();
                return;
            } else {
                $('#error-item-price').hide();
            }

            // check radio buttons for owner type
            const ownerTypeChecked = $('input[name="owner-type"]:checked').length;
            if (ownerTypeChecked === 0) {
                $('#error-owner-type').show();
                return;
            } else {
                $('#error-owner-type').hide();
            }

            // Validate owner type
            const ownerType = $('input[name="owner-type"]:checked').val();
            let itemOwners = [];
            if (ownerType === 'not-all') {
                itemOwners = $('#item-owner').val();
                if (!itemOwners || itemOwners.length === 0) {
                    $('#error-item-owner').show();
                    return;
                } else {
                    $('#error-item-owner').hide();
                }
            }

            // get destination id
            const destinationId = $('#destination-id').val().trim();
            if (destinationId === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Invalid destination ID.',
                    confirmButtonText: 'OK'
                });
                return;
            }


            // send to data9.php using ajax
            $.ajax({
                url: 'dashboard/data9.php',
                type: 'POST',
                data: {
                    destination_id: destinationId,
                    item_name: itemName,
                    item_price: itemPrice,
                    owner_type: ownerType,
                    item_owners: itemOwners,
                    trip_id: tripId
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status === 'not_logged_in') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Not Logged In',
                            text: 'Please log in to continue.',
                            confirmButtonText: 'Login',
                            preConfirm: () => {
                                // reload current page
                                location.reload();
                            }
                        });
                    } else if (response.status === 'success') {
                        // Clear input fields
                        $('#item-name').val('');
                        $('#item-price').val('');
                        $('#item-owner').val(null).trigger('change'); // Reset select2

                        // Hide error messages
                        $('#error-item-name').hide();
                        $('#error-item-price').hide();
                        $('#error-item-owner').hide();
                        // Hide owner select row if 'All' is selected
                        $('#owner-select-row').hide();
                        // Uncheck 'All' owner type
                        $('#owner-type-all').prop('checked', true);
                        // Show success message using sweetalert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Close modal
                            $('#modal-add-transaction').modal('hide');
                            // Reload trip info
                            getTripInfo();
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error saving transaction:', error);
                }
            });
        });

        // Delete transaction button click event
        $('#btn-delete-transaction').click(function() {
            // Get transaction ID
            var transactionId = $('#transaction-id-edit').val().trim();
            if (transactionId === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Invalid transaction ID.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Confirm deletion
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete transaction
                    $.ajax({
                        url: 'dashboard/data12.php',
                        type: 'POST',
                        data: {
                            transaction_id: transactionId
                        },
                        success: function(response) {
                            var response = JSON.parse(response);
                            if (response.status === 'success') {
                                // Reload trip info
                                getTripInfo();
                                // Toggle the visibility of the edit transaction modal after OK is clicked
                                $('#modal-edit-transaction').modal('hide');
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error deleting transaction:', error);
                        }
                    });
                }
            });
        });

        // Update transaction button click event
        $('#btn-update-transaction').click(function() {
            // Get transaction ID
            var transactionId = $('#transaction-id-edit').val().trim();
            var itemName = $('#item-name-edit').val();
            var itemPrice = $('#item-price-edit').val();

            // Validate owner type
            var itemOwners = [];
            itemOwners = $('#owner-name-edit').val();

            if (transactionId === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Invalid transaction ID.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Confirm update
            Swal.fire({
                title: 'Are you sure?',
                text: "The transaction will be updated!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete transaction
                    $.ajax({
                        url: 'dashboard/data13.php',
                        type: 'POST',
                        data: {
                            transaction_id: transactionId,
                            item_name: itemName,
                            item_price: itemPrice,
                            item_owners: itemOwners
                        },
                        success: function(response) {
                            var response = JSON.parse(response);
                            if (response.status === 'success') {
                                // Reload trip info
                                getTripInfo();
                                // Toggle the visibility of the edit transaction modal after OK is clicked
                                $('#modal-edit-transaction').modal('hide');
                                Swal.fire(
                                    'Updated!',
                                    response.message,
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error update transaction:', error);
                        }
                    });
                }
            });

        })

        // Owner type radio button logic
        $('input[name="owner-type"]').change(function() {
            if ($('#owner-type-not-all').is(':checked')) {
                $('#owner-select-row').show();
                getPayerNames('item-owner');
            } else {
                $('#owner-select-row').hide();
                // Optionally clear selection
                $('#item-owner').empty();
            }
        });

        // Ensure correct state on modal open
        $('#modal-add-transaction').on('shown.bs.modal', function() {
            if ($('#owner-type-not-all').is(':checked')) {
                $('#owner-select-row').show();
            } else {
                $('#owner-select-row').hide();
            }
        });
    });

    // function to get last trip id
    function getLastTripId() {
        $.ajax({
            url: 'dashboard/data3.php',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Set trip id to hidden input
                    $('#trip-id').val(response.trip.id);
                    getTripInfo();

                } else if (response.status === 'not_logged_in') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Not Logged In',
                        text: 'Please log in to continue.',
                        confirmButtonText: 'Login',
                        preConfirm: () => {
                            // reload current page
                            location.reload();
                        }
                    });
                } else {
                    console.error('Trip not found:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching last trip ID:', error);
            }
        });
    }

    // function to get all information about trip id
    function getTripInfo() {
        // get trip id
        const tripId = $('#trip-id').val().trim();

        $.ajax({
            url: 'dashboard/data4.php',
            type: 'POST',
            data: {
                trip_id: tripId
            },
            success: function(response) {
                if (response === 'not_logged_in') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Not Logged In',
                        text: 'Please log in to continue.',
                        confirmButtonText: 'Login',
                        preConfirm: () => {
                            // reload current page
                            location.reload();
                        }
                    });
                } else {
                    $('#data-value').html(response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching trip info:', error);
            }
        });
    }

    // get list payer names from database
    function getPayerNames(toid) {
        // get trip id
        const tripId = $('#trip-id').val().trim();
        if (tripId === '-') {
            Swal.fire({
                icon: 'error',
                title: 'Denied',
                text: 'Please start a trip first.',
                confirmButtonText: 'OK'
            }).then(() => {
                // reload current page
                $('#modal-add-destination').modal('hide');
            });

            return;
        }

        $.ajax({
            url: 'dashboard/data2.php',
            type: 'POST',
            data: {
                trip_id: tripId
            },
            success: function(response) {
                if (response === 'not_logged_in') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Not Logged In',
                        text: 'Please log in to continue.',
                        confirmButtonText: 'Login',
                        preConfirm: () => {
                            // reload current page
                            location.reload();
                        }
                    });
                } else {
                    // Populate payer names in the select element
                    $('#' + toid).html(response);
                    // Initialize select2 for better UX
                    // $('#payer-name').select2({
                    //     placeholder: 'Select Payer',
                    //     allowClear: true
                    // });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching payer names:', error);
            }
        });
    }

    // function to add transaction
    function addTransaction(destination_id, destination_name, payer_name) {
        // Set destination id to hidden input
        $('#destination-id').val(destination_id);
        // Set destination name to modal
        $('#destination-name-tr').html(destination_name);
        // Set payer name to modal
        $('#payer-name-tr').html(payer_name);
        // open modal
        $('#modal-add-transaction').modal('show');

    }

    // function to add participant
    function addParticipant(trip_id) {
        // Check if trip_id is valid
        if (trip_id === '-') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please start a trip first.',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Show modal
        $('#modal-add-participant-edit').modal('show');
    }

    // function to delete participant
    function deleteParticipant(participant_id) {
        // Check if participant_id is valid
        if (participant_id === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Invalid participant ID.',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Confirm deletion
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to delete participant
                $.ajax({
                    url: 'dashboard/data7.php',
                    type: 'POST',
                    data: {
                        participant_id: participant_id
                    },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status === 'success') {
                            // Reload trip info
                            getTripInfo();
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting participant:', error);
                    }
                });
            }
        });
    }

    // function to delete destination
    function deleteDestination(destination_id) {
        // Check if destination_id is valid
        if (destination_id === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Invalid destination ID.',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Confirm deletion
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to delete destination
                $.ajax({
                    url: 'dashboard/data8.php',
                    type: 'POST',
                    data: {
                        destination_id: destination_id
                    },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status === 'success') {
                            // Reload trip info
                            getTripInfo();
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting destination:', error);
                    }
                });
            }
        });
    }

    // function to edit transaction
    function editTransaction(transaction_id, item_name, item_price) {
        // Check if transaction_id is valid
        if (transaction_id === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Invalid transaction ID.',
                confirmButtonText: 'OK'
            });
            return;
        }
        // fill transaction details
        $('#item-name-edit').val(item_name);
        $('#item-price-edit').val(item_price);

        // Get transaction details
        getTransactionDetails(transaction_id);

        // get owner names
        getPayerNames('owner-name-edit');

        // Set transaction id to hidden input
        $('#transaction-id-edit').val(transaction_id);
        // Show modal
        $('#modal-edit-transaction').modal('show');
    }

    // function to get list owner
    function getTransactionDetails(transaction_id) {
        // Check if transaction_id is valid
        if (transaction_id === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Invalid transaction ID.',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Send AJAX request to get transaction details
        $.ajax({
            url: 'dashboard/data10.php',
            type: 'POST',
            data: {
                transaction_id: transaction_id
            },
            success: function(response) {
                $('#list-owner-now').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching transaction details:', error);
            }
        });
    }

    // function to delete owner
    function deleteOwner(owner_id, transaction_id) {
        // Check if owner_id is valid
        if (owner_id === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Invalid owner ID.',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Confirm deletion
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to delete owner
                $.ajax({
                    url: 'dashboard/data11.php',
                    type: 'POST',
                    data: {
                        owner_id: owner_id,
                    },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status === 'success') {
                            // Reload transaction details
                            getTransactionDetails(transaction_id);
                            // Reload trip info
                            getTripInfo();

                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting owner:', error);
                    }
                });
            }
        });
    }
</script>