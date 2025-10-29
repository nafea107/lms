<template>
    <div>
        <div
            class="max-w-7xl mx-auto px-3 flex flex-col justify-center items-center text-center"
        >
            <h1
                class="font-rabar-021 font-medium text-3xl"
                v-text="$t('الكورسات')"
            ></h1>
            <p
                class="font-rabar-022 text-lg"
                v-text="
                    $t(
                        'تقدم دوراتنا مزیجا من المعرفة العمیقة والتطبیق العملي في العلوم'
                    )
                "
            ></p>
            <div class="flex-wrap flex gap-6 place-content-center mt-8 w-full">
                <Link
                    v-for="subject in subjects"
                    :key="subject.id"
                    :href="
                        route('landing.courses.by-subject', {
                            subject: subject.id,
                        })
                    "
                    class="transition-transform hover:scale-105"
                >
                    <div
                        class="rounded-md shadow-md overflow-hidden w-64 h-40 flex flex-col items-center justify-center text-white"
                        :style="{ backgroundColor: subject.background }"
                    >
                        <h3 class="text-xl font-rabar-022 mb-4">
                            {{ subject.name[locale] }}
                        </h3>
                        <div class="w-16 h-16 flex items-center justify-center">
                            <img
                                v-if="subject.image"
                                :src="`/storage/${subject.image}`"
                                :alt="subject.name[locale]"
                                class="w-full h-full object-contain"
                            />
                            <Icon
                                v-else
                                :icon="getDefaultIcon(subject.name[locale])"
                                class="w-12 h-12 text-white"
                            />
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const props = defineProps({
    subjects: Array,
});
const page = usePage();
const locale = page.props.locale;

// Function to get default icon based on subject name
function getDefaultIcon(name) {
    const lowerName = name.toLowerCase();

    if (lowerName.includes("فيزياء") || lowerName.includes("physics")) {
        return "mdi:atom-variant";
    } else if (lowerName.includes("رياضيات") || lowerName.includes("math")) {
        return "mdi:calculator";
    } else if (lowerName.includes("علوم") || lowerName.includes("science")) {
        return "mdi:atom";
    } else if (
        lowerName.includes("كيمياء") ||
        lowerName.includes("chemistry")
    ) {
        return "mdi:flask";
    } else if (lowerName.includes("أحياء") || lowerName.includes("biology")) {
        return "mdi:microscope";
    }

    // Default icon
    return "mdi:book-open-page-variant";
}
</script>
