<template>
    <div class="max-w-7xl mx-auto w-full px-3">
        <h3 class="text-2xl mb-5 font-rabar-004" v-text="$t('تعديل كورس')"></h3>
        <Head :title="$t('تعديل كورس')" />
        <form enctype="multipart/form-data" @submit.prevent="submit">
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <InputLabel
                        :value="$t('الاسم العربي')"
                        class="font-rabar-021"
                    />

                    <Input
                        v-model="form.name.ar"
                        :placeholder="$t('الاسم العربي')"
                        autocomplete="name"
                        autofocus
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        required
                        type="text"
                    />

                    <InputError
                        :message="form.errors['name.ar']"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('الاسم الكردي')"
                        class="font-rabar-021"
                    />

                    <Input
                        v-model="form.name.ku"
                        :placeholder="$t('الاسم الكردي')"
                        autocomplete="name"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        required
                        type="text"
                    />

                    <InputError
                        :message="form.errors['name.ku']"
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
                        autofocus
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        required
                        type="text"
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
                        required
                        type="text"
                    />

                    <InputError
                        :message="form.errors['description.ku']"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('المرحلة')"
                        class="font-rabar-021"
                        for="email"
                    />

                    <Select
                        v-model="form.level_id"
                        class="focus-visible:ring-0"
                    >
                        <SelectTrigger
                            class="bg-transparent border-emerald-700 focus:ring-0 mt-2"
                        >
                            <SelectValue
                                :placeholder="$t('المرحلة')"
                                class="w-full flex justify-end"
                            />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem
                                v-for="level in levels"
                                :key="level.id"
                                :value="level.id"
                            >
                                {{ level.name[locale] }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError
                        :message="form.errors.level_id"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('المادة')"
                        class="font-rabar-021"
                        for="email"
                    />

                    <Select
                        v-model="form.subject_id"
                        class="focus-visible:ring-0"
                    >
                        <SelectTrigger
                            class="bg-transparent border-emerald-700 focus:ring-0 mt-2"
                        >
                            <SelectValue
                                :placeholder="$t('المادة')"
                                class="w-full flex justify-end"
                            />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem
                                v-for="subject in subjects"
                                :key="subject.id"
                                :value="subject.id"
                            >
                                {{ subject.name[locale] }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError
                        :message="form.errors.subject_id"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('القسم')"
                        class="font-rabar-021"
                        for="email"
                    />

                    <Select
                        v-model="form.category_id"
                        class="focus-visible:ring-0"
                    >
                        <SelectTrigger
                            class="bg-transparent border-emerald-700 focus:ring-0 mt-2"
                        >
                            <SelectValue
                                :placeholder="$t('القسم')"
                                class="w-full flex justify-end"
                            />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                            >
                                {{ category.name[locale] }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError
                        :message="form.errors.category_id"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('السعر')"
                        class="font-rabar-021"
                        for="email"
                    />

                    <Input
                        v-model="form.price"
                        :placeholder="$t('السعر')"
                        autocomplete="name"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        required
                        type="number"
                    />

                    <InputError
                        :message="form.errors.price"
                        class="mt-2 font-rabar-022"
                    />
                </div>
                <div>
                    <InputLabel
                        :value="$t('مميز')"
                        class="font-rabar-021"
                        for="email"
                    />

                    <Checkbox
                        :checked="form.is_featured"
                        class="mt-2"
                        @update:checked="form.is_featured = $event"
                    />

                    <InputError
                        :message="form.errors.price"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <div class="flex gap-2 items-center">
                        <InputLabel
                            :value="$t('الصورة')"
                            class="font-rabar-021"
                            for="email"
                        />
                        <a
                            v-if="typeof form.image === 'string'"
                            :href="`/storage/${form.file}`"
                            class="text-sm text-emerald-700 font-medium"
                            target="_blank"
                            >{{ $t("عرض الملف الحالي") }}</a
                        >
                    </div>

                    <Input
                        :placeholder="$t('الصورة')"
                        accept="image/*"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        type="file"
                        @change="form.image = $event.target.files[0]"
                    />
                    <InputError
                        :message="form.errors.image"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('المدرس')"
                        class="font-rabar-021"
                        for="instructor"
                    />

                    <Select
                        v-model="form.instructor_id"
                        class="focus-visible:ring-0"
                    >
                        <SelectTrigger
                            class="bg-transparent border-emerald-700 focus:ring-0 mt-2"
                        >
                            <SelectValue
                                :placeholder="$t('اختر المدرس')"
                                class="w-full flex justify-end"
                            />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem
                                v-for="instructor in instructors"
                                :key="instructor.id"
                                :value="instructor.id"
                            >
                                {{ instructor.name[locale] }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError
                        :message="form.errors.instructor_id"
                        class="mt-2 font-rabar-022"
                    />
                </div>

                <div>
                    <InputLabel
                        :value="$t('المستوى')"
                        class="font-rabar-021"
                        for="email"
                    />

                    <Select
                        v-model="form.level_id"
                        class="focus-visible:ring-0"
                    >
                        <SelectTrigger
                            class="bg-transparent border-emerald-700 focus:ring-0 mt-2"
                        >
                            <SelectValue
                                :placeholder="$t('المستوى')"
                                class="w-full flex justify-end"
                            />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem
                                v-for="level in levels"
                                :key="level.id"
                                :value="level.id"
                            >
                                {{ level.name[locale] }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError
                        :message="form.errors.level_id"
                        class="mt-2 font-rabar-022"
                    />
                </div>
            </div>

            <div class="h-[1px] bg-gray-300/70 mt-4 w-full"></div>
            <LangTabs
                v-model="currentLang"
                :langs="['ar', 'ku']"
                class="mt-4"
            />
            <div
                v-for="(chapter, i) in form.chapters"
                :key="`chapter-${i}`"
                class="mt-4"
            >
                {{ `${$t("جزء")} ${i + 1}` }}
                <div>
                    <div class="flex justify-between items-baseline">
                        <InputLabel
                            :value="
                                currentLang === 'ar'
                                    ? $t('الاسم العربي')
                                    : $t('الاسم الكردي')
                            "
                            class="font-rabar-021"
                        />
                        <div class="flex justify-end gap-2">
                            <Button
                                class="h-[unset] p-3"
                                type="button"
                                @click="addChapter"
                            >
                                <Icon icon="material-symbols:add" />
                            </Button>
                            <Button
                                class="h-[unset] p-2 group border-red-500 hover:bg-red-500"
                                type="button"
                                variant="outline"
                                @click="removeChapter(i)"
                            >
                                <Icon
                                    class="text-red-500 group-hover:text-white"
                                    icon="pajamas:remove"
                                />
                            </Button>
                        </div>
                    </div>

                    <Input
                        v-model="chapter.name[currentLang]"
                        :placeholder="
                            currentLang === 'ar'
                                ? chapter.name.ku
                                : chapter.name.ar
                        "
                        autocomplete="name"
                        autofocus
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0"
                        required
                        type="text"
                    />

                    <InputError
                        :message="
                            form.errors[`chapters.${i}.name.${currentLang}`]
                        "
                        class="mt-2 font-rabar-022"
                    />
                </div>
            </div>

            <div class="mt-4">
                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    :processing="form.processing"
                    class="ms-auto block"
                    @click="onSubmit"
                >
                    {{ $t("حفظ") }}
                </Button>
            </div>
        </form>
    </div>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/components/InputError.vue";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select/index.js";
import { Button } from "@/components/ui/button/index.js";
import InputLabel from "@/components/InputLabel.vue";
import { Input } from "@/components/ui/input/index.js";
import { useI18n } from "vue-i18n";
import LangTabs from "@/components/LangTabs.vue";
import { ref } from "vue";
import { Icon } from "@iconify/vue";
import { Checkbox } from "@/components/ui/checkbox/index.js";
import Swal from "sweetalert2";
import Textarea from "@/components/ui/textarea/Textarea.vue";

defineOptions({
    layout: AdminLayout,
});

const props = defineProps({
    course: Object,
    categories: Array,
    levels: Array,
    subjects: Array,
    instructors: Array,
});

const page = usePage();
const locale = page.props.locale;
const currentLang = ref("ar");
const { t } = useI18n();

const form = useForm({
    ...props.course,
    removed_chapters: [],
    _method: "PUT",
});

// Function to deeply clone the chapter object
function chapter() {
    return {
        name: {
            ar: "",
            ku: "",
        },
    };
}

function addChapter() {
    form.chapters.push(chapter()); // Use deep clone when adding
}

function removeChapter(index) {
    if (form.chapters.length > 1) {
        form.removed_chapters.push(form.chapters[index].id);
        form.chapters.splice(index, 1);
    }
}

function onSubmit() {
    form.post(route("admin.courses.update", { course: props.course.id }), {
        onSuccess: () => {
            Swal.fire({
                title: t("تم الحفظ"),
                icon: "success",
            });
        },
    });
}
</script>
