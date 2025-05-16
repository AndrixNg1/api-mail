<?php
// Chargement des variables d'environnement
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// CORS : Autoriser uniquement les domaines approuvés
$allowedOrigins = ['https://ton-portfolio.com', 'http://localhost:3000'];
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
}
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

// Réponse immédiate aux requêtes préflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Lecture des données JSON
$data = json_decode(file_get_contents("php://input"), true);

// Validation et assainissement des données
$name = filter_var($data['name'] ?? null, FILTER_SANITIZE_STRING);
$email = filter_var($data['email'] ?? null, FILTER_VALIDATE_EMAIL);
$subject = filter_var($data['subject'] ?? null, FILTER_SANITIZE_STRING);
$message = filter_var($data['message'] ?? null, FILTER_SANITIZE_STRING);

// Vérification des champs requis
if (!$name || !$email || !$subject || !$message) {
    http_response_code(400);
    echo json_encode(["error" => "Champs requis invalides ou manquants."]);
    exit();
}

$mail = new PHPMailer(true);

try {
    // Configuration SMTP via variables d’environnement
    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USER'];
    $mail->Password = $_ENV['SMTP_PASS'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $_ENV['SMTP_PORT'] ?? 587;

    $mail->setFrom($_ENV['SMTP_USER'], 'Portfolio');
    $mail->addReplyTo($email, $name);
    $mail->addAddress($_ENV['MAIL_TO']);

    $mail->isHTML(false);
    $mail->Subject = "[Contact Portfolio] $subject";
    $mail->Body = "Nom: $name\nEmail: $email\n\nMessage:\n$message";

    $mail->send();
    echo json_encode(["success" => true, "message" => "Email envoyé avec succès."]);
} catch (Exception $e) {
    error_log("Erreur d’envoi de mail : " . $mail->ErrorInfo);
    http_response_code(500);
    echo json_encode(["error" => "Une erreur est survenue. Veuillez réessayer plus tard."]);
}
