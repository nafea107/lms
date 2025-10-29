<template>
    <div class="flex-1" id="contact">
        <Head :title="$t('تواصل')" />
        <div class="py-5 px-3 max-w-7xl mx-auto w-full">
            <div class="md:flex">
                <!-- <div class="flex flex-col justify-center items-center flex-1">
                    <img
                        :alt="app_name"
                        :src="
                            image
                                ? `/storage/${image}`
                                : '/assets/img/teacher-2.png'
                        "
                        class="max-h-[60vh]"
                    />
                    <h2
                        class="mt-4 text-2xl underline underline-offset-8 text-emerald-950"
                    >
                        {{ app_name }}
                    </h2>
                </div> -->
                <div class="flex-1 flex justify-center flex-col w-full">
                    <h2
                        class="text-2xl mb-3 underline-offset-4 text-center font-rabar-021 text-white bg-emerald-950 py-2"
                    >
                        {{ $t("تواصل مع المعلم") }}
                    </h2>
                    <div>
                        <textarea
                            v-model="message"
                            :placeholder="$t('الرسالة')"
                            class="bg-emerald-950 w-full p-3 text-white caret-white"
                            rows="8"
                        >
                        </textarea>
                    </div>
                    <Button
                        class="bg-transparent w-full mt-4"
                        variant="outline"
                        @click="onSubmit"
                    >
                        {{ $t("ارسال") }}
                    </Button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Head, router, useForm, usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { useI18n } from "vue-i18n";
import { ref } from "vue";
import { Button } from "@/components/ui/button/index.js";
import Swal from "sweetalert2";

const page = usePage();
const locale = page.props.locale;
const { t } = useI18n();
const message = ref();

function onSubmit() {
    if (!message.value) return;
    useForm({
        message: message.value,
    }).post(route("landing.contact.send-email"), {
        onSuccess: () =>
            Swal.fire({
                title: t("تم الارسال بنجاح"),
                icon: "success",
            }),
    });
}
</script>
