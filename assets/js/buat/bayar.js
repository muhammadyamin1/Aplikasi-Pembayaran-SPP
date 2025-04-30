(function ($) {
    var t = $('#tabelbayar').DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 25,
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0, 5]
        }],
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'print',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5]
                }
            }
        ]
    });
    t.on('order.dt search.dt', function () {
        t.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    $("#hide-alert").delay(6000).slideUp(500, function () {
        $("#hide-alert").slideUp(500);
    });

    //Tombol
    $('#tambahsiswa').click(function () {
        console.log('tambahsiswa sukses di klik');
        window.location.href = 'addsiswa.php';
    });
    $('#kembalisiswa').click(function () {
        console.log('kembalisiswa sukses di klik');
        window.location.href = 'siswa.php';
    })

    //Tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    jQuery(document).ready(function () {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });

    //preview image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#foto").change(function () {
        readURL(this);
    });
})(jQuery);
