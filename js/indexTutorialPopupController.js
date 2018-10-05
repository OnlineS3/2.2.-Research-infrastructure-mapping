$(document).ready(function() {

	// localStorage.clear();	//NA SVISTEI AUTI I GRAMMI GIA NA STAMATISEI NA VGAINEI KATHE FORA
    var isshow = localStorage.getItem('isshow');

    if (isshow== null) {
        localStorage.setItem('isshow', 1);


		swal.setDefaults({
			confirmButtonText: 'Next &rarr;',
			showCancelButton: true,
			animation: false,
			progressSteps: ['1', '2', '3','4']
		})

		var steps = [
			{
				title: 'Click on markers',
				text: 'Click on a map marker to see more information for every infrastructure',
				imageUrl: 'images/marker.png',
			},
			{
				title: 'ESFRI Type',
				text: 'You can choose the type of ESFRI you prefer to explore by navigating using the bar above',
				imageUrl: 'images/marker.png',
				onOpen: function (){
					$('#mainnav ul').addClass('highlight');
				},
				onClose: function (){
					$('#mainnav ul').removeClass('highlight');
				}
			},
			{
				title: 'Filtering',
				text: 'You can filter the RIs you prefer to be displayed by using the filtering bar on the right',
				imageUrl: 'images/filter.jpg',
				onOpen: function (){
					$('.r-menu').addClass('highlight');
				},
				onClose: function (){
					$('.r-menu').removeClass('highlight');
				}
			},
						{
				title: 'Export to PDF',
				text: "You can export the filtered RIs by clicking the 'Filter' button on the right",
				imageUrl: 'images/export.png',
				onOpen: function (){
					$('.r-menu').addClass('highlight');
				},
				onClose: function (){
					$('.r-menu').removeClass('highlight');
				}
			}
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