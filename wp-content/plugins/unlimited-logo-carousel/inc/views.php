<?php
if(	!function_exists('ed_logo_carousel_enqueue')	){
	add_action('wp_enqueue_scripts', 'ed_logo_carousel_enqueue',999);
	function ed_logo_carousel_enqueue() {
		if (!is_admin()) { 
			wp_enqueue_style( 'ed-owl.carousel', ED_LOGO_URL . 'assets/owl.carousel.css' );
			wp_enqueue_style( 'ed-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' );
		
			wp_enqueue_script('ed-owl.carousel-js', ED_LOGO_URL . 'assets/owl.carousel.js' , array('jquery'), '1.3.3', true);
			
		}
	}
}

if(	!function_exists('ed_logo_carousel_views')	){
	function ed_logo_carousel_views( $atts ) {
		
		$data = shortcode_atts( array(
        'id' =>0,
   		 ), $atts );
		$output = ''; 
		
		if( isset($data['id']) && $data['id'] !="" && $data['id'] > 0):
		
		$postlist = get_post( $data['id'] );
		$ed_logo_id = get_post_meta($data['id'],'ed_logo_id', true);
		
			if( count($postlist) > 0 ):
			  $options = maybe_unserialize(get_post_meta($data['id'], 'ed_logo_carousel_slider', true));
			  $output .= '<div class="ed-carousel-wrp ed-carousel-'.$data['id'].'">';
			  $output .= '<div id="ed-carousel-'.$data['id'].'" class="owl-carousel ed-carousel center">';
				
				$ed_logo_id = maybe_unserialize(get_post_meta($data['id'],'ed_logo_id', true));
				$tooltip = maybe_unserialize( get_post_meta($data['id'], 'ed_logo_tooltip', true));
				$link = maybe_unserialize( get_post_meta($data['id'], 'ed_logo_link', true) );
				$target = maybe_unserialize( get_post_meta($data['id'], 'ed_logo_target', true));
				
				
				foreach ($ed_logo_id as $key => $thumbnail_id) {
					$logo = wp_get_attachment_image_src( $thumbnail_id, 'full' );
					if(isset($logo) && $logo != "" ){
						$tool_class = ( isset($tooltip[$key]) && $tooltip[$key] != "" )? 'masterTooltip':'';
						$tool_text = ( isset($tooltip[$key]) && $tooltip[$key] != "" )? $tooltip[$key]:'';
						
						
							$img = '<img src="'.$logo[0].'" alt="'.esc_html($tool_text).'" class="masterTooltip" title="'.esc_html($tool_text).'">';
						
						
						if($link[$key] != ""){
							$output .= '<a href="'.esc_url( $link[$key] ).'" target="'.$target[$key].'" rel="nofollow" class="ed-item">'.$img.'</a>';
						}else{
							$output .= '<div class="ed-item">'.$img.'</div>';
						}
					}
				}
					
			$output .='</div>';
			$output .='</div>';
			
			else:
			
			$output .= '<h2 class="sp-not-found-any-logo">' . __( 'No logo found', 'logo_carousel' ) . '</h2>';
			
			endif;	  
		else:
		
		$output .= '<h2 class="sp-not-found-any-logo">' . __( 'No logo found', 'logo_carousel' ) . '</h2>';	 
		 
		endif;	  
		return $output;
	}
	add_shortcode( 'ed-logo', 'ed_logo_carousel_views' );	
}






function ed_logo_carousel_js(){
?>
<script type="text/javascript">
jQuery(document).ready(function($) {     
	$(".owl-carousel.ed-carousel").owlCarousel({
			autoPlay : 4000,
			slideSpeed : 800,
			stopOnHover : true,
			navigation : true,
			pagination : true,
			mouseDrag : true,
			lazyLoad : false,
			items : 5,
			itemsDesktopSmall : [979, 4],
			itemsTablet : [768, 3],
			itemsMobile : [479, 2],
       
      });
});
</script>
<?php
	
}
add_action('wp_footer','ed_logo_carousel_js',999);