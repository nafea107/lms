<template>
    <div class="max-w-7xl mx-auto px-3 py-8">
        <Head :title="$t('البودكاست')" />
        <h1 class="text-3xl font-rabar-021 text-center mb-8 text-gray-900">
            {{ $t("البودكاست") }}
        </h1>

        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
        >
            <div
                v-for="podcast in podcasts.data"
                :key="podcast.id"
                class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300"
            >
                <div class="relative h-48 overflow-hidden bg-gradient-to-br from-emerald-400 to-emerald-600">
                    <img
                        v-if="podcast.image"
                        :src="`/storage/${podcast.image}`"
                        :alt="podcast.title[locale]"
                        class="w-full h-full object-cover"
                    />
                    <div
                        v-else
                        class="w-full h-full flex items-center justify-center"
                    >
                        <Icon
                            icon="mdi:podcast"
                            class="w-24 h-24 text-white opacity-80"
                        />
                    </div>
                </div>
                <div class="p-5">
                    <h2 class="text-xl font-rabar-021 mb-3 text-gray-900">
                        {{ podcast.title[locale] }}
                    </h2>
                    
                    <p
                        v-if="podcast.description && podcast.description[locale]"
                        class="text-gray-600 mb-4 line-clamp-3 text-sm"
                    >
                        {{ podcast.description[locale] }}
                    </p>

                    <div v-if="podcast.scheduled_at" class="flex items-center text-gray-500 text-sm mb-4">
                        <Icon icon="mdi:calendar-clock" class="w-5 h-5 me-2" />
                        <span>
                            {{ formatDate(podcast.scheduled_at) }}
                        </span>
                    </div>

                    <a
                        :href="podcast.invitation_url"
                        target="_blank"
                        class="block w-full"
                    >
                        <Button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white">
                            <Icon icon="mdi:video" class="w-5 h-5 me-2" />
                            {{ $t("انضم الآن") }}
                        </Button>
                    </a>
                </div>
            </div>
        </div>

        <div v-if="podcasts.data.length === 0" class="text-center py-12">
            <Icon icon="mdi:podcast" class="w-24 h-24 text-gray-300 mx-auto mb-4" />
            <div class="text-gray-500 text-xl font-rabar-021">
                {{ $t("لا يوجد بودكاست متاح حالياً") }}
            </div>
        </div>

        <!-- Pagination -->
        <div v-if="podcasts.data.length > 0 && (podcasts.prev_page_url || podcasts.next_page_url)" class="mt-8 flex justify-center gap-2">
            <Link
                v-if="podcasts.prev_page_url"
                :href="podcasts.prev_page_url"
                class="px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700"
            >
                {{ $t("السابق") }}
            </Link>
            <Link
                v-if="podcasts.next_page_url"
                :href="podcasts.next_page_url"
                class="px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700"
            >
                {{ $t("التالي") }}
            </Link>
        </div>
    </div>
</template>

<script setup>
import LandingLayout2 from "@/Layouts/LandingLayout2.vue";
import { Head, Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { Button } from "@/components/ui/button";

defineOptions({
    layout: LandingLayout2,
});

const props = defineProps({
    podcasts: Object,
});

const page = usePage();
const locale = page.props.locale;

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString(locale === 'ar' ? 'ar-IQ' : 'ku-IQ', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}
</script>
