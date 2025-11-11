<template>
    <div class="bg-gray-50 min-h-screen">
        <Head :title="podcast.title[locale]" />

        <div class="bg-gradient-to-r from-green-600 to-green-500 text-white py-10">
            <div class="max-w-7xl mx-auto px-4">
                <h1 class="text-3xl font-bold">{{ podcast.title[locale] }}</h1>
                <p v-if="podcast.description && podcast.description[locale]" class="opacity-90 mt-2">
                    {{ podcast.description[locale] }}
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="w-full" style="height: 70vh;">
                    <iframe
                        v-if="podcast.invitation_url"
                        :src="podcast.invitation_url"
                        class="w-full h-full border-0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        loading="lazy"
                    ></iframe>
                    <div v-else class="p-6 text-center text-gray-600">
                        <p class="mb-4">{{ $t('رابط البث غير متوفر حالياً') }}</p>
                    </div>
                </div>
                <div v-if="podcast.invitation_url" class="p-4 bg-gray-50 text-center">
                    <a :href="podcast.invitation_url" target="_blank" rel="noopener" class="text-green-700 font-semibold hover:underline">
                        {{ $t('فتح في تبويب جديد في حال لم يظهر الإطار') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";

defineOptions({
    layout: LandingLayout,
});

const props = defineProps({
    podcast: Object,
});

const page = usePage();
const locale = page.props.locale;
</script>
