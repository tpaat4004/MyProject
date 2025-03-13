<script setup>
import { reactive, ref } from 'vue';

const products = reactive([
    {
        id: 1,
        name: "Sản phẩm 1",
        description: "Mô tả sản phẩm 1, rất chất lượng và đáng mua.",
        sale: true,
        price: 500000,
        priceDiscount: 400000,
        image: "http://picsum.photos/id/1/300/300",
    },
    {
        id: 2,
        name: "Sản phẩm 2",
        description: "Mô tả sản phẩm 2, chất lượng tốt và giá phải chăng.",
        sale: false,
        price: 300000,
        priceDiscount: 0,
        image: "http://picsum.photos/id/2/300/300",
    },
    {
        id: 3,
        name: "Sản phẩm 3",
        description: "Mô tả sản phẩm 3, sản phẩm cao cấp và nhiều tính năng.",
        sale: true,
        price: 1000000,
        priceDiscount: 900000,
        image: "http://picsum.photos/id/3/300/300",
    },
]);
</script>

<template>
    <div class="container">
        <h1 class="text-center">Danh sách sản phẩm</h1>
        <div class="row mt-5">
            <div v-for="product in products" class="col-md-4" :key="product.id">
                <div class="card" style="width: 18rem; position: relative;">
                    <div v-if="product.sale && product.price > 300000" class="Sale">
                        <img
                            style="width: 90px;"
                            src="https://clipart-library.com/image_gallery2/Sale-Free-Download-PNG.png"
                            alt="Sale"
                        />
                    </div>
                    <img :src="product.image" class="card-img-top" alt="Product Image" />
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <p class="card-text">{{ product.description }}</p>
                        <h3 class="card-text fw-bold" :class="{ 'text-danger': product.sale && product.price > 300000 }">
                            {{ product.sale ? product.priceDiscount : product.price }} vnđ
                        </h3>
                        <a href="#" class="btn btn-primary d-block text-center">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    width: 1000px;
}
.card {
    margin-top: 10px;
}
.Sale {
    position: absolute;
    top: 0;
    right: 0;
}
</style>
