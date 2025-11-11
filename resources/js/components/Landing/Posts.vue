<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Section Title -->
        <div class="mb-8">
            <h2 class="text-3xl md:text-4xl font-rabar-021 text-gray-800 border-b-4 border-gray-800 inline-block pb-2">
                {{ $t("Post") }}
            </h2>
        </div>

        <!-- Posts List -->
        <div class="space-y-6">
            <div
                v-for="(post, index) in displayedPosts"
                :key="post.id"
                class="flex flex-col md:flex-row gap-6 bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300"
            >
                <!-- Post Image -->
                <div
                    v-if="post.image"
                    class="md:w-1/3 lg:w-1/4 flex-shrink-0"
                >
                    <img
                        :src="`/storage/${post.image}`"
                        :alt="post.title[locale]"
                        class="w-full h-full object-cover min-h-[200px] md:min-h-[250px]"
                    />
                </div>

                <!-- Post Content -->
                <div class="flex-1 p-6 flex flex-col">
                    <h3 class="text-xl md:text-2xl font-rabar-021 text-gray-800 mb-4">
                        {{ post.title[locale] }}
                    </h3>
                    <div
                        class="text-gray-700 font-rabar-004 leading-relaxed line-clamp-3 mb-4 flex-grow"
                        v-html="getExcerpt(post.content[locale])"
                    ></div>
                    <Link
                        :href="route('landing.posts.show', { post: post.id })"
                        class="inline-flex items-center text-gray-800 hover:text-gray-900 font-rabar-021 font-semibold transition-colors duration-300"
                    >
                        {{ $t("اقرأ المزيد") }}
                        <Icon icon="mdi:arrow-left" class="w-5 h-5 ml-2" />
                    </Link>
                </div>
            </div>
        </div>

        <!-- Show More Button -->
        <div
            v-if="posts.length > displayLimit"
            class="flex justify-center mt-8"
        >
            <button
                @click="toggleShowAll"
                class="bg-gray-800 hover:bg-gray-900 text-white font-rabar-021 px-8 py-3 rounded-full transition-colors duration-300 shadow-md hover:shadow-lg"
            >
                {{ showAll ? $t("عرض أقل") : $t("More") }}
            </button>
        </div>

        <!-- No Posts Message -->
        <div
            v-if="posts.length === 0"
            class="text-center py-12 text-gray-500 font-rabar-021 text-xl"
        >
            {{ $t("لا توجد منشورات حالياً") }}
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";
import { usePage, Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const props = defineProps({
    posts: {
        type: Array,
        default: () => [],
    },
});

const page = usePage();
const locale = page.props.locale;
const showAll = ref(false);
const displayLimit = 2;

const displayedPosts = computed(() => {
    if (showAll.value) {
        return props.posts;
    }
    return props.posts.slice(0, displayLimit);
});

function toggleShowAll() {
    showAll.value = !showAll.value;
}

function getExcerpt(content) {
    if (!content) return "";
    
    // Strip HTML tags for excerpt
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = content;
    const textContent = tempDiv.textContent || tempDiv.innerText || "";
    
    // Limit to 150 characters
    if (textContent.length > 150) {
        return textContent.substring(0, 150) + "...";
    }
    return textContent;
}
</script>

<style scoped>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
