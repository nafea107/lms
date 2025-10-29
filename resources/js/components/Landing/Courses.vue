<template>
    <div>
        <div
            class="max-w-7xl mx-auto px-3 flex flex-col justify-center items-center text-center"
        >
            <h1
                :class="{
                    'text-emerald-900': isCoursesPage,
                }"
                class="font-rabar-021 font-medium text-3xl"
                v-text="$t('الكورسات')"
            ></h1>
            <p
                :class="{
                    hidden: isCoursesPage,
                }"
                class="font-rabar-022 text-lg"
                v-text="
                    $t(
                        'تقدم دوراتي مزیجا من المعرفة العمیقة والتطبیق العملي في العلوم'
                    )
                "
            ></p>
            <div class="flex-wrap flex gap-4 place-content-center mt-5 w-full">
                <Link
                    v-for="course in courses"
                    v-show="course.image"
                    :key="course.id"
                    :href="route('landing.courses.show', { course: course.id })"
                >
                    <div class="border rounded overflow-clip bg-white">
                        <h3
                            class="text-gray-900 text-xl font-rabar-022 my-2"
                            v-text="course.name[locale]"
                        ></h3>
                        <img
                            :src="`/storage/${course.image}`"
                            alt=""
                            class="w-64 h-36 object-cover"
                        />
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage, Link } from "@inertiajs/vue3";

const props = defineProps({
    courses: Array,
    isCoursesPage: {
        type: Boolean,
        default: false,
        required: false,
    },
});
const page = usePage();
const locale = page.props.locale;
</script>
