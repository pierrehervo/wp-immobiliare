<?php get_header(); 
the_post(); // équivalent à la requête SQL qui récupére les infos de l'article
?>

    <h1 class="text-center my-5"><?php the_title(); ?></h1>

    <?php 
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        $image_url = $large_image_url[0] ?? null;
        
    ?>
    <div class="article-image" style="background-image: url(<?php echo $image_url?>)"></div>

    <div>
        <?php the_content(); ?>
    </div>

<?php get_footer(); ?>