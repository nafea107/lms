<template>
    <div>
        <Head :title="book.title[locale]" />
        <div class="max-w-7xl mx-auto px-3 py-8">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Book Cover -->
                <div class="md:col-span-1">
                    <div class="sticky top-8">
                        <div class="aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden shadow-lg">
                            <img
                                v-if="book.cover_image"
                                :src="`/storage/${book.cover_image}`"
                                :alt="book.title[locale]"
                                class="w-full h-full object-cover"
                            />
                            <div v-else class="w-full h-full flex items-center justify-center">
                                <Icon icon="mdi:book" class="w-24 h-24 text-gray-400"/>
                            </div>
                        </div>
                        
                        <!-- Download Button -->
                        <a
                            v-if="book.file_path"
                            :href="`/storage/${book.file_path}`"
                            :download="getFileName(book.file_path)"
                            target="_blank"
                            class="mt-4 w-full flex items-center justify-center gap-2 bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition-colors font-rabar-021"
                        >
                            <Icon icon="mdi:download" class="w-5 h-5"/>
                            {{ $t('تحميل الكتاب') }}
                        </a>
                        
                        <!-- View Online Button (for PDFs) -->
                        <a
                            v-if="book.file_path && book.file_path.endsWith('.pdf')"
                            :href="`/storage/${book.file_path}`"
                            target="_blank"
                            class="mt-2 w-full flex items-center justify-center gap-2 bg-white text-primary border-2 border-primary px-6 py-3 rounded-lg hover:bg-primary/10 transition-colors font-rabar-021"
                        >
                            <Icon icon="mdi:eye" class="w-5 h-5"/>
                            {{ $t('عرض الكتاب') }}
                        </a>
                    </div>
                </div>

                <!-- Book Details -->
                <div class="md:col-span-2">
                    <div class="mb-4">
                        <Link
                            :href="route('landing.library.by-category', { category: book.library_category.id })"
                            class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-primary transition-colors"
                        >
                            <Icon icon="mdi:arrow-right" class="w-4 h-4"/>
                            {{ book.library_category.name[locale] }}
                        </Link>
                    </div>

                    <h1 class="font-rabar-021 font-bold text-3xl md:text-4xl mb-4">
                        {{ book.title[locale] }}
                    </h1>

                    <div v-if="book.author" class="flex items-center gap-2 text-lg text-gray-700 mb-6">
                        <Icon icon="mdi:account-edit" class="w-5 h-5"/>
                        <span class="font-rabar-021">{{ book.author[locale] }}</span>
                    </div>

                    <div v-if="book.description" class="prose prose-lg max-w-none">
                        <h2 class="font-rabar-021 text-2xl font-semibold mb-3">
                            {{ $t('نبذة عن الكتاب') }}
                        </h2>
                        <p class="font-rabar-021 text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ book.description[locale] }}
                        </p>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                        <h3 class="font-rabar-021 text-xl font-semibold mb-4">
                            {{ $t('معلومات إضافية') }}
                        </h3>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <Icon icon="mdi:tag" class="w-5 h-5 text-gray-600"/>
                                <span class="font-rabar-021 text-gray-700">
                                    {{ $t('التصنيف') }}: {{ book.library_category.name[locale] }}
                                </span>
                            </div>
                            <div v-if="book.file_path" class="flex items-center gap-2">
                                <Icon icon="mdi:file-pdf-box" class="w-5 h-5 text-gray-600"/>
                                <span class="font-rabar-021 text-gray-700">
                                    {{ $t('متاح للتحميل') }}
                                </span>
                            </div>
                        </div>
                    </div>
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

defineOptions({
    layout: LandingLayout,
});

const props = defineProps({
    book: Object,
});

const page = usePage();
const locale = page.props.locale;

// Extract filename from path for download attribute
const getFileName = (filePath) => {
    if (!filePath) return '';
    const parts = filePath.split('/');
    return parts[parts.length - 1];
};
</script>
