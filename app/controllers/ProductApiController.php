<?php 
require_once('app/config/database.php'); 
require_once('app/models/ProductModel.php'); 

class ProductApiController 
{ 
    private $productModel; 
    private $db; 

    public function __construct() 
    { 
        $this->db = (new Database())->getConnection(); 
        $this->productModel = new ProductModel($this->db); 
    } 

    // Lấy danh sách sản phẩm 
    public function index() 
    { 
        header('Content-Type: application/json'); 
        $products = $this->productModel->getProducts(); 
        echo json_encode($products); 
    } 

    // Lấy thông tin sản phẩm theo ID 
    public function show($id) 
    { 
        header('Content-Type: application/json'); 
        $product = $this->productModel->getProductById($id); 
        if ($product) { 
            echo json_encode($product); 
        } else { 
            http_response_code(404); 
            echo json_encode(['message' => 'Product not found']); 
        } 
    } 

    // Thêm sản phẩm mới
    public function store() {
        $data = json_decode(file_get_contents("php://input"), true); // Lấy dữ liệu gửi lên
        
        // Kiểm tra xem các trường dữ liệu cần thiết có tồn tại không
        if (!isset($data['title']) || !isset($data['description']) || !isset($data['price']) || !isset($data['type']) || !isset($data['brain']) || !isset($data['manufacture']) || !isset($data['material']) || !isset($data['path_image'])) {
            echo json_encode(["message" => "Thiếu dữ liệu"]);
            return;
        }

        $title = $data['title'];
        $description = $data['description'];
        $price = $data['price'];
        $type = $data['type'];
        $brain = $data['brain'];
        $manufacture = $data['manufacture'];
        $material = $data['material'];
        $path_image = $data['path_image'];

        // Thêm sản phẩm mới vào database
        $productModel = new ProductModel($this->db);
        $result = $productModel->addProduct($title, $description, $price, $type, $brain, $manufacture, $material, $path_image);

        if ($result) {
            echo json_encode(["message" => "Product created successfully"]);
        } else {
            echo json_encode(["message" => "Failed to create product"]);
        }
    }

    // Cập nhật sản phẩm theo ID
    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true); // Lấy dữ liệu gửi lên
        
        // Kiểm tra xem các trường dữ liệu cần thiết có tồn tại không
        if (!isset($data['title']) || !isset($data['description']) || !isset($data['price']) || !isset($data['type']) || !isset($data['brain']) || !isset($data['manufacture']) || !isset($data['material']) || !isset($data['path_image'])) {
            echo json_encode(["message" => "Thiếu dữ liệu"]);
            return;
        }

        $title = $data['title'];
        $description = $data['description'];
        $price = $data['price'];
        $type = $data['type'];
        $brain = $data['brain'];
        $manufacture = $data['manufacture'];
        $material = $data['material'];
        $path_image = $data['path_image'];

        // Cập nhật sản phẩm trong database
        $productModel = new ProductModel($this->db);
        $result = $productModel->updateProduct($id, $title, $description, $price, $type, $brain, $manufacture, $material, $path_image);

        if ($result) {
            echo json_encode(["message" => "Product updated successfully"]);
        } else {
            echo json_encode(["message" => "Failed to update product"]);
        }
    }

    // Xóa sản phẩm theo ID
    public function destroy($id) 
    { 
        header('Content-Type: application/json'); 
        $result = $this->productModel->deleteProduct($id); 

        if ($result) { 
            echo json_encode(['message' => 'Product deleted successfully']); 
        } else { 
            http_response_code(400); 
            echo json_encode(['message' => 'Product deletion failed']); 
        } 
    } 
} 
?>
