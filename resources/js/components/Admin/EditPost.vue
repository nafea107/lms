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
        <DialogContent class="sm:max-w-[600px] max-h-[90vh] overflow-y-auto">
            <DialogHeader>
                <DialogTitle>{{ $t("تعديل المنشور") }}</DialogTitle>
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
                    <div class="grid grid-cols-4 items-center gap-4 hidden">
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
                        <textarea
                            v-model="form.content.ar"
                            class="col-span-3 min-h-[100px] p-2 border rounded-md"
                        ></textarea>
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-start gap-4">
                        <InputLabel class="text-right mt-2">
                            {{ $t("المحتوى الكردي") }}
                        </InputLabel>
                        <textarea
                            v-model="form.content.ku"
                            class="col-span-3 min-h-[100px] p-2 border rounded-md"
                        ></textarea>
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-start gap-4 hidden">
                        <InputLabel class="text-right mt-2">
                            {{ $t("المحتوى الانجليزي") }}
                        </InputLabel>
                        <textarea
                            v-model="form.content.en"
                            class="col-span-3 min-h-[100px] p-2 border rounded-md"
                        ></textarea>
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
                    <div v-if="post.image" class="mt-2 flex justify-center">
                        <img
                            :src="`/storage/${post.image}`"
                            alt="Post Image"
                            class="h-20 w-auto object-contain"
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

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
});
const emit = defineEmits(["getData"]);
const { t } = useI18n();

const form = reactive({
    ...props.post,
    _method: "PUT",
    image: null,
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
    formData.append("_method", "PUT");

    if (form.image) {
        formData.append("image", form.image);
    }

    await axios
        .post(
            route("admin.posts.update", {
                post: props.post.id,
            }),
            formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            }
        )
        .catch((errors) => {
            if (errors.response && errors.response.status === 422) {
                const [firstKey] = Object.keys(errors.response.data.errors);
                const error = errors.response.data.errors[firstKey][0];
                Swal.fire(t("خطأ"), error, "error");
            }
        });
    emit("getData");
}
</script>
