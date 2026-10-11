
<?php

include 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["fname"];
    $pass = $_POST["pass"];

    $sql = $conn->prepare("SELECT id, password FROM user WHERE fname=?");
    $sql->bind_param("s", $name);
    $sql->execute();

    $sql->bind_result($id, $db_password);

    if ($sql->fetch()) {
       

        if (password_verify($pass, $db_password)) {
            $_SESSION["id"] = $id;
            $_SESSION["name"] = $name;

            header("Location: dashboard.php");
            exit();
        }
    } else {
        $sql->close();
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>
    <header></header>

    <main>
        <h2 class="text-center">Login With Us</h2>

        <div class="container col-5 p-3 border rounded shadow mt-4">
            <form action="" method="POST">
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="fname"
                        id="formId1"
                        placeholder=""
                        required
                    >
                    <label for="formId1">Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="password"
                        class="form-control"
                        name="pass"
                        id="formId2"
                        placeholder=""
                        required
                    >
                    <label for="formId2">Password</label>
                </div>

                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </form>
        </div>
    </main>

    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
