<template>
    <div>
        <Head :title="$t('الاقسام')" />
        <div class="py-5 px-3 max-w-7xl mx-auto w-full">
            <div>
                <h2
                    class="text-2xl mb-3 underline-offset-4 underline text-center font-rabar-021 text-emerald-950"
                >
                    {{ $t("الٲقسام") }}
                </h2>
                <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-4">
                    <div
                        v-for="(category, ci) in categories"
                        :key="`category-${ci}`"
                        class="p-3 bg-[#697565] text-white"
                    >
                        <h6
                            class="text-center underline-offset-8 underline font-rabar-021"
                            v-text="category.title"
                        ></h6>
                        <p class="mt-3" v-text="category.details"></p>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <h2
                    class="text-2xl mb-3 underline-offset-4 underline text-center font-rabar-021 text-emerald-950"
                >
                    {{ $t("خدماتي") }}
                </h2>
                <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-4">
                    <div
                        v-for="(service, si) in services"
                        :key="`service-${si}`"
                        class="p-3 bg-[#56896d] text-white"
                    >
                        <h6
                            class="text-center underline-offset-8 underline font-rabar-021"
                            v-text="service.title"
                        ></h6>
                        <img
                            :alt="service.title"
                            :src="service.image"
                            class="h-24 block mx-auto mt-3"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { useI18n } from "vue-i18n";
import LandingLayout2 from "@/Layouts/LandingLayout2.vue";

defineOptions({
    layout: LandingLayout2,
});
const props = defineProps({
    page: Object,
});

const page = usePage();
const locale = page.props.locale;
const { t } = useI18n();
const categories = [
    {
        title: t("کورسات المباشر"),
        details: t(
            "جلسات تعليمية حية تتم إما في الفصول الدراسية أو عبر الإنترنت باستخدام منصات الفيديو. يتيح هذا النوع من الكورسات للطلاب فرصة التفاعل المباشر مع المعلم."
        ),
    },
    {
        title: t("كورسات عبر الٳنترنیت"),
        details: t(
            "دورات مسجلة مسبقًا تتيح للطلاب مرونة التعلم في أي وقت يناسبهم. يتضمن هذا القسم مواد تعليمية شاملة تغطي المفاهيم العلمية الأساسية والمتقدمة."
        ),
    },
    {
        title: t("الكتب"),
        details: t(
            "قسم مخصص للكتب والمراجع التي تساعد الطلاب على تعزيز فهمهم للمواد. يحتوي على مصادر تعليمية موثوقة تغطي مجموعة واسعة من المواضيع العلمية."
        ),
    },
    {
        title: t("التفاعلات"),
        details: t(
            "مساحة تفاعلية مخصصة للنقاشات والأسئلة بين الطلاب والمعلم، تهدف إلى تعزيز الفهم العميق للمفاهيم العلمية. يمكن للطلاب طرح استفساراتهم ومشاركة أفكارهم."
        ),
    },
];

const services = [
    {
        title: t("دروس خصوصية"),
        image: "/assets/img/services/lesson@4x.png",
    },
    {
        title: t("استشارات تعليمية"),
        image: "/assets/img/services/consulting@4x.png",
    },
    {
        title: t("مراجعات واختبارات دورية"),
        image: "/assets/img/services/test@4x.png",
    },
    {
        title: t("مشاريع وتطبيقات عملية"),
        image: "/assets/img/services/daily-routine@4x.png",
    },
];
</script>
