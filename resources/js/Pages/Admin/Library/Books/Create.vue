<template>
    <div class="max-w-7xl mx-auto w-full px-3 py-8">
        <h3 class="text-2xl mb-5 font-rabar-004" v-text="$t('اضافة كتاب')"></h3>
        <Head :title="$t('اضافة كتاب')" />
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
                        class="mt-2 block w-full"
                        required
                        type="text"
                    />
                    <InputError
                        :message="form.errors['title.ar']"
                        class="mt-2"
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
                        class="mt-2 block w-full"
                        required
                        type="text"
                    />
                    <InputError
                        :message="form.errors['title.ku']"
                        class="mt-2"
                    />
                </div>
                <div>
                    <InputLabel
                        :value="$t('العنوان الانجليزي')"
                        class="font-rabar-021"
                    />
                    <Input
                        v-model="form.title.en"
                        :placeholder="$t('العنوان الانجليزي')"
                        class="mt-2 block w-full"
                        required
                        type="text"
                    />
                    <InputError
                        :message="form.errors['title.en']"
                        class="mt-2"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('المؤلف العربي')"
                        class="font-rabar-021"
                    />
                    <Input
                        v-model="form.author.ar"
                        :placeholder="$t('المؤلف العربي')"
                        class="mt-2 block w-full"
                        type="text"
                    />
                    <InputError
                        :message="form.errors['author.ar']"
                        class="mt-2"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('المؤلف الكردي')"
                        class="font-rabar-021"
                    />
                    <Input
                        v-model="form.author.ku"
                        :placeholder="$t('المؤلف الكردي')"
                        class="mt-2 block w-full"
                        type="text"
                    />
                    <InputError
                        :message="form.errors['author.ku']"
                        class="mt-2"
                    />
                </div>
                <div>
                    <InputLabel
                        :value="$t('المؤلف الانجليزي')"
                        class="font-rabar-021"
                    />
                    <Input
                        v-model="form.author.en"
                        :placeholder="$t('المؤلف الانجليزي')"
                        class="mt-2 block w-full"
                        type="text"
                    />
                    <InputError
                        :message="form.errors['author.en']"
                        class="mt-2"
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
                        class="mt-2 block w-full"
                    />
                    <InputError
                        :message="form.errors['description.ar']"
                        class="mt-2"
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
                        class="mt-2 block w-full"
                    />
                    <InputError
                        :message="form.errors['description.ku']"
                        class="mt-2"
                    />
                </div>
                <div>
                    <InputLabel
                        :value="$t('الوصف الانجليزي')"
                        class="font-rabar-021"
                    />
                    <Textarea
                        v-model="form.description.en"
                        :placeholder="$t('الوصف الانجليزي')"
                        class="mt-2 block w-full"
                    />
                    <InputError
                        :message="form.errors['description.en']"
                        class="mt-2"
                    />
                </div>

                <div>
                    <InputLabel :value="$t('التصنيف')" class="font-rabar-021" />
                    <Select v-model="form.library_category_id" class="mt-2">
                        <SelectTrigger>
                            <SelectValue :placeholder="$t('اختر التصنيف')" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectItem
                                    v-for="category in categories"
                                    :key="category.id"
                                    :value="category.id"
                                >
                                    {{ category.name[locale] }}
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    <InputError
                        :message="form.errors.library_category_id"
                        class="mt-2"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('صورة الغلاف')"
                        class="font-rabar-021"
                    />
                    <Input
                        type="file"
                        accept="image/*"
                        class="mt-2 block w-full"
                        @change="handleCoverImage"
                    />
                    <InputError
                        :message="form.errors.cover_image"
                        class="mt-2"
                    />
                    <div v-if="coverImagePreview" class="mt-2">
                        <img
                            :src="coverImagePreview"
                            class="w-32 h-32 object-cover rounded"
                            alt="Cover preview"
                        />
                    </div>
                </div>

                <div>
                    <InputLabel
                        :value="$t('ملف الكتاب')"
                        class="font-rabar-021"
                    />
                    <Input
                        type="file"
                        accept=".pdf,.epub,.mobi"
                        class="mt-2 block w-full"
                        @change="handleBookFile"
                    />
                    <InputError :message="form.errors.file_path" class="mt-2" />
                    <div
                        v-if="form.file_path"
                        class="mt-2 text-sm text-gray-600"
                    >
                        {{ form.file_path.name }}
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4 gap-2">
                <Link :href="route('admin.books.index')">
                    <Button type="button" variant="outline">
                        {{ $t("الغاء") }}
                    </Button>
                </Link>
                <Button :disabled="form.processing" type="submit">
                    {{ $t("حفظ") }}
                </Button>
            </div>
        </form>
    </div>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputLabel from "@/components/InputLabel.vue";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { usePage } from "@inertiajs/vue3";
import { ref } from "vue";

defineOptions({
    layout: AdminLayout,
});

const props = defineProps({
    categories: Array,
});

const page = usePage();
const locale = page.props.locale;

const form = useForm({
    title: {
        ar: "",
        ku: "",
        en: "",
    },
    author: {
        ar: "",
        ku: "",
        en: "",
    },
    description: {
        ar: "",
        ku: "",
        en: "",
    },
    library_category_id: null,
    cover_image: null,
    file_path: null,
});

const coverImagePreview = ref(null);

function handleCoverImage(event) {
    const file = event.target.files[0];
    if (file) {
        form.cover_image = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            coverImagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

function handleBookFile(event) {
    const file = event.target.files[0];
    if (file) {
        form.file_path = file;
    }
}

function submit() {
    form.post(route("admin.books.store"));
}
</script>
