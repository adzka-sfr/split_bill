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

    // function to copy trip id to clipboard
    function copyToClipboard(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(function() {
                Swal.fire({
                    toast: true,
                    position: 'top',
                    icon: 'success',
                    title: 'Copied to clipboard!',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        } else {
            // fallback for older browsers
            var tempInput = document.createElement('input');
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Copied to clipboard!',
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
</script>