<template>
    <div class="p-3 bg-[#3a6868] flex flex-col items-center">
        <div class="w-full">
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
    categories: Array,
    selectedCatagory: Array,
});
const emit = defineEmits(["onCatagoryChange"]);
const locale = usePage().props.locale;
function onCatagoryChange(e) {
    emit("onCatagoryChange", e.target.value);
}
</script>
