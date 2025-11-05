<template>
    <div>
        <Head :title="$t('المكتبة')" />
        <div class="max-w-7xl mx-auto px-3 py-8">
            <h1 class="font-rabar-021 font-medium text-3xl text-center mb-8">
                {{ $t('المكتبة') }}
            </h1>

            <!-- Categories grid -->
            <div
                v-if="categories.length > 0"
                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4"
            >
                <Link
                    v-for="category in categories"
                    :key="category.id"
                    :href="route('landing.library.by-category', { category: category.id })"
                    class="relative rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 aspect-square flex items-center justify-center p-6"
                    :style="{ backgroundColor: category.color }"
                >
                    <div class="text-center">
                        <h3 class="font-rabar-021 text-white text-xl md:text-2xl font-bold mb-2">
                            {{ category.name[locale] }}
                        </h3>
                        <p class="text-white/90 text-sm">
                            {{ category.books_count }} {{ $t('كتاب') }}
                        </p>
                    </div>
                </Link>
            </div>

            <!-- Empty state -->
            <div v-else class="text-center py-12">
                <div class="text-gray-500 text-xl">
                    {{ $t('لا توجد تصنيفات متاحة') }}
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

defineOptions({
    layout: LandingLayout,
});

const props = defineProps({
    categories: Array,
});

const page = usePage();
const locale = page.props.locale;
</script>
