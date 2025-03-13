<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <!-- Thêm Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Danh sách sản phẩm</h1>
        <div class="row" id="product-list">
            <!-- Các sản phẩm sẽ được hiển thị tại đây -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/products')
                .then(response => response.json())
                .then(data => {
                    const productList = document.getElementById('product-list');
                    data.forEach(product => {
                        const productDiv = document.createElement('div');
                        productDiv.classList.add('col-md-4', 'mb-4'); // Áp dụng col-md-4

                        productDiv.innerHTML = `
                            <div class="card">
                                <img src="${product.image}" alt="${product.name}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">${product.name}</h5>
                                    <p class="card-text">${product.description}</p>
                                    <p class="price">${product.price.toLocaleString()} VND</p>
                                </div>
                            </div>
                        `;

                        productList.appendChild(productDiv);
                    });
                })
                .catch(error => console.error('Lỗi khi lấy dữ liệu sản phẩm:', error));
        });
    </script>

    <!-- Thêm Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
