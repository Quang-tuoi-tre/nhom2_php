<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý sản phẩm</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
      body { padding: 20px; }
      .action-btn { margin-right: 5px; }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="text-center">Danh sách sản phẩm</h2>
    <!-- Bảng hiển thị sản phẩm -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên sản phẩm</th>
          <th>Mô tả</th>
          <th>Giá</th>
          <th>Loại sản phẩm</th>
          <th>Hãng sản xuất</th>
          <th>Nhà sản xuất</th>
          <th>Chất liệu</th>
          <th>Ảnh sản phẩm</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody id="product-list">
        <!-- Dữ liệu sẽ được load vào đây -->
      </tbody>
    </table>
    
    <!-- Form thêm/sửa sản phẩm -->
    <h3 id="form-title">Thêm sản phẩm</h3>
    <form id="product-form">
      <input type="hidden" id="product-id" value="">
      <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control" id="name" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea class="form-control" id="description" required></textarea>
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" class="form-control" id="price" step="0.01" required>
      </div>
      <div class="mb-3">
        <label for="type" class="form-label">Loại sản phẩm</label>
        <input type="text" class="form-control" id="type" required>
      </div>
      <div class="mb-3">
        <label for="brain" class="form-label">Hãng sản xuất</label>
        <input type="text" class="form-control" id="brain" required>
      </div>
      <div class="mb-3">
        <label for="manufacture" class="form-label">Nhà sản xuất</label>
        <input type="text" class="form-control" id="manufacture" required>
      </div>
      <div class="mb-3">
        <label for="material" class="form-label">Chất liệu</label>
        <input type="text" class="form-control" id="material" required>
      </div>
      <div class="mb-3">
        <label for="path_image" class="form-label">Ảnh sản phẩm</label>
        <input type="text" class="form-control" id="path_image" required>
      </div>
      <button type="submit" class="btn btn-primary">Lưu</button>
      <button type="button" id="cancel-edit" class="btn btn-secondary" style="display: none;">Hủy</button>
    </form>
  </div>

  <script>
    const API_URL = "http://localhost/saleshoe/api/product";
    
    // Load danh sách sản phẩm
    function loadProducts() {
      $.ajax({
        url: API_URL,
        method: "GET",
        dataType: "json",
        success: function(response) {
          let html = "";
          $.each(response, function(index, product) {
            html += `
              <tr>
                <td>${product.id}</td>
                <td>${product.title}</td>
                <td>${product.description}</td>
                <td>${parseFloat(product.price).toLocaleString()} VND</td>
                <td>${product.type}</td>
                <td>${product.brain}</td>
                <td>${product.manufacture}</td>
                <td>${product.material}</td>
                <td><img src="${product.path_image}" alt="Product Image" width="100"></td>
                <td>
                  <button class="btn btn-warning btn-sm action-btn edit-btn" data-id="${product.id}" data-title="${product.title}" data-description="${product.description}" data-price="${product.price}" data-type="${product.type}" data-brain="${product.brain}" data-manufacture="${product.manufacture}" data-material="${product.material}" data-path_image="${product.path_image}">Sửa</button>
                  <button class="btn btn-danger btn-sm action-btn delete-btn" data-id="${product.id}">Xóa</button>
                </td>
              </tr>
            `;
          });
          $("#product-list").html(html);
        },
        error: function(xhr, status, error) {
          console.error("Lỗi khi gọi API:", error);
          console.log("Phản hồi từ server:", xhr.responseText);
        }
      });
    }
    
    // Xử lý thêm hoặc sửa sản phẩm
    $("#product-form").submit(function(e) {
      e.preventDefault();
      
      const id = $("#product-id").val();
      const data = {
        title: $("#name").val(),
        description: $("#description").val(),
        price: $("#price").val(),
        type: $("#type").val(),
        brain: $("#brain").val(),
        manufacture: $("#manufacture").val(),
        material: $("#material").val(),
        path_image: $("#path_image").val()
      };
      
      if (id === "") {
        // Thêm sản phẩm mới
        $.ajax({
          url: API_URL,
          method: "POST",  // Sử dụng POST để thêm sản phẩm mới
          dataType: "json",
          data: JSON.stringify(data),  // Chuyển dữ liệu thành JSON
          contentType: "application/json",  // Cấu hình content type là application/json
          success: function(response) {
            alert("Thêm sản phẩm thành công");
            $("#product-form")[0].reset();
            loadProducts();  // Tải lại danh sách sản phẩm
          },
          error: function(xhr, status, error) {
            console.error("Lỗi khi thêm sản phẩm:", error);
            console.log("Phản hồi từ server:", xhr.responseText);
          }
        });
      } else {
        // Sửa sản phẩm, sử dụng PUT
        $.ajax({
          url: API_URL + "/" + id,
          method: "PUT",  // hoặc "PATCH" nếu API của bạn hỗ trợ
          dataType: "json",
          data: JSON.stringify(data),
          contentType: "application/json", // Cấu hình content type là application/json
          success: function(response) {
            alert("Cập nhật sản phẩm thành công");
            $("#product-form")[0].reset();
            $("#form-title").text("Thêm sản phẩm");
            $("#cancel-edit").hide();
            loadProducts();
          },
          error: function(xhr, status, error) {
            console.error("Lỗi khi cập nhật sản phẩm:", error);
            console.log("Phản hồi từ server:", xhr.responseText);
          }
        });
      }
    });

    // Xử lý nút xóa
    $(document).on("click", ".delete-btn", function() {
      const id = $(this).data("id");
      if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
        $.ajax({
          url: API_URL + "/" + id,
          method: "DELETE",
          dataType: "json",
          success: function(response) {
            alert("Xóa sản phẩm thành công");
            loadProducts();
          },
          error: function(xhr, status, error) {
            console.error("Lỗi khi xóa sản phẩm:", error);
            console.log("Phản hồi từ server:", xhr.responseText);
          }
        });
      }
    });
    
    // Xử lý nút sửa: điền dữ liệu vào form
    $(document).on("click", ".edit-btn", function() {
      const id = $(this).data("id");
      const title = $(this).data("title");
      const description = $(this).data("description");
      const price = $(this).data("price");
      const type = $(this).data("type");
      const brain = $(this).data("brain");
      const manufacture = $(this).data("manufacture");
      const material = $(this).data("material");
      const path_image = $(this).data("path_image");
      
      $("#product-id").val(id);
      $("#name").val(title);
      $("#description").val(description);
      $("#price").val(price);
      $("#type").val(type);
      $("#brain").val(brain);
      $("#manufacture").val(manufacture);
      $("#material").val(material);
      $("#path_image").val(path_image);
      $("#form-title").text("Sửa sản phẩm");
      $("#cancel-edit").show();
    });
    
    // Nút hủy sửa: reset form
    $("#cancel-edit").click(function() {
      $("#product-form")[0].reset();
      $("#product-id").val("");
      $("#form-title").text("Thêm sản phẩm");
      $(this).hide();
    });
    
    // Load sản phẩm khi trang được tải
    $(document).ready(function() {
      loadProducts();
    });
  </script>
</body>
</html>
