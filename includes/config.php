<?php
    ob_start();

        // Load environment variables from .env file
    $envFile = __DIR__ . '/.env';
    if (file_exists($envFile)) {
        $envContents = file_get_contents($envFile);
        $envLines = explode("\n", $envContents);
        foreach ($envLines as $line) {
            $line = trim($line);
            if (!empty($line) && strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value; // Optional: also set in $_SERVER
            }
        }
    }


    $timezone = date_default_timezone_set("Asia/Kolkata");
    $con = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);

    if (mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }

?>