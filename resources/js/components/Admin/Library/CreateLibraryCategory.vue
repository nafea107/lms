<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button class="h-[unset] p-3">
                <Icon icon="material-symbols:add" />
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <DialogHeader>
                <DialogTitle>{{ $t("اضافة تصنيف كتب") }}</DialogTitle>
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
import { reactive } from "vue";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";

const emit = defineEmits(["getData"]);
const { t } = useI18n();

const form = reactive({
    name: {
        ar: "",
        ku: "",
        en: "",
    },
    color: "#3B82F6",
});

async function onSubmit() {
    await axios
        .post(route("admin.library-categories.store"), form)
        .catch((errors) => {
            if (errors.status == 422) {
                const [firstKey] = Object.keys(errors.response.data.errors);
                const error = errors.response.data.errors[firstKey][0];
                Swal.fire(t("خطأ"), error, "error");
            }
        });
    emit("getData");

    form.name = {
        ar: "",
        ku: "",
        en: "",
    };
    form.color = "#3B82F6";
}
</script>
