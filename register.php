<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "conn.php";
}
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registra un Utente</title>
</head>

<body>
    <div>
        <div class="w-25 p-3">
            <h3>Registra un Utente</h3>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="container">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Cognome</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Cognome">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Telefono</label>
                        <input type="text" class="form-control" placeholder="Telefono">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <div></div>
    </div>
</body>

</html>
