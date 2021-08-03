<!-- [REQUIRE] Template JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/jquery.countup.js"></script>
<script src="assets/js/jquery.waypoints.min.js"></script>


<!-- disable body scroll which navbar is in active -->
<script>
	$(function () {
		$('.navbar-toggler').click(function () {
			$('body').toggleClass('noscroll')
		})
	})


 	// stats number counter
	$('.counter').countUp()


	// Menu Scroll Effect
	$(window).on('scroll', function () {
		var scroll = $(window).scrollTop();

		if (scroll >= 80) { $("#site-header").addClass("nav-fixed") }
		else { $("#site-header").removeClass("nav-fixed") }
	})


	//Main navigation Active Class Add Remove
	$(".navbar-toggler").on("click", function () {
		$("header").toggleClass("active")
	})


	// On Document Ready
	$(document).on("ready", function () {
		if ($(window).width() > 991) { $("header").removeClass("active") }
		
		$(window).on("resize", function () {
			if ($(window).width() > 991) { $("header").removeClass("active") }
		})
	})
</script>