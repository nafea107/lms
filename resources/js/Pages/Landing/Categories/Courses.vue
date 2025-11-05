<template>
    <div class="my-8 max-w-7xl mx-auto p-3 w-full">
        <Head :title="categoryName" />
        
        <!-- Breadcrumb -->
        <div class="mb-6 flex items-center gap-2 text-sm text-gray-600">
            <Link :href="route('landing.home')" class="hover:text-green-600">
                {{ $t("الرئيسية") }}
            </Link>
            <Icon icon="mdi:chevron-right" class="w-4 h-4" />
            <span class="text-gray-900 font-semibold">{{ categoryName }}</span>
        </div>

        <!-- Category Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                {{ categoryName }}
            </h1>
            <p v-if="data.items.length > 0" class="text-gray-600">
                {{ $t("عدد الدورات") }}: {{ data.total }}
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-4 w-full">
            <div class="lg:flex-grow">
                <div v-if="data.isLoading" class="flex justify-center items-center py-20">
                    <Icon icon="mdi:loading" class="w-12 h-12 animate-spin text-green-600" />
                </div>
                
                <div v-else-if="data.items.length === 0" class="text-center py-20">
                    <Icon icon="mdi:book-off-outline" class="w-20 h-20 mx-auto text-gray-400 mb-4" />
                    <p class="text-xl text-gray-600">{{ $t("لا توجد دورات في هذه الفئة") }}</p>
                </div>
                
                <div v-else>
                    <Courses :isCoursesPage="true" :courses="data.items" />
                    <div class="px-3 mt-4 flex items-center justify-center">
                        <Pagination
                            v-if="data?.total_pages && data?.items?.length > 0"
                            v-model="data.page"
                            :total="data?.total_pages"
                            @update:modelValue="onPageChange"
                        />
                    </div>
                </div>
            </div>

            <LevelsAndCategories
                @onCatagoryChange="onCatagoryChange"
                :selected-catagory="data.category"
                class="lg:max-w-64 w-full"
                :categories="categories"
            />
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import { usePage, useRemember, Head, Link } from "@inertiajs/vue3";
import { onMounted, reactive, ref, computed } from "vue";
import { Icon } from "@iconify/vue";
import Courses from "@/components/Landing/Courses.vue";
import LandingLayout2 from "@/Layouts/LandingLayout2.vue";
import LevelsAndCategories from "@/components/Landing/LevelsAndCategories.vue";
import { Pagination } from "@/components/ui/pagination";

defineOptions({
    layout: LandingLayout2,
});

const props = defineProps({
    category: Object,
    categories: Array,
});

const { t } = useI18n();
const page = usePage();
const locale = page.props.locale;

const categoryName = computed(() => {
    return props.category?.name?.[locale] || "";
});

const data = useRemember(
    {
        page: 1,
        category: props.category?.id || "",
        items: [],
        total: 0,
        total_pages: 1,
        isLoading: true,
        per_page: 12,
    },
    `Pages/Landing/Categories/Courses-${props.category?.id}`
);

function onPageChange(val) {
    data.value.page = val;
    getItems();
}

function onCatagoryChange(event) {
    data.value.category = event;
    data.value.page = 1;
    getItems();
}

async function getItems() {
    data.value.isLoading = true;
    try {
        const response = await axios.get(
            route("landing.categories.courses", {
                category: props.category.id,
                _query: {
                    page: data.value.page,
                    per_page: data.value.per_page,
                },
            })
        );
        const responseData = response.data;
        data.value.items = responseData.data;
        data.value.total = responseData.total;
        data.value.total_pages = responseData.last_page;
    } catch (error) {
        console.error("Error fetching courses:", error);
    } finally {
        data.value.isLoading = false;
    }
}

onMounted(async () => {
    if (data.value.items.length === 0) {
        await getItems();
    }
});
</script>

<style scoped></style>
