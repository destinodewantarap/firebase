<?php
    require __DIR__.'/vendor/autoload.php';

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;

    $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/kebuninovasi-13220-firebase-adminsdk-d85bu-d16860d09c.json');
    $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://kebuninovasi-13220-default-rtdb.firebaseio.com')
        ->create();
    
    $database = $firebase->getDatabase();
?>