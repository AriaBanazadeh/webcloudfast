<?php
require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;

// Configure the AWS SDK with your credentials and region
$dynamodb = new DynamoDbClient([
    'region' => 'YOUR_AWS_REGION',
    'version' => 'latest',
    'credentials' => [
        'key' => 'YOUR_ACCESS_KEY_ID',
        'secret' => 'YOUR_SECRET_ACCESS_KEY',
    ],
]);

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Create the DynamoDB put-item parameters
    $params = [
        'TableName' => 'NewsletterSubscribers',
        'Item' => [
            'EmailAddress' => ['S' => $email],
        ],
    ];

    // Call the DynamoDB putItem operation
    $result = $dynamodb->putItem($params);

    if ($result['@metadata']['statusCode'] === 200) {
        echo 'Email inserted successfully: ' . $email;
    } else {
        echo 'Error inserting email: ' . $result['@metadata']['statusCode'];
    }
}
?>

<!-- HTML form for newsletter subscription -->
<form method="post" action="newsletter.php">
    <input type="email" name="email" placeholder="Enter your email" required>
    <button type="submit">Subscribe</button>
</form>

