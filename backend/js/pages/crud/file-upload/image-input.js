'use strict';

// Class definition
var ImageInput = function () {
	// Private functions
	var init = function () {

		var photo = new KTImageInput('kt_image_4');

		photo.on('cancel', function(imageInput) {
			swal.fire({
                title: 'Chargement annulé avec succès !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Ok',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
		});

		photo.on('change', function(imageInput) {
			swal.fire({
                title: 'Photo modifiée avec succès !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Ok',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
		});

		photo.on('remove', function(imageInput) {
			swal.fire({
                title: 'Photo supprimée avec succès !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Ok',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
		});
	}

	return {
		// public functions
		init: function() {
			init();
		}
	};
}();

KTUtil.ready(function() {
	ImageInput.init();
});
