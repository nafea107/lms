<template>
    <div class="max-w-7xl mx-auto w-full px-3">
        <EditProfileForm v-bind="props"/>
    </div>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import EditProfileForm from "@/components/EditProfileForm.vue";


defineOptions({
    layout: AdminLayout
})

const props = defineProps({
    user: Object,
    countries: Array
})


</script>
