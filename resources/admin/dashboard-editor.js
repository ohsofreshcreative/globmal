/* Edytor "Dashboard operacyjny" – 3 listy z przeciąganiem pozycji */
jQuery(function ($) {
	var $root = $('#gm-dash');
	if (!$root.length) return;

	var $data = $('#gm-dash-data');
	var LABELS = { magazyn: '→ Magazyn', produkcja: '→ Produkcja', transport: '→ Transport' };

	var DEFAULTS = {
		section: 'produkcja',
		order_no: '',
		product: '',
		qty: '',
		stock_status: 'dostepne',
		production_status: 'produkcja',
		progress: 0,
		carrier: '',
		date: ''
	};

	function options(map) {
		return $.map(map, function (label, value) {
			return '<option value="' + value + '">' + label + '</option>';
		}).join('');
	}

	var TEMPLATE =
		'<li class="gm-dash-row">' +
			'<span class="gm-dash-handle dashicons dashicons-menu" title="Przeciągnij"></span>' +
			'<input type="text" data-f="order_no" placeholder="np. ZZ/0584/2026">' +
			'<input type="text" data-f="product" placeholder="Produkt / nazwa">' +
			'<input type="number" data-f="qty" min="0" placeholder="0">' +
			'<select class="only-magazyn" data-f="stock_status">' +
				options({ dostepne: 'Dostępne', zarezerwowane: 'Zarezerwowane', niedostepne: 'Niedostępne' }) +
			'</select>' +
			'<select class="only-produkcja" data-f="production_status">' +
				options({ produkcja: 'Produkcja', opoznione: 'Opóźnione', gotowe: 'Gotowe' }) +
			'</select>' +
			'<span class="only-produkcja gm-dash-progress">' +
				'<input type="range" data-f="progress" min="0" max="100" step="5"><output></output>' +
			'</span>' +
			'<input type="text" class="only-transport" data-f="carrier" placeholder="np. Pociąg, TIR">' +
			'<input type="date" class="not-magazyn" data-f="date">' +
			'<span class="gm-dash-move">' +
				$.map(LABELS, function (label, key) {
					return '<button type="button" class="button" data-to="' + key + '">' + label + '</button>';
				}).join('') +
			'</span>' +
			'<button type="button" class="gm-dash-delete" title="Usuń pozycję"><span class="dashicons dashicons-trash"></span></button>' +
		'</li>';

	function buildRow(item) {
		item = $.extend({}, DEFAULTS, item);
		var $row = $(TEMPLATE);
		$row.find('[data-f]').each(function () {
			var f = $(this).data('f');
			$(this).val(item[f] === undefined ? '' : item[f]);
		});
		syncProgress($row);
		return $row;
	}

	function syncProgress($row) {
		$row.find('.gm-dash-progress output').text($row.find('[data-f="progress"]').val() + '%');
	}

	function updateCounts() {
		$root.find('.gm-dash-list').each(function () {
			$(this).closest('.gm-dash-section').find('.gm-dash-count').text($(this).children('.gm-dash-row').length);
		});
	}

	function flash($row) {
		$row.addClass('is-new');
		setTimeout(function () { $row.removeClass('is-new'); }, 1200);
	}

	function serialize() {
		var items = [];
		$root.find('.gm-dash-list').each(function () {
			var section = $(this).data('section');
			$(this).children('.gm-dash-row').each(function () {
				var item = { section: section };
				$(this).find('[data-f]').each(function () {
					item[$(this).data('f')] = $(this).val();
				});
				items.push(item);
			});
		});
		$data.val(JSON.stringify(items));
	}

	// Wczytanie danych
	var items = [];
	try { items = JSON.parse($data.val() || '[]') || []; } catch (e) { items = []; }
	$.each(items, function (_, item) {
		var $list = $root.find('.gm-dash-list[data-section="' + item.section + '"]');
		if (!$list.length) $list = $root.find('.gm-dash-list[data-section="produkcja"]');
		$list.append(buildRow(item));
	});
	updateCounts();

	// Przeciąganie między listami
	$root.find('.gm-dash-list').sortable({
		connectWith: '#gm-dash .gm-dash-list',
		handle: '.gm-dash-handle',
		items: '> .gm-dash-row',
		placeholder: 'gm-dash-placeholder',
		tolerance: 'pointer',
		cursor: 'grabbing',
		over: function () { $(this).addClass('is-drop-target'); },
		out: function () { $(this).removeClass('is-drop-target'); },
		stop: function (e, ui) {
			$root.find('.gm-dash-list').removeClass('is-drop-target');
			flash(ui.item);
			updateCounts();
		}
	});

	// Dodaj pozycję
	$root.on('click', '.gm-dash-add', function () {
		var section = $(this).data('section');
		var $row = buildRow({ section: section });
		$root.find('.gm-dash-list[data-section="' + section + '"]').append($row);
		flash($row);
		updateCounts();
		$row.find('[data-f="order_no"]').trigger('focus');
	});

	// Przenieś przyciskiem
	$root.on('click', '.gm-dash-move .button', function () {
		var $row = $(this).closest('.gm-dash-row');
		var $target = $root.find('.gm-dash-list[data-section="' + $(this).data('to') + '"]');
		$row.appendTo($target);
		flash($row);
		updateCounts();
	});

	// Usuń
	$root.on('click', '.gm-dash-delete', function () {
		var $row = $(this).closest('.gm-dash-row');
		var name = $row.find('[data-f="product"]').val() || 'tę pozycję';
		if (window.confirm('Usunąć „' + name + '”?')) {
			$row.remove();
			updateCounts();
		}
	});

	$root.on('input change', '[data-f="progress"]', function () {
		syncProgress($(this).closest('.gm-dash-row'));
	});

	// Enter w polu nie wysyła formularza
	$root.on('keydown', 'input', function (e) {
		if (e.key === 'Enter') e.preventDefault();
	});

	// Zapis
	$('#post').on('submit', serialize);
});
