<script setup>
import Checkbox from '@/components/Checkbox.vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import {Input} from "@/components/ui/input/index.js";
import {Button} from "@/components/ui/button/index.js";
import LandingLayout2 from "@/Layouts/LandingLayout2.vue";

defineOptions({
    layout: LandingLayout2,
})
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};


</script>

<template>
    <Head :title="$t('تسجبل الدخول')"/>
    <div class="flex-grow justify-center flex flex-col  ">


        <div class="max-w-sm mx-auto px-3 py-5 h-full flex flex-col justify-center w-full ">
            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel :value="$t('البريد الالكتروني')" class="font-rabar-021" for="email"/>

                    <Input
                        id="email"
                        v-model="form.email"
                        :placeholder="$t('البريد الالكتروني')"
                        autocomplete="username"
                        autofocus
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
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

                <div class="mt-4 flex items-center justify-between">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="form.remember" name="remember"/>
                        <span class="ms-2 text-sm text-gray-600"
                        >{{ $t('تذكرني') }}</span
                        >
                    </label>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        {{ $t('نسيت كلمة المرور؟') }}
                    </Link>
                </div>

                <div class="mt-4 ">


                    <Button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        :processing="form.processing"
                        class="w-full"
                    >
                        {{ $t('دخول') }}
                    </Button>
                </div>
            </form>
            <div class="flex items-center justify-center mt-3 gap-1 text-sm text-gray-600 ">
                {{ $t("ليس لديك حساب؟") }}

                <Link
                    :href="route('register')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                >
                    {{ $t("سجل الان") }}
                </Link>
            </div>
        </div>
    </div>
</template>
