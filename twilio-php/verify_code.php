<?php require_once __DIR__ . '/src/Twilio/autoload.php'; 


use Twilio\Rest\Client;

// Twilio credentials from the console
$account_sid = 'AC163f8d130d25477d2ce542c9441efc31';
$auth_token = 'c7da39a59cd97124fc0fbb3215a07acd';
$verify_sid = 'VAea4baa542a6114c8e5742d27e50fdffd';

// Get phone number and code from request
$data = json_decode(file_get_contents('php://input'), true);
$phoneNumber = $data['phone_num'];
$verificationCode = $data['verification_code'];

try {
    $twilio = new Client($account_sid, $auth_token);

    $verificationCheck = $twilio->verify->v2->services($verify_sid)
        ->verificationChecks
        ->create(['to' => $phoneNumber, 'code' => $verificationCode]);

    if ($verificationCheck->status === 'approved') {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Incorrect verification code.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
