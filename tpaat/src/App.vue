<script setup>

// import gioiThieu from './components/gioiThieu.vue'
// import login from './components/login.vue'
// import cv from './components/cv.vue'
// import Login1 from './components/login1.vue'
// import list from './components/list.vue'
// import quantityCart from './components/quantityCart.vue';
// import user from './components/user.vue';
// import oneTwo from './components/one-two.vue';
// import CategoryList from './components/categoryList.vue';
// import categories from './components/categories.vue';
// import dtb from './components/dtb.vue';
</script>

<template>



  <RouterView></RouterView>
</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
