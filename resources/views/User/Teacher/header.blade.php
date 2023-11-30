<style>
    /* ... Your existing styles ... */

    /* Keep the header fixed at the top when scrolling */
    .fixed-header {
        position: fixed;
        width: 100%;
        top: 0;
        background-color: #ffffff; /* Background color for the fixed header */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Add a box shadow for a subtle effect */
        z-index: 1000;
    }
    #header-row {

    /* border-bottom: 1px solid #eee; */
    /* Adjust margin-top for the container to avoid overlapping with the fixed header */
    }
    img {
    width: 50%;

    }
    #header-row {

     padding: 0;
    }
</style>

<div id="header-row" class="fixed-header">
		<div class="container">
			<div class="row">
				<!--LOGO-->
				<div class="span3">
                <a class="brand" href="{{ url('/') }}"><img src="{{ asset('resources/file/images/logotest.png') }}" /></a>				</div>
				<!-- /LOGO -->
				<!-- MAIN NAVIGATION -->
                @include("User.Teacher.navbar")
				<!-- MAIN NAVIGATION -->
			</div>
		</div>
</div>
