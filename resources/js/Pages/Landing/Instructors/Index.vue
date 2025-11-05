<template>
    <div class="max-w-7xl mx-auto px-3 py-8">
        <Head :title="$t('الموظفين')" />
        <h1 class="text-4xl font-rabar-021 text-center mb-12">
            {{ $t("الموظفين") }}
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Future Leaders Staff Card -->
            <Link
                :href="route('landing.instructors.by-type', { type: 'future_leader' })"
                class="group"
            >
                <div
                    class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-3xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-105 cursor-pointer"
                >
                    <div class="p-12 flex flex-col items-center justify-center min-h-[300px]">
                        <div class="mb-6">
                            <Icon
                                icon="mdi:account-group"
                                class="w-24 h-24 text-white"
                            />
                        </div>
                        <h2 class="text-3xl font-rabar-021 text-white text-center">
                            {{ $t("موظفي القادة المستقبليين") }}
                        </h2>
                    </div>
                </div>
            </Link>

            <!-- Trainers Card -->
            <Link
                :href="route('landing.instructors.by-type', { type: 'trainer' })"
                class="group"
            >
                <div
                    class="bg-gradient-to-br from-lime-600 to-lime-700 rounded-3xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-105 cursor-pointer"
                >
                    <div class="p-12 flex flex-col items-center justify-center min-h-[300px]">
                        <div class="mb-6">
                            <Icon
                                icon="mdi:teach"
                                class="w-24 h-24 text-white"
                            />
                        </div>
                        <h2 class="text-3xl font-rabar-021 text-white text-center">
                            {{ $t("المدربين") }}
                        </h2>
                    </div>
                </div>
            </Link>
        </div>
    </div>
</template>

<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

defineOptions({
    layout: LandingLayout,
});
</script>
