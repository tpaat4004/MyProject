<?php
require_once "model/ProductModel.php";
require_once "model/CategoryModel.php";
require_once "model/ColorModel.php";
require_once "model/SizeModel.php";
require_once "view/helpers.php";

class ProductController
{
    private $productModel;
    private $categoryModel;
    private $colorModel;
    private $sizeModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->colorModel = new ColorModel();
        $this->sizeModel = new SizeModel();
    }

    public function index()
{
    // Lấy tất cả sản phẩm
    $products = $this->productModel->getAllProducts();
    
    // Lấy danh sách danh mục
    $categories = $this->categoryModel->getAllCategory();

    // Lấy thông tin size, color và images cho từng sản phẩm (cần gán lại mảng `$products`)
    foreach ($products as $key => $product) { 
        $products[$key]['sizes'] = $this->sizeModel->getSizesByProductId($product['id']);
        $products[$key]['colors'] = $this->colorModel->getColorsByProductId($product['id']);
        $products[$key]['images'] = $this->productModel->getImagesByProductId($product['id']);
    }

    renderView("view/products/product_list.php", compact('products', 'categories'), "Product List");
}



    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        // Lấy thông tin danh mục theo product_id
        $product['categories'] = $this->categoryModel->getCategoryById($product['categories_id']);

        renderView("view/products/product_detail.php", compact('product'), "Product Detail");
    }

    public function shop()
    {
        // Lấy tất cả sản phẩm
        $products = $this->productModel->getAllProducts();

        // Lấy danh sách danh mục
        $categories = $this->categoryModel->getAllCategory();

        // Lấy thông tin size, color, và ảnh cho từng sản phẩm
        foreach ($products as &$product) {
            $product['category'] = $this->categoryModel->getCategoryById($product['category_id']);
            $product['sizes'] = $this->sizeModel->getSizesByProductId($product['id']);
            $product['colors'] = $this->colorModel->getColorsByProductId($product['id']);
            $product['images'] = $this->productModel->getImagesByProductId($product['id']);
        }

        // Render view trang shop
        renderView("view/shop.php", compact('products', 'categories'), "Shop");
    }


    public function list($productId)
    {
        $product = $this->productModel->getProductDetails($productId);

        if (!$product) {
            die("Sản phẩm không tồn tại.");
        }

        renderView("view/product_detail.php", compact('product'), "Product Detail");
    }




    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nhận dữ liệu từ form
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            // Tạo sản phẩm
            $productId = $this->productModel->createProduct($name, $category_id, $description, $price);
            // Xử lý upload ảnh
            $images = $this->uploadImages($_FILES['images']);
            if (!$images) {
                die("Image upload failed. Please try again.");
            }


            foreach ($images as $imagePath) {
                $this->productModel->uploadImages($productId, $imagePath);
            }


            // Điều hướng về danh sách sản phẩm
            header("Location: /products");
        } else {
            // Lấy dữ liệu danh mục, màu sắc, và kích thước để hiển thị form
            $categories = $this->categoryModel->getAllCategory();
            renderView("view/products/product_create.php", compact('categories'), "Create Product");
        }
    }


    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            // Kiểm tra và xử lý upload ảnh (nếu có)
            $images = isset($_FILES['images']) && $_FILES['images']['error'][0] === UPLOAD_ERR_OK
                ? $this->uploadImages($_FILES['images'])
                : null;

            // Cập nhật thông tin sản phẩm
            $this->productModel->updateProduct($id, $name, $category_id, $description, $price);

            // Nếu có ảnh mới, thêm ảnh vào cơ sở dữ liệu
            if ($images) {
                foreach ($images as $imagePath) {
                    $this->productModel->uploadImages($id, $imagePath);
                }
            }

            // Điều hướng về danh sách sản phẩm
            header("Location: /products");
            exit;
        } else {
            // Lấy thông tin sản phẩm và danh mục để hiển thị form
            $product = $this->productModel->getProductById($id);
            $categories = $this->categoryModel->getAllCategory();
            $images = $this->productModel->getImagesByProductId($id); // Lấy ảnh cũ

            renderView(
                "view/products/product_edit.php",
                compact('product', 'categories', 'images'),
                "Edit Product"
            );
        }
    }

    private function uploadImages($file)
    {
        $uploadDir = 'uploads/'; //thư mục lưu ảnh
        $uploadedFiles = []; // mảng chứa các đường dẫn ảnh đã upload

        foreach ($file['name'] as $key => $fileName) {
            //Tạo tên file duy nhất
            $uniqueFileName = uniqid() . '_' . basename($fileName);
            $stargetFilePath = $uploadDir . $uniqueFileName;

            //Kiểm tra và upload từng file
            if (move_uploaded_file($file['tmp_name'][$key], $stargetFilePath)) {
                $uploadedFiles[] = $stargetFilePath;
            }
        }

        return $uploadedFiles;
    }

    public function delete($id)
    {
        $this->productModel->deleteProduct($id);
        header("Location: /products");
    }

    public function deleteImage($id)
    {
        // Kiểm tra tham số ID
        $imageId = intval($id); // Đảm bảo ID là số nguyên

        if (!$imageId) {
            http_response_code(400); // Bad Request
            die("Invalid request: Missing image ID.");
        }

        // Lấy thông tin ảnh từ database
        $image = $this->productModel->getImageById($imageId);

        if (!$image) {
            http_response_code(404); // Not Found
            die("Image not found.");
        }

        // Xóa file ảnh trên server
        $imagePath = realpath(__DIR__ . '/../' . $image['image_path']); // Điều chỉnh đường dẫn
        if ($imagePath && file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                http_response_code(500); // Internal Server Error
                die("Failed to delete image file from the server.");
            }
        }

        // Xóa ảnh trong database
        $isDeleted = $this->productModel->deleteImageById($imageId);
        if (!$isDeleted) {
            http_response_code(500); // Internal Server Error
            die("Failed to delete image from database.");
        }

        // Điều hướng về trang chỉnh sửa sản phẩm
        header("Location: /products/edit/" . $image['product_id']);
        exit;
    }

    public function detail($productId) {
        // Lấy thông tin sản phẩm hiện tại
        $product = $this->productModel->getProductById($productId);

        $product['variants'] = $this->productModel->getAllProductVariants();
        
        if (!$product) {
            die("Sản phẩm không tồn tại!");
        }
    
        // Lấy danh mục của sản phẩm
        $categoryId = $product['category_id'];
    
        // Lấy danh sách danh mục
        $categories = $this->categoryModel->getAllCategory();
    
        // Lấy danh sách biến thể, ảnh sản phẩm
        $product['sizes'] = $this->sizeModel->getSizesByProductId($productId);
        $product['colors'] = $this->colorModel->getColorsByProductId($productId);
        $product['images'] = $this->productModel->getImagesByProductId($productId);
    
        // Lấy sản phẩm liên quan theo danh mục (bỏ qua sản phẩm hiện tại)
        $relatedProducts = $this->productModel->getRelatedProducts($categoryId, $productId, 4);
    
        // Render view trang chi tiết sản phẩm
        renderView("view/product_detail.php", compact('product', 'categories', 'relatedProducts'), "Chi tiết sản phẩm");
    }
    
}
