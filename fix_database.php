<?php
/**
 * Script untuk menambahkan kolom 'shipping' dan 'payment' ke tabel 'orders'
 */

// Load environment variables
$dotenv_path = __DIR__ . '/.env';
if (file_exists($dotenv_path)) {
    $env_lines = file($dotenv_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($env_lines as $line) {
        if (strpos($line, '=') && !strpos($line, '#')) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

$db_host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$db_port = $_ENV['DB_PORT'] ?? '3306';
$db_database = $_ENV['DB_DATABASE'] ?? 'TechPed';
$db_username = $_ENV['DB_USERNAME'] ?? 'root';
$db_password = $_ENV['DB_PASSWORD'] ?? '';

try {
    // Koneksi ke database menggunakan PDO
    $pdo = new PDO(
        "mysql:host={$db_host};port={$db_port};dbname={$db_database}",
        $db_username,
        $db_password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Cek struktur tabel orders
    $tableInfo = $pdo->query("DESCRIBE `orders`")->fetchAll(PDO::FETCH_ASSOC);
    $columns = array_column($tableInfo, 'Field');

    // Cek dan tambah kolom 'shipping' jika belum ada
    if (!in_array('shipping', $columns)) {
        echo "Menambahkan kolom 'shipping' ke tabel 'orders'...\n";
        $pdo->exec("ALTER TABLE `orders` ADD COLUMN `shipping` VARCHAR(255) NULL AFTER `total_harga`");
        echo "✓ Kolom 'shipping' berhasil ditambahkan\n";
    } else {
        echo "✓ Kolom 'shipping' sudah ada\n";
    }

    // Cek dan tambah kolom 'payment' jika belum ada
    if (!in_array('payment', $columns)) {
        echo "Menambahkan kolom 'payment' ke tabel 'orders'...\n";
        $pdo->exec("ALTER TABLE `orders` ADD COLUMN `payment` VARCHAR(255) NULL AFTER `shipping`");
        echo "✓ Kolom 'payment' berhasil ditambahkan\n";
    } else {
        echo "✓ Kolom 'payment' sudah ada\n";
    }

    echo "\n✓ Database berhasil diperbarui!\n";

    // Catat migrasi sebagai sudah berjalan
    $stmt = $pdo->prepare("INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES (?, ?)");
    $batch = $pdo->query("SELECT MAX(batch) as max_batch FROM migrations")->fetch()['max_batch'] ?? 0;
    $stmt->execute(['2026_03_26_232835_add_shipping_payment_to_orders_table', $batch + 1]);
    echo "✓ Migrasi telah tercatat di database\n";

} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}
