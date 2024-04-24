<!DOCTYPE html>
<html lang="en">
<head>
    <link rel ="stylesheet" href="styleFP.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
    background-color: black;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
.form-label {
    font-size: 1.2em;
}
.form-control {
    font-size: 1.2em;
}
.btn {
    font-size: 1.2em;   
}

.reset {
    width: 80%;
    display: flex;
}
.form-control {
    background-color: transparent; 
    border: 1px solid white; 
    color: white;
}
.form-control::placeholder {
    color: white; 
}

form {
    width: 50%;
}
form {
    width: 60%;
    margin-right: 2%;
}

.btn-warning {
    width: 100%;
    color: white;
}

.btn-container {
    width: 100%; 
    margin-top: 1rem;
}
img {
    width: 70%; 
    max-width: 100%;
    height: auto; 
    display: block; 
    margin: 0 auto; 
}


    </style>
</head>
<body>

  <div class="reset">
    <form style="width:25%;float:left;display:block;">
        <h1 style="color:#FFBF00D1; text-align: center">CAMBIA PASSWORD</h1>
        <div class="mb-3">
            <label for="email" class="form-label" style= "color:white">Pawword</label>
            <input type="email" class="form-control"  placeholder="Inserire la password...">
        </div>
        <div class="mb-3">
            <label for="phone number" class="form-label" style= "color:white">Conferma Password</label>
            <input type="phone" class="form-control" placeholder="Ri-inserire la password...">
        </div>
        
        <div class="btn-container"> <!-- Contenitore per il pulsante -->
        <button type="button" class="btn btn-warning">Cambia Password</button>
    </div>

        
      </form>
    
   <img src="./img/reset.PNG" style="width:40%;float:left;display:block; margin-left:5%" >
   </div>
</body>
</html>