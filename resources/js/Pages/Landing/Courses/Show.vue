<template>
    <div class="px-3 mx-auto max-w-7xl py-5 w-full">
        <Head :title="course.name[locale]" />
        <div class="grid md:grid-cols-3 gap-3">
            <div>
                <LessonsList
                    :chapters="course.chapters"
                    :course="course"
                    :locked="!course.is_subscribed"
                />

                <!-- Instructor Information -->
                <div
                    v-if="course.instructor"
                    class="mt-6 bg-white rounded-lg shadow-md p-4"
                >
                    <h3 class="text-lg font-rabar-021 mb-3">
                        {{ $t("المدرس") }}
                    </h3>
                    <div
                        class="flex items-center space-x-3 rtl:space-x-reverse"
                    >
                        <div class="flex-shrink-0">
                            <img
                                v-if="course.instructor.image"
                                :src="`/storage/${course.instructor.image}`"
                                :alt="course.instructor.name[locale]"
                                class="w-12 h-12 rounded-full object-cover"
                            />
                            <div
                                v-else
                                class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center"
                            >
                                <Icon
                                    icon="mdi:account"
                                    class="w-8 h-8 text-gray-400"
                                />
                            </div>
                        </div>
                        <div>
                            <h4 class="font-rabar-021">
                                {{ course.instructor.name[locale] }}
                            </h4>
                            <p
                                v-if="course.instructor.specialty"
                                class="text-sm text-gray-600"
                            >
                                {{ course.instructor.specialty }}
                            </p>
                            <Link
                                :href="
                                    route('landing.instructors.show', {
                                        slug: course.instructor.slug,
                                    })
                                "
                                class="text-sm text-primary hover:underline mt-1 inline-block"
                            >
                                {{ $t("عرض الملف الشخصي") }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:col-span-2">
                <Link
                    v-if="
                        course.chapters &&
                        course.chapters[0] &&
                        course.chapters[0].lessons &&
                        course.chapters[0].lessons[0]
                    "
                    :href="
                        route('landing.lessons.show', {
                            lesson: course.chapters[0].lessons[0].id,
                        })
                    "
                    class="font-rabar-022 flex items-center gap-2 text-emerald-950 text-base w-full"
                >
                    <div
                        class="h-[70vh] bg-emerald-900 w-full flex justify-center items-center"
                    >
                        <Icon class="text-white text-4xl" icon="bi:play-btn" />
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage, Head, Link } from "@inertiajs/vue3";
import LandingLayout2 from "@/Layouts/LandingLayout2.vue";
import LessonsList from "@/components/Landing/LessonsList.vue";
import { Icon } from "@iconify/vue";

defineOptions({
    layout: LandingLayout2,
});
const props = defineProps({
    course: Object,
});
const page = usePage();
const locale = page.props.locale;
</script>
