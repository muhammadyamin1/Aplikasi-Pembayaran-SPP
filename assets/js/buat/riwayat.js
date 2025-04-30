(function ($) {
	var t = $('#tabelriwayat').DataTable({
		"responsive": true,
		"autoWidth": false,
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": [0]
		}],
		"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'print',
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6]
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
					columns: [1, 2, 3, 4, 5, 6]
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

	var ts = $('#tabelriwayatsiswa').DataTable({
		"responsive": true,
		"autoWidth": false,
		"language": {
			"emptyTable": "Siswa belum pernah melakukan transaksi pembayaran spp atau Nama siswa pada sesi ini tidak ada yang sesuai dengan database siswa"
		},
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": [0]
		}],
		"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'print',
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6]
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
					columns: [1, 2, 3, 4, 5, 6]
				}
			}
		]
	});
	ts.on('order.dt search.dt', function () {
		ts.column(0, {
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
	$('#tambahkelas').click(function () {
		console.log('tambahkelas sukses di klik');
		window.location.href = 'addkelas.php';
	});
	$('#kembalikelas').click(function () {
		console.log('kembalikelas sukses di klik');
		window.location.href = 'kelas.php';
	})

	jQuery(document).ready(function () {
		jQuery(".standardSelect").chosen({
			disable_search_threshold: 10,
			no_results_text: "Oops, nothing found!",
			width: "100%"
		});
	});
})(jQuery);
