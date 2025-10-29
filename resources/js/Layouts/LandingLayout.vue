<template>
    <div class="bg-white">
        <Header :style="1"/>
        <slot></slot>
    </div>
</template>

<script setup>
import Header from "@/components/Landing/Header.vue";
import Footer from "@/components/Landing/Footer.vue";

</script>

