<template>
    <div class="max-w-7xl mx-auto w-full px-3">
        <h3 class="text-2xl mb-5 font-rabar-004" v-text="$t('تعديل صفحة')"></h3>
        <Head :title="$t('تعديل صفحة')"/>
        <form enctype="multipart/form-data" @submit.prevent="onSubmit">

            <div class="grid  gap-4">
                <div>
                    <InputLabel :value="$t('الاسم')" class="font-rabar-021"/>

                    <Input
                        v-model="form.name"
                        autofocus
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                        disabled
                        type="text"
                    />

                </div>

                <div v-for="[fieldKey, fieldValue] of Object.entries(form.fields)">
                    <div v-if="fieldValue.type === 'image'">
                        <div class="flex gap-2 items-baseline">
                            <InputLabel :value="fieldKey.replaceAll('_',' ')" class="font-rabar-021" for="email"/>
                            <a v-if="typeof form.fields[fieldKey].value === 'string'"
                               :href="`/storage/${form.fields[fieldKey].value}`"
                               class="text-sm text-emerald-700 font-medium" target="_blank">{{
                                    $t('عرض الملف الحالي')
                                }}</a>
                        </div>

                        <Input
                            accept="image/*"
                            class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                            type="file"

                            @change="form.fields[fieldKey].value = $event.target.files[0]"
                        />
                        <InputError :message="form.errors[fieldKey]" class="mt-2 font-rabar-022"/>
                    </div>
                    <div v-else-if="fieldValue.type ==='text'">
                        <InputLabel :value="fieldKey.replaceAll('_',' ')" class="font-rabar-021" for="email"/>


                        <Textarea
                            v-model="form.fields[fieldKey].value"
                            class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                            type="text"
                        />
                        <InputError :message="form.errors[fieldKey]" class="mt-2 font-rabar-022"/>
                    </div>

                </div>


            </div>

            <div class="mt-4 ">


                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    :processing="form.processing"
                    class="ms-auto block"
                    @click="onSubmit"
                >
                    {{ $t('حفظ') }}
                </Button>
            </div>
        </form>

    </div>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Head, useForm, usePage} from "@inertiajs/vue3";
import InputError from "@/components/InputError.vue";
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select/index.js";
import {Button} from "@/components/ui/button/index.js";
import InputLabel from "@/components/InputLabel.vue";
import {Input} from "@/components/ui/input/index.js";
import LangTabs from "@/components/LangTabs.vue";
import {onMounted, ref, watch} from "vue";
import {Icon} from "@iconify/vue";
import {Textarea} from '@/components/ui/textarea'

defineOptions({
    layout: AdminLayout
})
const props = defineProps({
    page: Object,
})

const locale = usePage().props.locale;
const page = usePage();
const currentLang = ref('ar');
const form = useForm({
    fields: props.page.data,
    name: props.page.name,

    _method: 'PUT',
});


async function onSubmit() {
    await form.post(route('admin.pages.update', {page: props.page.id}));
}


</script>
