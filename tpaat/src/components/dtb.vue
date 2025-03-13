<script setup>
import { ref } from 'vue';

const dtb = ref('');
</script>
<template>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
      style="width: 400px; background-color: #f9f9f9; border-radius: 12px; box-shadow: 0px 0px 15px rgba(0,0,0,0.1);">
      <form>
        <div class="form-group mb-3">
          <div class="form-group">
            <input class="form-control" name="status" type="text" v-model="dtb">
            <h1>Điểm trung bình: {{ dtb }}</h1>
            <p v-if="dtb < 5" class="text-danger">Xếp loại: Yếu</p>
            <p v-else-if="dtb >= 5 && dtb < 6.5" class="text-warning">Xếp loại: Trung bình</p>
            <p v-else-if="dtb >= 6.5 && dtb < 8" class="text-success">Xếp loại: Khá"</p>
            <p v-else-if="dtb >= 8 && dtb < 9" class="text-primary">Xếp loại: Gioi"</p>
            <p v-else-if="dtb >= 9" class="text-info">Xếp loại: Xuất sắc"</p>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>