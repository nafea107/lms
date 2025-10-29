<template>
    <div class="px-3 mx-auto max-w-7xl py-5 w-full">
        <Head :title="course.name[locale]" />
        <div class="flex gap-4 flex-col lg:flex-row w-full">
            <div>
                <div
                    class="flex flex-col justify-center items-center py-5 px-10"
                >
                    <img
                        :src="`/storage/${course.image}`"
                        :alt="course.name[locale]"
                        class="w-64 h-36 object-cover"
                    />
                </div>
                <div
                    class="mt-2 underline underline-offset-8 text-[#1d5764] text-center"
                    v-text="course.name[locale]"
                ></div>
                <div class="flex flex-col items-center gap-3 mt-8">
                    <button @click="changeFav">
                        <Icon
                            v-if="course.is_fav"
                            icon="solar:heart-linear"
                            class="text-[#1d5764] text-3xl"
                        />

                        <Icon
                            v-if="!course.is_fav"
                            icon="mdi:heart"
                            class="text-[#1d5764] text-3xl"
                        />
                    </button>
                    <Link
                        :href="route('landing.pages.show', { page: 'about' })"
                    >
                        <Icon
                            icon="healthicons:question-outline"
                            class="text-[#1d5764] text-3xl"
                        />
                    </Link>
                </div>

                <div
                    class="bg-[#1d5764] flex flex-col justify-center items-center p-1 text-white mt-8 text-2xl w-max mx-auto"
                >
                    {{ $t("شراء") }}
                </div>

                <div
                    class="mt-2 text-emerald-950 text-center"
                    v-text="$t('ارسال المبلغ لهذا الرقم')"
                ></div>
                <div
                    class="mt-2 underline underline-offset-8 text-emerald-950 text-center"
                    v-text="whatsapp"
                ></div>
            </div>
            <div class="text-center flex-grow px-8">
                <img
                    src="/assets/img/academic-hat-on-a-textbook-icon-outline-style-vector.svg"
                    class="block mx-auto mb-2 w-24"
                />
                <div
                    class="text-2xl font-rabar-021 text-emerald-950"
                    v-text="course.name[locale]"
                ></div>

                <div
                    class="mt-1 underline underline-offset-8 text-emerald-950 text-center text-xl"
                    v-text="`${course.price} د.ع`"
                ></div>
                <p class="text-emerald-950/90 leading-8 mt-2">
                    {{ course.description[locale] }}
                </p>

                <!-- Instructor Information -->
                <div
                    v-if="course.instructor"
                    class="mt-6 bg-white rounded-lg shadow-md p-4 text-left"
                >
                    <h3 class="text-lg font-rabar-021 mb-3">
                        {{ $t("المدرس") }}
                    </h3>
                    <div
                        class="flex items-center space-x-3 rtl:space-x-reverse"
                    >
                        <div class="flex-shrink-0">
                            <img
                                v-if="course.instructor.image"
                                :src="`/storage/${course.instructor.image}`"
                                :alt="course.instructor.name[locale]"
                                class="w-12 h-12 rounded-full object-cover"
                            />
                            <div
                                v-else
                                class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center"
                            >
                                <Icon
                                    icon="mdi:account"
                                    class="w-8 h-8 text-gray-400"
                                />
                            </div>
                        </div>
                        <div>
                            <h4 class="font-rabar-021">
                                {{ course.instructor.name[locale] }}
                            </h4>
                            <p
                                v-if="course.instructor.specialty"
                                class="text-sm text-gray-600"
                            >
                                {{ course.instructor.specialty }}
                            </p>
                            <Link
                                :href="
                                    route('landing.instructors.show', {
                                        slug: course.instructor.slug,
                                    })
                                "
                                class="text-sm text-primary hover:underline mt-1 inline-block"
                            >
                                {{ $t("عرض الملف الشخصي") }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <LessonsList
                    as-child
                    :chapters="course.chapters"
                    :course="course"
                    :locked="!course.is_subscribed"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage, Head, Link } from "@inertiajs/vue3";
import LandingLayout2 from "@/Layouts/LandingLayout2.vue";
import LessonsList from "@/components/Landing/LessonsList.vue";
import { Icon } from "@iconify/vue";
import { ref } from "vue";

defineOptions({
    layout: LandingLayout2,
});
const props = defineProps({
    course: Object,
    whatsapp: String,
});
const page = usePage();
const locale = page.props.locale;
const course = ref({ ...props.course });
function changeFav() {
    try {
        axios
            .post(
                route("landing.favorite-courses.update", {
                    course: course.value.id,
                }),
                {
                    is_fav: !course.value.is_fav,
                }
            )
            .then(() => {
                course.value.is_fav = !course.value.is_fav;
            });
    } catch (e) {
        console.error(e);
    }
}
</script>
