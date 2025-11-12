<style>
    /* container yang membatasi watermark agar tidak keluar area tabel */
    .table-container {
        position: relative;
        /* penting: patokan posisi watermark */
        display: block;
        overflow: hidden;
        /* memotong watermark bila melebihi tinggi tabel */
        padding: 8px;
        /* optional: beri jarak supaya watermark tidak nempel ujung */
        background: transparent;
    }

    /* watermark wrapper (mengisi area container) */
    .watermark {
        position: absolute;
        inset: 0;
        /* top:0; right:0; bottom:0; left:0 */
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
        /* tidak mengganggu klik/select tabel */
        z-index: 0;
        /* di belakang konten tabel (beri z-index table > 0) */
    }

    /* teks watermark, miring dan responsif */
    .watermark span {
        transform: rotate(-15deg);
        font-weight: 700;
        white-space: nowrap;
        /* responsif: ukuran antara 30px sampai 80px tergantung lebar */
        font-size: clamp(30px, 8vw, 80px);
        color: rgba(0, 0, 0, 0.06);
        /* atur opacity di sini */
        user-select: none;
    }

    /* pastikan tabel berada di atas watermark */
    .table,
    .table thead,
    .table tbody,
    .table tr,
    .table th,
    .table td {
        position: relative;
        z-index: 1;
    }

    /* override background default Bootstrap pada <th> dan <td> agar watermark tembus */
    .table th,
    .table td {
        background-color: transparent !important;
    }

    /* jika pakai .table-striped dan ingin strip tetap ada,
   hilangkan rule di atas atau gunakan background semi-transparan untuk strip */
</style>

<div class="card shadow">
    <div class="card-header text-center">
        <!-- <h2>Split Bill<sub style="font-size: 10px;">by Adzka</sub></h2> -->
        <p class="text-muted">Trip Checker</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <input type="text" name="trip-id" id="trip-id" class="form-control mb-3" placeholder="Enter Trip ID" required>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="button" disabled class="btn btn-primary w-100" id="btn-check">View</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center mt-3">
                <button id="kembali-btn" class="btn btn-sm"><i class="fa-solid fa-left-long"></i> Kembali</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-3" id="data-value" style="display: none;">

    </div>
    <div class="col-12 text-center" id="laoding" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p>Loading data, please wait...</p>
    </div>
</div>


<script>
    $(document).ready(function() {
        // jika input trip id berubah dan ada isinya, aktifkan tombol view
        $('#trip-id').on('input', function() {
            var tripId = $(this).val().trim();
            $('#btn-check').prop('disabled', tripId === '');
        });

        // ketika enter di klik trigger tombol view
        $('#trip-id').on('keypress', function(e) {
            if (e.which === 13) {
                $('#btn-check').click();
            }
        });

        $('#btn-check').click(function() {
            var tripId = $('#trip-id').val().trim();
            $('#data-value').hide();
            $('#laoding').show();

            $.ajax({
                url: 'check/data1.php',
                type: 'POST',
                data: {
                    trip_id: tripId
                },
                success: function(response) {
                    $('#laoding').hide();
                    $('#data-value').show();
                    $('#data-value').html(response);
                },
                error: function(xhr, status, error) {
                    $('#laoding').hide();
                    $('#data-value').show();
                    $('#data-value').html(`
                    <div class="alert alert-danger" role="alert">
                        <strong>Error!</strong> Unable to load data. Please try again later.
                    </div>
                `);
                }
            });
        });

        // kembali button
        $('#kembali-btn').click(function() {
            const url = new URL(window.location.href);
            url.searchParams.set('page', 'login');
            window.location.href = url.pathname.replace(/\/auth\/login\/index\.php$/, '/auth/main.php') + url.search;
        })
    });
</script>