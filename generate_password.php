<?php
// Script untuk generate password hash

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['password'])) {
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Password Hash</title>
</head>
<body>
    <h2>Generate Password Hash</h2>
    <form method="post">
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" required>
        <button type="submit">Generate Hash</button>
    </form>
    <?php if (isset($hashedPassword)): ?>
        <h3>Hasil Hash:</h3>
        <textarea rows="3" cols="60" readonly><?php echo htmlspecialchars($hashedPassword); ?></textarea>
    <?php endif; ?>
</body>
</html>
