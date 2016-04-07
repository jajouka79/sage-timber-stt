<?php
$context = Timber::get_context();
//$context['simon'] = get_post_meta( $context['post']->ID );
#$post = $post . array('simon'=>"beezlee");
$context['post'] = new TimberPost();
$context['news_category'] = Timber::get_terms('news_category');


/*foreach($context as $c):
echo "<pre>";
print_r($c);
echo "</pre>";
endforeach;*/


echo "<br>";
echo "<br>";
echo "<br>";

echo "<pre>";
#print_r($context);
echo "</pre>";

Timber::render('templates/single.twig', $context);