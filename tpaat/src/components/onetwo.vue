<template>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4"
            style="width: 400px; background-color: #f9f9f9; border-radius: 12px; box-shadow: 0px 0px 15px rgba(0,0,0,0.1);">
            <form>

                <!-- One-way Data Binding -->
                <div class="form-group">
                    <label>Liên kết một chiều:</label>
                    <input type="text" class="form-control" placeholder="Nhập giá trị">
                    
                </div>

                <!-- Two-way Data Binding -->
                <div class="form-group">
                    <label>Liên kết hai chiều:</label>
                    <input v-model="twoWayValue" type="text" class="form-control" placeholder="Nhập giá trị">
                    <p>Giá trị (Hai chiều): {{ twoWayValue }}</p>
                </div>

                
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const oneWayValue = ref("");

const twoWayValue = ref("");

// Hàm thay đổi giá trị của twoWayValue

</script>

<style scoped>
.container {
    margin-left: 250px;

}
</style>