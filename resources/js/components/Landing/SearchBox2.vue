<template>
    <div class="relative  items-center    md:w-full md:max-w-xs">


        <Input id="search"
               v-model="searchTerm"
               :placeholder="$t('بحث...')"
               class="pe-10 py-1 flex items-center bg-gray-100 w-full rounded-3xl  focus-visible:outline-none focus-visible:ring-0 focus-visible:ring-gray-950 focus-visible:-ring-offset-2 bg-transparent caret-white text-gray-200 placeholder:text-gray-200"
               type="search"
               @keyup.enter="onSearch"/>
        <span class="absolute end-0 inset-y-0 flex items-center justify-center px-3"
              @click="onSearch">
            <Icon class="text-white" icon="tabler:search"/>
        </span>
        <div
            v-show="suggestions.length > 0"
            ref="suggestionsBox"
            class="absolute top-full w-full text-right text-sm text-slate-600 dark:text-slate-300 bg-white border shadow rounded-b-lg mt-1 max-h-52 flex flex-col z-40"
        >
            <div class="flex-grow overflow-y-scroll">
                <Link
                    v-for="suggestion in suggestions"
                    :key="suggestion.id"
                    :href="route('landing.courses.show',{course:suggestion.id})"
                    class="p-2  hover:bg-gray-200 cursor-pointer transition w-full block"
                    @click="suggestions = []"
                >
                    {{ suggestion.name[locale] }}
                </Link>
            </div>
            <div
                v-show="suggestions.length > 0"
                class="p-2 py-1.5 bg-gray-200/60 font-medium hover:bg-gray-200 cursor-pointer transition text-center text-emerald-600"
                @click="onSearch"
            >
                {{ $t('عرض الكل') }}
            </div>
        </div>

    </div>
</template>

<script setup>
import {Input} from '@/components/ui/input'
import {Icon} from "@iconify/vue";
import {ref, watch} from "vue";
import {usePage, Link, router} from "@inertiajs/vue3";
import {onClickOutside} from "@vueuse/core";

const page = usePage();
const current_route_params = page.props.current_route_params
const timeout = ref();
const searchTerm = ref('');
const suggestions = ref([]);
const suggestionsBox = ref(null)
const locale = page.props.locale
if (searchTerm.value === "") {
    searchTerm.value = current_route_params.search
}

onClickOutside(suggestionsBox, event => suggestions.value = []);

async function getSuggestions() {
    const res = await axios.get(
        `${route("landing.search.data")}?per_page=18&s=${searchTerm.value}`,
    );
    suggestions.value = res.data.data;
    console.log(suggestions.value)

}

async function onSearch() {
    router.visit(route('landing.search.show', {
        search: searchTerm.value,

    }))
}


watch(searchTerm, () => {
    if (timeout.value) clearTimeout(timeout.value);
    timeout.value = setTimeout(getSuggestions, 400);
});

</script>

