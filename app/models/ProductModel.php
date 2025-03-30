<?php 
class ProductModel 
{ 
    private $conn; 
    private $table_name = "shoes"; 

    public function __construct($db) 
    { 
        $this->conn = $db; 
    } 

    public function getProducts() 
    { 
        // Chỉnh sửa lại truy vấn để phù hợp với các trường trong bảng sản phẩm mà không sử dụng category_id
        $query = "SELECT p.id, p.title, p.description, p.price, p.type, p.brain, p.manufacture, p.material, p.path_image 
                  FROM " . $this->table_name . " p"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(PDO::FETCH_OBJ); 
        return $result; 
    } 

    public function getProductById($id) 
    { 
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':id', $id); 
        $stmt->execute(); 
        $result = $stmt->fetch(PDO::FETCH_OBJ); 
        return $result; 
    } 

    public function addProduct($title, $description, $price, $type, $brain, $manufacture, $material, $path_image) 
    {
        // Kiểm tra dữ liệu hợp lệ
        if (empty($title) || empty($description) || !is_numeric($price)) {
            return false;
        }

        $query = "INSERT INTO product (title, description, price, type, brain, manufacture, material, path_image) 
                  VALUES (:title, :description, :price, :type, :brain, :manufacture, :material, :path_image)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':brain', $brain);
        $stmt->bindParam(':manufacture', $manufacture);
        $stmt->bindParam(':material', $material);
        $stmt->bindParam(':path_image', $path_image);

        return $stmt->execute();  // Thực thi lệnh và trả về true/false
    }

    public function updateProduct($id, $title, $description, $price, $type, $brain, $manufacture, $material, $path_image) 
    { 
        $query = "UPDATE " . $this->table_name . " 
                  SET title=:title, description=:description, price=:price, type=:type, brain=:brain, 
                      manufacture=:manufacture, material=:material, path_image=:path_image 
                  WHERE id=:id"; 
        $stmt = $this->conn->prepare($query); 

        $title = htmlspecialchars(strip_tags($title)); 
        $description = htmlspecialchars(strip_tags($description)); 
        $price = htmlspecialchars(strip_tags($price)); 
        $type = htmlspecialchars(strip_tags($type)); 
        $brain = htmlspecialchars(strip_tags($brain)); 
        $manufacture = htmlspecialchars(strip_tags($manufacture)); 
        $material = htmlspecialchars(strip_tags($material)); 
        $path_image = htmlspecialchars(strip_tags($path_image)); 

        $stmt->bindParam(':id', $id); 
        $stmt->bindParam(':title', $title); 
        $stmt->bindParam(':description', $description); 
        $stmt->bindParam(':price', $price); 
        $stmt->bindParam(':type', $type); 
        $stmt->bindParam(':brain', $brain); 
        $stmt->bindParam(':manufacture', $manufacture); 
        $stmt->bindParam(':material', $material); 
        $stmt->bindParam(':path_image', $path_image); 

        if ($stmt->execute()) { 
            return true; 
        } 
        return false; 
    } 

    public function deleteProduct($id) 
    { 
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':id', $id); 
        if ($stmt->execute()) { 
            return true; 
        } 
        return false; 
    } 
} 
?>
