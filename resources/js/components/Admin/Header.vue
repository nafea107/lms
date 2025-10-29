<template>
    <header class="sticky top-0 flex h-16 items-center gap-4 border-b  px-4 md:px-6 bg-white z-50">
        <div class="max-w-7xl mx-auto w-full flex">
            <nav
                class="hidden flex-col gap-6 text-lg font-medium md:flex md:flex-row md:items-center md:gap-5 md:text-sm lg:gap-6">
                <Link
                    :href="route('landing.home')"
                >
                    <img :src="`/storage/${logo}`" alt="Logo" class="h-8">

                </Link>
                <Link v-for="item in menu.items" :key="item.link" :href="item.link"
                      class="text-foreground transition-colors hover:text-foreground"
                      v-text="item.label"
                >
                </Link>

            </nav>
            <Sheet>
                <SheetTrigger as-child>
                    <Button
                        class="shrink-0 md:hidden bg-white text-gray-900 hover:text-gray-700 hover:bg-white border-gray-900 "
                        size="icon"
                        variant="outline"
                    >
                        <Menu class="h-5 w-5"/>
                        <span class="sr-only">Toggle navigation menu</span>
                    </Button>
                </SheetTrigger>
                <SheetContent side="left">
                    <nav class="grid place-content-center gap-6 text-lg font-medium">
                        <a
                            :href="route('landing.home')"
                            class="flex items-center  gap-2 text-lg font-semibold"
                        >
                            <img :src="`/storage/${logo}`" alt="" class="w-24 h-10">
                        </a>
                        <Link v-for="item in menu.items" :key="item.link" :href="item.link"
                              class="hover:text-foreground text-center" v-text="item.label">
                        </Link>

                    </nav>
                </SheetContent>
            </Sheet>
            <div class="flex  items-center gap-4  md:gap-2 lg:gap-4 ms-auto">

                <DropdownMenu>
                    <DropdownMenuTrigger as-child class="bg-white">
                        <Button class="rounded-full" size="icon" variant="primary">
                            <CircleUser class="h-5 w-5"/>
                            <span class="sr-only">Toggle user menu</span>
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuSeparator/>
                        <DropdownMenuItem @click="router.visit(route('admin.profile.edit'))">{{
                                $t('الملف الشخصي')
                            }}
                        </DropdownMenuItem>
                        <DropdownMenuSeparator/>
                        <DropdownMenuItem @click="router.visit(route('logout'))">{{
                                $t('تسجيل الخروج')
                            }}
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </div>
        </div>
    </header>
</template>

<script setup>
import {CircleUser, Menu} from "lucide-vue-next";
import {Link, router} from "@inertiajs/vue3";
import {
    Sheet,
    SheetContent,
    SheetTrigger,
} from '@/components/ui/sheet'
import {
    DropdownMenu,
    DropdownMenuContent, DropdownMenuItem,
    DropdownMenuLabel, DropdownMenuSeparator,
    DropdownMenuTrigger
} from "@/components/ui/dropdown-menu/index.js";
import {Button} from "@/components/ui/button/index.js";
import {Input} from "@/components/ui/input/index.js";
import useAdminMenu from "@/lib/useAdminMenu.js";
import {onMounted, ref} from "vue";

const menu = useAdminMenu()

const logo = ref(null);

onMounted(() => {
    axios.get(route('landing.settings', {
        keys: 'logo'
    })).then((res) =>
        logo.value = res.data.logo
    )
})

</script>
