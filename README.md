# Giày Shop - Website Bán Giày

Chào mừng bạn đến với dự án **Giày Shop** – Một website bán giày trực tuyến với thiết kế đẹp, dễ sử dụng và chức năng quản lý sản phẩm chuyên nghiệp.

## 🚀 Giới thiệu

Giày Shop là một nền tảng trực tuyến để khách hàng có thể duyệt và mua giày từ nhiều thương hiệu và loại khác nhau. Website cung cấp các tính năng như:
- Xem và tìm kiếm sản phẩm theo danh mục, giá cả và kích cỡ.
- Thêm, sửa, xóa sản phẩm quản lý dễ dàng.
- Giỏ hàng và thanh toán trực tuyến.
- Thiết kế responsive, thân thiện với mọi thiết bị.

## 🛠️ Các tính năng

- **Trang chủ**: Hiển thị danh sách các sản phẩm phổ biến, thông tin khuyến mãi.
- **Danh sách sản phẩm**: Người dùng có thể duyệt qua các sản phẩm được phân loại theo danh mục, giá cả, và thương hiệu.
- **Trang chi tiết sản phẩm**: Mỗi sản phẩm có một trang riêng với các thông tin chi tiết, hình ảnh, đánh giá sản phẩm.
- **Tìm kiếm sản phẩm**: Hỗ trợ người dùng tìm kiếm sản phẩm nhanh chóng theo tên, loại giày, hoặc giá trị.
- **Giỏ hàng**: Người dùng có thể thêm sản phẩm vào giỏ hàng, điều chỉnh số lượng và thanh toán.
- **Quản lý sản phẩm**: Admin có thể thêm, chỉnh sửa hoặc xóa sản phẩm từ bảng quản lý.
- **Responsive Design**: Giao diện tự động điều chỉnh phù hợp với mọi kích cỡ màn hình.

## 📦 Cài đặt

1. **Clone repository**:
    ```bash
    git clone https://github.com/Quang-tuoi-tre/nhom2_php
    ```

2. **Cài đặt các phụ thuộc**:
   Dự án sử dụng PHP, vì vậy bạn cần cài đặt PHP và MySQL.
    - Cài đặt PHP và MySQL trên máy tính của bạn.
    - Cài đặt [Composer](https://getcomposer.org/) để quản lý các thư viện PHP (nếu cần).

3. **Cấu hình cơ sở dữ liệu**:
   - Tạo cơ sở dữ liệu trong MySQL (hoặc SQL Server) với tên `shopshoe`.
   - Import cấu trúc bảng vào cơ sở dữ liệu từ `sql_shopshoe.txt` (đảm bảo rằng tệp này có sẵn trong thư mục của dự án).

4. **Cấu hình dự án**:
   - Mở tệp cấu hình database và chỉnh sửa các thông số kết nối với MySQL trong tệp `config/database.php`.

5. **Chạy dự án**:
    - Khởi động server:
    ```bash
    php -S localhost:8000
    ```
    Truy cập vào `http://localhost/saleshoe` trong trình duyệt của bạn.

## 🎨 Thiết kế

Website được thiết kế tối giản và hiện đại với:
- **Bootstrap 5**: Tối ưu cho việc phát triển giao diện đẹp, dễ sử dụng và responsive.
- **JQuery**: Sử dụng để xử lý các tương tác người dùng, như tìm kiếm, thêm sản phẩm vào giỏ hàng.
- **PHP**: Backend xử lý dữ liệu, điều hướng và quản lý sản phẩm.

## 🖥️ Các công nghệ sử dụng

- **Frontend**: HTML, CSS, JavaScript (JQuery), Bootstrap
- **Backend**: PHP (với các framework như Slim hoặc Laravel nếu có)
- **Database**: MySQL (hoặc SQL Server)
- **Version Control**: Git, GitHub

## 🚧 Roadmap

- **Thêm tính năng đăng nhập người dùng và quản lý tài khoản.**
- **Tích hợp thanh toán trực tuyến (PayPal, Stripe, v.v.)**
- **Hỗ trợ đa ngôn ngữ và nhiều đơn vị tiền tệ.**
- **Tối ưu hóa hiệu suất cho các sản phẩm có lượng truy cập cao.**

## 👨‍💻 Contributing

Chúng tôi hoan nghênh các đóng góp từ cộng đồng. Nếu bạn có ý tưởng hoặc tìm thấy lỗi, vui lòng tạo một **issue** hoặc **pull request**.

## 📄 License

Dự án này được cấp phép theo [MIT License](LICENSE).

## ✨ Cảm ơn

Cảm ơn bạn đã sử dụng và tham gia đóng góp cho dự án **Giày Shop**. Hy vọng bạn có trải nghiệm mua sắm tuyệt vời!
