<template>
    <div class="bg-white">
        <!-- Kurdish Flag Design -->
        <div class="relative">
            <!-- Red Stripe (Top) -->
            <div class="bg-red-600 h-8"></div>

            <!-- White Stripe (Middle) - Empty -->
            <div
                class="bg-white h-11 flex flex-col justify-center items-center relative"
            >
                <!-- Center: Sun Icon -->
                <div class="absolute left-1/2 transform -translate-x-1/2">
                    <img alt="" class="w-10 h-10" src="/assets/img/sun.png" />
                </div>
            </div>

            <!-- Green Stripe (Bottom) with Content -->
            <div class="bg-green-600 h-8">
                <div
                    class="max-w-7xl mx-auto px-2 sm:px-4 py-2 sm:py-2.5 flex justify-between items-center absolute bottom-0 top-0"
                >
                    <!-- Left: Logo and Text -->
                    <div
                        class="flex flex-col justify-center items-center gap-1 sm:gap-2 bg-white h-28 px-3"
                    >
                        <Link :href="route('landing.home')">
                            <img
                                :src="`/assets/img/logo.png`"
                                alt="Logo"
                                class="h-6 sm:h-10"
                            />
                        </Link>
                        <span
                            class="text-green-600 text-sm sm:text-lg font-bold"
                            >{{ appName }}</span
                        >
                    </div>
                </div>
                <div
                    class="max-w-7xl mx-auto items-center justify-center h-full px-4"
                >
                    <!-- Right: Icons and Sign Up -->
                    <div
                        class="flex gap-2 sm:gap-3 items-center justify-end h-full"
                    >
                        <DropdownMenu v-if="$page.props.notifications !== null">
                            <DropdownMenuTrigger as-child>
                                <button
                                    class="text-white hover:text-gray-200 hidden sm:block"
                                >
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

                        <!-- Language Switcher -->
                        <DropdownMenu>
                            <DropdownMenuTrigger as-child>
                                <div>
                                    <button
                                        class="text-white hover:text-gray-200 flex items-center gap-1"
                                    >
                                        <Icon
                                            icon="mdi:web"
                                            class="w-4 h-4 sm:w-5 sm:h-5"
                                        />
                                        <span
                                            class="text-xs sm:text-sm font-semibold uppercase"
                                            >{{ currentLocale }}</span
                                        >
                                    </button>
                                </div>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent
                                align="end"
                                class="bg-white min-w-[150px]"
                            >
                                <DropdownMenuItem
                                    v-for="lang in languages"
                                    :key="lang.code"
                                    @click="switchLanguage(lang.code)"
                                    :class="{
                                        'bg-green-50':
                                            currentLocale === lang.code,
                                    }"
                                    class="cursor-pointer"
                                >
                                    <Icon
                                        :icon="lang.icon"
                                        class="w-4 h-4 me-2"
                                    />
                                    {{ lang.name }}
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>

                        <Link
                            v-if="!$page.props.auth.user"
                            :href="route('login')"
                            class="text-white hover:text-gray-200 flex items-center gap-1 font-semibold"
                        >
                            <Icon
                                icon="material-symbols:login"
                                class="w-4 h-4 sm:w-5 sm:h-5"
                            />
                            <span class="text-xs sm:text-sm">{{
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
                                        class="w-4 h-4 sm:w-5 sm:h-5"
                                    />
                                    <span class="text-xs sm:text-sm">{{
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

                                    <!-- Academy in Mobile Menu -->
                                    <div class="border-t pt-4">
                                        <p
                                            class="text-sm text-gray-500 mb-3 text-center font-bold"
                                        >
                                            {{ $t("الأكاديمية") }}
                                        </p>
                                        <div
                                            v-for="category in categories"
                                            :key="category.id"
                                            class="mb-4"
                                        >
                                            <p
                                                class="font-semibold text-center mb-2 text-green-600"
                                            >
                                                {{
                                                    category.name[
                                                        $page.props.locale
                                                    ]
                                                }}
                                            </p>
                                            <div
                                                class="flex flex-col gap-2 pl-4"
                                            >
                                                <Link
                                                    v-for="subCategory in category.children"
                                                    :key="subCategory.id"
                                                    :href="
                                                        route(
                                                            'landing.categories.courses',
                                                            {
                                                                category:
                                                                    subCategory.id,
                                                            }
                                                        )
                                                    "
                                                    class="text-sm hover:text-green-600 text-center"
                                                >
                                                    {{
                                                        subCategory.name[
                                                            $page.props.locale
                                                        ]
                                                    }}
                                                    <span
                                                        v-if="
                                                            subCategory.courses_count >
                                                            0
                                                        "
                                                        class="text-xs text-gray-500"
                                                    >
                                                        ({{
                                                            subCategory.courses_count
                                                        }})
                                                    </span>
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <!-- Language Switcher in Mobile Menu -->
                                        <div class="border-t pt-4 mt-2">
                                            <p
                                                class="text-sm text-gray-500 mb-3 text-center"
                                            >
                                                {{ $t("اللغة") }}
                                            </p>
                                            <div class="flex flex-col gap-2">
                                                <button
                                                    v-for="lang in languages"
                                                    :key="lang.code"
                                                    @click="
                                                        switchLanguage(
                                                            lang.code
                                                        )
                                                    "
                                                    :class="[
                                                        'flex items-center justify-center gap-2 px-4 py-2 rounded-lg transition',
                                                        currentLocale ===
                                                        lang.code
                                                            ? 'bg-green-600 text-white'
                                                            : 'bg-gray-100 hover:bg-gray-200',
                                                    ]"
                                                >
                                                    <Icon
                                                        :icon="lang.icon"
                                                        class="w-5 h-5"
                                                    />
                                                    <span class="font-medium">{{
                                                        lang.name
                                                    }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                            </SheetContent>
                        </Sheet>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Bar -->
        <nav class="bg-[#3f3e44] hidden md:block">
            <div class="max-w-7xl mx-auto px-4">
                <div
                    class="flex flex-col md:flex-row justify-between items-center gap-2 md:gap-0 py-2 md:py-0"
                >
                    <div
                        class="flex flex-wrap gap-1 justify-center md:justify-start"
                    >
                        <Link
                            v-for="(item, i) in menu"
                            :key="`menu-item-${i}`"
                            :href="item.href"
                            class="text-white px-3 md:px-4 py-2 md:py-3 hover:bg-gray-700 transition font-medium text-sm md:text-base"
                            v-text="item.title"
                        ></Link>

                        <!-- Academy Dropdown -->
                        <DropdownMenu>
                            <DropdownMenuTrigger as-child>
                                <div class="relative">
                                    <button
                                        class="text-white px-3 md:px-4 py-2 md:py-3 hover:bg-gray-700 transition font-medium text-sm md:text-base flex items-center gap-1"
                                    >
                                        {{ $t("الأكاديمية") }}
                                        <Icon
                                            icon="mdi:chevron-down"
                                            class="w-4 h-4"
                                        />
                                    </button>
                                </div>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent
                                align="start"
                                class="bg-white min-w-[250px] max-h-[500px] overflow-y-auto"
                            >
                                <div
                                    v-for="category in categories"
                                    :key="category.id"
                                    class="relative"
                                >
                                    <!-- Main Category -->
                                    <DropdownMenu>
                                        <DropdownMenuTrigger as-child>
                                            <div>
                                                <div
                                                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer !flex flex-row items-center justify-between group"
                                                    @click="
                                                        toggleMainCategory(
                                                            category.id
                                                        )
                                                    "
                                                >
                                                    <span
                                                        class="font-semibold text-gray-800"
                                                    >
                                                        {{
                                                            category.name[
                                                                $page.props
                                                                    .locale
                                                            ]
                                                        }}
                                                    </span>
                                                    <Icon
                                                        icon="mdi:chevron-right"
                                                        class="w-4 h-4 text-gray-500 group-hover:text-gray-700"
                                                        :class="{
                                                            'rtl:rotate-180':
                                                                $page.props
                                                                    .locale ===
                                                                    'ar' ||
                                                                $page.props
                                                                    .locale ===
                                                                    'ku',
                                                        }"
                                                    />
                                                </div>
                                            </div>
                                        </DropdownMenuTrigger>
                                        <DropdownMenuContent
                                            side="right"
                                            class="bg-white min-w-[200px] max-h-[400px] overflow-y-auto"
                                            v-if="
                                                category.children &&
                                                category.children.length > 0
                                            "
                                        >
                                            <!-- Sub Categories -->
                                            <Link
                                                v-for="subCategory in category.children"
                                                :key="subCategory.id"
                                                :href="
                                                    route(
                                                        'landing.categories.courses',
                                                        {
                                                            category:
                                                                subCategory.id,
                                                        }
                                                    )
                                                "
                                                class="block px-4 py-2 hover:bg-gray-100 text-gray-700 hover:text-gray-900"
                                            >
                                                <div
                                                    class="flex items-center justify-between"
                                                >
                                                    <span>{{
                                                        subCategory.name[
                                                            $page.props.locale
                                                        ]
                                                    }}</span>
                                                    <span
                                                        v-if="
                                                            subCategory.courses_count >
                                                            0
                                                        "
                                                        class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full"
                                                    >
                                                        {{
                                                            subCategory.courses_count
                                                        }}
                                                    </span>
                                                </div>
                                            </Link>
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                </div>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                    <div class="relative w-full md:w-auto">
                        <input
                            v-model="searchTerm"
                            type="text"
                            :placeholder="$t('بحث')"
                            class="bg-white rounded-full px-4 py-1.5 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 w-full md:w-auto"
                            @keyup.enter="onSearch"
                        />
                        <Icon
                            icon="mdi:magnify"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 w-4 h-4 md:w-5 md:h-5 cursor-pointer"
                            @click="onSearch"
                        />
                        <div
                            v-show="suggestions.length > 0"
                            ref="suggestionsBox"
                            class="absolute top-full w-full text-right text-sm text-slate-600 bg-white border shadow rounded-b-lg mt-1 max-h-52 flex flex-col z-50"
                        >
                            <div class="flex-grow overflow-y-auto">
                                <Link
                                    v-for="suggestion in suggestions"
                                    :key="suggestion.id"
                                    :href="
                                        route('landing.courses.show', {
                                            course: suggestion.id,
                                        })
                                    "
                                    class="p-2 hover:bg-gray-200 cursor-pointer transition w-full block"
                                    @click="suggestions = []"
                                >
                                    {{ suggestion.name[$page.props.locale] }}
                                </Link>
                            </div>
                            <div
                                v-show="suggestions.length > 0"
                                class="p-2 py-1.5 bg-gray-200/60 font-medium hover:bg-gray-200 cursor-pointer transition text-center text-emerald-600"
                                @click="onSearch"
                            >
                                {{ $t("عرض الكل") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script setup>
import { Icon } from "@iconify/vue";
import { Link, router, usePage } from "@inertiajs/vue3";
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
import { onMounted, ref, watch } from "vue";
import { onClickOutside } from "@vueuse/core";

const { t } = useI18n();
const logo = ref(null);
const appName = ref("Future Leaders");
const searchTerm = ref("");
const suggestions = ref([]);
const suggestionsBox = ref(null);
const timeout = ref();
const currentLocale = ref(usePage().props.locale || "ar");
const categories = ref([]);
const openMainCategory = ref(null);

const languages = [
    { code: "ar", name: "العربية", icon: "twemoji:flag-iraq" },
    { code: "en", name: "English", icon: "twemoji:flag-united-states" },
    { code: "ku", name: "کوردی", icon: "emojione:flag-for-kurdistan" },
];

onClickOutside(suggestionsBox, () => (suggestions.value = []));

const menu = [
    { title: t("الرئيسية"), href: route("landing.home") },
    {
        title: t("الفريق"),
        href: route("landing.instructors.index"),
    },
    {
        title: t("المكتبة"),
        href: route("landing.library.index"),
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

async function fetchCategories() {
    try {
        const res = await axios.get(route("landing.categories.index"));
        categories.value = res.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
}

function toggleMainCategory(categoryId) {
    openMainCategory.value =
        openMainCategory.value === categoryId ? null : categoryId;
}

async function getSuggestions() {
    if (!searchTerm.value) {
        suggestions.value = [];
        return;
    }
    try {
        const res = await axios.get(
            `${route("landing.search.data")}?per_page=10&s=${searchTerm.value}`
        );
        suggestions.value = res.data.data;
    } catch (error) {
        console.error("Error fetching suggestions:", error);
    }
}

function onSearch() {
    if (searchTerm.value) {
        router.visit(
            route("landing.search.show", {
                search: searchTerm.value,
            })
        );
        suggestions.value = [];
    }
}

function switchLanguage(locale) {
    const currentPath = window.location.pathname;
    const pathSegments = currentPath.split("/").filter(Boolean);

    // Replace the first segment (locale) with the new locale
    if (
        pathSegments.length > 0 &&
        ["ar", "en", "ku"].includes(pathSegments[0])
    ) {
        pathSegments[0] = locale;
    } else {
        pathSegments.unshift(locale);
    }

    const newPath = "/" + pathSegments.join("/");
    window.location.href = newPath + window.location.search;
}

watch(searchTerm, () => {
    if (timeout.value) clearTimeout(timeout.value);
    timeout.value = setTimeout(getSuggestions, 400);
});

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

    fetchCategories();
});
</script>
