<template>
    <div>
        <Head :title="$t('الرئيسية')" />
        <Hero :data="page.data" :stats="stats" class="mt-5" />
        <Posts :posts="posts" class="mt-8" />
        <Footer :data="page.data" :page="footerPage" class="mt-12" />
    </div>
</template>
<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import { Head } from "@inertiajs/vue3";
import Hero from "@/components/Landing/Hero.vue";
import Posts from "@/components/Landing/Posts.vue";
import Footer from "@/components/Landing/Footer.vue";

defineOptions({
    layout: LandingLayout,
});
const props = defineProps({
    page: Object,
    posts: Array,
    stats: Object,
    footerPage: Object,
});
</script>
