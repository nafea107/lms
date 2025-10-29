<template>
    <div class="max-w-7xl mx-auto px-3 py-8">
        <Head :title="instructor.name[locale]" />

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="md:flex">
                <!-- Instructor Image and Basic Info -->
                <div class="md:w-1/3 p-6">
                    <div
                        class="relative h-64 md:h-80 overflow-hidden rounded-lg mb-4"
                    >
                        <img
                            v-if="instructor.image"
                            :src="`/storage/${instructor.image}`"
                            :alt="instructor.name[locale]"
                            class="w-full h-full object-cover"
                        />
                        <div
                            v-else
                            class="w-full h-full bg-gray-200 flex items-center justify-center"
                        >
                            <Icon
                                icon="mdi:account"
                                class="w-24 h-24 text-gray-400"
                            />
                        </div>
                    </div>

                    <h1 class="text-2xl font-rabar-021 mb-2">
                        {{ instructor.name[locale] }}
                    </h1>
                    <p v-if="instructor.specialty" class="text-gray-600 mb-4">
                        {{ instructor.specialty }}
                    </p>

                    <div class="space-y-3">
                        <div v-if="instructor.email" class="flex items-center">
                            <Icon
                                icon="mdi:email"
                                class="w-5 h-5 text-gray-600 mr-2"
                            />
                            <a
                                :href="`mailto:${instructor.email}`"
                                class="text-blue-600 hover:underline"
                                >{{ instructor.email }}</a
                            >
                        </div>
                        <div v-if="instructor.phone" class="flex items-center">
                            <Icon
                                icon="mdi:phone"
                                class="w-5 h-5 text-gray-600 mr-2"
                            />
                            <a
                                :href="`tel:${instructor.phone}`"
                                class="text-blue-600 hover:underline"
                                >{{ instructor.phone }}</a
                            >
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-4 rtl:space-x-reverse">
                        <a
                            v-if="instructor.facebook_url"
                            :href="instructor.facebook_url"
                            target="_blank"
                            class="text-blue-600 hover:text-blue-800"
                        >
                            <Icon icon="mdi:facebook" class="w-6 h-6" />
                        </a>
                        <a
                            v-if="instructor.twitter_url"
                            :href="instructor.twitter_url"
                            target="_blank"
                            class="text-blue-400 hover:text-blue-600"
                        >
                            <Icon icon="mdi:twitter" class="w-6 h-6" />
                        </a>
                        <a
                            v-if="instructor.linkedin_url"
                            :href="instructor.linkedin_url"
                            target="_blank"
                            class="text-blue-700 hover:text-blue-900"
                        >
                            <Icon icon="mdi:linkedin" class="w-6 h-6" />
                        </a>
                        <a
                            v-if="instructor.instagram_url"
                            :href="instructor.instagram_url"
                            target="_blank"
                            class="text-pink-600 hover:text-pink-800"
                        >
                            <Icon icon="mdi:instagram" class="w-6 h-6" />
                        </a>
                    </div>
                </div>

                <!-- Instructor Bio and Details -->
                <div class="md:w-2/3 p-6 border-t md:border-t-0 md:border-r">
                    <Tabs defaultValue="bio" class="w-full">
                        <TabsList class="grid w-full grid-cols-3">
                            <TabsTrigger value="bio">{{
                                $t("السيرة الذاتية")
                            }}</TabsTrigger>
                            <TabsTrigger value="qualifications">{{
                                $t("المؤهلات العلمية")
                            }}</TabsTrigger>
                            <TabsTrigger value="experience">{{
                                $t("الخبرات العملية")
                            }}</TabsTrigger>
                        </TabsList>

                        <TabsContent value="bio" class="mt-4">
                            <div
                                v-if="instructor.bio && instructor.bio[locale]"
                                class="prose max-w-none"
                            >
                                <p>{{ instructor.bio[locale] }}</p>
                            </div>
                            <div v-else class="text-gray-500 italic">
                                {{ $t("لا توجد معلومات متاحة") }}
                            </div>
                        </TabsContent>

                        <TabsContent value="qualifications" class="mt-4">
                            <div
                                v-if="
                                    instructor.qualifications &&
                                    instructor.qualifications[locale]
                                "
                                class="prose max-w-none"
                            >
                                <p>{{ instructor.qualifications[locale] }}</p>
                            </div>
                            <div v-else class="text-gray-500 italic">
                                {{ $t("لا توجد معلومات متاحة") }}
                            </div>
                        </TabsContent>

                        <TabsContent value="experience" class="mt-4">
                            <div
                                v-if="
                                    instructor.experience &&
                                    instructor.experience[locale]
                                "
                                class="prose max-w-none"
                            >
                                <p>{{ instructor.experience[locale] }}</p>
                            </div>
                            <div v-else class="text-gray-500 italic">
                                {{ $t("لا توجد معلومات متاحة") }}
                            </div>
                        </TabsContent>
                    </Tabs>
                </div>
            </div>
        </div>

        <!-- Instructor Courses -->
        <div class="mt-12">
            <h2 class="text-2xl font-rabar-021 mb-6">{{ $t("الكورسات") }}</h2>

            <div
                v-if="courses.length > 0"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
            >
                <div
                    v-for="course in courses"
                    :key="course.id"
                    class="bg-white rounded-lg shadow-md overflow-hidden"
                >
                    <Link
                        :href="
                            route('landing.courses.show', { course: course.id })
                        "
                    >
                        <img
                            v-if="course.image"
                            :src="`/storage/${course.image}`"
                            :alt="course.name[locale]"
                            class="w-full h-48 object-cover"
                        />
                        <div class="p-4">
                            <h3 class="text-lg font-rabar-021 mb-2">
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
                        </div>
                    </Link>
                </div>
            </div>

            <div v-else class="text-center py-8 bg-gray-50 rounded-lg">
                <Icon
                    icon="mdi:book-open-page-variant"
                    class="w-12 h-12 text-gray-400 mx-auto mb-2"
                />
                <div class="text-gray-500">
                    {{ $t("لا توجد كورسات متاحة لهذا المدرس") }}
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";

defineOptions({
    layout: LandingLayout,
});

const props = defineProps({
    instructor: Object,
    courses: Array,
});

const page = usePage();
const locale = page.props.locale;
</script>
