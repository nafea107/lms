<template>
    <div
        class="p-3 border border-emerald-900/90 flex flex-col items-center justify-center text-center text-emerald-900/90"
    >
        <h1 class="text-2xl mb-2 font-rabar-021">
            {{ course.name[locale] }}
        </h1>
        <Icon
            v-if="locked"
            class="text-xl"
            icon="material-symbols:lock-outline"
        />
        <Icon v-else class="text-xl" icon="icon-park-outline:unlock" />
        <div class="mt-4">
            <div
                v-for="chapter in chapters"
                :key="chapter.id"
                class="font-rabar-021 text-lg"
            >
                {{ chapter.name[locale] }} :

                <div class="mt-1 space-y-1">
                    <div v-for="lesson in chapter.lessons" :key="lesson.id">
                        <Link
                            :href="
                                route('landing.lessons.show', {
                                    lesson: lesson.id,
                                })
                            "
                            class="font-rabar-022 flex items-center gap-2 text-emerald-950 text-base"
                        >
                            <Icon
                                class="text-emerald-900/90"
                                icon="bi:play-btn"
                            />
                            {{ lesson.name[locale] }}
                        </Link>
                        <!-- <Link v-if="lesson.quiz"
                              :href="route('landing.quizzes.show',{quiz: lesson.quiz.id})"
                              class="font-rabar-022 flex items-center gap-2 text-emerald-950 text-base mt-1">
                            <Icon class="text-emerald-900/90" icon="akar-icons:question"/>
                            {{ $t('اختبار') }} {{ lesson.quiz.name[locale] }}
                        </Link> -->
                        <a
                            v-if="lesson.file"
                            :download="`/storage/${lesson.file}`"
                            :href="`/storage/${lesson.file}`"
                            class="font-rabar-022 flex items-center gap-2 text-emerald-950 text-base mt-1"
                        >
                            <Icon
                                class="text-emerald-900/90"
                                icon="mynaui:file"
                            />
                            {{ $t("ملف") }} {{ lesson.name[locale] }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Icon } from "@iconify/vue";
import { usePage, Link } from "@inertiajs/vue3";

const props = defineProps({
    course: Object,
    chapters: Array,
    locked: Boolean,
});
const page = usePage();
const locale = page.props.locale;
</script>
