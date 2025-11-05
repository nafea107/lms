<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button
                class="h-[unset] p-2 group border-primary hover:bg-primary"
                variant="outline"
            >
                <Icon
                    class="text-primary group-hover:text-white"
                    icon="tabler:edit"
                />
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <DialogHeader>
                <DialogTitle>{{ $t("تعديل تصنيف كتب") }}</DialogTitle>
            </DialogHeader>
            <div class="grid gap-4">
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t("الاسم العربي") }}
                        </InputLabel>
                        <Input v-model="form.name.ar" class="col-span-3" />
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t("الاسم الكردي") }}
                        </InputLabel>
                        <Input v-model="form.name.ku" class="col-span-3" />
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t("الاسم الانجليزي") }}
                        </InputLabel>
                        <Input v-model="form.name.en" class="col-span-3" />
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <InputLabel class="text-right">
                            {{ $t("اللون") }}
                        </InputLabel>
                        <Input
                            v-model="form.color"
                            type="color"
                            class="col-span-3 h-12"
                        />
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
import { reactive, watch } from "vue";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";

const props = defineProps({
    category: Object,
});

const emit = defineEmits(["getData"]);
const { t } = useI18n();

const form = reactive({
    name: {
        ar: props.category.name.ar,
        ku: props.category.name.ku,
        en: props.category.name.en || "",
    },
    color: props.category.color,
});

watch(
    () => props.category,
    (newVal) => {
        form.name = {
            ar: newVal.name.ar,
            ku: newVal.name.ku,
            en: newVal.name.en || "",
        };
        form.color = newVal.color;
    }
);

async function onSubmit() {
    await axios
        .put(
            route("admin.library-categories.update", {
                libraryCategory: props.category.id,
            }),
            form
        )
        .catch((errors) => {
            if (errors.status == 422) {
                const [firstKey] = Object.keys(errors.response.data.errors);
                const error = errors.response.data.errors[firstKey][0];
                Swal.fire(t("خطأ"), error, "error");
            }
        });
    emit("getData");
}
</script>
