<template>
    <div class="flex items-center ">


        <DropdownMenu>
            <DropdownMenuTrigger class="flex gap-1 items-center">
                <img alt="Language Switcher Icon" class="h-5" src="/assets/img/earth.svg">
                <span class="font-rabar-004">{{ $t('اللغة') }}</span>

            </DropdownMenuTrigger>
            <DropdownMenuContent class="mx-3">
                <DropdownMenuItem class="font-rabar-022" style="direction: rtl" @click="changeLocale('ar')">
                    {{ $t('العربية') }}
                </DropdownMenuItem>
                <DropdownMenuItem class="font-rabar-022" style="direction: rtl" @click="changeLocale('ku')">
                    {{ $t('كوردي') }}
                </DropdownMenuItem>

            </DropdownMenuContent>
        </DropdownMenu>
    </div>
</template>
<script setup>
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel, DropdownMenuSeparator,
    DropdownMenuTrigger
} from "@/components/ui/dropdown-menu/index.js";
import {router, usePage} from "@inertiajs/vue3"

const page = usePage();

function changeLocale(locale) {
    if (typeof window !== "undefined") {
        window.location = (route(page.props.current_route_name, {
            ...page.props.current_route_params,
            locale: locale
        }))
    }

}
</script>
