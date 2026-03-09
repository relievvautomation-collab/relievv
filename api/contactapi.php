<?php
// api/contact.php - Updated with file attachment support
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['statusCode' => 405, 'message' => 'Method not allowed']);
    exit();
}

// Check if it's a contact form submission
if (!isset($_POST['action']) || $_POST['action'] !== 'contactform') {
    http_response_code(400);
    echo json_encode(['statusCode' => 400, 'message' => 'Invalid request']);
    exit();
}
 
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendContactEmail($user_email, $username, $phonenumber, $message, $attachments = []) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'relievvautomation@gmail.com';
        $mail->Password   = 'yayjxkxgjtolohne'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->Timeout    = 30;
        
        // Recipients
        $mail->setFrom('relievvautomation@gmail.com', 'Relievv');
        $mail->addAddress('relievvautomation@gmail.com', 'Relievv Admin');  
        $mail->addReplyTo($user_email, $username);
        
        // Add attachments
        if (!empty($attachments)) {
            foreach ($attachments['tmp_name'] as $key => $tmp_name) {
                if (!empty($tmp_name) && isset($attachments['name'][$key])) {
                    $filename = $attachments['name'][$key];
                    $file_tmp = $tmp_name;
                    
                    // Validate file size (10MB max)
                    if ($attachments['size'][$key] <= 10 * 1024 * 1024) {
                        $mail->addAttachment($file_tmp, $filename);
                    }
                }
            }
        }
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission from ' . $username;
        
        $attachmentList = '';
        if (!empty($attachments) && !empty($attachments['name'][0])) {
            $attachmentList = '<div class="field">
                <div class="label">📎 Attachments:</div>
                <div class="value">';
            foreach ($attachments['name'] as $filename) {
                $attachmentList .= '<div>• ' . htmlspecialchars($filename) . '</div>';
            }
            $attachmentList .= '</div></div>';
        }
        
        $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #1a87c3; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
                .field { margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px; }
                .label { font-weight: bold; color: #1a87c3; font-size: 16px; margin-bottom: 5px; }
                .value { color: #333; font-size: 15px; padding: 8px; background: white; border-radius: 5px; }
                .message-box { background: white; padding: 15px; border-radius: 5px; border-left: 4px solid #1a87c3; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>📬 New Contact Form Submission</h2>
                </div>
                <div class='content'>
                    <div class='field'>
                        <div class='label'>👤 Name:</div>
                        <div class='value'>" . htmlspecialchars($username) . "</div>
                    </div>
                    <div class='field'>
                        <div class='label'>📧 Email:</div>
                        <div class='value'>" . htmlspecialchars($user_email) . "</div>
                    </div>
                    <div class='field'>
                        <div class='label'>📞 Phone:</div>
                        <div class='value'>" . htmlspecialchars($phonenumber) . "</div>
                    </div>
                    <div class='field'>
                        <div class='label'>💬 Message:</div>
                        <div class='message-box'>" . nl2br(htmlspecialchars($message)) . "</div>
                    </div>
                    " . $attachmentList . "
                </div>
            </div>
        </body>
        </html>";
        
        $mail->AltBody = "New Contact Form Submission\n\n" .
                         "Name: " . $username . "\n" .
                         "Email: " . $user_email . "\n" .
                         "Phone: " . $phonenumber . "\n" .
                         "Message: " . $message . "\n\n" .
                         (!empty($attachments) ? "Attachments: " . implode(", ", $attachments['name']) : "");
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}

// Process form submission
$contactname = isset($_POST['contactname']) ? trim($_POST['contactname']) : '';
$contactemail = isset($_POST['contactemail']) ? trim($_POST['contactemail']) : '';
$contactphone = isset($_POST['contactphone']) ? trim($_POST['contactphone']) : '';
$contactmessage = isset($_POST['contactmessage']) ? trim($_POST['contactmessage']) : '';
$attachments = isset($_FILES['attachments']) ? $_FILES['attachments'] : [];

 

// Validate email
if (!filter_var($contactemail, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'statusCode' => 400,
        'message' => 'Please enter a valid email address'
    ]);
    exit();
}

// Validate attachments if any
if (!empty($attachments) && !empty($attachments['name'][0])) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', 
                     'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                     'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                     'application/json', 'text/plain'];
    
    foreach ($attachments['type'] as $type) {
        if (!in_array($type, $allowed_types)) {
            echo json_encode([
                'statusCode' => 400,
                'message' => 'Invalid file type. Only images, PDF, Word, Excel, JSON, and text files are allowed.'
            ]);
            exit();
        }
    }
    
    // Check file sizes (10MB max each)
    foreach ($attachments['size'] as $size) {
        if ($size > 10 * 1024 * 1024) {
            echo json_encode([
                'statusCode' => 400,
                'message' => 'One or more files exceed the 10MB size limit.'
            ]);
            exit();
        }
    }
}

$emailSent = sendContactEmail($contactemail, $contactname, $contactphone, $contactmessage, $attachments);

if ($emailSent) {
    echo json_encode([
        'statusCode' => 200, 
        'message' => 'Your message has been sent successfully! We will get back to you soon.'
    ]);
} else {
    echo json_encode([
        'statusCode' => 500, 
        'message' => 'Failed to send your message. Please try again later.'
    ]);
}
exit();
?>