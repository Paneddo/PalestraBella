<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "conn.php";
}

?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <div>
        <div class="w-25 p-3">
            Accedi al Sito
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="container">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <br>
                    <small id="emailHelp" class="form-text text-muted">Hai dimenticato la password?</small>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
