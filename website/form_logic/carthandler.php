<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] === 'add') {
    $productID = $data['productID'];
    $isAuctioned = $data['isAuctioned'];

    $_SESSION['cart'][] = [
        'productID' => $productID,
        'isAuctioned' => $isAuctioned
    ];

    echo json_encode(['success' => true]);
} elseif ($data['action'] === 'remove') {
    $productID = $data['productID'];
    $isAuctioned = $data['isAuctioned'];

    // Search for the item in the cart and remove it
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['productID'] == $productID && $item['isAuctioned'] == $isAuctioned) {
            unset($_SESSION['cart'][$key]);
            // Re-index the array to maintain consistent keys
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            echo json_encode(['success' => true]);
            exit;
        }
    }

    echo json_encode(['success' => false, 'message' => 'Item not found in cart.']);
} else {
    echo json_encode(['success' => false]);
}

?>
