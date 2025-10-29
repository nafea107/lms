<template>
    <div class="bg-white flex flex-col min-h-screen">
        <!-- Header -->
        <header class="bg-white">
            <!-- Kurdish Flag Design -->
            <div class="relative">
                <!-- Red Stripe (Top) -->
                <div class="bg-red-600 h-2.5"></div>
                
                <!-- White Stripe (Middle) - Empty -->
                <div class="bg-white h-3"></div>
                
                <!-- Green Stripe (Bottom) with Content -->
                <div class="bg-green-600 relative">
                    <div class="max-w-7xl mx-auto px-4 py-2.5 flex justify-between items-center">
                        <!-- Left: Logo and Text -->
                        <div class="flex items-center gap-2">
                            <img
                                v-if="logo"
                                :src="`/storage/${logo}`"
                                alt="Logo"
                                class="h-8"
                            />
                            <span class="text-white text-lg font-bold">{{ settings.app_name || 'Future Leaders' }}</span>
                        </div>
                        
                        <!-- Center: Sun Icon -->
                        <div class="absolute left-1/2 transform -translate-x-1/2 -top-1">
                            <svg class="w-10 h-10" viewBox="0 0 100 100">
                                <!-- Sun circle -->
                                <circle cx="50" cy="50" r="12" fill="#FFD700"/>
                                <!-- Sun rays (21 rays) -->
                                <g fill="#FFD700">
                                    <polygon points="50,15 48,30 52,30"/>
                                    <polygon points="50,85 48,70 52,70"/>
                                    <polygon points="15,50 30,48 30,52"/>
                                    <polygon points="85,50 70,48 70,52"/>
                                    <polygon points="25,25 35,35 32,38 22,28"/>
                                    <polygon points="75,75 65,65 68,62 78,72"/>
                                    <polygon points="75,25 65,35 62,32 72,22"/>
                                    <polygon points="25,75 35,65 38,68 28,78"/>
                                    <!-- Additional rays -->
                                    <polygon points="50,20 49,32 51,32"/>
                                    <polygon points="50,80 49,68 51,68"/>
                                    <polygon points="20,50 32,49 32,51"/>
                                    <polygon points="80,50 68,49 68,51"/>
                                    <polygon points="28,28 37,37 34,40 25,31"/>
                                    <polygon points="72,72 63,63 66,60 75,69"/>
                                    <polygon points="72,28 63,37 60,34 69,25"/>
                                    <polygon points="28,72 37,63 40,66 31,75"/>
                                    <!-- More rays for density -->
                                    <polygon points="38,18 40,30 42,30"/>
                                    <polygon points="62,18 60,30 58,30"/>
                                    <polygon points="38,82 40,70 42,70"/>
                                    <polygon points="62,82 60,70 58,70"/>
                                    <polygon points="18,38 30,40 30,42"/>
                                </g>
                            </svg>
                        </div>
                        
                        <!-- Right: Icons and Sign Up -->
                        <div class="flex items-center gap-3">
                            <button class="text-white hover:text-gray-200">
                                <Icon icon="mdi:moon-waning-crescent" class="w-5 h-5" />
                            </button>
                            <button class="text-white hover:text-gray-200">
                                <Icon icon="mdi:bell" class="w-5 h-5" />
                            </button>
                            <button class="text-white hover:text-gray-200">
                                <Icon icon="mdi:web" class="w-5 h-5" />
                            </button>
                            <Link
                                v-if="!$page.props.auth.user"
                                :href="route('login')"
                                class="text-white hover:text-gray-200 flex items-center gap-1 font-semibold"
                            >
                                <Icon icon="mdi:close-circle-outline" class="w-5 h-5" />
                                <span class="text-sm">{{ $t("تسجيل الدخول") }}</span>
                            </Link>
                            <DropdownMenu v-else>
                                <DropdownMenuTrigger as-child>
                                    <button class="text-white hover:text-gray-200 flex items-center gap-1">
                                        <Icon icon="mdi:account-circle" class="w-5 h-5" />
                                        <span class="text-sm">{{ $page.props.auth.user.name }}</span>
                                    </button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="end">
                                    <DropdownMenuItem
                                        v-if="$page.props.auth.user?.roles?.includes('admin')"
                                        @click="router.visit(route('admin.home'))"
                                    >
                                        {{ $t("لوحة التحكم") }}
                                    </DropdownMenuItem>
                                    <DropdownMenuSeparator />
                                    <DropdownMenuItem @click="router.visit(route('profile.edit'))">
                                        {{ $t("الملف الشخصي") }}
                                    </DropdownMenuItem>
                                    <DropdownMenuSeparator />
                                    <DropdownMenuItem @click="router.visit(route('logout'))">
                                        {{ $t("تسجيل الخروج") }}
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
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
                                placeholder="Search"
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
        </header>

        <!-- Main Content -->
        <div class="flex-grow">
            <slot></slot>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12 mt-12">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <!-- Left Side: Logo and Text -->
                    <div class="flex gap-8">
                        <div class="flex-shrink-0">
                            <img
                                v-if="logo"
                                :src="`/storage/${logo}`"
                                alt="Logo"
                                class="h-32 w-32 object-contain"
                            />
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-4">{{ settings.app_name || 'Future Leaders' }}</h3>
                            <p class="text-gray-300 text-sm leading-relaxed mb-6">
                                {{ footerText }}
                            </p>
                            <div>
                                <h4 class="text-lg font-semibold mb-3">{{ $t("وسائل التواصل الاجتماعي") }}</h4>
                                <div class="flex gap-3">
                                    <a
                                        v-if="settings.facebook"
                                        :href="settings.facebook"
                                        target="_blank"
                                        class="bg-white text-gray-800 rounded-full p-2 hover:bg-gray-200 transition"
                                    >
                                        <Icon icon="mdi:facebook" class="w-6 h-6" />
                                    </a>
                                    <a
                                        v-if="settings.instagram"
                                        :href="settings.instagram"
                                        target="_blank"
                                        class="bg-white text-gray-800 rounded-full p-2 hover:bg-gray-200 transition"
                                    >
                                        <Icon icon="mdi:instagram" class="w-6 h-6" />
                                    </a>
                                    <a
                                        v-if="settings.tiktok"
                                        :href="settings.tiktok"
                                        target="_blank"
                                        class="bg-white text-gray-800 rounded-full p-2 hover:bg-gray-200 transition"
                                    >
                                        <Icon icon="ic:baseline-tiktok" class="w-6 h-6" />
                                    </a>
                                    <a
                                        v-if="settings.telegram"
                                        :href="settings.telegram"
                                        target="_blank"
                                        class="bg-white text-gray-800 rounded-full p-2 hover:bg-gray-200 transition"
                                    >
                                        <Icon icon="mdi:telegram" class="w-6 h-6" />
                                    </a>
                                    <a
                                        v-if="settings.youtube"
                                        :href="settings.youtube"
                                        target="_blank"
                                        class="bg-white text-gray-800 rounded-full p-2 hover:bg-gray-200 transition"
                                    >
                                        <Icon icon="mdi:youtube" class="w-6 h-6" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Video -->
                    <div class="bg-white rounded-2xl overflow-hidden" style="aspect-ratio: 16/9;">
                        <iframe
                            v-if="settings.footer_video_url"
                            :src="settings.footer_video_url"
                            class="w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                        <div v-else class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <Icon icon="mdi:video" class="w-24 h-24 text-gray-400" />
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { useI18n } from "vue-i18n";
import { onMounted, ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu/index.js";

const { t } = useI18n();
const page = usePage();
const locale = page.props.locale;
const logo = ref(null);
const settings = ref({});

const menu = [
    { title: t("الرئيسية"), href: route("landing.home") },
    { title: t("الاكاديمية"), href: route("landing.pages.show", { page: "courses" }) },
    { title: t("البودكاست"), href: route("landing.podcasts.index") },
    { title: t("المدربين"), href: route("landing.instructors.index") },
    { title: t("تواصل معنا"), href: `${route("landing.home")}#contact` },
    { title: t("من نحن"), href: route("landing.pages.show", { page: "about" }) },
];

const footerText = computed(() => {
    if (locale === 'ar' && settings.value.footer_text_ar) {
        return settings.value.footer_text_ar;
    } else if (locale === 'ku' && settings.value.footer_text_ku) {
        return settings.value.footer_text_ku;
    }
    return "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus.";
});

onMounted(() => {
    axios
        .get(
            route("landing.settings", {
                keys: "logo,app_name,facebook,instagram,youtube,telegram,tiktok,footer_text_ar,footer_text_ku,footer_video_url",
            })
        )
        .then((res) => {
            logo.value = res.data.logo;
            settings.value = res.data;
        });
});
</script>
