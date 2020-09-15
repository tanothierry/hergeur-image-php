<?php

//VERIFIER SI IMAGE A BIEN ETE ENVOYER
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    
    $error = 1;

    //VERIFIER LA TAILLE DE IMAGE 
    if ($_FILES['image']['size'] < 30000000) {
        
        //VERIFIER EXTENSION DU FICHIER
        $infoImage = pathinfo($_FILES['image']['name']);
        $extensionImage =   $infoImage['extension'];
        $extensionArray = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($extensionImage, $extensionArray)) {

            $adress = 'upload/'.time().rand().rand().'.'.$extensionImage;
            move_uploaded_file($_FILES['image']['tmp_name'], $adress);
            $error = 0;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hebergeur image gratuit</title>

    <style>
        html, body{
            margin: 0;
            
        }

        header{
            text-align: center;
            background-color: brown;
        }

        .container{
            max-width: 1000px;
            margin: 0 auto;
        }

        article{
            margin-top: 50px;
            background: #f7f7f7;
        }

        button{
            margin: auto;
            margin-top: 30px;
        }

        #image{
            max-width: 400px;
        }

        .presentation-picture{
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <h2>PHOTOSHOP</h2>
    </header>

    <!-- FORMULAIRE -->
    <div class="container">
        <article>
            <h1>Heberger une image</h1>


            <?php
                if (isset($error) && $error == 0) {
                    echo '<div class="presentation-picture">
                    <img src="'. $adress.'" id="image"/>
                    </div> 
                    <input type="text" value="http://localhost/'. $adress .'" />';
                } else if(isset($error) && $error == 1){
                    echo 'votre image ne peut pas etre envoyer verifier son extension et sa taille (maximum 30mo)';
                }

            ?>

            <form action="index.php" method="post" enctype="multipart/form-data">
                <p>
                    <input type="file" name="image" id="image">
                    <button type="submit">Envoyer</button>
                </p>
        </form>
        </article>
    </div>
</body>
</html>