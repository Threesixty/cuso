 $(document).ready(function(){

 	$.datepicker.regional['fr'] = {
 		clearText: 'Effacer', 
 		clearStatus: '',
	    closeText: 'Fermer', 
	    closeStatus: 'Fermer sans modifier',
	    prevText: '<Préc', 
	    prevStatus: 'Voir le mois précédent',
	    nextText: 'Suiv>', 
	    nextStatus: 'Voir le mois suivant',
	    currentText: 'Courant', 
	    currentStatus: 'Voir le mois courant',
	    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
	    monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'],
	    monthStatus: 'Voir un autre mois', 
	    yearStatus: 'Voir un autre année',
	    weekHeader: 'Sm', 
	    weekStatus: '',
	    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
	    dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
	    dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
	    dayStatus: 'Utiliser DD comme premier jour de la semaine', 
	    dateStatus: 'Choisir le DD, MM d',
	    dateFormat: 'dd/mm/yy', 
	    firstDay: 0, 
	    initStatus: 'Choisir la date', 
	    isRTL: false
	};

	function toggleDatepicker() {

		var currentLang = $('body').data('lang') != undefined && $('body').data('lang') != '' ?  $('body').data('lang') : 'fr';
 		$.datepicker.setDefaults($.datepicker.regional[currentLang]);
			
		$('#datepicker-from, #datepicker-from-bn, #datepicker-from-page').datepicker('destroy');
		$('#datepicker-to, #datepicker-to-bn, #datepicker-to-page').datepicker('destroy');
		
		var dateFormat = 'dd/mm/yy';
		var selectedFromDate = undefined;

		from = $('#datepicker-from, #datepicker-from-bn, #datepicker-from-page').datepicker({
			dateFormat: dateFormat,
			defaultDate: '+1w',
			changeMonth: true,
			numberOfMonths: $(window).outerWidth() > 812 ? 2 : 1,
		}).on('change', function() {
			selectedFromDate = getDate(this);
			to.datepicker('option', 'minDate', selectedFromDate);
			to.datepicker('option', 'beforeShowDay', function(d) {
				return [true, d.getTime() == selectedFromDate.getTime() ? 'from' : ''];
			});
		});

		to = $('#datepicker-to, #datepicker-to-bn, #datepicker-to-page').datepicker({
			dateFormat: dateFormat,
			defaultDate: '+1w',
			changeMonth: true,
			numberOfMonths: $(window).outerWidth() > 812 ? 2 : 1,
		}).on('change', function() {
			var selectedToDate = getDate(this);
			//from.datepicker('option', 'maxDate', selectedToDate);
			from.datepicker('option', 'beforeShowDay', function(d) {
				var toTime = d.getTime();
				var selectedTime = selectedToDate.getTime();

				if (selectedFromDate != undefined) {
					if (selectedFromDate.getTime() == toTime)
						return [true, 'from'];
					if (selectedFromDate.getTime() <= toTime && selectedTime > toTime)
						return [true, 'range'];
					if (selectedTime == toTime)
						return [true, 'to'];
				} 
				return [true, ''];
			});
			to.datepicker('option', 'beforeShowDay', function(d) {
				var toTime = d.getTime();
				var selectedTime = selectedToDate.getTime();

				if (selectedFromDate != undefined) {
					if (selectedFromDate.getTime() == toTime)
						return [true, 'from'];
					if (selectedFromDate.getTime() <= toTime && selectedTime > toTime)
						return [true, 'range'];
					if (selectedTime == toTime)
						return [true, 'to'];
				} 
				return [true, ''];
			});
		});

		function getDate( element ) {
			var date;
			try {
				date = $.datepicker.parseDate( dateFormat, element.value );
			} catch( error ) {
				date = null;
			}

			return date;
		}
	}
	
	toggleDatepicker();
	
	$(window).resize(function(){
		toggleDatepicker();
	})
 })