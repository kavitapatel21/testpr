<?php

get_header();



?>

<style>

    .warehouse-login {

        max-width: 500px;

        width: 80%;

        margin: 100px auto 200px auto;

        border: 5px solid #3479c5;

        border-radius: 10px;

        padding: 25px;

        box-sizing: border-box;

    }

    .warehouse-login label {

        display: block;

    }

    .warehouse-login p:last-child {

        padding-bottom: 0;

    }

    .warehouse-login input[type=text], .warehouse-login input[type=password]{

        width: 100%;

        padding: 10px 10px;

        box-sizing: border-box;

        font-size: 20px;

    }

    .warehouse-login input[type=submit] {

        padding: 10px 20px;

        background-color: #3479c5;

        color: #ffffff;

        font-size: 20px;

        border-radius: 5px;

    }

</style>



<div class="warehouse-login">

<?php

    wp_login_form([

        'redirect' => '/warehouse/',

    ]);

    ?>

</div>



<?php

get_footer();