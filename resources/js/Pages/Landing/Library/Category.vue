<template>
    <div>
        <Head :title="currentCategory.name[locale]" />
        <div class="max-w-7xl mx-auto px-3 py-8">
            <h1 class="font-rabar-021 font-medium text-3xl text-center mb-6">
                {{ currentCategory.name[locale] }}
            </h1>

            <!-- Category filters -->
            <div class="flex flex-wrap gap-4 justify-center mb-8">
                <Link
                    :href="route('landing.library.index')"
                    class="px-4 py-2 rounded-lg transition-colors bg-gray-100 hover:bg-gray-200"
                >
                    {{ $t("جميع التصنيفات") }}
                </Link>
                <Link
                    v-for="category in categories"
                    :key="category.id"
                    :href="route('landing.library.by-category', { category: category.id })"
                    class="px-4 py-2 rounded-lg transition-colors"
                    :class="
                        currentCategory.id === category.id
                            ? 'text-white'
                            : 'bg-gray-100 hover:bg-gray-200'
                    "
                    :style="
                        currentCategory.id === category.id
                            ? { backgroundColor: category.color }
                            : {}
                    "
                >
                    {{ category.name[locale] }}
                </Link>
            </div>

            <!-- Books grid -->
            <div
                v-if="books.data.length > 0"
                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6"
            >
                <Link
                    v-for="book in books.data"
                    :key="book.id"
                    :href="route('landing.library.book.show', { book: book.id })"
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow"
                >
                    <div class="aspect-[3/4] bg-gray-200 relative">
                        <img
                            v-if="book.cover_image"
                            :src="`/storage/${book.cover_image}`"
                            :alt="book.title[locale]"
                            class="w-full h-full object-cover"
                        />
                        <div v-else class="w-full h-full flex items-center justify-center">
                            <Icon icon="mdi:book" class="w-16 h-16 text-gray-400"/>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-rabar-021 text-base font-medium mb-1 line-clamp-2">
                            {{ book.title[locale] }}
                        </h3>
                        <p v-if="book.author" class="text-sm text-gray-600 line-clamp-1">
                            {{ book.author[locale] }}
                        </p>
                    </div>
                </Link>
            </div>

            <!-- Empty state -->
            <div v-else class="text-center py-12">
                <div class="text-gray-500 text-xl">
                    {{ $t("لا توجد كتب في هذا التصنيف") }}
                </div>
            </div>

            <!-- Pagination -->
            <div
                v-if="books.data.length > 0"
                class="mt-8 flex justify-center"
            >
                <nav class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span v-for="(link, i) in books.links" :key="i">
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
                                        ? 'text-white'
                                        : 'bg-gray-100 hover:bg-gray-200'
                                "
                                :style="
                                    link.active
                                        ? { backgroundColor: currentCategory.color }
                                        : {}
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
    books: Object,
    currentCategory: Object,
    categories: Array,
});

const page = usePage();
const locale = page.props.locale;
</script>
