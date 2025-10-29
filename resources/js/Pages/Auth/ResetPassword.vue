<script setup>
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import {Head, useForm, usePage} from '@inertiajs/vue3';
import {Button} from "@/components/ui/button/index.js";
import {Input} from "@/components/ui/input/index.js";

import LandingLayout2 from "@/Layouts/LandingLayout2.vue";

defineOptions({
    layout: LandingLayout2
})

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const page = usePage();
const locale = page.props.locale;

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head :title="$t('اعداد كلمة المرور')"/>

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
                        {{ $t('اعداد كلمة المرور') }}
                    </Button>
                </div>
            </form>

        </div>
    </div>
</template>
