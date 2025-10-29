<template>
    <div class="grid md:grid-cols-3 gap-4">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2"><h3
                class="text-sm font-medium"> {{ $t('المستخدمين') }} </h3>
                <Icon icon="mynaui:users"/>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold"> {{ users_count }}</div>
            </div>
        </div>

        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2"><h3
                class="text-sm font-medium"> {{ $t('الاشتراكات') }} </h3>
                <Icon icon="solar:card-broken"/>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold"> {{ subscriptions_count }}</div>
            </div>
        </div>


        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2"><h3
                class="text-sm font-medium"> {{ $t('الكورسات') }} </h3>
                <Icon icon="hugeicons:course"/>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold"> {{ courses_count }}</div>
            </div>
        </div>
    </div>

</template>
<script setup>
import {Icon} from "@iconify/vue";

const props = defineProps({
    courses_stats: Array,
    top_sale_courses: Array,
    courses_count: Number,
    users_count: Number,
    subscriptions_count: Number,
});
</script>
