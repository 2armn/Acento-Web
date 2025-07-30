<?php
if (isset($_POST['email'])) {

    // REPLACE THIS 2 LINES AS YOU DESIRE
    $email_to = "sumatemaspublicidad2@gmail.com";
    $email_subject = "Nuevo Mensaje desde acento.com";

    function problem($error)
    {
        echo "Parece que hay un error en la informacion: <br><br>";
        echo $error . "<br><br>";
        echo "Por favor corrija el error y proceda.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['message'])
    ) {
        problem('Parece que hay un error en la informacion.');
    }

    $name = $_POST['name']; // required
    $email = $_POST['email']; // required
    $phone = $_POST['phone']; // required
    $message = $_POST['message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'La direccion de correo electronico no es valida.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'El nombre no es valido.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'El mensaje no debe ser mas corto que dos caracteres<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Los detalles del mensaje son los siguientes:\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Nombre: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Telefono: " . clean_string($phone) . "\n";
    $email_message .= "Mensaje: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- Replace this as your success message -->

   Gracias por tu mensaje, nos pondremos en contacto tan pronto como podamos.

<?php
}
?>