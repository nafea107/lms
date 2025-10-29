<template>
    <div class="max-w-7xl mx-auto w-full px-3">
        <h3 class="text-2xl mb-5 font-rabar-004" v-text="$t('تعديل بودكاست')"></h3>
        <Head :title="$t('تعديل بودكاست')" />
        <form enctype="multipart/form-data" @submit.prevent="submit">
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <InputLabel
                        :value="$t('العنوان العربي')"
                        class="font-rabar-021"
                    />

                    <Input
                        v-model="form.title.ar"
                        :placeholder="$t('العنوان العربي')"
                        autocomplete="title"
                        autofocus
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        required
                        type="text"
                    />

                    <InputError
                        :message="form.errors['title.ar']"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('العنوان الكردي')"
                        class="font-rabar-021"
                    />

                    <Input
                        v-model="form.title.ku"
                        :placeholder="$t('العنوان الكردي')"
                        autocomplete="title"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        required
                        type="text"
                    />

                    <InputError
                        :message="form.errors['title.ku']"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('الوصف العربي')"
                        class="font-rabar-021"
                    />

                    <Textarea
                        v-model="form.description.ar"
                        :placeholder="$t('الوصف العربي')"
                        autocomplete="description"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                    />

                    <InputError
                        :message="form.errors['description.ar']"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('الوصف الكردي')"
                        class="font-rabar-021"
                    />

                    <Textarea
                        v-model="form.description.ku"
                        :placeholder="$t('الوصف الكردي')"
                        autocomplete="description"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                    />

                    <InputError
                        :message="form.errors['description.ku']"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('رابط الدعوة')"
                        class="font-rabar-021"
                    />

                    <Input
                        v-model="form.invitation_url"
                        :placeholder="$t('رابط الدعوة')"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        required
                        type="url"
                    />

                    <InputError
                        :message="form.errors.invitation_url"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('موعد البودكاست')"
                        class="font-rabar-021"
                    />

                    <Input
                        v-model="form.scheduled_at"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        type="datetime-local"
                    />

                    <InputError
                        :message="form.errors.scheduled_at"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('الصورة')"
                        class="font-rabar-021"
                    />

                    <Input
                        @change="handleImageChange"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        type="file"
                        accept="image/*"
                    />

                    <InputError
                        :message="form.errors.image"
                        class="mt-2 font-rabar-022"
                    />

                    <div v-if="imagePreview" class="mt-2">
                        <img :src="imagePreview" alt="Preview" class="w-32 h-32 object-cover rounded" />
                    </div>
                </div>

                <div>
                    <InputLabel
                        :value="$t('نشط')"
                        class="font-rabar-021"
                    />

                    <div class="flex items-center mt-2">
                        <input
                            v-model="form.is_active"
                            type="checkbox"
                            class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500"
                        />
                        <label class="ms-2 text-sm font-medium text-gray-900">
                            {{ $t('تفعيل البودكاست') }}
                        </label>
                    </div>

                    <InputError
                        :message="form.errors.is_active"
                        class="mt-2 font-rabar-022"
                    />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    class="ms-4 bg-emerald-900 hover:bg-emerald-800"
                >
                    {{ $t("حفظ") }}
                </Button>
            </div>
        </form>
    </div>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { Input } from "@/components/ui/input/index.js";
import { Button } from "@/components/ui/button/index.js";
import InputLabel from "@/components/InputLabel.vue";
import InputError from "@/components/InputError.vue";
import { Textarea } from "@/components/ui/textarea/index.js";
import { ref } from "vue";

defineOptions({
    layout: AdminLayout,
});

const props = defineProps({
    podcast: Object,
});

const imagePreview = ref(
    props.podcast.image ? `/storage/${props.podcast.image}` : null
);

const form = useForm({
    title: {
        ar: props.podcast.title.ar || "",
        ku: props.podcast.title.ku || "",
    },
    description: {
        ar: props.podcast.description?.ar || "",
        ku: props.podcast.description?.ku || "",
    },
    invitation_url: props.podcast.invitation_url || "",
    image: props.podcast.image || null,
    scheduled_at: props.podcast.scheduled_at 
        ? new Date(props.podcast.scheduled_at).toISOString().slice(0, 16)
        : "",
    is_active: props.podcast.is_active,
});

function handleImageChange(event) {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

const submit = () => {
    form.post(route("admin.podcasts.update", { podcast: props.podcast.id }));
};
</script>
