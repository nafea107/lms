<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button class="h-[unset] p-2 group" variant="outline">
                <Icon
                    class="text-emerald-900/90 group-hover:text-white"
                    icon="solar:pen-bold-duotone"
                />
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[600px]">
            <DialogHeader>
                <DialogTitle>{{ $t("تعديل المدرس") }}</DialogTitle>
            </DialogHeader>
            <div class="grid gap-4 max-h-[70vh] overflow-y-auto p-2">
                <Tabs defaultValue="basic" class="w-full">
                    <TabsList class="grid w-full grid-cols-2">
                        <TabsTrigger value="basic">{{
                            $t("المعلومات الأساسية")
                        }}</TabsTrigger>
                        <!-- <TabsTrigger value="bio">{{
                            $t("السيرة الذاتية")
                        }}</TabsTrigger>
                        <TabsTrigger value="social">{{
                            $t("التواصل الاجتماعي")
                        }}</TabsTrigger> -->
                    </TabsList>

                    <!-- Basic Information Tab -->
                    <TabsContent value="basic">
                        <div class="space-y-4">
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("الاسم الانجليزي") }}
                                    </InputLabel>
                                    <Input
                                        v-model="form.name.en"
                                        class="col-span-3"
                                    />
                                </div>
                            </div>

                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("الاسم العربي") }}
                                    </InputLabel>
                                    <Input
                                        v-model="form.name.ar"
                                        class="col-span-3"
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("الاسم الكردي") }}
                                    </InputLabel>
                                    <Input
                                        v-model="form.name.ku"
                                        class="col-span-3"
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("البريد الإلكتروني") }}
                                    </InputLabel>
                                    <Input
                                        v-model="form.email"
                                        type="email"
                                        class="col-span-3"
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("رقم الهاتف") }}
                                    </InputLabel>
                                    <Input
                                        v-model="form.phone"
                                        class="col-span-3"
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("التخصص") }}
                                    </InputLabel>
                                    <Input
                                        v-model="form.specialty"
                                        class="col-span-3"
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("الصورة") }}
                                    </InputLabel>
                                    <Input
                                        type="file"
                                        @input="handleImageUpload"
                                        class="col-span-3"
                                    />
                                </div>
                                <div
                                    v-if="instructor.image"
                                    class="mt-2 flex justify-center"
                                >
                                    <img
                                        :src="`/storage/${instructor.image}`"
                                        :alt="instructor.name[locale]"
                                        class="h-20 w-auto object-contain"
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("نوع الموظف") }}
                                    </InputLabel>
                                    <select
                                        v-model="form.type"
                                        class="col-span-3 flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                                    >
                                        <option value="trainer">{{ $t("مدرب") }}</option>
                                        <option value="future_leader">{{ $t("موظف قادة المستقبل") }}</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("الحالة") }}
                                    </InputLabel>
                                    <div class="col-span-3 flex items-center">
                                        <Switch
                                            id="is-active-edit"
                                            v-model="form.is_active"
                                        />
                                        <Label
                                            for="is-active-edit"
                                            class="mr-2"
                                        >
                                            {{
                                                form.is_active
                                                    ? $t("نشط")
                                                    : $t("غير نشط")
                                            }}
                                        </Label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </TabsContent>

                    <!-- Bio Tab -->
                    <TabsContent value="bio">
                        <div class="space-y-4">
                            <div>
                                <InputLabel class="mb-2 block">
                                    {{ $t("السيرة الذاتية (انجليزي)") }}
                                </InputLabel>
                                <Textarea v-model="form.bio.en" rows="5" />
                            </div>
                            <div>
                                <InputLabel class="mb-2 block">
                                    {{ $t("السيرة الذاتية (كردي)") }}
                                </InputLabel>
                                <Textarea v-model="form.bio.ku" rows="5" />
                            </div>
                            <div>
                                <InputLabel class="mb-2 block">
                                    {{ $t("المؤهلات العلمية (انجليزي)") }}
                                </InputLabel>
                                <Textarea
                                    v-model="form.qualifications.en"
                                    rows="5"
                                />
                            </div>
                            <div>
                                <InputLabel class="mb-2 block">
                                    {{ $t("المؤهلات العلمية (عربي)") }}
                                </InputLabel>
                                <Textarea
                                    v-model="form.qualifications.ar"
                                    rows="5"
                                />
                            </div>
                            <div>
                                <InputLabel class="mb-2 block">
                                    {{ $t("المؤهلات العلمية (كردي)") }}
                                </InputLabel>
                                <Textarea
                                    v-model="form.qualifications.ku"
                                    rows="5"
                                />
                            </div>
                            <div>
                                <InputLabel class="mb-2 block">
                                    {{ $t("المؤهلات العلمية (انجليزي)") }}
                                </InputLabel>
                                <Textarea
                                    v-model="form.qualifications.en"
                                    rows="5"
                                />
                            </div>
                            <div>
                                <InputLabel class="mb-2 block">
                                    {{ $t("الخبرات العملية (عربي)") }}
                                </InputLabel>
                                <Textarea
                                    v-model="form.experience.ar"
                                    rows="5"
                                />
                            </div>
                            <div>
                                <InputLabel class="mb-2 block">
                                    {{ $t("الخبرات العملية (كردي)") }}
                                </InputLabel>
                                <Textarea
                                    v-model="form.experience.ku"
                                    rows="5"
                                />
                            </div>
                        </div>
                    </TabsContent>

                    <!-- Social Media Tab -->
                    <TabsContent value="social">
                        <div class="space-y-4">
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("فيسبوك") }}
                                    </InputLabel>
                                    <Input
                                        v-model="form.facebook_url"
                                        class="col-span-3"
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("تويتر") }}
                                    </InputLabel>
                                    <Input
                                        v-model="form.twitter_url"
                                        class="col-span-3"
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("لينكد إن") }}
                                    </InputLabel>
                                    <Input
                                        v-model="form.linkedin_url"
                                        class="col-span-3"
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="grid grid-cols-4 items-center gap-4"
                                >
                                    <InputLabel class="text-right">
                                        {{ $t("انستغرام") }}
                                    </InputLabel>
                                    <Input
                                        v-model="form.instagram_url"
                                        class="col-span-3"
                                    />
                                </div>
                            </div>
                        </div>
                    </TabsContent>
                </Tabs>
            </div>
            <DialogFooter>
                <DialogClose as-child>
                    <Button type="submit" @click="onSubmit">
                        {{ $t("حفظ") }}
                    </Button>
                </DialogClose>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
<script setup>
import { Button } from "@/components/ui/button";
import {
    Dialog,
    DialogContent,
    DialogClose,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { Switch } from "@/components/ui/switch";
import { Label } from "@/components/ui/label";
import InputLabel from "@/components/InputLabel.vue";
import { Icon } from "@iconify/vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/components/InputError.vue";
import { reactive } from "vue";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";
import { usePage } from "@inertiajs/vue3";

const props = defineProps({
    instructor: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["getData"]);
const { t } = useI18n();
const page = usePage();
const locale = page.props.locale;

// Initialize form with instructor data
const form = reactive({
    ...props.instructor,
    _method: "PUT",
    image: null,
    // Ensure nested objects exist
    name: props.instructor.name || { en: "", ar: "", ku: "" },
    bio: props.instructor.bio || { en: "", ar: "", ku: "" },
    qualifications: props.instructor.qualifications || { en: "", ar: "", ku: "" },
    experience: props.instructor.experience || { en: "", ar: "", ku: "" },
    type: props.instructor.type || "trainer",
});

function handleImageUpload(event) {
    form.image = event.target.files[0];
}

async function onSubmit() {
    const formData = new FormData();
    formData.append("name[en]", form.name?.en || "");
    formData.append("name[ar]", form.name.ar);
    formData.append("name[ku]", form.name.ku);
    formData.append("email", form.email || "");
    formData.append("phone", form.phone || "");
    formData.append("specialty", form.specialty || "");
    formData.append("bio[en]", form.bio?.en || "");
    formData.append("bio[ar]", form.bio?.ar || "");
    formData.append("bio[ku]", form.bio?.ku || "");
    formData.append("qualifications[en]", form.qualifications?.en || "");
    formData.append("qualifications[ar]", form.qualifications?.ar || "");
    formData.append("qualifications[ku]", form.qualifications?.ku || "");
    formData.append("experience[en]", form.experience?.en || "");
    formData.append("experience[ar]", form.experience?.ar || "");
    formData.append("experience[ku]", form.experience?.ku || "");
    formData.append("facebook_url", form.facebook_url || "");
    formData.append("twitter_url", form.twitter_url || "");
    formData.append("linkedin_url", form.linkedin_url || "");
    formData.append("instagram_url", form.instagram_url || "");
    formData.append("is_active", form.is_active ? 1 : 0);
    formData.append("type", form.type || "trainer");
    formData.append("_method", "PUT");

    if (form.image) {
        formData.append("image", form.image);
    }

    await axios
        .post(
            route("admin.instructors.update", {
                instructor: props.instructor.id,
            }),
            formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            }
        )
        .then(() => {
            Swal.fire(t("نجاح"), t("تم تحديث المدرس بنجاح"), "success");
            emit("getData");
        })
        .catch((errors) => {
            if (errors.response && errors.response.status === 422) {
                const [firstKey] = Object.keys(errors.response.data.errors);
                const error = errors.response.data.errors[firstKey][0];
                Swal.fire(t("خطأ"), error, "error");
            } else {
                Swal.fire(t("خطأ"), t("حدث خطأ أثناء التحديث"), "error");
            }
        });
}
</script>
