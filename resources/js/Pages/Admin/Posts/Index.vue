<template>
    <div class="max-w-7xl mx-auto w-full py-8 px-3">
        <Head :title="$t('المنشورات')" />
        <div class="flex justify-between">
            <h3 class="font-rabar-004 text-2xl">{{ $t("المنشورات") }}</h3>
            <CreatePost @get-data="getData" />
        </div>
        <div class="mt-5">
            <Input
                v-model="searchTerm"
                :placeholder="$t('بحث ...')"
                class="max-w-sm"
            />
        </div>
        <Table class="mt-2">
            <TableHeader>
                <TableRow>
                    <TableHead class="text-start text-gray-700">
                        {{ $t("العنوان") }}
                    </TableHead>
                    <TableHead class="text-start text-gray-700">
                        {{ $t("الصورة") }}
                    </TableHead>
                    <TableHead class="text-start text-gray-700">
                        {{ $t("الحالة") }}
                    </TableHead>
                    <TableHead class="text-start text-gray-700">
                        {{ $t("الترتيب") }}
                    </TableHead>
                    <TableCell class="text-end text-gray-700">
                        {{ $t("الادوات") }}
                    </TableCell>
                </TableRow>
            </TableHeader>
            <TableBody v-if="!isLoading">
                <TableRow v-for="row in tableData?.data" :key="row.id">
                    <TableCell v-text="row.title[locale]"> </TableCell>
                    <TableCell>
                        <img
                            v-if="row.image"
                            :src="`/storage/${row.image}`"
                            alt="Post Image"
                            class="h-10 w-auto object-contain"
                        />
                    </TableCell>
                    <TableCell>
                        <span
                            :class="
                                row.is_published
                                    ? 'text-green-600'
                                    : 'text-red-600'
                            "
                        >
                            {{
                                row.is_published
                                    ? $t("منشور")
                                    : $t("غير منشور")
                            }}
                        </span>
                    </TableCell>
                    <TableCell v-text="row.order"> </TableCell>
                    <TableCell class="flex justify-end">
                        <div class="flex justify-between gap-1">
                            <EditPost :post="row" @get-data="getData" />
                            <Button
                                class="h-[unset] p-2 group border-red-500 hover:bg-red-500"
                                variant="outline"
                                @click="removeItem(row)"
                            >
                                <Icon
                                    class="text-red-500 group-hover:text-white"
                                    icon="pajamas:remove"
                                />
                            </Button>
                        </div>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
        <div
            v-show="isLoading"
            class="w-full justify-center items-center flex mt-8"
        >
            <Loading />
        </div>
        <div
            v-show="!isLoading && tableData?.data?.length === 0"
            class="w-full justify-center items-center flex mt-8 font-rabar-021 text-2xl"
        >
            {{ $t("لا يوجد بيانات") }}
        </div>
        <Pagination
            v-if="
                !isLoading &&
                tableData?.total_pages &&
                tableData?.data?.length > 0
            "
            v-model="currentPage"
            :total="tableData?.total_pages"
        />
    </div>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { onMounted, ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import { Link, Head } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";
import CreatePost from "@/components/Admin/CreatePost.vue";
import EditPost from "@/components/Admin/EditPost.vue";
import { Input } from "@/components/ui/input/index.js";
import Loading from "@/components/Loading.vue";
import { Icon } from "@iconify/vue";
import { Button } from "@/components/ui/button/index.js";
import Pagination from "@/components/Pagination.vue";

defineOptions({
    layout: AdminLayout,
});
const page = usePage();
const locale = page.props.locale;
const { t } = useI18n();
const isLoading = ref(true);
const timeout = ref();
const searchTerm = ref("");
const tableData = ref([]);
const currentPage = ref(1);
const controller = ref(new AbortController());

async function getData() {
    isLoading.value = true;
    if (controller.value) controller.value.abort();
    controller.value = new AbortController();
    const res = await axios.get(
        `${route("admin.posts.data")}?page=${currentPage.value}&search=${
            searchTerm.value
        }`
    );
    tableData.value = await res.data;
    isLoading.value = false;
}

function removeItem(row) {
    Swal.fire({
        title: t("هل تريد الحذف؟"),
        text: t("عند التاكيد سيتم حذف المنشور"),
        showCancelButton: true,
        confirmButtonText: t("تاكيد"),
        cancelButtonText: t("الغاء"),
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .delete(`${route("admin.posts.destroy", { post: row.id })}`)
                .then(() => {
                    Swal.fire(
                        t("تم الحذف"),
                        t("تم حذف المنشور بنجاح"),
                        "success"
                    );
                    getData();
                })
                .catch((error) => {
                    Swal.fire(t("خطأ"), t("حدث خطأ أثناء الحذف"), "error");
                });
        }
    });
}

watch(searchTerm, () => {
    currentPage.value = 1;
    if (timeout.value) clearTimeout(timeout.value);
    timeout.value = setTimeout(getData, 400);
});

watch(currentPage, () => {
    getData();
});

onMounted(() => {
    getData();
});
</script>
