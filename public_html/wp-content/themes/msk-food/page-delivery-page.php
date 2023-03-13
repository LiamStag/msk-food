<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * template name: Доставка 
 * @package msk-food
 */

get_header();
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">

		
	<main id="primary" class="site-main">

<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	// if ( comments_open() || get_comments_number() ) :
	// 	comments_template();
	// endif;

endwhile; // End of the loop.
?>

</main><!-- #main -->
</div>
	</div>
</div>

	<div id="map"></div>
   
    <script>
      var map;
      var src = '';

      function initMap() {
       const map = new google.maps.Map(document.getElementById('map'), {
         
		  center: { lat: 55.75733336212132, lng: 37.61341589528507 },
         
		  mapTypeId: "terrain",
		 
  zoom: 19,
		  
        });
		
        const ctaLayer = new google.maps.KmlLayer({
		url: "https://msk-food.ru/z80.kml",
	
		map: map,
        });
		
        ctaLayer.addListener('click', function(event) {
          var content = event.featureData.infoWindowHtml;
        
        });
      }
    </script>
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkrqVuBuZMLY6jIGPTdTuNs5sF2P0GGcc&zoom=19&callback=initMap">
    </script>




    <?php

    get_footer();
