
$('#sidebar-toggle').click(function () {
	$('#main').css('transition','0.3s linear');
	if (localStorage.getItem("navbar_toggle") == "") {
    localStorage.setItem("navbar_toggle", "sidebar-small");
		$('#sidebar-left').addClass('sidebar-small');
  }else{
    localStorage.setItem("navbar_toggle", "");
		$('#sidebar-left').removeClass('sidebar-small');
  }

});


function sidebarLeft() {

	if ($(window).width() > 768) {
		var sidebarWidth = $('#sidebar-left').width();
		$('#main').css('padding-left',sidebarWidth+30 +'px');
		setTimeout(function(){
			$('#sidebar-close').addClass('sr-only');
			$('#sidebar-left').removeClass('sidebar-mobile');
			var sidebarWidth = $('#sidebar-left').width();
			$('#main').css('padding-left',sidebarWidth+30 +'px');
			$('#sidebar-left').css('margin-left','0px');
		},400);

		$('#sidebar-toggle').click(function () {
			if ($('#sidebar-left').hasClass('sidebar-small')) {
				$('#sidebar-left').removeClass('sidebar-small fadeInLeft').addClass('flipInY');
				var sidebarWidth = $('#sidebar-left').width();
				$('#main').css('padding-left',sidebarWidth+30 +'px');
			}else if ($('#sidebar-left').hasClass('sidebar-mobile')){

			}else{
				$('#sidebar-left').removeClass('flipInY').addClass('sidebar-small fadeInLeft');
				var sidebarWidth = $('#sidebar-left').width();
				$('#main').css('padding-left',sidebarWidth+25 +'px');
			}
		});
		$('.breadcrumb').css('display','block');

	}

	if ($(window).width() <= 768) {
		$('#sidebar-close').removeClass('sr-only');
		$('#sidebar-left').removeClass('sidebar-small').addClass('sidebar-mobile');
		setTimeout(function(){
			var sidebarWidth = $('#sidebar-left').width();
			$('#sidebar-left').css('margin-left',-sidebarWidth-15 +'px');
			$('#main').css('padding-left','15px');
		},400);

		$('#sidebar-close').click(function () {
			var sidebarWidth = $('#sidebar-left').width();
			$('#sidebar-left').css('margin-left',-sidebarWidth-15 +'px');
			console.log(sidebarWidth);
		});

		$('#sidebar-toggle').click(function () {
			$('#sidebar-left').css('margin-left','0px');
		});
		$('.breadcrumb').css('display','none');
	}

}

$( document ).ready(sidebarLeft);
setTimeout(function(){$( window ).resize(sidebarLeft);},400);

$('.sidebar-sticky').perfectScrollbar();
$('#dataTable').DataTable();

if (localStorage.getItem("navbar_toggle") === "") {
	$('#sidebar-left').addClass('sidebar-small');
}else{
	$('#sidebar-left').removeClass('sidebar-small');
}

// Alert Delete
$("button.delete").click(function() {
	swal({
	  title: 'Are you sure?',
	  text: "You won't be able to revert this!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	  if (result.value) {
		  let timerInterval
			swal({
	      title: "Deleted!",
	      text: "Item has been deleted.",
	      type: "success",
	      showConfirmButton: false,
			  timer: 800,
			  onOpen: () => {
			    timerInterval = setInterval(() => {
			      // swal.getContent().querySelector('strong').textContent = swal.getTimerLeft()
			    }, 100)
			  },
			  onClose: () => {
			    clearInterval(timerInterval)
			  }
			}).then((result) => {
			  if (
			    // Read more about handling dismissals
			    result.dismiss === swal.DismissReason.timer
			  ) {
			    // console.log('I was closed by the timer')
			  	$(this).next().click();
			  }
			})
		}
	})
});


