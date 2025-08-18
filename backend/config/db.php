<?php
// Load environment variables manually
function loadEnv($path)
{
    if (!file_exists($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // skip comments
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        $_ENV[$name] = $value;
        putenv("$name=$value");
    }
}

// Load from project root .env file
loadEnv(__DIR__ . '/../../.env');

// Assign DB credentials
$host = getenv('DB_HOST') ?: $_ENV['DB_HOST'];
$port = getenv('DB_PORT') ?: $_ENV['DB_PORT'];
$dbname = getenv('DB_NAME') ?: $_ENV['DB_NAME'];
$user = getenv('DB_USER') ?: $_ENV['DB_USER'];
$password = getenv('DB_PASS') ?: $_ENV['DB_PASS'];

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection Successful!"; // Uncomment to test connection
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}