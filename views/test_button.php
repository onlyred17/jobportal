<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Initialize response array
    $response = [];

    $send_data = [];

    // START - Parameters to Change
    $send_data['sender_id'] = "PhilSMS";  // Put the SID here
    $send_data['recipient'] = "+639071559721";  // Put the number or numbers here separated by commas with country code +63
    $send_data['message'] = "Sample broadcast message content.";  // Put message content here
    $token = "1779|F92JpAemLPDd69Zwk3ZLDFOY6Ntmq8sXntXVKFhY";  // Put your API TOKEN here
    // END - Parameters to Change

    // Convert parameters to JSON
    $parameters = json_encode($send_data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://app.philsms.com/api/v3/sms/send");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = [
        "Content-Type: application/json",
        "Authorization: Bearer $token"
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute cURL request
    $get_sms_status = curl_exec($ch);

    if ($get_sms_status === false) {
        $response['success'] = false;
        $response['message'] = 'Error sending SMS: ' . curl_error($ch);
    } else {
        $response['success'] = true;
        $response['message'] = 'SMS Sent Successfully!';
    }

    curl_close($ch);

    // Return JSON response
    echo json_encode($response);
    exit;  // End script execution after sending response
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send SMS via API</title>
    <style>
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <form method="POST">
        <button type="submit">Send SMS</button>
    </form>

</body>
</html>
