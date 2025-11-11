<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <Head :title="post.title[locale]" />
        
        <!-- Back Button -->
        <Link
            :href="route('landing.home')"
            class="inline-flex items-center text-gray-600 hover:text-gray-800 mb-6 font-rabar-021"
        >
            <Icon icon="mdi:arrow-right" class="w-5 h-5 mr-2" />
            {{ $t("العودة") }}
        </Link>

        <!-- Post Container -->
        <article class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Post Image -->
            <div v-if="post.image" class="w-full">
                <img
                    :src="`/storage/${post.image}`"
                    :alt="post.title[locale]"
                    class="w-full h-64 md:h-96 object-cover"
                />
            </div>

            <!-- Post Content -->
            <div class="p-6 md:p-8 lg:p-12">
                <!-- Post Title -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-rabar-021 text-gray-800 mb-6">
                    {{ post.title[locale] }}
                </h1>

                <!-- Post Meta -->
                <div class="flex items-center text-gray-500 text-sm mb-8 font-rabar-004">
                    <Icon icon="mdi:calendar" class="w-5 h-5 mr-2" />
                    <span>{{ formatDate(post.created_at) }}</span>
                </div>

                <!-- Post Content -->
                <div
                    class="prose prose-lg max-w-none font-rabar-004 text-gray-700 leading-relaxed"
                    v-html="post.content[locale]"
                ></div>
            </div>
        </article>
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
    post: {
        type: Object,
        required: true,
    },
});

const page = usePage();
const locale = page.props.locale;

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString(locale === 'ar' ? 'ar-SA' : locale === 'ku' ? 'ku-IQ' : 'en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
}
</script>

<style scoped>
/* Ensure rich text content displays properly */
:deep(.prose) {
    color: #374151;
}

:deep(.prose img) {
    border-radius: 0.5rem;
    margin: 1.5rem auto;
    max-width: 100%;
    height: auto;
}

:deep(.prose h1),
:deep(.prose h2),
:deep(.prose h3),
:deep(.prose h4) {
    font-family: 'Rabar-021', sans-serif;
    color: #1f2937;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

:deep(.prose p) {
    margin-bottom: 1rem;
    line-height: 1.75;
}

:deep(.prose ul),
:deep(.prose ol) {
    margin: 1rem 0;
    padding-right: 1.5rem;
}

:deep(.prose a) {
    color: #2563eb;
    text-decoration: underline;
}

:deep(.prose a:hover) {
    color: #1d4ed8;
}

:deep(.prose strong) {
    font-weight: 700;
}

:deep(.prose em) {
    font-style: italic;
}

:deep(.prose blockquote) {
    border-right: 4px solid #e5e7eb;
    padding-right: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6b7280;
}
</style>
