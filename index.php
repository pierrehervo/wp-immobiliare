<?php
//Equivalent d'un include 'header.php'
get_header (); ?>

<div class="container">
            <h1>Bienvenue sur le site <?php bloginfo('name'); ?></h1>
            <p><?php bloginfo('description'); ?></p>

<?php
//On inclue le footer
get_footer();