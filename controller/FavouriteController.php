<?php
require_once "model/FavouriteModel.php";
require_once "view/helpers.php";



class FavouriteController {
    private $favoriteModel;

    public function __construct()
    {
        $this->favoriteModel = new FavoriteModel();
    }

    public function add() {
        if (!isset($_SESSION['user']['id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Bạn cần đăng nhập!']);
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $productId = $_POST['product_id'] ?? 0;

        if ($this->favoriteModel->addFavorite($userId, $productId)) {
            echo json_encode(['status' => 'success', 'message' => 'Đã thêm vào yêu thích']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Lỗi!']);
        }
    }

    public function getFavourites() {
        if (!isset($_SESSION['user']['id'])) {
            echo json_encode(['status' => 'error', 'message' => 'VMLINUX']);
            exit;
        }
        $userId = $_SESSION['user']['id'];
        $favourites = $this->favoriteModel->getFavorites($userId);
        echo json_encode(['status' => 'success', 'favourites' => $favourites]);
    }
    public function remove() {
        if (!isset($_SESSION['user']['id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Bạn cần đăng nhập!']);
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $productId = $_POST['product_id'] ?? 0;

        if ($this->favoriteModel->removeFavorite($userId, $productId)) {
            echo json_encode(['status' => 'success', 'message' => 'Đã xóa khỏi yêu thích']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Lỗi!']);
        }
    }
}
