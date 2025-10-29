<script setup>
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import {Button} from "@/components/ui/button/index.js";
import {Input} from "@/components/ui/input/index.js";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import LandingLayout2 from "@/Layouts/LandingLayout2.vue";

defineOptions({
    layout: LandingLayout2
})

const props = defineProps({
    countries: Array
});

const page = usePage();
const locale = page.props.locale;

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    country_phone_code: '',
    phone: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head :title="$t('تسجيل حساب')"/>

    <div class="flex-grow justify-center flex flex-col  ">


        <div class="max-w-sm mx-auto px-3 py-5 h-full flex flex-col justify-center w-full ">

            <form @submit.prevent="submit">

                <div>
                    <InputLabel :value="$t('الاسم')" class="font-rabar-021" for="name"/>

                    <Input
                        id="name"
                        v-model="form.name"
                        :placeholder="$t('الاسم')"
                        autocomplete="name"
                        autofocus
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                        required
                        type="text"
                    />

                    <InputError :message="form.errors.name" class="mt-2 font-rabar-022"/>
                </div>

                <div class="mt-4">
                    <InputLabel :value="$t('البريد الالكتروني')" class="font-rabar-021" for="email"/>

                    <Input
                        id="email"
                        v-model="form.email"
                        :placeholder="$t('البريد الالكتروني')"
                        autocomplete="email"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                        required
                        type="email"
                    />

                    <InputError :message="form.errors.email" class="mt-2 font-rabar-022"/>
                </div>
                <div class="mt-4">
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

                <div class="mt-4">
                    <InputLabel :value="$t('الهاتف')" class="font-rabar-021" for="phone"/>


                    <div class="relative w-full max-w-sm items-center" dir="ltr">
                        <Input
                            id="phone"
                            v-model="form.phone"

                            :class="{
                                'ps-12' : form.country_phone_code,
                            }"
                            :placeholder="$t('الهاتف')"
                            autocomplete="phone"
                            class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 placeholder:text-end"
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


                <div class="mt-4">
                    <InputLabel :value="$t('كلمة المرور')" class="font-rabar-021" for="password"/>

                    <Input
                        id="password"
                        v-model="form.password"

                        :placeholder="$t('كلمة المرور')"
                        autocomplete="current-password"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        required
                        type="password"
                    />

                    <InputError :message="form.errors.password" class="mt-2 font-rabar-022"/>
                </div>

                <div class="mt-4">
                    <InputLabel :value="$t(' تاكيد كلمة المرور')" class="font-rabar-021" for="password_confirmation"/>

                    <Input
                        id="password_confirmation"
                        v-model="form.password_confirmation"

                        :placeholder="$t(' تاكيد كلمة المرور')"
                        autocomplete="current-password"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        required
                        type="password"
                    />

                    <InputError :message="form.errors.password_confirmation" class="mt-2 font-rabar-022"/>
                </div>


                <div class="mt-4 ">


                    <Button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        :processing="form.processing"
                        class="w-full"
                    >
                        {{ $t('تسجيل') }}
                    </Button>
                </div>
            </form>
            <div class="flex items-center justify-center mt-3 gap-1 text-sm text-gray-600 ">
                {{ $t("لديك حساب؟") }}

                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                >
                    {{ $t("سجل دخول") }}
                </Link>
            </div>
        </div>
    </div>
</template>
