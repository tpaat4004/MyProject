<script setup>
defineProps({

  
})
</script>

<template>
  <div class="container">
    <h1 class="text-center">Nguyễn Văn A</h1>
    <div class="text-center">
        <p>Email: nguyenvana@example.com</p>
        <p>Điện thoại: 0123 456 789</p>
        <p>Địa chỉ: 123 Đường ABC, TP. HCM</p>
    </div>

    <div class="section">
        <h2 class="section-title">Kinh nghiệm làm việc</h2>
        <div class="experience">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Chức danh - Công ty XYZ</h5>
                    <h6 class="card-subtitle mb-2 text-muted">01/2020 - Hiện tại</h6>
                    <p class="card-text">Mô tả công việc và thành tựu của bạn tại đây.</p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Chức danh - Công ty ABC</h5>
                    <h6 class="card-subtitle mb-2 text-muted">01/2018 - 12/2019</h6>
                    <p class="card-text">Mô tả công việc và thành tựu của bạn tại đây.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Giáo dục</h2>
        <div class="education">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Bằng cấp - Trường đại học XYZ</h5>
                    <h6 class="card-subtitle mb-2 text-muted">2014 - 2018</h6>
                    <p class="card-text">Mô tả về chương trình học hoặc thành tích nổi bật.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Kỹ năng</h2>
        <ul>
            <li>Kỹ năng 1</li>
            <li>Kỹ năng 2</li>
            <li>Kỹ năng 3</li>
        </ul>
    </div>

    <div class="section">
        <h2 class="section-title">Sở thích</h2>
        <ul>
            <li>Sở thích 1</li>
            <li>Sở thích 2</li>
            <li>Sở thích 3</li>
        </ul>
    </div>
</div>
</template>

<style scoped>
.container {
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
        }
        .section-title {
            margin-top: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
</style>