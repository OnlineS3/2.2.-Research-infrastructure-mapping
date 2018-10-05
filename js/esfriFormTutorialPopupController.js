$(document).ready(function() {

	localStorage.clear();	//NA SVISTEI AUTI I GRAMMI GIA NA STAMATISEI NA VGAINEI KATHE FORA
    var isshow = localStorage.getItem('esfriFormShowTutorial');

    if (isshow== null) {
        localStorage.setItem('esfriFormShowTutorial', 1);


		swal.setDefaults({
			confirmButtonText: 'Next &rarr;',
			showCancelButton: true,
			animation: false,
			progressSteps: ['1', '2', '3']
		})

		var steps = [
			{
				title: 'Fill the fields',
				text: 'Please fill out all the fields in the following fields',
				imageUrl: 'images/documents.png',
				onOpen: function (){
					$('#contentmain').addClass('highlight');
				},
				onClose: function (){
					$('#contentmain').removeClass('highlight');
				}
			},
			{
				title: 'Required fields',
				text: 'Pay special attention to the required fields',
				imageUrl: 'images/exclamation_mark.png',
				onOpen: function (){
					$('#contentmain').addClass('highlight');
				},
				onClose: function (){
					$('#contentmain').removeClass('highlight');
				}
			},
			{
				title: 'Submit',
				text: 'After completion, press the submit button to finalize the the form',
				imageUrl: 'images/arrow.png',
				onOpen: function (){
					$('#contentmain').addClass('highlight');
				},
				onClose: function (){
					$('#contentmain').removeClass('highlight');
				}
			},
		]

		swal.queue(steps).then(function (result) {
			swal.resetDefaults()
			swal({
				title: 'All done!',
				html: 'You are ready to use our tool!',
				confirmButtonText: 'Go On!',
				showCancelButton: false
			})
		}, 
		function () {
			swal.resetDefaults()
		})

	}
});