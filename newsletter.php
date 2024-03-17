<?php
require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;

$dynamodb = new DynamoDbClient([
    'region' => 'eu-west-2',
    'version' => 'latest',
    'credentials' => [
        'key' => 'AKIAQ3EGPIQ6TS36KJOP',
        'secret' => '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',
    ],
]);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $email = $_GET['email'];
    $params = [
        'TableName' => 'NewsletterSubscribers',
        'Item' => [
            'email' => ['S' => $email],
        ],
    ];
    try {
	       $result = $dynamodb->putItem($params);
		    echo 'Email inserted successfully: ' . $email;
    } catch (Aws\Exception\AwsException $e) {
echo 'Error inserting email: ' . $e->getMessage();
}
echo $result;
echo "hahahah no error"; 
    if ($result['@metadata']['statusCode'] === 200) {
        echo 'Email inserted successfully: ' . $email;
    } else {
        echo 'Error inserting email: ' . $result['@metadata']['statusCode'];
    }
}
?>
