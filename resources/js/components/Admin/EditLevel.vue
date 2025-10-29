<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button class="h-[unset] p-2 group" variant="outline">
                <Icon class="text-emerald-900/90 group-hover:text-white" icon="solar:pen-bold-duotone"/>
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <DialogHeader>
                <DialogTitle>{{ $t('تعديل مرحلة') }}</DialogTitle>

            </DialogHeader>
            <div class="grid gap-4">
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t('الاسم العربي') }}
                        </InputLabel>

                        <Input v-model="form.name.ar" class="col-span-3"/>

                    </div>

                </div>
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t('الاسم الكردي') }}
                        </InputLabel>
                        <Input v-model="form.name.ku" class="col-span-3"/>
                    </div>

                </div>
            </div>
            <DialogFooter>
                <DialogClose as-child>
                    <Button type="submit" @click="onSubmit">
                        {{ $t('حفظ') }}
                    </Button>
                </DialogClose>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
<script setup>
import {Button} from '@/components/ui/button'
import {
    Dialog,
    DialogContent,
    DialogClose,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog'
import {Input} from '@/components/ui/input'
import InputLabel from "@/components/InputLabel.vue";
import {Icon} from "@iconify/vue";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/components/InputError.vue";
import {reactive} from "vue";
import Swal from "sweetalert2";
import {useI18n} from "vue-i18n";

const props = defineProps({
    level: {
        type: Object,
        required: true,
    },
})
const emit = defineEmits(['getData']);
const {t} = useI18n()

const form = reactive({
    ...props.level,
    _method: 'PUT'
});

async function onSubmit() {
    await axios.post(route('admin.levels.update', {level: props.level}), form).catch((errors) => {
        if (errors.status == 422) {
            const [firstKey] = Object.keys(errors.response.data.errors)
            const error = errors.response.data.errors[firstKey][0]
            Swal.fire(
                t('خطأ'),
                error,
                'error'
            );
        }
    })
    emit('getData')
}
</script>
