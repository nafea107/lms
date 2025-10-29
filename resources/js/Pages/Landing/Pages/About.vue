<template>
    <div>
        <Head :title="$t('المدرب')" />
        <div class="py-8 px-3 max-w-7xl mx-auto w-full">
            <div
                class="md:grid md:grid-cols-3 md:space-y-0 space-y-4 items-center"
            >
                <div
                    ref="description"
                    class="border border-emerald-950 border-l-0 border-t-0 p-3"
                >
                    <h1
                        class="font-rabar-021 text-emerald-900 text-3xl text-center"
                    >
                        {{ $t("وصف") }}
                    </h1>
                    <div class="mt-4">
                        <p
                            class="leading-10 font-rabar-022 text-lg"
                            v-text="
                                locale === 'ar'
                                    ? page.props.page.data?.description
                                          ?.value ||
                                      $t(
                                          'يلا كورس هو أكثر من مجرد منصة تعليمية؛ إنه جسر يربط بين المعلمين الطموحين والطلاب الباحثين عن المعرفة. تم تصميمه ليكون الوجهة الأمثل للمعلمين الذين يرغبون في تطوير علاماتهم الشخصية وبناء محتوى تعليمي مبتكر يصل لكل طالب في أي مكان. من خلال يلا كورس، نفتح أبوابًا جديدة للتعلم، ونمكّن المعلمين من مشاركة رسالتهم التعليمية عبر أدوات تكنولوجية متقدمة تضمن لهم التميز والتأثير. هنا، يجتمع الشغف بالتعليم مع الاحترافية، ليصنعوا مستقبلًا مليئًا بالفرص والإبداع.'
                                      )
                                    : page.props.page.data?.description_ku
                                          ?.value ||
                                      $t(
                                          'یەڵا کۆرس زیاترە لە پلاتفۆڕمێکی فێرکاری؛ ئەو پردێکە کە مامۆستایانی پڕ ئارەزوو و قوتابیانی بەدوای زانیندا دەگەڕێن پێکەوە دەبەستێتەوە. دیزاین کراوە بۆ ئەوەی ببێتە باشترین مەبەست بۆ ئەو مامۆستایانەی کە دەیانەوێت براندی کەسیی خۆیان پەرەپێبدەن و ناوەڕۆکی فێرکاری داهێنەرانە بنیات بنێن. لە ڕێگەی یەڵا کۆرسەوە، دەرگای نوێی فێربوون دەکەینەوە و مامۆستایان بەهێز دەکەین بۆ هاوبەشکردنی پەیامی فێرکارییان لە ڕێگەی ئامرازە تەکنۆلۆژییە پێشکەوتووەکانەوە کە جیاوازی و کاریگەرییان بۆ دەستەبەر دەکات. لێرەدا، شەیدایی فێرکردن لەگەڵ پیشەگەرییدا کۆدەبێتەوە، بۆ دروستکردنی داهاتوویەکی پڕ لە هەل و داهێنان.'
                                      )
                            "
                        ></p>
                    </div>
                </div>

                <div class="">
                    <img
                        alt=""
                        class="max-w-md w-full block mx-auto"
                        src="/assets/img/about.png"
                    />
                </div>

                <div>
                    <div
                        ref="goal"
                        class="border border-emerald-950 border-r-0 border-t-0 p-3"
                    >
                        <h1
                            class="font-rabar-021 text-emerald-900 text-3xl text-center"
                        >
                            {{ $t("هدفنا") }}
                        </h1>
                        <div class="mt-4">
                            <p
                                class="leading-10 font-rabar-022 text-lg"
                                v-text="
                                    locale === 'ar'
                                        ? page.props.page.data?.goal?.value ||
                                          $t(
                                              'هدفنا في يلا كورس هو أن نكون الحافز الذي يحوّل أحلام المعلمين إلى واقع ملموس، وأن نساعدهم في نشر رسالتهم التعليمية للعالم. نؤمن بأن كل معلم يستحق منصة تتيح له أن يبدع ويصل إلى طلابه بأفضل الطرق الممكنة. نطمح إلى بناء مجتمع تعليمي يزدهر فيه الإبداع والتواصل، حيث يصبح كل معلم قائدًا وكل طالب مؤثرًا، معًا نصنع غدًا أكثر إشراقًا وأثرًا في عالم التعليم.'
                                          )
                                        : page.props.page.data?.goal_ku
                                              ?.value ||
                                          $t(
                                              'ئامانجی ئێمە لە یەڵا کۆرس ئەوەیە کە ببینە ئەو هاندەرەی کە خەونەکانی مامۆستایان دەکاتە ڕاستی بەرجەستە، و یارمەتیان بدەین لە بڵاوکردنەوەی پەیامی فێرکارییان بۆ جیهان. ئێمە بڕوامان وایە کە هەموو مامۆستایەک شایانی پلاتفۆرمێکە کە ڕێگەی پێ بدات داهێنان بکات و بە باشترین ڕێگای مومکین بگاتە قوتابیەکانی. ئێمە ئارەزوو دەکەین کۆمەڵگایەکی فێرکاری بنیات بنێین کە داهێنان و پەیوەندی تێیدا گەشە بکات، کە تێیدا هەموو مامۆستایەک دەبێتە ڕابەر و هەموو قوتابییەک کاریگەر، پێکەوە سبەینێیەکی ڕووناکتر و کاریگەرتر لە جیهانی پەروەردەدا دروست دەکەین.'
                                          )
                                "
                            ></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:grid-cols-3 grid w-full mt-2 gap-4">
                <div class="md:col-start-2">
                    <img
                        alt=""
                        class="max-w-44 w-full block mx-auto mt-5"
                        src="/assets/img/yallacourse-green.png"
                    />
                </div>
                <div class="flex gap-2 md:col-start-3 justify-center">
                    <a :href="`https://wa.me/${whatsapp}`" target="_blank">
                        <Icon
                            class="text-3xl text-emerald-950"
                            icon="ic:baseline-whatsapp"
                        />
                    </a>

                    <a
                        :href="`https://facebook.com/yalla.course`"
                        target="_blank"
                    >
                        <Icon
                            class="text-3xl text-emerald-950"
                            icon="lucide:facebook"
                        />
                    </a>

                    <a :href="`tel:${whatsapp}`" target="_blank">
                        <Icon
                            class="text-3xl text-emerald-950"
                            icon="mdi-light:phone"
                        />
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
    <script setup>
        import { Head, usePage } from "@inertiajs/vue3";
        import { Icon } from "@iconify/vue";
        import { onMounted, onUnmounted, ref } from "vue";
        import LandingLayout2 from "@/Layouts/LandingLayout2.vue";

        defineOptions({
            layout: LandingLayout2,
        });

        const props = defineProps({
            page: Object,
            whatsapp: String,
        });

        const page = usePage();
        const locale = page.props.locale;

        const description = ref();
        const goal = ref();

        function setGoalHeight() {
            goal.value.style.height = `${description.value.offsetHeight}px`;
        }

        // onMounted(() => {
        //     setGoalHeight();
        //     window.addEventListener("resize", setGoalHeight);
        // });
        // onUnmounted(() => {
        //     window.removeEventListener("resize", setGoalHeight);
        // });
    </script>
</template>
