<template>
    <div class="max-w-7xl mx-auto w-full px-3">
        <h3 class="text-2xl mb-5 font-rabar-004" v-text="$t('الاعدادت')"></h3>
        <Head :title="$t('الاعدادت')" />
        <form @submit.prevent="submit">
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <InputLabel
                        :value="$t('اسم التطبيق')"
                        class="font-rabar-021"
                    />

                    <Input
                        v-model="form.app_name"
                        :placeholder="$t('اسم التطبيق')"
                        autocomplete="name"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        type="text"
                    />

                    <InputError
                        :message="form.errors['app_name']"
                        class="mt-2 font-rabar-022"
                    />
                </div>
                <div>
                    <InputLabel :value="$t('الشعار')" class="font-rabar-021" />

                    <Input
                        :placeholder="$t('الشعار')"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        type="file"
                        @change="form.logo = $event.target.files[0]"
                    />
                    <InputError
                        :message="form.errors['logo']"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('Facebook')"
                        class="font-rabar-021"
                    />

                    <Input
                        v-model="form.facebook"
                        :placeholder="$t('Facebook')"
                        autocomplete="name"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        type="text"
                    />

                    <InputError
                        :message="form.errors['facebook']"
                        class="mt-2 font-rabar-022"
                    />
                </div>
                <div>
                    <InputLabel
                        :value="$t('Whatsapp')"
                        class="font-rabar-021"
                    />

                    <Input
                        v-model="form.whatsapp"
                        :placeholder="$t('Whatsapp')"
                        autocomplete="name"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        type="text"
                    />

                    <InputError
                        :message="form.errors['whatsapp']"
                        class="mt-2 font-rabar-022"
                    />
                </div>
                <div>
                    <InputLabel
                        :value="$t('instagram')"
                        class="font-rabar-021"
                    />

                    <Input
                        v-model="form.instagram"
                        :placeholder="$t('instagram')"
                        autocomplete="name"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        type="text"
                    />

                    <InputError
                        :message="form.errors['instagram']"
                        class="mt-2 font-rabar-022"
                    />
                </div>
                <div>
                    <InputLabel :value="$t('email')" class="font-rabar-021" />

                    <Input
                        v-model="form.email"
                        :placeholder="$t('email')"
                        autocomplete="name"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        type="text"
                    />

                    <InputError
                        :message="form.errors['email']"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('سنوات الخبرة')"
                        class="font-rabar-021"
                    />

                    <Input
                        v-model="form.experience_years"
                        :placeholder="$t('سنوات الخبرة')"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        type="number"
                        min="1"
                    />

                    <InputError
                        :message="form.errors['experience_years']"
                        class="mt-2 font-rabar-022"
                    />
                </div>
            </div>

            <div class="mt-4">
                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    :processing="form.processing"
                    class="ms-auto block"
                    @click="onSubmit"
                >
                    {{ $t("حفظ") }}
                </Button>
            </div>
        </form>
    </div>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button/index.js";
import InputLabel from "@/components/InputLabel.vue";
import { Input } from "@/components/ui/input/index.js";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";

defineOptions({
    layout: AdminLayout,
});

const props = defineProps({
    settings: Array,
});

const page = usePage();
const locale = page.props.locale;
const { t } = useI18n();

const data = {};
props.settings.forEach((item) => {
    data[item.key] = item.value;
});
const form = useForm({
    ...data,
});

function onSubmit() {
    form.post(route("admin.settings.update"), {
        onSuccess: () => {
            Swal.fire({
                title: t("تم الحفظ"),
                icon: "success",
            });
        },
    });
}
</script>
