<template>
    <div
        class="flex w-full p-1 rounded-xl bg-emerald-200 text-emerald-900/90 uppercase text-sm"
    >
        <div
            v-for="lang in langs"
            :key="lang"
            :class="{
        'flex w-full p-1.5 rounded-xl bg-emerald-900/90  text-white':
          lang == currentLang,
      }"
            class="flex-1 flex justify-center items-center cursor-pointer transition"
            @click="currentLang = lang"
            v-text="lang"
        />
    </div>
</template>
<script setup>
import {useVModel} from "@vueuse/core";
import {ref} from "vue";

const props = defineProps({
    modelValue: String,
    langs: Array,
});

const emits = defineEmits(["update:modelValue"]);
const currentLang = useVModel(props, "modelValue", emits);
</script>
