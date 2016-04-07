<?php

use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\CMB\Meta\PostMeta as PostMeta;

$context = Timber::get_context( );

$q = $wp_query->query;
$pt = $q['post_type'];

Common::write_log( "getMetaPrefix" );
Common::write_log( PostMeta::getMetaPrefix( "var!!" ) );


Common::write_log( PostMeta::getPosMetaConfigByPt( "promoter" ) );


$prefix = "";

echo "**********************" . $pt . "------------------";

if( $pt == "gig" ) :

	$context['title'] = "Gigs";
	Timber::render( 'templates/archive-gig.twig', $context );

	#$Globals

	/*
	_cmb_gig_options_venue_web_address
	_cmb_gig_options_tickets_link
	_cmb_gig_options_start_date
	_cmb_gig_options_time
	_cmb_gig_options_price
	_cmb_gig_options_venue
	*/



elseif( $pt == "video" ) :

	if( have_posts( ) ) : 
		while( have_posts( ) ) : the_post( );

			#print_r($post);

			$v = array( 
				'title' => get_the_title( ),
				'code' => get_post_meta( $post->ID, '_cmb_video_options_youtube_code', true ),
				'date' => $post->post_date,
			);

			$videos[] = $v;			
		endwhile;	
	endif;

	/*print ("<pre>");
	print_r($videos);
	print ("</pre>");*/

	$context['videos'] = $videos;

	Timber::render('templates/archive-video.twig', $context);

elseif( $pt == "blog" ) :

	$context['title'] = "Blog";

	Timber::render('templates/archive-blog.twig', $context);

else :

	Timber::render('templates/archive.twig', $context);

endif;