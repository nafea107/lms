<template>
    <div class="p-3 bg-[#3a6868] flex flex-col justify-between items-center">
        <div class="flex-1 overflow-x-auto">
            <h6
                class="text-lg font-rabar-021 text-white text-center"
                v-text="$t('المراحل')"
            ></h6>
            <div class="mt-4 flex flex-col gap-2">
                <label
                    v-for="level in levels"
                    :key="level.id"
                    class="text-center text-white block"
                >
                    <input
                        type="radio"
                        name="level"
                        :value="level.id"
                        @change="onLevelChange"
                        :checked="level.id == selectedLevel"
                    />
                    {{ level.name[locale] }}
                </label>
            </div>
        </div>
        <div class="flex-1 overflow-x-auto">
            <h6
                class="text-lg font-rabar-021 text-white text-center"
                v-text="$t('الاقسام')"
            ></h6>
            <div class="mt-4 flex flex-col gap-2">
                <label
                    v-for="category in categories"
                    :key="category.id"
                    class="text-center text-white"
                >
                    <input
                        type="radio"
                        name="category"
                        @change="onCategoryChange"
                        :value="category.id"
                        :checked="category.id == selectedCatagory"
                    />
                    {{ category.name[locale] }}
                </label>
            </div>
        </div>
    </div>
</template>
<script setup>
import { router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    levels: Array,
    categories: Array,
    selectedLevel: Array,
    selectedCatagory: Array,
});
const emit = defineEmits(["onLevelChange", "onCatagoryChange"]);
const locale = usePage().props.locale;
function onLevelChange(e) {
    emit("onLevelChange", e.target.value);
}
function onCatagoryChange(e) {
    emit("onCatagoryChange", e.target.value);
}
</script>
