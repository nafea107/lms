<script setup>
import {Primitive} from "radix-vue";
import {buttonVariants} from ".";
import {cn} from "@/lib/utils";
import {Icon} from "@iconify/vue";

const props = defineProps({
    variant: {type: null, required: false},
    size: {type: null, required: false},
    class: {type: null, required: false},
    asChild: {type: Boolean, required: false},
    as: {type: null, required: false, default: "button"},
    processing: {type: Boolean, required: false, default: false},
});
</script>

<template>
    <Primitive
        :as="as"
        :as-child="asChild"
        :class="cn(buttonVariants({ variant, size }), props.class ,'flex gap-1')"
    >
        <Icon v-if="processing" :class="{
            'text-white': variant != 'outline',
            'text-emerald-900/90': variant === 'outline',
        }" class="me-2"
              icon="svg-spinners:180-ring"/>
        <slot/>
    </Primitive>
</template>
