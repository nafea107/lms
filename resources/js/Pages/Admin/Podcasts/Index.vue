<template>
    <div class="max-w-7xl mx-auto w-full py-8 px-3">
        <Head :title="$t('البودكاست')" />
        <div class="flex justify-between">
            <h3 class="font-rabar-004 text-2xl">{{ $t("البودكاست") }}</h3>
            <Link :href="route('admin.podcasts.create')">
                <Button class="h-[unset] p-3">
                    <Icon icon="material-symbols:add" />
                </Button>
            </Link>
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
                        {{ $t("رابط الدعوة") }}
                    </TableHead>

                    <TableHead class="text-start text-gray-700">
                        {{ $t("الموعد") }}
                    </TableHead>

                    <TableHead class="text-start text-gray-700">
                        {{ $t("نشط") }}
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
                        <a :href="row.invitation_url" target="_blank" class="text-blue-600 hover:underline">
                            {{ row.invitation_url.substring(0, 40) }}...
                        </a>
                    </TableCell>

                    <TableCell>
                        <span v-if="row.scheduled_at">
                            {{ new Date(row.scheduled_at).toLocaleString(locale === 'ar' ? 'ar-IQ' : 'ku-IQ') }}
                        </span>
                        <span v-else class="text-gray-400">{{ $t("غير محدد") }}</span>
                    </TableCell>

                    <TableCell
                        v-text="parseInt(row.is_active) ? $t('نعم') : $t('لا')"
                    >
                    </TableCell>

                    <TableCell class="flex justify-end">
                        <div class="flex justify-between gap-1">
                            <Link
                                :href="
                                    route('admin.podcasts.edit', {
                                        podcast: row.id,
                                    })
                                "
                            >
                                <Button
                                    class="h-[unset] p-2 group border-emerald-900/90 hover:bg-emerald-900/90"
                                    variant="outline"
                                >
                                    <Icon
                                        class="text-emerald-900/90 group-hover:text-white"
                                        icon="solar:pen-outline"
                                    />
                                </Button>
                            </Link>

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
            class="w-full justify-center items-center flex mt-10"
        >
            <Loading />
        </div>
        <div
            v-show="!isLoading && tableData?.data?.length === 0"
            class="w-full justify-center items-center flex mt-8 font-rabar-021 text-2xl text-gray-700"
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
import { Head, Link, usePage } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";
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
        `${route("admin.podcasts.data")}?page=${currentPage.value}&search=${
            searchTerm.value
        }`
    );
    tableData.value = await res.data;
    isLoading.value = false;
}

function removeItem(row) {
    Swal.fire({
        title: t("هل تريد الحذف؟"),
        text: t("عند التاكيد سيتم حذف البودكاست"),
        showCancelButton: true,
        confirmButtonText: t("تاكيد"),
        cancelButtonText: t("الغاء"),
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .delete(`${route("admin.podcasts.destroy", { podcast: row.id })}`)
                .then(() => {
                    Swal.fire(
                        t("تم الحذف"),
                        t("تم حذف البودكاست بنجاح"),
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
