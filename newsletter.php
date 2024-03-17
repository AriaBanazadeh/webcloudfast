<?php
require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;

$dynamodb = new DynamoDbClient([
    'region' => 'eu-west-2',
    'version' => 'latest',
    'credentials' => [
        'key' => 'KIAQ3EGPIQ6TS36KJOP',
        'secret' => '+Xu2AWb8zQrnPBV8GRQF1rPPFuVIt8EmGaQX85bW',
    ],
]);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "yes";
    $email = $_GET['email'];
    echo $email;
    $params = [
        'TableName' => 'NewsletterSubscribers',
        'Item' => [
            'email' => ['S' => $email],
        ],
    ];
    var_dump($params);
    $result = $dynamodb->putItem($params);
echo $result;
    if ($result['@metadata']['statusCode'] === 200) {
        echo 'Email inserted successfully: ' . $email;
    } else {
        echo 'Error inserting email: ' . $result['@metadata']['statusCode'];
    }
}
?>
