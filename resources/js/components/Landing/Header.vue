<template>
    <div class="bg-white">
        <!-- Kurdish Flag Design -->
        <div class="relative">
            <!-- Red Stripe (Top) -->
            <div class="bg-red-600 h-2.5"></div>

            <!-- White Stripe (Middle) - Empty -->
            <div class="bg-white h-3"></div>

            <!-- Green Stripe (Bottom) with Content -->
            <div class="bg-green-600 relative">
                <div
                    class="max-w-7xl mx-auto px-4 py-2.5 flex justify-between items-center"
                >
                    <!-- Left: Logo and Text -->
                    <div class="flex items-center gap-2">
                        <Link :href="route('landing.home')">
                            <img
                                v-if="logo"
                                :src="`/storage/${logo}`"
                                alt="Logo"
                                class="h-8"
                            />
                        </Link>
                        <span class="text-white text-lg font-bold">{{
                            appName
                        }}</span>
                    </div>

                    <!-- Center: Sun Icon -->
                    <div
                        class="absolute left-1/2 transform -translate-x-1/2 -top-1"
                    >
                        <svg class="w-10 h-10" viewBox="0 0 100 100">
                            <!-- Sun circle -->
                            <circle cx="50" cy="50" r="12" fill="#FFD700" />
                            <!-- Sun rays (21 rays) -->
                            <g fill="#FFD700">
                                <polygon points="50,15 48,30 52,30" />
                                <polygon points="50,85 48,70 52,70" />
                                <polygon points="15,50 30,48 30,52" />
                                <polygon points="85,50 70,48 70,52" />
                                <polygon points="25,25 35,35 32,38 22,28" />
                                <polygon points="75,75 65,65 68,62 78,72" />
                                <polygon points="75,25 65,35 62,32 72,22" />
                                <polygon points="25,75 35,65 38,68 28,78" />
                                <!-- Additional rays -->
                                <polygon points="50,20 49,32 51,32" />
                                <polygon points="50,80 49,68 51,68" />
                                <polygon points="20,50 32,49 32,51" />
                                <polygon points="80,50 68,49 68,51" />
                                <polygon points="28,28 37,37 34,40 25,31" />
                                <polygon points="72,72 63,63 66,60 75,69" />
                                <polygon points="72,28 63,37 60,34 69,25" />
                                <polygon points="28,72 37,63 40,66 31,75" />
                                <!-- More rays for density -->
                                <polygon points="38,18 40,30 42,30" />
                                <polygon points="62,18 60,30 58,30" />
                                <polygon points="38,82 40,70 42,70" />
                                <polygon points="62,82 60,70 58,70" />
                                <polygon points="18,38 30,40 30,42" />
                            </g>
                        </svg>
                    </div>

                    <!-- Right: Icons and Sign Up -->
                    <div class="flex gap-3 items-center">
                        <DropdownMenu v-if="$page.props.notifications !== null">
                            <DropdownMenuTrigger as-child>
                                <button class="text-white hover:text-gray-200">
                                    <Icon icon="mdi:bell" class="w-5 h-5" />
                                </button>
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
                                        notification.message[$page.props.locale]
                                    "
                                ></div>
                            </DropdownMenuContent>
                        </DropdownMenu>

                        <button class="text-white hover:text-gray-200">
                            <Icon icon="mdi:web" class="w-5 h-5" />
                        </button>

                        <Link
                            v-if="!$page.props.auth.user"
                            :href="route('login')"
                            class="text-white hover:text-gray-200 flex items-center gap-1 font-semibold"
                        >
                            <Icon
                                icon="mdi:close-circle-outline"
                                class="w-5 h-5"
                            />
                            <span class="text-sm">{{
                                $t("تسجيل الدخول")
                            }}</span>
                        </Link>
                        <DropdownMenu v-else>
                            <DropdownMenuTrigger>
                                <button
                                    class="text-white hover:text-gray-200 flex flex-row items-center gap-1"
                                >
                                    <Icon
                                        icon="mdi:account-circle"
                                        class="w-5 h-5"
                                    />
                                    <span class="text-sm">{{
                                        $page.props.auth.user.name
                                    }}</span>
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent align="end">
                                <DropdownMenuItem
                                    v-if="
                                        $page.props.auth.user?.roles?.includes(
                                            'admin'
                                        )
                                    "
                                    @click="router.visit(route('admin.home'))"
                                >
                                    {{ $t("لوحة التحكم") }}
                                </DropdownMenuItem>
                                <DropdownMenuSeparator />
                                <DropdownMenuItem
                                    @click="router.visit(route('profile.edit'))"
                                >
                                    {{ $t("الملف الشخصي") }}
                                </DropdownMenuItem>
                                <DropdownMenuSeparator />
                                <DropdownMenuItem
                                    @click="router.visit(route('logout'))"
                                >
                                    {{ $t("تسجيل الخروج") }}
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>

                        <Sheet>
                            <SheetTrigger as-child>
                                <Button
                                    class="shrink-0 md:hidden bg-transparent text-white hover:text-gray-200 border-white"
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

        <!-- Navigation Bar -->
        <nav class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center">
                    <div class="flex gap-1">
                        <Link
                            v-for="(item, i) in menu"
                            :key="`menu-item-${i}`"
                            :href="item.href"
                            class="text-white px-4 py-3 hover:bg-gray-700 transition font-medium"
                            v-text="item.title"
                        ></Link>
                    </div>
                    <div class="relative">
                        <input
                            type="text"
                            :placeholder="$t('بحث')"
                            class="bg-white rounded-full px-4 py-1.5 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                        />
                        <Icon
                            icon="mdi:magnify"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 w-5 h-5"
                        />
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script setup>
import { Icon } from "@iconify/vue";
import { Link, router } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
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
import { Menu } from "lucide-vue-next";
import { Button } from "@/components/ui/button/index.js";
import { onMounted, ref } from "vue";

const { t } = useI18n();
const logo = ref(null);
const appName = ref("Future Leaders");

const menu = [
    { title: t("الرئيسية"), href: route("landing.home") },
    {
        title: t("المدربين"),
        href: route("landing.instructors.index"),
    },
    {
        title: t("البودكاست"),
        href: route("landing.podcasts.index"),
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
                keys: "logo,app_name",
            })
        )
        .then((res) => {
            logo.value = res.data.logo;
            appName.value = res.data.app_name || "Future Leaders";
        });
});
</script>
