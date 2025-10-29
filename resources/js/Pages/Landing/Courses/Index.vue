<template>
    <div>
        <Head :title="$t('الكورسات')" />
        <div class="max-w-7xl mx-auto px-3 py-8">
            <h1 class="font-rabar-021 font-medium text-3xl text-center mb-6">
                {{
                    currentSubject
                        ? currentSubject.name[locale]
                        : $t("جميع الكورسات")
                }}
            </h1>

            <!-- Subject filters -->
            <div class="flex flex-wrap gap-4 justify-center mb-8">
                <Link
                    :href="route('landing.courses')"
                    class="px-4 py-2 rounded-lg transition-colors"
                    :class="
                        !currentSubject
                            ? 'bg-primary text-white'
                            : 'bg-gray-100 hover:bg-gray-200'
                    "
                >
                    {{ $t("الكل") }}
                </Link>
                <Link
                    v-for="subject in subjects"
                    :key="subject.id"
                    :href="
                        route('landing.courses.by-subject', {
                            subject: subject.id,
                        })
                    "
                    class="px-4 py-2 rounded-lg transition-colors"
                    :class="
                        currentSubject && currentSubject.id === subject.id
                            ? 'text-white'
                            : 'bg-gray-100 hover:bg-gray-200'
                    "
                    :style="
                        currentSubject && currentSubject.id === subject.id
                            ? { backgroundColor: subject.background }
                            : {}
                    "
                >
                    {{ subject.name[locale] }}
                </Link>
            </div>

            <!-- Courses grid -->
            <div
                v-if="courses.data.length > 0"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
            >
                <div
                    v-for="course in courses.data"
                    :key="course.id"
                    class="bg-white rounded-lg shadow-md overflow-hidden"
                >
                    <Link
                        :href="
                            route('landing.courses.show', { course: course.id })
                        "
                    >
                        <img
                            :src="`/storage/${course.image}`"
                            :alt="course.name[locale]"
                            class="w-full h-48 object-cover"
                        />
                        <div class="p-4">
                            <h3 class="font-rabar-021 text-lg font-medium mb-2">
                                {{ course.name[locale] }}
                            </h3>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-600">{{
                                        course.category.name[locale]
                                    }}</span>
                                </div>
                                <div class="text-primary font-medium">
                                    {{
                                        course.price > 0
                                            ? `IQD ${course.price}`
                                            : $t("مجاني")
                                    }}
                                </div>
                            </div>
                            <div
                                v-if="course.instructor"
                                class="mt-2 flex items-center text-sm text-gray-600"
                            >
                                <Icon icon="mdi:account" class="w-4 h-4 mr-1" />
                                <span>{{
                                    course.instructor.name[locale]
                                }}</span>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>

            <!-- Empty state -->
            <div v-else class="text-center py-12">
                <div class="text-gray-500 text-xl">
                    {{ $t("لا توجد كورسات متاحة") }}
                </div>
            </div>

            <!-- Pagination -->
            <div
                v-if="courses.data.length > 0"
                class="mt-8 flex justify-center"
            >
                <nav class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span v-for="(link, i) in courses.links" :key="i">
                            <Link
                                v-if="
                                    link.url &&
                                    !link.label.includes('Previous') &&
                                    !link.label.includes('Next')
                                "
                                :href="link.url"
                                class="px-4 py-2 rounded-md transition-colors"
                                v-html="link.label"
                                :class="
                                    link.active
                                        ? 'bg-primary text-white'
                                        : 'bg-gray-100 hover:bg-gray-200'
                                "
                            >
                            </Link>
                        </span>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

defineOptions({
    layout: LandingLayout,
});

const props = defineProps({
    courses: Object,
    subjects: Array,
    currentSubject: Object,
});

const page = usePage();
const locale = page.props.locale;
</script>
