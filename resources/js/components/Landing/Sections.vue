<template>
    <div>
        <div
            class="max-w-7xl mx-auto px-3 flex flex-col justify-center items-center text-center"
        >
            <h1
                class="font-rabar-021 font-medium text-3xl"
                v-text="$t('الأقسام')"
            ></h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5">
                <div
                    v-for="item in sections"
                    :key="item.id"
                    class="hover:bg-emerald-400 transition p-4"
                >
                    <div class="flex justify-center items-center w-full mb-1">
                        <img
                            :alt="item.title"
                            :src="item.img"
                            class="w-24 h-24"
                        />
                    </div>
                    <h2
                        class="font-rabar-021 font-medium text-2xl mt-3"
                        v-text="item.title"
                    ></h2>
                    <p
                        class="font-rabar-022 text-lg font-medium mt-1"
                        v-text="item.description"
                    ></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const sections = [
    {
        img: "/assets/img/sections/1.jpeg",
        title: t("الدروس الاساسي"),
        description:
            "lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.",
    },
    {
        img: "/assets/img/sections/2.png",
        title: t("كورسات عبر الانترنت"),
        description:
            "lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.",
    },
    {
        img: "/assets/img/sections/3.jpeg",
        title: t("التحلیل الاسئلة"),
        description:
            "lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.",
    },
    {
        img: "/assets/img/sections/4.png",
        title: t("التفاعلات"),
        description:
            "lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.",
    },
];
// const sections = [
//     {
//         img: "/assets/img/academic-hat-on-a-textbook-icon-outline-style-vector.svg",
//         title: t("الدروس الاساسي"),
//         description: t(
//             "تغطية شاملة للمفاهيم الأساسية في المواد العلمية، مصممة لتعزيز الفهم وبناء أساس قوي للطلاب."
//         ),
//     },
//     {
//         img: "/assets/img/revision.svg",
//         title: t("المراجعة"),
//         description: t(
//             "مراجعات مكثفة للمنهج تساعد الطلاب على ترسيخ المعلومات والاستعداد للامتحانات بثقة."
//         ),
//     },
//     {
//         img: "/assets/img/analysis.svg",
//         title: t("التحلیل الاسئلة"),
//         description: t(
//             "تفكيك وتحليل الأسئلة المعقدة لتعليم الطلاب كيفية التعامل مع مختلف أنواع التحديات التي قد يواجهونها في الامتحانات."
//         ),
//     },
//     {
//         img: "/assets/img/recommendations.svg",
//         title: t("التوصیات"),
//         description: t(
//             "إرشادات ونصائح عملية لتحسين الأداء الأكاديمي وتطوير استراتيجيات فعّالة لتحقيق النجاح."
//         ),
//     },
// ];
</script>
