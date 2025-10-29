<template>
    <div
        :class="{
            'bg-amber-100': style === 2,
        }"
    >
        <div>
            <div class="relative overflow-hidden">
                <img
                    v-if="style === 2"
                    alt="vector"
                    class="absolute w-52 top-0 left-2/3 hidden md:block"
                    src="/assets/img/vectors/vector-1.svg"
                />

                <img
                    v-if="style === 2"
                    alt="vector"
                    class="absolute w-52 top-0 left-1/2 hidden md:block"
                    src="/assets/img/vectors/vector-1.svg"
                />

                <div class="max-w-7xl mx-auto px-3 mt-3 relative z-10">
                    <div class="flex justify-between items-center">
                        <div class="flex gap-4 items-center">
                            <Link :href="route('landing.home')">
                                <img
                                    :src="`/storage/${logo}`"
                                    alt="Logo"
                                    class="h-8"
                                />
                            </Link>
                            <LangSwitcher class="flex" />
                        </div>
                        <div class="flex gap-2 items-center">
                            <DropdownMenu
                                v-if="$page.props.notifications !== null"
                            >
                                <DropdownMenuTrigger as-child class="bg-white">
                                    <Button
                                        class="hover:bg-transparent text-emerald-950 flex items-center bg-transparent p-0 m-0"
                                    >
                                        <Icon
                                            icon="mdi:bell"
                                            class="text-emerald-900 text-2xl"
                                        />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent
                                    v-if="$page.props.notifications.length > 0"
                                    align="start"
                                    class="max-h-40 overflow-y-auto"
                                >
                                    <div
                                        class="text-gray-600 px-1"
                                        v-for="notification in $page.props
                                            .notifications"
                                        v-text="
                                            notification.message[
                                                $page.props.locale
                                            ]
                                        "
                                    ></div>
                                </DropdownMenuContent>
                            </DropdownMenu>

                            <div
                                v-if="$page.props.auth.user"
                                class="flex items-center gap-4 md:gap-2 lg:gap-4 ms-auto"
                            >
                                <DropdownMenu>
                                    <DropdownMenuTrigger
                                        as-child
                                        class="bg-white"
                                    >
                                        <Button
                                            class="hover:bg-transparent text-emerald-950 flex items-center gap-2 bg-transparent"
                                        >
                                            <CircleUser class="h-5 w-5" />

                                            <span
                                                class="font-rabar-021 sm:block hidden"
                                                v-text="
                                                    $page.props.auth.user?.name
                                                "
                                            ></span>
                                        </Button>
                                    </DropdownMenuTrigger>
                                    <DropdownMenuContent align="end">
                                        <DropdownMenuItem
                                            v-if="
                                                $page.props.auth.user?.roles?.includes(
                                                    'admin'
                                                )
                                            "
                                            @click="
                                                router.visit(
                                                    route('admin.home')
                                                )
                                            "
                                            >{{ $t("لوحة التحكم") }}
                                        </DropdownMenuItem>
                                        <DropdownMenuSeparator />
                                        <DropdownMenuItem
                                            @click="
                                                router.visit(
                                                    route('profile.edit')
                                                )
                                            "
                                            >{{ $t("الملف الشخصي") }}
                                        </DropdownMenuItem>
                                        <DropdownMenuSeparator />
                                        <DropdownMenuItem
                                            @click="
                                                router.visit(route('logout'))
                                            "
                                            >{{ $t("تسجيل الخروج") }}
                                        </DropdownMenuItem>
                                    </DropdownMenuContent>
                                </DropdownMenu>
                            </div>
                            <div v-else>
                                <Link :href="route('login')">
                                    <Button>
                                        {{ $t("دخول") }}
                                    </Button>
                                </Link>
                            </div>
                            <Sheet>
                                <SheetTrigger as-child>
                                    <Button
                                        class="shrink-0 md:hidden bg-transparent text-gray-900 hover:text-gray-700 hover:bg-white border-gray-900"
                                        size="icon"
                                        variant="outline"
                                    >
                                        <Menu class="h-5 w-5" />
                                        <span class="sr-only"
                                            >Toggle navigation menu</span
                                        >
                                    </Button>
                                </SheetTrigger>
                                <SheetContent side="left">
                                    <nav
                                        class="grid place-content-center gap-6 text-lg font-medium"
                                    >
                                        <Link
                                            :href="route('landing.home')"
                                            class="flex items-center gap-2 text-lg font-semibold"
                                        >
                                            <img
                                                :src="`/storage/${logo}`"
                                                alt=""
                                                class="w-24 h-10"
                                            />
                                        </Link>
                                        <Link
                                            v-for="item in menu"
                                            :key="item.href"
                                            :href="item.href"
                                            class="hover:text-foreground text-center"
                                            v-text="item.title"
                                        >
                                        </Link>
                                    </nav>
                                </SheetContent>
                            </Sheet>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-[#1a3636] mt-3 py-2 px-3 sm:hidden">
                <SearchBox class="sm:hidden" />
            </div>
        </div>
        <div class="bg-[#1a3636] hidden sm:block mt-3">
            <div class="max-w-7xl mx-auto p-3">
                <div class="flex justify-between items-center gap-4">
                    <div class="flex gap-3 items-center">
                        <Link
                            v-for="(item, i) in menu"
                            :key="`menu-item-${i}`"
                            :href="item.href"
                            class="text-white font-rabar-022 hover:text-gray-200 transition"
                            v-text="item.title"
                        ></Link>
                    </div>
                    <SearchBox2 />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Icon } from "@iconify/vue";
import SearchBox from "@/components/Landing/SearchBox.vue";
import { Link, router } from "@inertiajs/vue3";
import LangSwitcher from "@/components/Landing/LangSwitcher.vue";
import { useI18n } from "vue-i18n";
import SearchBox2 from "@/components/Landing/SearchBox2.vue";
import {
    Sheet,
    SheetContent,
    SheetTrigger,
} from "@/components/ui/sheet/index.js";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu/index.js";
import { CircleUser, Menu } from "lucide-vue-next";
import { Button } from "@/components/ui/button/index.js";
import { onMounted, ref } from "vue";

defineProps({
    style: {
        type: Number,
        required: false,
        default: 1,
    },
});
const { t } = useI18n();
const logo = ref(null);

const menu = [
    { title: t("الرئيسية"), href: route("landing.home") },
    {
        title: t("المدربين"),
        href: route("landing.instructors.index"),
    },
    {
        title: t("كورسات"),
        href: route("landing.pages.show", { page: "courses" }),
    },
    {
        title: t("الاقسام"),
        href: route("landing.pages.show", { page: "categories" }),
    },
    {
        title: t("تواصل"),
        href: `${route("landing.home")}#contact`,
    },
    {
        title: t("من نحن"),
        href: route("landing.pages.show", { page: "about" }),
    },
];

onMounted(() => {
    axios
        .get(
            route("landing.settings", {
                keys: "logo",
            })
        )
        .then((res) => (logo.value = res.data.logo));
});
</script>
