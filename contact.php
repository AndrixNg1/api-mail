<?php
// Autoriser les requêtes CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

// Réponse immédiate aux requêtes préflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Lecture des données JSON envoyées depuis le frontend
$data = json_decode(file_get_contents("php://input"), true);

// Vérification des champs requis
if (
    empty($data['name']) ||
    empty($data['email']) ||
    empty($data['subject']) ||
    empty($data['message'])
) {
    http_response_code(400);
    echo json_encode(["error" => "Champs requis manquants."]);
    exit();
}

// Sécurisation des données reçues
$name = htmlspecialchars($data['name']);
$email = htmlspecialchars($data['email']);
$subject = htmlspecialchars($data['subject']);
$message = htmlspecialchars($data['message']);

// Initialisation de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuration SMTP (exemple avec Gmail)
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'User@exemple.com';         // Adresse Gmail
    $mail->Password = 'xxx xxxx xxxxx';              // Mot de passe d'application Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Paramètres de l'email
    $mail->setFrom('User@exemple.com', 'Portfolio');
    $mail->addReplyTo($email, $name);
    $mail->addAddress('andrixngoyi243@gmail.com');        // Destinataire final

    // Contenu de l’email
    $mail->isHTML(false);
    $mail->Subject = "[Contact Portfolio] $subject";
    $mail->Body = "Nom: $name\nEmail: $email\n\nMessage:\n$message";

    // Envoi de l'email
    $mail->send();

    echo json_encode(["success" => true, "message" => "Email envoyé avec succès."]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erreur PHPMailer : " . $mail->ErrorInfo]);
}
