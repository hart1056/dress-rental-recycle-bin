<?php
require_once 'core/models.php';

// check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// check kung may valid customer id
if (!isset($_GET['customer_id']) || !is_numeric($_GET['customer_id'])) {
    header("Location: index.php");
    exit();
}

$customer_id = (int) $_GET['customer_id'];
$customer = getCustomerByID($pdo, $customer_id);

if (!$customer) {
    header("Location: index.php");
    exit();
}

$deletedRentals = getDeletedRentals($pdo, $customer_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <header>
        <h1>Recycle Bin</h1>
        <p>Deleted rental records for <?php echo htmlspecialchars($customer['customer_name'], ENT_QUOTES, 'UTF-8'); ?></p>
    </header>

    <section class="table-card">
        <h2>Deleted Rentals</h2>

        <?php if (count($deletedRentals) > 0) { ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Rental ID</th>
                            <th>Dress Name</th>
                            <th>Rental Date</th>
                            <th>Return Date</th>
                            <th>Deleted By</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($deletedRentals as $log) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($log['rental_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($log['dress_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($log['rental_date'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($log['return_date'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($log['deleted_by_username'] ?? 'Unknown', ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($log['deleted_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="actions">
                                    <form action="core/handleForms.php" method="POST">
                                        <input type="hidden" name="log_id" value="<?php echo $log['log_id']; ?>">
                                        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                                        <button type="submit" name="restoreRentalBtn">Restore</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p class="empty-message">No deleted rentals found.</p>
        <?php } ?>
    </section>

    <p><a class="view-btn" href="viewrentals.php?customer_id=<?php echo $customer_id; ?>">← Back to Rentals</a></p>
</div>

</body>
</html>