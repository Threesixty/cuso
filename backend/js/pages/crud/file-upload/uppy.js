"use strict";

// Class definition
var KTUppy = function () {
	const Tus = Uppy.Tus;
	const XHRUpload = Uppy.XHRUpload;
	const ProgressBar = Uppy.ProgressBar;
	const StatusBar = Uppy.StatusBar;
	const FileInput = Uppy.FileInput;
	const Informer = Uppy.Informer;

	// to get uppy companions working, please refer to the official documentation here: https://uppy.io/docs/companion/
	const Dashboard = Uppy.Dashboard;


	var initUppy2 = function(){

		if ($('#kt_uppy_2').length) {
			var id = '#kt_uppy_2';

			var options = {
				proudlyDisplayPoweredByUppy: false,
				target: id,
				inline: true,
				replaceTargetContent: true,
				showProgressDetails: true,
				note: 'Images et vidéos uniquement, maximum de 5MB',
				height: 470,
				browserBackButtonClose: true
			}

			var uppyDashboard = Uppy.Core({
				autoProceed: true,
				locale: Uppy.locales.fr_FR,
				restrictions: {
					//maxFileSize: 1000000, // 1mb
					//maxNumberOfFiles: 5,
					minNumberOfFiles: 1,
					allowedFileTypes: ['image/*', 'video/*']
				},
			});

			uppyDashboard.use(Dashboard, options);
			uppyDashboard.use(XHRUpload, {
				endpoint: $('#kt_uppy_2').data('upload-url'),
				formData: true,
  				fieldName: 'file'
			});

			uppyDashboard.on('complete', result => {
				console.log('successful files:', result.successful)
				console.log('failed files:', result.failed)
				for (var i=0; i<result.successful.length; i++) {
					console.log(result.successful[i].response.body);

                	var newImage = $('.block-image').clone().prependTo('.medias-evenodd').removeClass('block-image');
				}
			});
		}
	}

	return {
		// public functions
		init: function() {
			initUppy2();
		}
	};
}();

KTUtil.ready(function() {
	KTUppy.init();
});
