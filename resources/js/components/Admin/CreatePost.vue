<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button class="h-[unset] p-3">
                <Icon icon="material-symbols:add" />
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[600px] max-h-[90vh] overflow-y-auto">
            <DialogHeader>
                <DialogTitle>{{ $t("اضافة منشور") }}</DialogTitle>
            </DialogHeader>
            <div class="grid gap-4">
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t("العنوان العربي") }}
                        </InputLabel>
                        <Input v-model="form.title.ar" class="col-span-3" />
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t("العنوان الكردي") }}
                        </InputLabel>
                        <Input v-model="form.title.ku" class="col-span-3" />
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t("العنوان الانجليزي") }}
                        </InputLabel>
                        <Input v-model="form.title.en" class="col-span-3" />
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-start gap-4">
                        <InputLabel class="text-right mt-2">
                            {{ $t("المحتوى العربي") }}
                        </InputLabel>
                        <div class="col-span-3">
                            <RichTextEditor v-model="form.content.ar" />
                        </div>
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-start gap-4">
                        <InputLabel class="text-right mt-2">
                            {{ $t("المحتوى الكردي") }}
                        </InputLabel>
                        <div class="col-span-3">
                            <RichTextEditor v-model="form.content.ku" />
                        </div>
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-start gap-4">
                        <InputLabel class="text-right mt-2">
                            {{ $t("المحتوى الانجليزي") }}
                        </InputLabel>
                        <div class="col-span-3">
                            <RichTextEditor v-model="form.content.en" />
                        </div>
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t("الصورة") }}
                        </InputLabel>
                        <input
                            type="file"
                            @input="handleImageUpload"
                            class="col-span-3"
                        />
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t("الترتيب") }}
                        </InputLabel>
                        <Input
                            type="number"
                            v-model="form.order"
                            class="col-span-3"
                            min="0"
                        />
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t("منشور") }}
                        </InputLabel>
                        <div class="col-span-3 flex items-center">
                            <input
                                type="checkbox"
                                v-model="form.is_published"
                                class="w-4 h-4"
                            />
                        </div>
                    </div>
                </div>
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
import InputLabel from "@/components/InputLabel.vue";
import { Icon } from "@iconify/vue";
import { reactive } from "vue";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";
import RichTextEditor from "@/components/RichTextEditor.vue";

const emit = defineEmits(["getData"]);
const { t } = useI18n();

const form = reactive({
    title: {
        ar: "",
        ku: "",
        en: "",
    },
    content: {
        ar: "",
        ku: "",
        en: "",
    },
    image: null,
    is_published: true,
    order: 0,
});

function handleImageUpload(event) {
    form.image = event.target.files[0];
}

async function onSubmit() {
    const formData = new FormData();
    formData.append("title[ar]", form.title.ar);
    formData.append("title[ku]", form.title.ku);
    formData.append("title[en]", form.title.en || "");
    formData.append("content[ar]", form.content.ar);
    formData.append("content[ku]", form.content.ku);
    formData.append("content[en]", form.content.en || "");
    formData.append("is_published", form.is_published ? 1 : 0);
    formData.append("order", form.order);

    if (form.image) {
        formData.append("image", form.image);
    }

    await axios
        .post(route("admin.posts.store"), formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .catch((errors) => {
            if (errors.response && errors.response.status === 422) {
                const [firstKey] = Object.keys(errors.response.data.errors);
                const error = errors.response.data.errors[firstKey][0];
                Swal.fire(t("خطأ"), error, "error");
            }
        });
    emit("getData");

    // Reset form
    form.title = { ar: "", ku: "", en: "" };
    form.content = { ar: "", ku: "", en: "" };
    form.image = null;
    form.is_published = true;
    form.order = 0;
}
</script>
