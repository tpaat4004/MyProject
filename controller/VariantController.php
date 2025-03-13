<?php
require_once "model/ProductModel.php";
require_once "model/CategoryModel.php";
require_once "model/ColorModel.php";
require_once "model/SizeModel.php";
require_once "model/VariantModel.php";
require_once "view/helpers.php";

class VariantController {
    private $categoryModel;
    private $colorModel;
    private $sizeModel;
    private $variantModel;
    private $productModel;

    public function __construct() {
        $this->variantModel = new VariantModel();
        $this->categoryModel = new CategoryModel();
        $this->colorModel = new ColorModel();
        $this->sizeModel = new SizeModel();
        $this->productModel = new ProductModel();
    }

    

    public function show($id) {
        $product = $this->variantModel->getVariantById($id);
        renderView("view/product/variant_detail.php", compact('product'), "Product Detail");
    }
    
    public function index() {
        // Lấy tất cả các biến thể sản phẩm
        $productVariants = $this->variantModel->getAllProductVariants();
        renderView("view/products/product_variants_list.php", compact('productVariants'), "Product Variants List");
    }

    // Phương thức tạo trang thêm biến thể
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nếu form được gửi, lấy dữ liệu từ POST
            $productId = $_POST['product_id'];
            $colors = $_POST['colors'];
            $sizes = $_POST['sizes'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $sku = $_POST['sku'];

            // Lưu biến thể sản phẩm vào bảng product_variants
            foreach ($colors as $colorId) {
                foreach ($sizes as $sizeId) {
                    $this->variantModel->addProductVariant($productId, $colorId, $sizeId, $quantity, $price, $sku);
                }
            }
            header("Location: /product"); // Chuyển hướng về trang danh sách sản phẩm
        } else {
            $products = $this->productModel->getAllProducts();
            $colors = $this->colorModel->getAllColor();
            $sizes = $this->sizeModel->getAllSize();
            renderView("view/products/product_add.php", compact('products', 'colors', 'sizes'), "Add Product Variant");
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $productId = $_POST['product_id'];
            $colorId = $_POST['color_id'];
            $sizeId = $_POST['size_id'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $sku = $_POST['sku'];
    
            // Cập nhật biến thể sản phẩm
            $this->variantModel->updateVariant($id, $productId, $colorId, $sizeId, $quantity, $price, $sku);
    
            // Chuyển hướng về danh sách biến thể
            header("Location: /product");
        } else {
            // Lấy thông tin biến thể hiện tại
            $variant = $this->variantModel->getVariantById($id);
    
            // Lấy danh sách sản phẩm, màu sắc, kích thước để điền vào form
            $products = $this->productModel->getAllProducts();
            $colors = $this->colorModel->getAllColor();
            $sizes = $this->sizeModel->getAllSize();
    
            // Hiển thị form chỉnh sửa
            renderView(
                "view/products/product_variants_edit.php",
                compact('variant', 'products', 'colors', 'sizes'),
                "Edit Product Variant"
            );
        }
    }
    

    public function delete($id) {
        $this->variantModel->deleteVariant($id);
        header("Location: /product");
    }

}