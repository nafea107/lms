<template>
    <div>
        <div class="max-w-7xl mx-auto px-3">
            <div class="flex md:flex-row flex-col gap-3 w-full">
                <!-- <div
                    class="flex flex-col items-center md:w-[calc(50%-1rem)] px-3 pb-5"
                >
                    <h1 class="font-rabar-022 text-3xl" v-text="$t('معي')"></h1>
                    <img
                        :src="
                            data.image_2.value
                                ? `/storage/${data.image_2.value}`
                                : '/assets/img/teacher-2.png'
                        "
                        alt="Teacher"
                        class="md:h-56 h-44 max-w-56 object-contain mt-3"
                    />

                    <div class="flex justify-center gap-3 w-full mt-3">
                        <div class="flex flex-col justify-center gap-1">
                            <a
                                :href="`https://facebook.com/${settings?.facebook}`"
                                class="flex gap-1 items-center w-max"
                                target="_blank"
                            >
                                <img
                                    alt="facebook icon"
                                    class="size-4"
                                    src="/assets/img/icons/facebook.svg"
                                />
                                <span
                                    class="text-sm"
                                    v-text="settings?.facebook"
                                ></span>
                            </a>

                            <a
                                :href="`https://www.instagram.com/${settings?.instagram}`"
                                class="flex gap-1 items-center w-max"
                                target="_blank"
                            >
                                <img
                                    alt="instagram icon"
                                    class="size-4"
                                    src="/assets/img/icons/instagram.svg"
                                />
                                <span
                                    class="text-sm"
                                    v-text="settings?.instagram"
                                ></span>
                            </a>
                        </div>

                        <div class="w-0.5 bg-black mx-3"></div>

                        <div class="flex flex-col justify-center gap-1">
                            <a
                                :href="`mailto:${settings?.email}`"
                                class="flex gap-1 items-center w-max"
                                target="_blank"
                            >
                                <img
                                    alt="comment icon"
                                    class="size-4"
                                    src="/assets/img/icons/comment.svg"
                                />
                                <span
                                    class="text-sm"
                                    v-text="settings?.email"
                                ></span>
                            </a>
                            <a
                                :href="`tel:${settings?.whatsapp}`"
                                class="flex gap-1 items-center w-max"
                                target="_blank"
                            >
                                <img
                                    alt="comment icon"
                                    class="size-4"
                                    src="/assets/img/icons/phone-call.svg"
                                />
                                <span
                                    class="text-sm"
                                    v-text="settings?.whatsapp"
                                ></span>
                            </a>
                        </div>
                    </div>
                </div> -->

                <div
                    class="flex flex-col items-center md:w-[calc(50%-0.25rem)] p-3"
                >
                    <h1
                        class="font-rabar-022 text-3xl"
                        v-text="$t('Future Leaders Organization')"
                    ></h1>
                    <img
                        alt="Teacher"
                        class="md:h-56 h-44 max-w-56 object-contain mt-3"
                        src="/assets/img/logo.png"
                    />

                    <div class="flex justify-center gap-3 w-full mt-3">
                        <div class="flex flex-col justify-center gap-1">
                            <a
                                :href="`https://www.facebook.com/`"
                                class="flex gap-1 items-center w-max"
                                target="_blank"
                            >
                                <img
                                    alt="facebook icon"
                                    class="size-4"
                                    src="/assets/img/icons/facebook.svg"
                                />
                                <span class="text-sm">futureleaderskrd</span>
                            </a>

                            <a
                                :href="`https://www.instagram.com/`"
                                class="flex gap-1 items-center w-max"
                                target="_blank"
                            >
                                <img
                                    alt="instagram icon"
                                    class="size-4"
                                    src="/assets/img/icons/instagram.svg"
                                />
                                <span class="text-sm">futureleaderskrd</span>
                            </a>
                        </div>

                        <div class="w-0.5 bg-black mx-3"></div>

                        <div class="flex flex-col justify-center gap-1">
                            <a
                                :href="`tel:07510471658`"
                                class="flex gap-1 items-center w-max"
                                target="_blank"
                            >
                                <img
                                    alt="comment icon"
                                    class="size-4"
                                    src="/assets/img/icons/phone-call.svg"
                                />
                                <span class="text-sm">07510471658</span>
                            </a>
                            <a
                                class="flex gap-1 items-center w-max"
                                href="https://futureleaderskrd.com/"
                                target="_blank"
                            >
                                <img
                                    alt="comment icon"
                                    class="size-4"
                                    src="/assets/img/icons/world-wide-web@4x.svg"
                                />
                                <span class="text-sm"
                                    >futureleaderskrd.com</span
                                >
                            </a>
                        </div>
                    </div>
                </div>

                <div class="w-1 bg-black hidden md:block"></div>

                <Contact />
            </div>
        </div>
        <div class="bg-[#282828]">
            <div class="max-w-7xl mx-auto px-3 py-5">
                <div
                    class="flex md:flex-row flex-col justify-center items-center gap-4"
                >
                    <div class="p-3 md:basis-1/2 flex flex-col items-center">
                        <!-- <h2
                            class="text-5xl font-rabar-021 text-center text-white"
                            v-text="$t('قناتنا على یوتوب')"
                        ></h2> -->
                        <img
                            alt="Future Leaders Organization Logo"
                            class="w-56 mt-12"
                            src="/assets/img/logo.png"
                        />
                        <div class="mt-12 flex flex-wrap gap-2">
                            <a href="tel:07510471658" target="_blank">
                                <img
                                    alt="Future Leaders Organization phone"
                                    class="size-6"
                                    src="/assets/img/icons/light/phone-call@4x.svg"
                                />
                            </a>
                            <a
                                href="https://futureleaderskrd.com/"
                                target="_blank"
                            >
                                <img
                                    alt="Future Leaders Organization site"
                                    class="size-6"
                                    src="/assets/img/icons/light/world-wide-web@4x.png"
                                />
                            </a>
                            <a href="//www.instagram.com/" target="_blank">
                                <img
                                    alt="Future Leaders Organization instagram"
                                    class="size-6"
                                    src="/assets/img/icons/light/instagram@4x.svg"
                                />
                            </a>
                            <a href="https://www.facebook.com/" target="_blank">
                                <img
                                    alt="Future Leaders Organization facebook"
                                    class="size-6"
                                    src="/assets/img/icons/light/facebook@4x.svg"
                                />
                            </a>
                        </div>
                    </div>
                    <div class="px-3 text-white md:basis-1/2">
                        <iframe
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            class="w-full h-72"
                            frameborder="0"
                            height="720"
                            referrerpolicy="strict-origin-when-cross-origin"
                            :src="footerPage?.data?.youtube_url?.value || 'https://www.youtube.com/embed/R0GdXyU18LI'"
                            title="October 27, 2024"
                            width="1280"
                        ></iframe>
                        <h4
                            class="text-xl font-rabar-021 mt-5"
                            v-text="$t('التعریف:-')"
                        ></h4>
                        <h6 class="mt-2" v-text="$t('من نحن:')"></h6>
                        <p
                            v-if="locale === 'ar'"
                            v-text="
                                footerPage?.data?.footer_text_ar?.value ||
                                $t(
                                    'يلا كورس هي منصة تعليمية متكاملة تم إنشاؤها في 15 أغسطس 2024، بهدف تمكين المعلمين من بناء علاماتهم الشخصية وتقديم دورات تعليمية عالية الجودة. نسعى من خلال خدماتنا المتنوعة إلى دعم المعلمين والمدربين في تقديم تجارب تعليمية مميزة للطلاب في مختلف المراحل. بإدارة شاهين راشد، نطمح إلى أن نصبح الوجهة الأولى للمعلمين في مجتمعنا، لتطوير أدواتهم التعليمية وبناء مستقبل مشرق للتعليم'
                                )
                            "
                        ></p>
                        <p
                            v-else-if="locale === 'ku'"
                            v-text="
                                footerPage?.data?.footer_text_ku?.value ||
                                $t(
                                    'یەڵا کۆرس پلاتفۆرمێکی تەواوی فێرکارییە کە لە ١٥ی ئابی ٢٠٢٤ دروستکراوە، بە ئامانجی بەهێزکردنی مامۆستایان لە دروستکردنی برەندی تایبەتی خۆیان و پێشکەشکردنی کۆرسی فێرکاری بەرز. ئێمە هەوڵ دەدەین لە رێگەی خزمەتگوزارییە جۆراوجۆرەکانمانەوە، پشتگیری مامۆستایان و راهێنەران بکەین لە پێشکەشکردنی ئەزموونی فێرکاری تایبەت بە قوتابیان لە قۆناغە جیاوازەکاندا. بە بەڕێوەبردنی شاهین راشد، ئامانجمان ئەوەیە ببینە وێستگەی یەکەمی مامۆستایان لە کۆمەڵگای خۆماندا، بۆ پەرەپێدانی کەرەستەکانی فێرکردن و بنیاتنانی داهاتوویەکی گەش بۆ پەروەردە'
                                )
                            "
                        ></p>
                        <p
                            v-else
                            v-text="
                                footerPage?.data?.footer_text_en?.value ||
                                $t(
                                    'Yalla Course is a comprehensive educational platform created on August 15, 2024, with the goal of empowering teachers to build their personal brands and deliver high-quality educational courses. Through our diverse services, we strive to support teachers and trainers in providing exceptional educational experiences for students at various stages. Under the management of Shaheen Rashid, we aspire to become the first destination for teachers in our community, to develop their educational tools and build a bright future for education.'
                                )
                            "
                        ></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import Contact from "@/components/Landing/Contact.vue";
import { usePage } from "@inertiajs/vue3";

const props = defineProps({
    data: Object,
    page: Object,
    footerPage: Object,
});

const page = usePage();
const locale = page.props.locale;
const settings = ref({});

onMounted(() => {
    axios
        .get(
            route("landing.settings", {
                keys: "email,facebook,instagram,whatsapp",
            })
        )
        .then((res) => (settings.value = res.data));
});
</script>
