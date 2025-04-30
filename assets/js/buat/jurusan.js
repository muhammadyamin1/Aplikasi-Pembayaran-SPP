(function ($) {
	var t = $('#tabeljurusan').DataTable({
		"responsive": true,
		"autoWidth": false,
		"order": [
			[2, 'asc']
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
	$('#tambahjur').click(function () {
		console.log('tambahjur sukses di klik');
		window.location.href = 'addjurusan.php';
	});
	$('#kembalijur').click(function () {
		console.log('kembalijur sukses di klik');
		window.location.href = 'jurusan.php';
	})
})(jQuery);
