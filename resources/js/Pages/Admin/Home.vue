<template>
    <div class="max-w-7xl mx-auto w-full px-3">
        <Head :title="$t('الرئيسية')"/>
        <HomeStats v-bind="props"/>
        <div class="md:grid-cols-2 grid gap-4 mt-8">
            <TopSaleCoursesChart :data="top_sale_courses"/>
            <CoursesChart :data="courses_stats"/>
        </div>
    </div>
</template>
<script setup>
import {Head} from '@inertiajs/vue3'
import AdminLayout from "@/Layouts/AdminLayout.vue";
import HomeStats from "@/components/Admin/HomeStats.vue";
import TopSaleCoursesChart from "@/components/Admin/TopSaleCoursesChart.vue";
import CoursesChart from "@/components/Admin/CoursesChart.vue";

defineOptions({
    layout: AdminLayout
})
const props = defineProps({
    courses_stats: Array,
    top_sale_courses: Array,
    courses_count: Number,
    users_count: Number,
    subscriptions_count: Number,
});
</script>
