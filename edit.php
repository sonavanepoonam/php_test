
<?php
include 'db.php';

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

$user_id = (int) $_SESSION["id"];


if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: dashboard.php");
    exit();
}

$id = (int) $_GET["id"];


$sql = $conn->prepare(
    "SELECT * FROM products WHERE id = ? AND user_id = ?"
);
$sql->bind_param("ii", $id, $user_id);
$sql->execute();

$result = $sql->get_result();
$product = $result->fetch_assoc();
$sql->close();

if (!$product) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pname = trim($_POST["pname"] ?? "");
    $pcategory = trim($_POST["category"] ?? "");
    $pprice = $_POST["price"] ?? "";
    $pquantity = $_POST["quantity"] ?? "";
    $description = trim($_POST["description"] ?? "");

    if (
        $pname === "" ||
        $pcategory === "" ||
        $description === "" ||
        !is_numeric($pprice) ||
        !is_numeric($pquantity) ||
        (float)$pprice < 0 ||
        (int)$pquantity < 0 ||
        (float)$pquantity != (int)$pquantity
    ) {
        $error = "Please enter valid product details.";
    } else {
        $pprice = (float) $pprice;
        $pquantity = (int) $pquantity;

        $sql = $conn->prepare(
            "UPDATE products
             SET pname = ?, category = ?, price = ?,
                 quantity = ?, description = ?
             WHERE id = ? AND user_id = ?"
        );

      
        $sql->bind_param(
            "ssdisii",
            $pname,
            $pcategory,
            $pprice,
            $pquantity,
            $description,
            $id,
            $user_id
        );

        if ($sql->execute()) {
            $sql->close();
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error updating product. Please try again.";
        }

        $sql->close();
    }

  
    $product["pname"] = $pname;
    $product["category"] = $pcategory;
    $product["price"] = $pprice;
    $product["quantity"] = $pquantity;
    $product["description"] = $description;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>

    <div class="container col-md-6 mt-4 p-4 border rounded shadow">

        <h2 class="text-center mb-4">EDIT PRODUCT</h2>

        <?php if ($error !== ""): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Product ID</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?= (int)$product['id'] ?>"
                    readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input
                    type="text"
                    name="pname"
                    class="form-control"
                    value="<?= htmlspecialchars($product['pname'] ?? '') ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <input
                    type="text"
                    name="category"
                    class="form-control"
                    value="<?= htmlspecialchars($product['category'] ?? '') ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input
                    type="number"
                    name="price"
                    class="form-control"
                    min="0"
                    step="0.01"
                    value="<?= htmlspecialchars((string)($product['price'] ?? '')) ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input
                    type="number"
                    name="quantity"
                    class="form-control"
                    min="0"
                    step="1"
                    value="<?= htmlspecialchars((string)($product['quantity'] ?? '')) ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                    required><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                UPDATE
            </button>

            <a href="dashboard.php" class="btn btn-secondary">
                CANCEL
            </a>

        </form>

    </div>

</body>
</html>
