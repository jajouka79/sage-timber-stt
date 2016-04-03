home.php<?php

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
// echo "test2";


#curl https://uk.patronbase.com/_LeicesterYMCA/API/v1/Productions/Feed \-H "X-PatronBase-Api-Key:ba28aed6329c27827b63b3043419752f45f2f438"


// set post fields
$post = [
    'X-PatronBase-Api-Key' => 'ba28aed6329c27827b63b3043419752f45f2f438',
];

$ch = curl_init('https://uk.patronbase.com/_LeicesterYMCA/API/v1/Productions/Feed');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$response = curl_exec($ch);
curl_close($ch);
var_dump($response);



Timber::render('templates/home.twig', $context);