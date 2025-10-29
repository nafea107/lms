<template>
    <div class="max-w-7xl mx-auto px-3 py-8">
        <Head :title="$t('المعلمين')" />
        <h1 class="text-3xl font-rabar-021 text-center mb-8">
            {{ $t("المعلمين") }}
        </h1>

        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
        >
            <div
                v-for="instructor in instructors"
                :key="instructor.id"
                class="bg-white rounded-lg shadow-md overflow-hidden"
            >
                <Link
                    :href="
                        route('landing.instructors.show', {
                            slug: instructor.slug,
                        })
                    "
                >
                    <div class="relative h-64 overflow-hidden">
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
                    <div class="p-4">
                        <h2 class="text-xl font-rabar-021 mb-2">
                            {{ instructor.name[locale] }}
                        </h2>
                        <p
                            v-if="instructor.specialty"
                            class="text-gray-600 mb-3"
                        >
                            {{ instructor.specialty }}
                        </p>
                        <p
                            v-if="instructor.bio && instructor.bio[locale]"
                            class="text-gray-700 line-clamp-3"
                        >
                            {{ instructor.bio[locale] }}
                        </p>

                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex space-x-2 rtl:space-x-reverse">
                                <a
                                    v-if="instructor.facebook_url"
                                    :href="instructor.facebook_url"
                                    target="_blank"
                                    class="text-blue-600 hover:text-blue-800"
                                >
                                    <Icon icon="mdi:facebook" class="w-5 h-5" />
                                </a>
                                <a
                                    v-if="instructor.twitter_url"
                                    :href="instructor.twitter_url"
                                    target="_blank"
                                    class="text-blue-400 hover:text-blue-600"
                                >
                                    <Icon icon="mdi:twitter" class="w-5 h-5" />
                                </a>
                                <a
                                    v-if="instructor.linkedin_url"
                                    :href="instructor.linkedin_url"
                                    target="_blank"
                                    class="text-blue-700 hover:text-blue-900"
                                >
                                    <Icon icon="mdi:linkedin" class="w-5 h-5" />
                                </a>
                                <a
                                    v-if="instructor.instagram_url"
                                    :href="instructor.instagram_url"
                                    target="_blank"
                                    class="text-pink-600 hover:text-pink-800"
                                >
                                    <Icon
                                        icon="mdi:instagram"
                                        class="w-5 h-5"
                                    />
                                </a>
                            </div>

                            <Button variant="outline" size="sm">
                                {{ $t("عرض الملف الشخصي") }}
                            </Button>
                        </div>
                    </div>
                </Link>
            </div>
        </div>

        <div v-if="instructors.length === 0" class="text-center py-12">
            <div class="text-gray-500 text-xl">
                {{ $t("لا يوجد مدرسين متاحين حالياً") }}
            </div>
        </div>
    </div>
</template>

<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { Button } from "@/components/ui/button";

defineOptions({
    layout: LandingLayout,
});

const props = defineProps({
    instructors: Array,
});

const page = usePage();
const locale = page.props.locale;
</script>
