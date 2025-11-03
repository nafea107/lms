<template>
    <div class="px-3 mx-auto max-w-7xl py-5 w-full">
        <Head :title="course.name[locale]" />
        <div class="grid md:grid-cols-3 gap-3">
            <LessonsList
                :chapters="course.chapters"
                :course="course"
                :locked="!course.is_subscribed"
            />
            <div ref="dom" class="md:col-span-2">
                <div
                    v-if="
                        course.chapters &&
                        course.chapters[0] &&
                        course.chapters[0].lessons &&
                        course.chapters[0].lessons[0]
                    "
                    class="font-rabar-022 flex items-center gap-2 text-emerald-950 text-base w-full"
                >
                    <VuePlyr class="w-full h-[70vh]">
                        <div
                            :data-plyr-embed-id="lesson.yt_url"
                            class="w-full h-[70vh]"
                            data-plyr-provider="youtube"
                        ></div>
                    </VuePlyr>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage, Head, Link } from "@inertiajs/vue3";
import LandingLayout2 from "@/Layouts/LandingLayout2.vue";
import LessonsList from "@/components/Landing/LessonsList.vue";
import { Icon } from "@iconify/vue";
import { onMounted, ref } from "vue";
import VuePlyr from "vue-plyr";
import "vue-plyr/dist/vue-plyr.css";

defineOptions({
    layout: LandingLayout2,
});
const props = defineProps({
    course: Object,
    lesson: Object,
});
const page = usePage();
const locale = page.props.locale;
const dom = ref();
</script>

<style scoped>
::v-deep .plyr--youtube {
    @apply h-[70vh] w-full;
}
</style>
