<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Workshop Main Menu</title>
</head>
<body>
    <h1>Car Workshop Main Menu</h1>

    <h2>Choose role</h2>

    <form action="./View/ViewReparation.php" method="POST">
        <select name="role">
            <option value="employee">Employee</option>
            <option value="client">Client</option>
        </select>

        <button type="submit">Enter</button>
    </form>
</body>
</html>