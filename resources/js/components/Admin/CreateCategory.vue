<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button class="h-[unset] p-3">
                <Icon icon="material-symbols:add" />
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <DialogHeader>
                <DialogTitle>{{ $t("اضافة قسم") }}</DialogTitle>
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
                            {{ $t("القسم الرئيسي") }}
                        </InputLabel>
                        <Select v-model="form.parent_id" class="col-span-3">
                            <SelectTrigger>
                                <SelectValue :placeholder="$t('اختياري - لإنشاء قسم فرعي')" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem :value="null">
                                    {{ $t("بدون قسم رئيسي") }}
                                </SelectItem>
                                <SelectItem
                                    v-for="category in mainCategories"
                                    :key="category.id"
                                    :value="category.id"
                                >
                                    {{ category.name[locale] }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
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
import { useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/components/InputError.vue";
import { reactive, computed, onMounted, ref } from "vue";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select/index.js";

const emit = defineEmits(["getData"]);
const { t } = useI18n();
const page = usePage();
const locale = page.props.locale;
const categories = ref([]);

const form = reactive({
    name: {
        ar: "",
        ku: "",
        en: "",
    },
    parent_id: null,
});

const mainCategories = computed(() => {
    return categories.value.filter(cat => !cat.parent_id);
});

async function fetchCategories() {
    try {
        const res = await axios.get(route("admin.categories.data") + "?per_page=1000");
        categories.value = res.data.data || [];
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
}

onMounted(() => {
    fetchCategories();
});

async function onSubmit() {
    await axios.post(route("admin.categories.store"), form).catch((errors) => {
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
    form.parent_id = null;
    
    // Refresh categories list
    fetchCategories();
}
</script>
