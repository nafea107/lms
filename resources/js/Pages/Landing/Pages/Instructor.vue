<template>
    <div>
        <Head :title="$t('المدرب')" />
        <div class="py-5 px-3 max-w-7xl mx-auto w-full">
            <div class="flex md:flex-row flex-col gap-3">
                <div class="flex justify-center items-center flex-col">
                    <img
                        :src="`/storage/${$page.props.page?.data?.photo?.value}`"
                        class="max-w-72"
                        :alt="$t('المدرب')"
                    />
                    <h4
                        class="mt-4 font-rabar-021 text-xl underline underline-offset-4"
                    >
                        {{ $page.props.app_name }}
                    </h4>
                </div>
                <div
                    class="md:flex md:space-y-0 space-y-4 items-stretch flex-grow"
                >
                    <div class="flex-1">
                        <h1
                            class="underline underline-offset-2 font-rabar-021 text-emerald-900 text-3xl text-center"
                        >
                            {{ $t("المدرب") }}
                        </h1>
                        <div class="mt-4">
                            <div class="flex gap-1 items-center">
                                <Icon
                                    class="transform -rotate-90 text-emerald-900"
                                    icon="solar:map-arrow-up-bold"
                                />
                                <h2 class="text-xl">{{ $t("التخصص:") }}</h2>
                            </div>
                            <p
                                v-text="props.page.data.specialization.value"
                            ></p>
                        </div>
                        <div class="mt-4">
                            <div class="flex gap-1 items-center">
                                <Icon
                                    class="transform -rotate-90 text-emerald-900"
                                    icon="solar:map-arrow-up-bold"
                                />
                                <h2 class="text-xl">
                                    {{ $t("الحياة العملية:") }}
                                </h2>
                            </div>
                            <p v-text="props.page.data.career.value"></p>
                        </div>
                    </div>

                    <div class="w-[1px] bg-emerald-900 mx-4"></div>

                    <div class="flex-1">
                        <h1
                            class="underline underline-offset-2 font-rabar-021 text-emerald-900 text-3xl text-center"
                        >
                            {{ $t("شعاري") }}
                        </h1>
                        <div class="mt-4">
                            <p v-text="props.page.data.slogan.value"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Head } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import LandingLayout from "@/Layouts/LandingLayout.vue";

defineOptions({
    layout: LandingLayout,
});
const props = defineProps({
    page: Object,
});
</script>
