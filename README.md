# Hệ thống website thương mại điện tử đa nhà cung cấp - Megamart

Mô tả: Hệ thống website thương mại điện tử đa nhà cung cấp phép người bán (gian hàng) đăng sản phẩm để
kinh doanh, khách hàng chọn mua và thanh toán trực tuyến. Ngoài ra, hệ
thống tích hợp chức năng tư vấn trực tuyến, hỗ trợ khách hàng nhận tư
vấn nhanh chóng từ người bán.


<img src="https://github.com/khoait03/Multi-vendor-ecommerce-megamart/raw/main/public/uploads/megamart-demo.png" alt="Megamart Demo" width="900">

# Chi tiết:

Ngôn ngữ lập trình: PHP
Framework: Laravel (mô hình MVC)
Giao diện: HTML, CSS, Bootstrap, Jquery, Ajax
Cơ sở dữ liệu: MySQL
Công cụ khác: Pusher (tạo server cho chức năng chatbox), các cổng
thanh toán Paypal, Stripe, VNPay, Laragon,...

# Thông tin đăng nhập

-   Admin: admin@gmail.com - admin123456
-   Vendor: vendor@gmail.com - admin123456
-   User: user@gmail.com - admin123456

## DEMO

-   Youtube: https://youtu.be/BjckpoayEcI?si=QpAYRbdiJQKRo3w1

## Cài đặt

Để cài đặt dự án, bạn cần thực hiện các bước sau:

1. Clone repository:
2. Cài đặt các phụ thuộc:

    ```bash
    composer install

    ```

3. Tạo file .env:

    ```bash
    cp .env.example .env

    ```

4. Cấu hình file .env:
   Mở file .env và cấu hình các thông số kết nối cơ sở dữ liệu, ứng dụng, và các thông tin khác cần thiết cho dự án.

5. Tạo khóa ứng dụng:

    ```bash
    php artisan key:generate

    ```

6. Chạy migration:

    ```bash
    php artisan migrate

    ```

7. Chạy seeder:

    ```bash
    php artisan db:seed

    ```

8. Run project:

    ```bash
    php artisan serve

    ```

9. Truy cập vào địa chỉ: http://127.0.0.1:8000 để xem ứng dụng:

Đóng góp
Nếu bạn muốn đóng góp cho dự án, vui lòng tạo pull request và tuân thủ các quy tắc đóng góp.

Giấy phép
Dự án này được cấp phép theo MIT License.

Bản quyền thuộc về Nguyễn Lê Anh Khoa
Email: nguyenleanhkhoa.dev@gmail.com
Phone: 0336216546
