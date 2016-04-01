<?php

$context = Timber::get_context();

$slides = include ('home-slider.php');

$context['slides']=$slides;

$args = array(
  'post_type' => 'page',
  'post_status' => 'publish',
  'p' => 123,
  'posts_per_page' => 1, 
);

$query = get_posts( $args );

if( ! empty ( $query ) ) :
	$context['page'] = $query[0];
endif;

// echo "test";
echo "test2";

Timber::render('templates/home.twig', $context);