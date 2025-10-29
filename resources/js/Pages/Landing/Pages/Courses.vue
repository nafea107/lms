<template>
    <div class="my-8 max-w-7xl mx-auto p-3 w-full">
        <Head :title="$t('كورسات')" />
        <div class="flex flex-col lg:flex-row gap-4 w-full">
            <div class="lg:flex-grow">
                <Courses :isCoursesPage="true" :courses="data.items" />
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

            <LevelsAndCategories
                @onLevelChange="onLevelChange"
                @onCatagoryChange="onCatagoryChange"
                :selected-catagory="data.category"
                :selected-level="data.level"
                class="lg:max-w-64 w-full"
                :levels="levels"
                :categories="categories"
            />

            <div class="lg:max-w-80">
                <img
                    src="/assets/img/courses.png"
                    alt="courses vector"
                    class="mx-auto block"
                />
                <h5
                    v-text="$t('كورساتي')"
                    class="text-xl text-center font-rabar-021 text-emerald-900 mt-3"
                ></h5>
                <p
                    class="text-center mt-4 font-rabar-022 leading-6"
                    v-text="
                        locale === 'ar'
                            ? page.props.page?.data?.courses_description
                                  ?.value ||
                              $t(
                                  'كورساتي في العلوم تم تصميمها بعناية لتلبية جميع احتياجات الطلاب، بدءًا من المفاهيم الأساسية وحتى التطبيقات المتقدمة. سواء كنت تسعى لتعزيز فهمك للفيزياء، الكيمياء، أو الأحياء، ستجد في هذه الدورات كل ما تحتاجه لتحقيق التفوق الأكاديمي. أسعى من خلال هذه الكورسات لتوفير محتوى تعليمي شامل وعملي، يمكّن الطلاب من بناء أساس قوي يساعدهم على النجاح في دراستهم وتحقيق أهدافهم المستقبلية. معًا، نصنع طريق النجاح خطوة بخطوة.'
                              )
                            : page.props.page?.data?.courses_description_ku
                                  ?.value ||
                              $t(
                                  'کۆرسەکانم لە زانستدا بە وردی دیزاین کراون بۆ پڕکردنەوەی هەموو پێداویستیەکانی قوتابیان، لە چەمکە بنەڕەتیەکانەوە بگرە تا جێبەجێکردنە پێشکەوتووەکان. ئەگەر هەوڵ دەدەیت بۆ بەهێزکردنی تێگەیشتنت لە فیزیا، کیمیا، یان زیندەوەرزانی، لەم کۆرسانەدا هەموو ئەوەی پێویستتە بۆ بەدەستهێنانی سەرکەوتنی ئەکادیمی دەدۆزیتەوە. هەوڵ دەدەم لە ڕێگەی ئەم کۆرسانەوە ناوەرۆکی فێرکاری گشتگیر و پراکتیکی دابین بکەم، کە قوتابیان بەهێز دەکات بنچینەیەکی بەهێز دروست بکەن کە یارمەتیان دەدات لە خوێندن و بەدیهێنانی ئامانجەکانی داهاتوویان سەرکەوتوو بن. پێکەوە، ڕێگای سەرکەوتن دروست دەکەین هەنگاو بە هەنگاو.'
                              )
                    "
                ></p>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useI18n } from "vue-i18n";
import { usePage, useRemember, Head } from "@inertiajs/vue3";
import { onMounted, reactive, ref } from "vue";
import Courses from "@/components/Landing/Courses.vue";
import LandingLayout2 from "@/Layouts/LandingLayout2.vue";

defineOptions({
    layout: LandingLayout2,
});
const props = defineProps({
    search: String,
    levels: Array,
    categories: Array,
    page: Object,
    footerPage: Object,
});

const { t } = useI18n();
const page = usePage();
const locale = page.props.locale;
const current_route_params = page.props.current_route_params;
const params = new URLSearchParams(page.url);
const data = useRemember(
    {
        page: params.get("page") ?? 1,
        level: params.get("level") ?? "",
        category: params.get("category") ?? "",
        items: [],
        total_pages: 1,
        isShowMoreBtnShown: true,
        isLoading: true,
        s: current_route_params?.search ?? "",
        per_page: 18,
    },
    "Pages/Landing/Search"
);

function onPageChange(val) {
    data.value.page = val;
    getItems();
}
function onLevelChange(event) {
    data.value.level = event;
    getItems();
}
function onCatagoryChange(event) {
    data.value.category = event;
    getItems();
}

async function getItems() {
    data.value.isLoading = true;
    const response = await axios.get(
        route("landing.search.data", {
            _query: {
                s: data.value.s,
                page: data.value.page,
                per_page: data.value.per_page,
                level: data.value.level,
                category: data.value.category,
            },
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
