function sidebarLeft() {

	// Tablet to Computer
	if ($(window).width() > 768) {

		// Toggle onClick
		$('#sidebar-toggle').click(function () {

			// Javascript Local Var
			if (localStorage.getItem("navbar_toggle") === "") {
			    localStorage.setItem("navbar_toggle", "sidebar-small");
			}else{
			    localStorage.setItem("navbar_toggle", "");
			}

		  // Transition Main Content
			$('#main').css('transition','0.3s linear');

			// Check and Change
			if ($('#sidebar-left').hasClass('sidebar-small')) {
				$('#sidebar-left').removeClass('sidebar-small fadeInLeft').addClass('flipInY');
				$('#sidebar-toggle > i').removeClass('fa-list-ul').addClass('fa-ellipsis-v');
				var sidebarWidth = $('#sidebar-left').width();
				$('#main').css('padding-left',sidebarWidth+25 +'px');
			}else if ($('#sidebar-left').hasClass('sidebar-mobile')){
				$('#sidebar-left').css('transition','0.3s linear');
			}else{
				$('#sidebar-left').removeClass('flipInY').addClass('sidebar-small fadeInLeft');
				$('#sidebar-toggle > i').removeClass('fa-ellipsis-v').addClass('fa-list-ul');
				var sidebarWidth = $('#sidebar-left').width();
				$('#main').css('padding-left',sidebarWidth+20 +'px');
			}
		});

		// Get Side Bar Width
		var sidebarWidth = $('#sidebar-left').width();
		// Padding Main Content
		$('#main').css('padding-left',sidebarWidth+20 +'px');
		
		setTimeout(function(){
			$('#sidebar-close').addClass('sr-only');
			$('#sidebar-left').removeClass('sidebar-mobile');
			$('#sidebar-left').css('margin-left','0px');
		},400);


		// Show breadcrumb When Tablet and PC
		$('.breadcrumb').css('display','block');
	}

	// Mobile Screen
	if ($(window).width() <= 768) {

		// Toggle Onclick
		$('#sidebar-toggle').click(function () {
			$('#sidebar-left').css('margin-left','0px');
		});

		// Show Button Close Sidebar
		$('#sidebar-close').removeClass('sr-only');
		$('#sidebar-left').removeClass('sidebar-small').addClass('sidebar-mobile');
		
		$('#sidebar-left').css('transition','0.3s linear');

		setTimeout(function(){
			var sidebarWidth = $('#sidebar-left').width();
			$('#sidebar-left').css('margin-left',-sidebarWidth-15 +'px');
			$('#main').css('padding-left','15px');
		},400);

		// Close Button onClick
		$('#sidebar-close').click(function () {
			var sidebarWidth = $('#sidebar-left').width();
			$('#sidebar-left').css('margin-left',-sidebarWidth-15 +'px');
			console.log(sidebarWidth);
		});

		// Hide breadcrumb When Mobil
		$('.breadcrumb').css('display','none');
	}

}

setTimeout(function(){$( window ).resize(sidebarLeft);},400);

$( document ).ready(function () {

	$('.sidebar-sticky').perfectScrollbar();
	$('#dataTable').DataTable( {
        "language": {
			    "decimal":        "",
			    "emptyTable":     "ពុំមានទិន្នន័យឡើយ",
			    "info":           "បង្ហាញ _START_ ដល់ _END_ នៃ _TOTAL_ ជួរ",
			    "infoEmpty":      "បង្ហាញ 0 ដល់ 0 នៃ 0 ជួរ",
			    "infoFiltered":   "(filtered ពី _MAX_ សរុប ជួរ)",
			    "infoPostFix":    "",
			    "thousands":      ",",
			    "lengthMenu":     "បង្ហាញ _MENU_ ជួរ",
			    "loadingRecords": "កំពុងដំណើរការ...",
			    "processing":     "កំពុងដំណើរការ...",
			    "search":         "ស្វែងរក:",
			    "zeroRecords":    "ពុំមានទិន្នន័យឡើយ",
			    "paginate": {
			        "first":      "ដំបូង",
			        "last":       "ចុងក្រោយ",
			        "next":       "បន្ទាប់",
			        "previous":   "ថយ"
			        }
      	}
    });
	$('.select2').select2({
			theme: 'bootstrap',
	});

	if (localStorage.getItem("navbar_toggle") === "") {
		$('#sidebar-left').addClass('sidebar-small fadeInLeft');
		$('#sidebar-toggle > i').removeClass('fa-ellipsis-v').addClass('fa-list-ul');
	}else{
		$('#sidebar-left').removeClass('sidebar-small');
		$('#sidebar-toggle > i').removeClass('fa-list-ul').addClass('fa-ellipsis-v');
	}
});


	// Alert Fucntion
	function alertYesNo() {
		var text = $(this).data('text');
		var type = $(this).data('type');
		var rstitle = $(this).data('rstitle');
		var rstext = $(this).data('rstext');
		swal({
		  title: 'តើអ្នកប្រាកដ ឬទេ?',
		  text: text,
		  type: type,
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'យល់ព្រម',
	    cancelButtonText: 'បោះបង'
		}).then((result) => {
		  if (result.value) {
			  let timerInterval
				swal({
		      title: rstitle,
		      text: rstext,
		      type: "success",
		      showConfirmButton: false,
				  timer: 800,
				  onOpen: () => {
				    timerInterval = setInterval(() => {
				    }, 100)
				  },
				  onClose: () => {
				    clearInterval(timerInterval)
				  }
				}).then((result) => {
				  if (
				    result.dismiss === swal.DismissReason.timer
				  ) {
				  	$(this).next().click();
				  }
				})
			}
		})
	}
$( document ).ready(sidebarLeft);


function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
    return this.flatten().reduce( function ( a, b ) {
        if ( typeof a === 'string' ) {
            a = a.replace(/[^\d.-]/g, '') * 1;
        }
        if ( typeof b === 'string' ) {
            b = b.replace(/[^\d.-]/g, '') * 1;
        }
 
        return a + b;
    }, 0 );
} );