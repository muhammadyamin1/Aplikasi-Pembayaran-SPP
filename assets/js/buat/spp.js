(function ($) {
	var t = $('#tabelspp').DataTable({
		"responsive": true,
		"autoWidth": false,
		"order": [
			[1, 'asc']
		],
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": [0, 3]
		}]
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
	$('#tambahspp').click(function () {
		console.log('tambahspp sukses di klik');
		window.location.href = 'addspp.php';
	});
	$('#kembalispp').click(function () {
		console.log('kembalispp sukses di klik');
		window.location.href = 'spp.php';
	})
})(jQuery);
