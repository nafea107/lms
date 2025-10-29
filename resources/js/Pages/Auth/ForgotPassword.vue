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
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});


const submit = () => {
    form.post(route('password.email'));
};


</script>

<template>
    <Head :title="$t('استرجاع كلمة المرور')"/>
    <div class="flex-grow justify-center flex flex-col  ">


        <div class="max-w-sm mx-auto px-3 py-5 h-full flex flex-col justify-center w-full ">
            <div v-if="status" class="mb-4 text-sm font-medium text-emerald-950">
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


                <div class="mt-4 ">


                    <Button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        :processing="form.processing"
                        class="w-full"
                    >
                        {{ $t('استرجاع كلمة المرور') }}
                    </Button>
                </div>
            </form>

        </div>
    </div>
</template>





