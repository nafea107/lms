<template>
    <div>
        <Head :title="$t('الرئيسية')" />
        <Hero :data="page.data" :stats="stats" />
        <!-- <Courses :courses="courses" class="mt-8"/> -->
        <Subjects :subjects="subjects" class="mt-8" />
        <Sections class="mt-8" />
        <Footer :data="page.data" :page="footerPage" class="mt-12" />
    </div>
</template>
<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import { Head } from "@inertiajs/vue3";
import Hero from "@/components/Landing/Hero.vue";
import Courses from "@/components/Landing/Courses.vue";
import Subjects from "@/components/Landing/Subjects.vue";
import Sections from "@/components/Landing/Sections.vue";
import Footer from "@/components/Landing/Footer.vue";

defineOptions({
    layout: LandingLayout,
});
const props = defineProps({
    page: Object,
    subjects: Array,
    stats: Object,
    footerPage: Object,
});
</script>
