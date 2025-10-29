<template>
    <h3 class="text-2xl mb-5 font-rabar-004" v-text="$t('تعديل الملف الشخصي')"></h3>
    <Head :title="$t('تعديل الملف الشخصي')"/>
    <form enctype="multipart/form-data" @submit.prevent="onSubmit">

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <InputLabel :value="$t('الاسم')" class="font-rabar-021"/>

                <Input
                    v-model="form.name"
                    :placeholder="$t('الاسم')"
                    autocomplete="name"
                    autofocus
                    class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                    required
                    type="text"
                />

                <InputError :message="form.errors['name']" class="mt-2 font-rabar-022"/>
            </div>

            <div>
                <InputLabel :value="$t('البريد الالكتروني')" class="font-rabar-021"/>

                <Input
                    v-model="form.email"
                    :placeholder="$t('البريد الالكتروني')"
                    autocomplete="name"
                    class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                    required
                    type="text"
                />

                <InputError :message="form.errors['email']" class="mt-2 font-rabar-022"/>
            </div>


            <div>
                <InputLabel :value="$t('كود الدولة')" class="font-rabar-021"/>

                <Select v-model="form.country_phone_code" :multiple="false" class="focus-visible:ring-0 ">
                    <SelectTrigger class="bg-transparent border-emerald-700 focus:ring-0 mt-2">
                        <SelectValue :placeholder="$t('كود الدولة')" class="w-full flex justify-end "/>
                    </SelectTrigger>
                    <SelectContent>
                        <SelectItem v-for="country in countries" :key="country.id.toString()"
                                    :value="country.phone_code.toString()">
                            {{ country.name[locale] }}
                        </SelectItem>
                    </SelectContent>
                </Select>
                <InputError :message="form.errors.country_phone_code" class="mt-2 font-rabar-022"/>
            </div>

            <div>
                <InputLabel :value="$t('الهاتف')" class="font-rabar-021" for="phone"/>


                <div class="relative w-full  items-center" dir="ltr">
                    <Input
                        id="phone"
                        v-model="form.phone"

                        :class="{
                                'ps-12' : form.country_phone_code,
                            }"
                        :placeholder="$t('الهاتف')"
                        autocomplete="phone"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        required
                        type="text"
                    />
                    <span v-show="form.country_phone_code"
                          class="absolute start-0 inset-y-0 flex items-center justify-center px-2">
                          +{{ form.country_phone_code }}
                        </span>
                </div>
                <InputError :message="form.errors.phone" class="mt-2 font-rabar-022"/>
            </div>

            <div>
                <InputLabel :value="$t('الصورة')" class="font-rabar-021" for="email"/>

                <Input
                    :placeholder="$t('الصورة')"
                    accept="image/*"
                    class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                    type="file"
                    @change="form.avatar = $event.target.files[0]"
                />
                <InputError :message="form.errors.avatar" class="mt-2 font-rabar-022"/>
            </div>

        </div>

        <div class="mt-4 ">


            <Button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                class="ms-auto block"
            >
                {{ $t('حفظ') }}
            </Button>
        </div>

        <div class="mt-8">
            <h3 class="text-2xl mb-5 font-rabar-004" v-text="$t('تعديل كلمة المرور')"></h3>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <InputLabel :value="$t('كلمة المرور')" class="font-rabar-021"/>

                    <Input
                        v-model="form.password"
                        :placeholder="$t('كلمة المرور')"
                        autocomplete="password"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                        type="password"
                    />

                    <InputError :message="form.errors['email']" class="mt-2 font-rabar-022"/>
                </div>
                <div>
                    <InputLabel :value="$t('تاكيد كلمة المرور')" class="font-rabar-021"/>

                    <Input
                        v-model="form.password_confirmation"
                        :placeholder="$t('تاكيد كلمة المرور')"
                        autocomplete="password"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                        type="password"
                    />

                    <InputError :message="form.errors['password_confirmation']" class="mt-2 font-rabar-022"/>
                </div>
            </div>

        </div>


        <div class="mt-4 ">


            <Button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                class="ms-auto block"
            >
                {{ $t('حفظ') }}
            </Button>
        </div>
    </form>

</template>
<script setup>
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select/index.js";
import InputError from "@/components/InputError.vue";
import {Head, useForm, usePage} from "@inertiajs/vue3";
import {Input} from "@/components/ui/input/index.js";
import InputLabel from "@/components/InputLabel.vue";
import {Button} from "@/components/ui/button/index.js";
import {ref} from "vue";
import {useI18n} from "vue-i18n";
import Swal from "sweetalert2";

const page = usePage();
const locale = page.props.locale;
const chapters = ref([]);
const {t} = useI18n();


const props = defineProps({
    user: Object,
    countries: Array
})


const form = useForm({
    ...props.user,
    _method: 'PATCH',
});


async function onSubmit() {
    form.post(route('profile.update'), {
        onSuccess: () => {
            Swal.fire(
                {
                    title: t('تم الحفظ'),
                    icon: 'success'
                }
            );
        }
    });
}
</script>
