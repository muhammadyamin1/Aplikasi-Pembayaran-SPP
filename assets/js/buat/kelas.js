(function ($) {
	var t = $('#tabelkelas').DataTable({
		"responsive": true,
		"autoWidth": false,
		"order": [
			[2, 'asc']
		],
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": [0, 4]
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
	$('#tambahkelas').click(function () {
		console.log('tambahkelas sukses di klik');
		window.location.href = 'addkelas.php';
	});
	$('#kembalikelas').click(function () {
		console.log('kembalikelas sukses di klik');
		window.location.href = 'kelas.php';
	})

	jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
})(jQuery);
