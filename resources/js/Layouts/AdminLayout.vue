<script setup>
import Header from "@/components/Admin/Header.vue";
import Swal from "sweetalert2";
import {router} from "@inertiajs/vue3";
import {useI18n} from "vue-i18n";

const {t} = useI18n();
router.on('error', (errors) => {
    const [firstKey] = Object.keys(errors.detail.errors)
    const error = errors.detail.errors[firstKey]
    Swal.fire(
        t('خطأ'),
        error,
        'error'
    );
})
</script>

<template>
    <div class="flex min-h-screen w-full flex-col">
        <Header/>
        <main class="flex flex-1 flex-col gap-4 p-4 md:gap-8 md:p-8">
            <slot/>
        </main>
    </div>
</template>
