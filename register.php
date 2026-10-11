
<?php 

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["fname"];
    $email = $_POST["email"];
     $phone = $_POST["phone"];
      $uname = $_POST["uname"];
    $pass = password_hash($_POST["pass"], PASSWORD_BCRYPT);

    $sql = $conn->prepare("INSERT INTO user (fname, email,phone,username, password) VALUES (?,?,?, ?, ?)");
    $sql->bind_param("ssiss", $name, $email,$phone,$uname, $pass);

    if ($sql->execute()) {
        header("Location: login.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <h2 class="text-center">Register With Us</h2>
            <div class="container col-5 p-3 border rounded shadow mt-4">
                <form action="" method="POST">
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="fname"
                            id="formId1"
                            placeholder=""
                        required/>
                        <label for="formId1"> Full Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            id="formId2"
                            placeholder=""
                       required />
                        <label for="formId2">Email</label>
                    </div>
                     <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="phone"
                            id="formId1"
                            placeholder=""
                        required/>
                        <label for="formId1">Phone</label>
                    </div>
                     <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="uname"
                            id="formId1"
                            placeholder=""
                       required />
                        <label for="formId1">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="password"
                            class="form-control"
                            name="pass"
                            id="formId3"
                            placeholder=""
                       required />
                        <label for="formId3">Password</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>

        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
