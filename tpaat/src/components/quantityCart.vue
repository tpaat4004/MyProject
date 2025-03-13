<script setup>
import { ref } from 'vue';
const quantity = ref(0);
const increaseQuantity = () => {
    quantity.value+=1;
}
const decreaseQuantity = () => {
    if (quantity.value > 0) {
        quantity.value-=1;
    }
}
</script>
<template>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4"
            style="width: 400px; background-color: #f9f9f9; border-radius: 12px; box-shadow: 0px 0px 15px rgba(0,0,0,0.1);">
            <form>
                <div class="form-group mb-3 text-center">
                    <h5>Số lượng sản phẩm trong giỏ hàng: <strong>{{ quantity }}</strong></h5>
                    <div class="btn-group">
                        <button @click.prevent="decreaseQuantity" :disabled="quantity <= 0" class="btn btn-decrease">−</button>
                        <button @click.prevent="increaseQuantity" class="btn btn-increase">+</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<style scoped>
.container {
    margin-left: 250px;
}

.btn-group {
  display: flex;
  gap: 8px;
  justify-content: center;
}


.btn {

  border: none;
  font-size: 20px;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-increase {
  background-color: #4CAF50; 
  color: white;
}

.btn-decrease {
  background-color: #f44336; 
  color: white;
}


</style>