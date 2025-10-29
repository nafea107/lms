<template>
    <div class="max-w-7xl mx-auto w-full px-3">
        <EditProfileForm v-bind="props"/>
    </div>
</template>
<script setup>
import EditProfileForm from "@/components/EditProfileForm.vue";
import LandingLayout2 from "@/Layouts/LandingLayout2.vue";


defineOptions({
    layout: LandingLayout2
})

const props = defineProps({
    user: Object,
    countries: Array
})


</script>
