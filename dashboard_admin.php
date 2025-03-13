<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="content container">
        <h2>Dashboard Admin</h2>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card p-3">
                    <h5>Doanh thu</h5>
                    <p>
                        <span id="totalRevenue"><?= number_format($totalRevenue, 0, ',', '.') ?></span> VNĐ
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3">
                    <h5>Đơn hàng</h5>
                    <p>
                        <span id="totalOrders"><?= $totalOrders ?></span>
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3">
                    <h5>Đơn hàng đã giao</h5>
                    <p>
                        <span id="completedOrders"><?= $completedOrders ?></span>
                    </p>
                </div>
            </div>

            <div class="col-md-4 mt-3">
                <div class="card p-3">
                    <h5>Tổng số lượng sản phẩm</h5>
                    <p><i class="fas fa-cubes"></i> <span><?= number_format($totalQuantity) ?></span> sản phẩm</p>
                </div>
            </div>


        </div>

        <h4 class="mt-4">Biểu đồ doanh thu</h4>
        <canvas id="revenueChart" width="400" height="150"></canvas>
    </div>

    <script>
        // Hiển thị biểu đồ doanh thu
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById("revenueChart").getContext("2d");
            const months = <?= $months ?>;
            const revenues = <?= $revenues ?>;

            new Chart(ctx, {
                type: "line",
                data: {
                    labels: months,
                    datasets: [{
                        label: "Doanh thu (VNĐ)",
                        data: revenues,
                        borderColor: "blue",
                        backgroundColor: "rgba(0, 0, 255, 0.2)",
                        borderWidth: 2
                    }]
                }
            });
        });
    </script>
</body>

</html>