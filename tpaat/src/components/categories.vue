<script setup>
import { reactive, ref, onMounted } from "vue";
import axios from "axios";


const form = reactive({
  categoryName: ""
});

const submitForm = async () => {
  // Xử lý logic gửi biểu mẫu
};
</script>

<template>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Create New Category</h2>
    <form @submit.prevent="submitForm" class="p-4 border rounded shadow-lg bg-white">
      <div class="form-floating mb-3">
        <input
          type="text"
          id="categoryName"
          v-model="form.categoryName"
          class="form-control"
          placeholder="Enter category name"
          required
        />
        <label for="categoryName">Category Name</label>
      </div>
      
      <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
  </div>
</template>

<style scoped>
.container {
  max-width: 600px;
  margin: auto;
}

h2 {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #343a40;
}

form {
  transition: transform 0.3s, box-shadow 0.3s;
}

form:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

input:focus {
  border-color: #80bdff;
  outline: none;
  box-shadow: 0 0 5px rgba(128, 189, 255, 0.5);
}
</style>