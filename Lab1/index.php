<html>

<head>
    <title> contact form </title>
</head>

<?php include_once 'config.php';
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$user_message = isset($_POST["message"]) ? $_POST["message"] : "";
$errors = [];
$message = "";

//Submit button functionality
if (isset($_POST["submit"])) {

    $empty_fields = [];
    $empty_message = "";

    // foreach ($_POST as $key => $value) {
    //     if (empty($value)) {
    //         $empty_fields[] = ucfirst($key);
    //     }
    // }

    if (empty($name)) {
        $empty_fields[] = "Name";
    } elseif (strlen($name) > MAX_NAME_LENGTH) {
        $errors[] = "Name should be less than " . MAX_NAME_LENGTH . " characters.";
    }

    if (empty($email)) {
        $empty_fields[] = "Email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (empty($user_message)) {
        $empty_fields[] = "Message";
    } elseif (strlen($user_message) > MAX_MESSAGE_LENGTH) {
        $errors[] = "Message should be less than " . MAX_MESSAGE_LENGTH . " characters.";
    }

    if (!empty($empty_fields)) {
        $empty_message = implode(", ", $empty_fields);
        $empty_message .= (count($empty_fields) === 1) ? " is required." : " are required.";
        $errors[] = $empty_message;
    }

    if (empty($errors)) {
        $message = "<h4 style='text-align: center;'>Thank you for contacting us</h4><br>";
        $message .= "<div style='margin: 0 auto; width: 300px; text-align: left;'>";
        $message .= "<p><strong>Name:</strong> $name</p>";
        $message .= "<p><strong>Email:</strong> $email</p>";
        $message .= "<p><strong>Message:</strong> $user_message</p>";
        $message .= "</div>";
        exit($message);
    }
} //Clear button functionality
elseif (isset($_POST["clear"])) {
    $name = "";
    $email = "";
    $user_message = "";
    $errors = [];
    $message = "";
}
?>

<!-- HTML form -->

<body>
    <h3> Contact Form </h3>
    <div id="after_submit">
        <?php
        //var_dump($errors);
        if (!empty($errors)) {
            echo "<ul style='color: red;'>";
            foreach ($errors as $error) {
                echo "<li> $error </li>";
            }
            echo "</ul>";
        }
        ?>
    </div>

    <form id="contact_form" action="#" method="POST" enctype="multipart/form-data">

        <div class="row">
            <label class="required" for="name">Your name:</label><br />
            <input id="name" class="input" name="name" type="text" value="<?php echo $name ?>" size="30" /><br />

        </div>
        <div class="row">
            <label class="required" for="email">Your email:</label><br />
            <input id="email" class="input" name="email" type="text" value="<?php echo $email ?>" size="30" /><br />

        </div>
        <div class="row">
            <label class="required" for="message">Your message:</label><br />
            <textarea id="message" class="input" name="message" rows="7" cols="30"><?php echo $user_message ?></textarea><br />

        </div>

        <input id="submit" name="submit" type="submit" value="Send email" />
        <input id="clear" name="clear" type="submit" value="clear form" />

    </form>
</body>