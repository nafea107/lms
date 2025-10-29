<script setup>
import {cn} from '@/lib/utils';
import {Check} from 'lucide-vue-next';
import {
    CheckboxIndicator,
    CheckboxRoot,
    useForwardPropsEmits,
} from 'radix-vue';
import {computed} from 'vue';

const props = defineProps({
    defaultChecked: {type: Boolean, required: false},
    checked: {type: [Boolean, String], required: false},
    disabled: {type: Boolean, required: false},
    required: {type: Boolean, required: false},
    name: {type: String, required: false},
    value: {type: String, required: false},
    id: {type: String, required: false},
    asChild: {type: Boolean, required: false},
    as: {type: null, required: false},
    class: {type: null, required: false},
});
const emits = defineEmits(['update:checked']);

const delegatedProps = computed(() => {
    const {class: _, ...delegated} = props;

    return delegated;
});

const forwarded = useForwardPropsEmits(delegatedProps, emits);
</script>

<template>
    <CheckboxRoot
        :class="
      cn(
        'peer h-4 w-4 shrink-0 rounded-sm border border-emerald-200 border-emerald-900 ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-emerald-900 data-[state=checked]:text-emerald-50 dark:border-emerald-800 dark:border-emerald-50 dark:ring-offset-emerald-950 dark:focus-visible:ring-emerald-300 dark:data-[state=checked]:bg-emerald-50 dark:data-[state=checked]:text-emerald-900',
        props.class,
      )
    "
        v-bind="forwarded"
    >
        <CheckboxIndicator
            class="flex h-full w-full items-center justify-center text-current"
        >
            <slot>
                <Check class="h-4 w-4"/>
            </slot>
        </CheckboxIndicator>
    </CheckboxRoot>
</template>
