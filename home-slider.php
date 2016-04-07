<?php 

$args = array(
  'post_type' => 'slider',
  'post_status' => 'publish',
  'p' => 75,
  #'p' => 6,
  'posts_per_page' => 5, 
);


$slides = array();
$slider_query = null;

$slider_query = get_posts( $args );

/*print( "slider_query:<br>" );
print_html_r($slider_query);*/


if(isset($slider_query)):


  if(count($slider_query)>0):    

    $slides_meta = get_post_meta( $slider_query[0]->ID, '_cmb_slide_options_slide', true );

    #print_html_r($slides_meta);

    #print_html_r( get_post_meta( $slider_query[0]->ID ) );

    $x = 0;

    $slides = array( );

    foreach( $slides_meta as $key => $entry ) :

      #print_html_r($entry);

      $slide_data = array();
      //if($entry['_cmb_slide_options_featured_slide']=='yes'):

        $slide_link="";
        $slide_heading="";
        $slide_desc="";
        $slide_image_src="";
        $slide_start_date_time="";
        $slide_end_date_time="";

        if(!empty($entry['_cmb_slide_options_heading'] ) ):
          $slide_data['slide_heading']=$entry['_cmb_slide_options_heading'];
        endif;


        $link = false;

        if( ! empty($entry['_cmb_slide_options_link_page'] ) ):
        
          $link = get_permalink( $entry['_cmb_slide_options_link_page'] );

          $params = array( );

          if ( ! empty ( $entry['_cmb_slide_options_url_params'] ) ) :

            $params = $entry['_cmb_slide_options_url_params'];

            if ( count ( array_filter ( $params ) ) != 0 ) :

              $link_with_params = $link ;

              foreach ( $params as $param ) :
                $arr = explode( "=", $param );
                if ( ! empty ( $arr[0] ) ) : $param_key = $arr[0]; endif; 
                if ( ! empty ( $arr[1] ) ) : $param_value = $arr[1]; endif;
                if ( ! empty ( $param_key ) &&  ! empty ( $param_value ) ) : 
                  $link_with_params = add_query_arg( $param_key, $param_value, $link_with_params );
                  $link = $link_with_params;            
                endif; 
              endforeach;

            endif;

          endif;

        endif;




        if( ! empty( $entry['_cmb_slide_options_ext_link'] ) ):

          $link = $entry['_cmb_slide_options_ext_link'];
          $slide_data['slide_link'] = $link;

        endif;



        if(!empty($entry['_cmb_slide_options_description'] ) ):
          $slide_data['slide_desc']=$entry['_cmb_slide_options_description'];
        endif;




        if(!empty($entry['_cmb_slide_options_image'] ) ):
          $tmp=wp_get_attachment_image_src( $entry['_cmb_slide_options_image_id'], 'display-slide-full-width' );
          $slide_data['slide_image_src']=$tmp[0];
        endif; 




        if(!empty($entry['_cmb_slide_options_start_date_time'] ) ):
          $slide_data['slide_start_date_time']=$entry['_cmb_slide_options_start_date_time'];
          $slide_data['slide_start_date_time_formatted']=date('jS F Y h:i:s A (T)', $entry['_cmb_slide_options_start_date_time'] );
       endif;




        if(!empty($entry['_cmb_slide_options_end_date_time'])):
          $slide_data['slide_end_date_time']=$entry['_cmb_slide_options_end_date_time'];
          $slide_data['slide_end_date_time_formatted']=date('jS F Y h:i:s A (T)', $entry['_cmb_slide_options_end_date_time'] );
        endif;


        if(empty($slide_data['slide_end_date_time'])):

          $slides[$x]=$slide_data;
          $x++;

        else:

          if($slide_data['slide_end_date_time']>time()):
            $slides[$x]=$slide_data;
            $x++;
          endif;

        endif;

      //endif;

      #print_html_r($slide_data);

    endforeach; 

    #$context = array();
    #$context['slides']=$slides;

/**/
    
  endif;

endif;


return $slides;

?>