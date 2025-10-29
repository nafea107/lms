<template>
    <div class="bg-gray-50 min-h-screen">
        <Head :title="$t('البودكاست')" />
        
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-green-600 to-green-500 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h1 class="text-4xl font-bold mb-4">
                    {{ $t("البودكاست") }}
                </h1>
                <p class="text-lg opacity-90">
                    {{ $t("استمع إلى أحدث حلقات البودكاست التعليمية") }}
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-12">
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
            >
                <div
                    v-for="podcast in podcasts.data"
                    :key="podcast.id"
                    class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div class="relative h-56 overflow-hidden bg-gradient-to-br from-green-400 to-green-600">
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
                                class="w-32 h-32 text-white opacity-80"
                            />
                        </div>
                        <!-- Overlay Badge -->
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                            <span class="text-green-600 font-semibold text-sm">{{ $t("بودكاست") }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-3 text-gray-900 line-clamp-2">
                            {{ podcast.title[locale] }}
                        </h2>
                        
                        <p
                            v-if="podcast.description && podcast.description[locale]"
                            class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed"
                        >
                            {{ podcast.description[locale] }}
                        </p>

                        <div v-if="podcast.scheduled_at" class="flex items-center text-gray-500 text-sm mb-5 bg-gray-50 p-3 rounded-lg">
                            <Icon icon="mdi:calendar-clock" class="w-5 h-5 me-2 text-green-600" />
                            <span>
                                {{ formatDate(podcast.scheduled_at) }}
                            </span>
                        </div>

                        <a
                            :href="podcast.invitation_url"
                            target="_blank"
                            class="block w-full"
                        >
                            <Button class="w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-semibold py-3 rounded-lg shadow-md hover:shadow-lg transition-all">
                                <Icon icon="mdi:video" class="w-5 h-5 me-2" />
                                {{ $t("انضم الآن") }}
                            </Button>
                        </a>
                    </div>
                </div>
            </div>

            <div v-if="podcasts.data.length === 0" class="text-center py-20">
                <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                    <Icon icon="mdi:podcast" class="w-32 h-32 text-gray-300 mx-auto mb-6" />
                    <div class="text-gray-600 text-xl font-semibold">
                        {{ $t("لا يوجد بودكاست متاح حالياً") }}
                    </div>
                    <p class="text-gray-500 mt-2">
                        {{ $t("تحقق مرة أخرى قريباً للحصول على محتوى جديد") }}
                    </p>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="podcasts.data.length > 0 && (podcasts.prev_page_url || podcasts.next_page_url)" class="mt-12 flex justify-center gap-3">
                <Link
                    v-if="podcasts.prev_page_url"
                    :href="podcasts.prev_page_url"
                    class="px-6 py-3 bg-white text-green-600 border-2 border-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-all font-semibold shadow-md"
                >
                    {{ $t("السابق") }}
                </Link>
                <Link
                    v-if="podcasts.next_page_url"
                    :href="podcasts.next_page_url"
                    class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg hover:from-green-700 hover:to-green-600 transition-all font-semibold shadow-md"
                >
                    {{ $t("التالي") }}
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import PodcastLayout from "@/Layouts/PodcastLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { Button } from "@/components/ui/button";

defineOptions({
    layout: PodcastLayout,
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
