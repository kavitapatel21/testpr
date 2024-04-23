<?php  
//ctrl + shift + /    [To add multiline comment]
// ctrll + /          [To add single line comment]
/* get_header();
if($flag){
	echo $domain;
}else {
	echo 'variable is false';
} */
<<<<<<< HEAD

// Template Name: Contact Form Template
// validate form data

get_header();
?>

<!-- display success & error msg -->
<?php 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors = validate_contact_form($_POST);
}

if(empty($errors)){
    $to = 'prashimishra11@gmail.com';
    $subject = 'New contact form submit:';
    $message = 'Name: ' . $_POST['name'] . "\r\n";
    $message .= 'Email: ' . $_POST['email'] . "\r\n";
    $message .= 'Message: ' . $_POST['message'];

    wp_mail($to, $subject, $message);

    echo '<div class="success">Thank you for your message</div>';
}
else{
    foreach ($errors as $error) {
        echo '<div class="error"> . $error . </div>';
    }
}
?>




<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = validate_contact_form($_POST);
    
    if (empty($errors)) {
        // Send email and display success message
        $to = 'youremail@example.com';
        $subject = 'New Contact Form Submission';
        $message = 'Name: ' . $_POST['name'] . "\r\n";
        $message .= 'Email: ' . $_POST['email'] . "\r\n";
        $message .= 'Message: ' . $_POST['message'];

        wp_mail($to, $subject, $message);
        
        echo '<div class="success">Thank you for your message!</div>';
    } else {
        foreach ($errors as $error) {
            echo '<div class="error">' . $error . '</div>';
        }
    }
}
?>
    
    <div class="container form-container">
        <form id="contact-form" action="<?php echo esc_url(admin_url('admin-post.php'));?>" method="post">
            <!-- <input type="text"> -->
            <div class="form-group">
                <label for="email">Username:</label>
                <input type="text" name="name">
            </div> <br>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email">
            </div> <br>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" id="" cols="30" rows="5"></textarea>
            </div> <br>

            <div class="form-group submit-btn">
                <input type="submit" value="submit">
            </div>

        </form>
    </div>


<?php get_footer(); ?>
=======
?>
>>>>>>> 09609779f381e604f1cedaa9d24b924b6b49c98f
