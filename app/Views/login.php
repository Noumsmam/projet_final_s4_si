<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="/login" method="post">
        <?= csrf_field() ?>
        <label for="numero">Numero:</label>
        <input type="text" id="numero" name="numero" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>