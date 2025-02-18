<?php
require_once "../src/database.php";  // Asegúrate de que la ruta sea correcta

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
    $id = $data['id'];
    $stmt = $conn->prepare("DELETE FROM membresia WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
    $stmt->close();
}
$conn->close();
?>
