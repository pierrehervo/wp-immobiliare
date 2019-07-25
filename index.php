<?php
// Equivalent d'un include 'header.php'

//Traitement du formulaire 
if (POST === $_SERVER['REQUEST_METHOD']){

    $housing_id = $_POST['housing_id'];
    $reference = $_POST['reference'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $message = $_POST['message'];

    $errors = [];

    if (strlen($lastname) == 0){
        $errors['lastname'] = "le nom n'est pas valide";
    }
    if (strlen($firstname) == 0){
        $errors['firstname'] = "le prenom n'est pas valide";
    }
    if (strlen($message) <10){
        $errors['message'] = "le message n'est pas valide (trop court)";
    }
    if (empty($errors)){
        $success= 'Votre demande à bien été envoyée';
        //Requete SQL pour insérerr la demande de contact
        global $wpsb;
        //Prefixe de la base: $wpdb->prefix = gruik4
        $wpdb->insert($wpdb->prefix.'contact',[
            'reference'=> $reference,
            'housing_id'=> $housing_id,
            'lastname'=> $lastname,
            'firstname'=> $firstname,
            'message'=> $message
        ]);
        
    }
}


get_header(); ?>
        <div class="container">
            <h1 class ="text-center my-4  v">Bienvenue sur le site <?php bloginfo('name'); ?></h1>
            <p><?php bloginfo('description'); ?></p>

            <?php var_dump($errors ?? null); var_dump($success ?? null); 
                if (!empty ($errors)) {?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $field =>$error){
                        echo $field . ':' . $error . '<br />';
                    }?> 
                </div>
            <?php } ?>

            <?php if (isset($success)) {
                echo '<div class="alert alert-success">' .$success.'</div>';
            } ?>

        <div class="row">
            <?php

                if(have_posts())    // Si on a des articles
                {
                    while(have_posts()){ the_post() // On parcourt les articles;?>
                        <div class="col-4">
                            <a class="card-link" href="<?php the_permalink(); ?>">
                                <div class="card shadow mb-4">
                                    <?php 
                                        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                                        $image_url = $large_image_url[0] ?? null;
                                        echo '<img class="img-fluid" src="'.$image_url.'">'; 
                                    ?>
                                    <div class="card-body">
                                        <h2 class="card-title">
                                            <?php the_title(); ?>   
                                        </h2>
                                        <?php if (!is_home()){ ?>
                                        <p>Surface: <?php echo get_post_meta($post->ID, 'surface', true); ?> m²</p>
                                        <p>Prix: <?php echo get_post_meta($post->ID, 'prix', true); ?> &euro;</p>
                                        <p><?php the_terms( $post->ID, 'size', 'Taille:'); ?></p>
                                        <p><?php the_terms( $post->ID, 'villes', 'Villes:'); ?></p>
                                        <?php }?>
                                    </div>
                                    <div class="card-footer">

                                    <button data-id="<?php the_ID(); ?> "data-title="<?php the_title();?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#housing-modal">Nous contacter</button>

                                        
                                                            
                                                   

                                    <?php echo get_the_date(); ?>
                                    </div>
                                </div>  
                            </a>  
                        </div>              
                    <?php }
                }
            ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="housing-modal">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="housing_id" id="housing_id">
                            <div class="form-group">
                                <label for="reference">Reference</label>
                                <input type="text" name="reference" id="reference" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Nom</label>
                                <input type="text" name="lastname" id="lastname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="firstname">Prénom</label>
                                <input type="text" name="firstname" id="firstname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <input type="text" name="message" id="message" class="form-control">
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                    </form>
                    </div>
            </div>
        </div>

<?php 
// On inclue le footer
get_footer(); ?>