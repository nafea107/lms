<template>
    <div class="my-8 max-w-7xl mx-auto p-3">
        <Head :title="$t('كورسات')" />
        <Courses :courses="data.items" />
        <div class="px-3 mt-4 flex items-center justify-center">
            <Pagination
                v-if="
                    !data.isLoading &&
                    data?.total_pages &&
                    data?.items?.length > 0
                "
                v-model="data.page"
                :total="data?.total_pages"
                @update:modelValue="onPageChange"
            />
        </div>
    </div>
</template>
<script setup>
import { useI18n } from "vue-i18n";
import { usePage, useRemember, Head } from "@inertiajs/vue3";
import { onMounted, reactive, ref } from "vue";
import Courses from "@/components/Landing/Courses.vue";
import LandingLayout2 from "@/Layouts/LandingLayout2.vue";
import Pagination from "@/components/Pagination.vue";

defineOptions({
    layout: LandingLayout2,
});
const props = defineProps({
    search: String,
});

const { t } = useI18n();
const page = usePage();
const locale = page.props.locale;
const current_route_params = page.props.current_route_params;
const params = new URLSearchParams(page.url);
const data = useRemember(
    {
        page: params.get("page") ?? 1,
        items: [],
        total_pages: 1,
        isShowMoreBtnShown: true,
        isLoading: true,
    },
    "Pages/Landing/Search"
);

let query = reactive({
    s: current_route_params?.search ?? "",
    page: parseInt(data.value.page),
    per_page: 18,
});

function onPageChange(val) {
    data.page = val;
    query.page = val;
    getItems();
}

async function getItems() {
    data.value.isLoading = true;
    const response = await axios.get(
        route("landing.search.data", {
            _query: query,
        })
    );
    const responseData = response.data;
    data.value.items = responseData.data;
    data.value.total_pages = responseData.total_pages;
    if (responseData.length < 18) {
        data.value.isShowMoreBtnShown = false;
    }
    data.value.isLoading = false;
}

onMounted(async () => {
    if (data.value.items.length === 0) {
        await getItems();
    }
});
</script>

<style scoped></style>
