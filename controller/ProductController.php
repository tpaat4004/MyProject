<?php
require_once "model/ProductModel.php";
require_once "view/helpers.php";

class ProductController
{
    private $CartModel;
    private $ProductModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
    }

    public function home()
    {
        $products = $this->ProductModel->getAllProduct();
        $categories = $this->ProductModel->getAllCategories();
        renderViewUser("view/users/home.php", compact('products', 'categories'), "Home");
    }

    public function detailBySlug($slug)
    {
        $product = $this->ProductModel->getProductBySlug($slug); 
        if (!$product) {
            renderViewUser("view/users/home.php", [], "Không tìm thấy sản phẩm");
            return;
        }
        renderViewUser("view/users/home.php", compact('product'), "Chi tiết sản phẩm");
    }



    public function index()
    {
        $products = $this->ProductModel->getAllProduct();
        renderViewAdmin("view/admin/products/products_list.php", compact('products'), "Product List");
    }

    public function show($id)
    {
        $product = $this->ProductModel->getProductById($id);
        renderViewAdmin("view/admin/products/products_detail.php", compact('product'), "Product Detail");
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            // Lưu sản phẩm, nhận lại product_id
            $product_id = $this->ProductModel->createProduct($category_id, $name, $price, $description);

            // Xử lý nhiều ảnh
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['name'] as $index => $filename) {
                    $imageName = time() . '_' . basename($filename);
                    move_uploaded_file($_FILES['images']['tmp_name'][$index], 'uploads/' . $imageName);
                    $this->ProductModel->addProductImage($product_id, $imageName);
                }
            }

            header("Location: /admin/products");
            exit;
        } else {
            $categories = $this->ProductModel->getAllCategories();
            renderViewAdmin("view/admin/products/products_create.php", compact('categories'), "Create Product");
        }
    }



    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            $this->ProductModel->updateProduct($id, $category_id, $name, $price, $description);

            // Nếu có upload thêm ảnh
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['name'] as $index => $filename) {
                    $imageName = time() . '_' . basename($filename);
                    move_uploaded_file($_FILES['images']['tmp_name'][$index], 'uploads/' . $imageName);
                    $this->ProductModel->addProductImage($id, $imageName);
                }
            }

            header("Location: /admin/products");
            exit;
        } else {
            $product = $this->ProductModel->getProductById($id);
            $categories = $this->ProductModel->getAllCategories();
            renderViewAdmin("view/admin/products/products_edit.php", compact('product', 'categories'), "Edit Product");
        }
    }



    public function delete($id)
    {
        $this->ProductModel->deleteProduct($id);
        header("Location: /admin/products");
    }
}
