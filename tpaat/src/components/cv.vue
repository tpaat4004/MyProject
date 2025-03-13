<script setup>
import { ref } from 'vue'
defineProps({
  status: {
    type: String,
    required: true
  },
  ten: {
    type: String,
    required: true
  },
  tuoi: {
    type: String,
    required: true
  },
  lop: {
    type: String,
    required: true
  },
  so_thich: {
    type: String,
    required: true
  },
  diem_manh: {
    type: String,
    required: true
  },
  diem_yeu: {
    type: String,
    required: true
  }
})

const avatar = ref("https://scontent.fbmv1-1.fna.fbcdn.net/v/t39.30808-1/464001809_1287828115924931_8397227289454145079_n.jpg?stp=cp6_dst-jpg_s160x160&_nc_cat=103&ccb=1-7&_nc_sid=0ecb9b&_nc_eui2=AeEDGWvlvELRlDZTbYtSYCPP8LVALiSYTc3wtUAuJJhNzZdoMxs2AQ757hd_azIuCpzRkq7GwYax-v855OWKu-ro&_nc_ohc=8rjNtjZetmoQ7kNvgFFWpaU&_nc_zt=24&_nc_ht=scontent.fbmv1-1.fna&_nc_gid=A9G-wLpuy8Qoabs7V9sRHDZ&oh=00_AYCeqSwE7SpP6GYEapKpe8MPet5H-mzD65p_zvOfC0eMTg&oe=672E970F")
const alt = ref("http://www.github.com")
const status = ref("Đang hoạt động")
const ten = ref("Trần Tiến Phát")
const pr = ref("Nhà phát triển Front End giàu kinh nghiệm và độc lập với 5 năm kinh nghiệm trong việc kết hợp nghệ thuật thiết kế với kỹ năng lập trình để mang lại trải nghiệm người dùng hấp dẫn và lôi cuốn thông qua quá trình phát triển trang web hiệu quả, tối ưu hóa tính năng chủ động và gỡ lỗi không ngừng")
const li_1 = ref("Mang lại trải nghiệm người dùng hấp dẫn thông qua việc tối ưu hóa hình ảnh, mã và khả năng tương thích giữa các trình duyệt, tăng Thời gian trên Trang thêm +60 giây cho hơn 50 trang web.")
const Edu = ref("Tốt nghiệp với điểm học thuật cao nhất.")

const changeStatus = () => {
  const newStatus = prompt("Nhập vào trạng thái mới:");
  if (newStatus) { 
    status.value = newStatus; 
  }
}
const changeAvatar = () => {
  const newAvatar = prompt("Nhập vào link mới :");
  if (newAvatar) { 
    avatar.value = newAvatar; 
  }
}
const changeTen = () => {
  const newTen = prompt("Nhập vào tên mới :");
  if (newTen) { 
    ten.value = newTen; 
  }
}
const changePr = () => {
  const newPr = prompt("Nhập vào profile mới :");
  if (newPr) { 
    pr.value = newPr; 
  }
}
const changeLi_1 = () => {
  const newLi_1 = prompt("Nhập vào text mới :");
  if (newLi_1) {
    li_1.value = newLi_1; 
  }
}
const changeEdu = () => {
  const newEdu = prompt("Nhập vào text mới:");
  if (newEdu) {
    Edu.value = newEdu;
  }
}
</script>

<template>
<div class="container my-5">
  <div class="row">
    <div class="col-md-4 sidebar">
      <div class="text-center">
        <img @click="changeAvatar()" class="profile-img mb-3" :src="avatar" alt="Profile Image">
        <h1 @click="changeTen()" class="name">{{ ten }}</h1>
        <p @click="changeStatus()" class="status">{{ status }}</p>
      </div>

      <div class="contact-info mt-4">
        <p><strong>Thông tin liên hệ</strong></p>
        <p>Địa chỉ: 123 Đường ABC, TP. HCM</p>
        <p>Điện thoại: 0123 456 789</p>
        <a href="mailto:nguyenvana@example.com">Email: phatttpk03754@example.com</a>
        <a href="https://web.facebook.com/?_rdc=1&_rdr">facebook</a>
        <a :href="alt">GitHub</a>
      </div>

      <div class="section-title">Quản lí dự án</div>
      <ul class="project-list">
        <li>Jira</li>
        <li>Slack</li>
        <li>Trello</li>
      </ul>

      <div class="section-title">Thiết kế & Code</div>
      <ul class="skills-list">
        <li>HTML, CSS</li>
        <li>JavaScript, jQuery</li>
        <li>Front End Frameworks (Angular, Ember, React)</li>
        <li>Responsive UI Design</li>
        <li>WordPress</li>
        <li>Adobe Photoshop</li>
        <li>Visual Studio</li>
      </ul>
    </div>

    <div class="col-md-8 main-content">
      <div class="section-title">Hồ sơ</div>
      <p @click="changePr()" class="profile-text">{{ pr }}</p>
      <textarea v-if="isPrVisible" v-model="pr" rows="4" cols="50" placeholder="Nhập văn bản tại đây..."></textarea>

      <div class="section-title">Kinh nghiệm</div>
      <h5>Nhà phát triển Front End / Henser Ltd. <span class="text-muted">(Sep 2024 – Present)</span></h5>
      <ul>
        <li @click="changeLi_1()" class="experience-item">{{ li_1 }}</li>
      </ul>

      <h5>Nhà phát triển Front End / Henser Ltd. <span class="text-muted">(Sep 2024 – Aug 2024)</span></h5>
      <ul>
        <li>Đã cung cấp các trang web phản hồi, tương thích với nhiều trình duyệt và tuân thủ khả năng truy cập, đạt được thời gian tải nhanh hơn 19%.</li>
        <li>Đã tạo ra các thành phần trực quan tuyệt đẹp bằng cách dịch khung thiết kế UI/UX thành mã bằng HTML5 và CSS3.</li>
      </ul>

      <div class="section-title">Gíao dục</div>
      <h5>Cử nhân Khoa học Máy tính / Đại học FPT <span class="text-muted">(Sep 2011 – Jul 2014)</span></h5>
      <p @click="changeEdu()" class="education-text">{{ Edu }}</p>
      <p>Đã học tập và rèn luyện các kỹ năng lập trình và phát triển web, bao gồm ngôn ngữ JavaScript, HTML, CSS và các kỹ năng phát triển giao diện.</p>
      <h5>Chứng chỉ Web Developer / Google Academy <span class="text-muted">(2023)</span></h5>
      <p>Hoàn thành khóa học lập trình web chuyên nghiệp, tập trung vào phát triển front-end, tối ưu hóa hiệu suất trang và cải tiến UI/UX.</p>
        
        <h5>Khóa học UX/UI Design / Udemy <span class="text-muted">(2022)</span></h5>
        <p>Nắm bắt được các nguyên tắc thiết kế UI/UX và các công cụ thiết kế như Figma và Adobe XD.</p>
      <div class="section-title">Sở thích</div>
      <ul>
        <li>Thích xem phim.</li>
        <li>Thích đi du lịch.</li>
        <li>Thích đọc sách.</li>
      </ul>
      <div class="section-title">Mục tiêu nghề nghiệp</div>
      <p>Tìm kiếm một vị trí phát triển web để có thể tận dụng tối đa các kỹ năng lập trình của mình và tiếp tục học hỏi.</p>
    </div>
  </div>
</div>
</template>

<style scoped>
.container {
  width: 1500px;
 
}

.profile-img {
  border-radius: 50%;
  width: 150px;
  height: 150px;
  object-fit: cover;
  border: 2px solid #4CAF50; /* Green border */
  transition: transform 0.3s;
}

.profile-img:hover {
  transform: scale(1.05); /* Slight zoom effect on hover */
}

.name {
  color: #4CAF50; /* Green color */
  cursor: pointer;
}

.status {
  color: #888; /* Muted text for status */
  cursor: pointer;
}

.sidebar {
  background-color: #f8f9fa;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.main-content {
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  background-color: #fff; /* White background for main content */
}

.section-title {
  font-weight: bold;
  margin-top: 20px;
  border-bottom: 2px solid #4CAF50; /* Green underline */
  padding-bottom: 5px;
}

.contact-info a {
  display: block;
  margin-bottom: 5px;
  color: #007BFF; /* Bootstrap primary color */
  text-decoration: none;
}

.contact-info a:hover {
  text-decoration: underline;
}

.project-list, .skills-list {
  list-style: none;
  padding-left: 0;
}

.project-list li, .skills-list li {
  margin-bottom: 10px;
}

.experience-item {
  cursor: pointer;
  color: #007BFF; /* Link color */
}

.experience-item:hover {
  text-decoration: underline;
}

.profile-text, .education-text {
  cursor: pointer;
  color: #333; /* Darker text for better readability */
}
</style>
