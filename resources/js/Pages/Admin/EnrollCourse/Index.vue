<template>
    <div class="max-w-7xl mx-auto w-full px-3">
        <h3 class="text-2xl mb-5 font-rabar-004" v-text="$t('اشترك في كورس')"></h3>
        <Head :title="$t('اشترك في كورس')"/>
        <form @submit.prevent="submit">

            <div class="grid md:grid-cols-2 gap-4">


                <div>
                    <InputLabel :value="$t('المستخدم')" class="font-rabar-021" for="email"/>

                    <vSelect v-model="form.user_id" :filter="userFilter" :get-option-label="(option) => option.name"
                             :options="users"
                             :reduce="item => item.id"
                             class="mt-2">
                        <template #option="option">
                            <em>{{ option.name }} - {{ option.email }}</em>
                        </template>
                    </vSelect>

                    <InputError :message="form.errors.user_id" class="mt-2 font-rabar-022"/>
                </div>

                <div>
                    <InputLabel :value="$t('الكورس')" class="font-rabar-021" for="email"/>

                    <vSelect v-model="form.course_id" :filter="courseSearch"
                             :get-option-label="(option) => option.name[locale]"
                             :options="courses"
                             :reduce="item => item.id"
                             class="mt-2 courses-select">
                        <template #option="option">
                            <em>{{ option.name[locale] }} </em>
                        </template>
                    </vSelect>

                    <InputError :message="form.errors.course_id" class="mt-2 font-rabar-022"/>
                </div>


            </div>


            <div class="mt-4 ">


                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    :processing="form.processing"
                    class="ms-auto block"
                    @click="onSubmit"
                >
                    {{ $t('حفظ') }}
                </Button>
            </div>
        </form>

    </div>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Head, useForm, usePage} from "@inertiajs/vue3";
import InputError from "@/components/InputError.vue";
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select/index.js";
import {Button} from "@/components/ui/button/index.js";
import InputLabel from "@/components/InputLabel.vue";
import {useI18n} from "vue-i18n";
import {ref, watch} from "vue";
import Swal from "sweetalert2";
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import Fuse from 'fuse.js'

defineOptions({
    layout: AdminLayout
})

const props = defineProps({
    users: Array,
    courses: Array,
})

const page = usePage();
const locale = page.props.locale;
const currentLang = ref('ar');
const {t} = useI18n();


const form = useForm({
    user_id: null,
    course_id: null,
});

function userFilter(options, search) {
    const fuse = new Fuse(props.users, {
        keys: ['email', 'name'],
        shouldSort: true,
    })
    return search.length
        ? fuse.search(search).map(({item}) => item)
        : fuse.list
}

function courseSearch(options, search) {
    const fuse = new Fuse(props.courses, {
        keys: ['name.ar', 'name.ku'],
    })
    return search.length
        ? fuse.search(search).map(({item}) => item)
        : fuse.list
}


function onSubmit() {
    form.post(route('admin.enroll-course.store'), {
        onSuccess: () => {
            Swal.fire(
                {
                    title: t('تم الحفظ'),
                    icon: 'success'
                }
            );
        }
    });
}

</script>

<style>
.courses-select .vs__clear {
    margin: 0 0.5rem;
}
</style>
