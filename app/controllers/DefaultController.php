<?php
// app/controllers/DefaultController.php

class DefaultController
{
    // Phương thức xử lý yêu cầu trang chủ (index)
    public function index()
    {
        // Ví dụ về việc trả về thông tin trang chủ
        echo "Welcome to the homepage!";
    }

    // Phương thức xử lý yêu cầu khác nếu cần (ví dụ: về trang giới thiệu)
    public function about()
    {
        echo "This is the About page.";
    }
}
?>
