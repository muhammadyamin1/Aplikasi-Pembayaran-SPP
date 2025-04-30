(function ($) {
	var t = $('#tabelpetugas').DataTable({
		"responsive": true,
		"autoWidth": false,
		"order": [
			[3, 'asc']
		],
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": [0, 1, 5]
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
	$('#tambahpetugas').click(function () {
		console.log('tambahpetugas sukses di klik');
		window.location.href = 'addpetugas.php';
	});
	$('#kembalipetugas').click(function () {
		console.log('kembalipetugas sukses di klik');
		window.location.href = 'petugas.php';
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
