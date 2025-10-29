<template>
    <div class="max-w-7xl mx-auto w-full px-3">
        <h3 class="text-2xl mb-5 font-rabar-004" v-text="$t('تعديل درس')"></h3>
        <Head :title="$t('تعديل درس')"/>
        <form enctype="multipart/form-data" @submit.prevent="onSubmit">

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <InputLabel :value="$t('الاسم العربي')" class="font-rabar-021"/>

                    <Input
                        v-model="form.name.ar"
                        :placeholder="$t('الاسم العربي')"
                        autocomplete="name"
                        autofocus
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                        required
                        type="text"
                    />

                    <InputError :message="form.errors['name.ar']" class="mt-2 font-rabar-022"/>
                </div>

                <div>
                    <InputLabel :value="$t('الاسم الكردي')" class="font-rabar-021"/>

                    <Input
                        v-model="form.name.ku"
                        :placeholder="$t('الاسم الكردي')"
                        autocomplete="name"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                        required
                        type="text"
                    />

                    <InputError :message="form.errors['name.ku']" class="mt-2 font-rabar-022"/>
                </div>


                <div>
                    <InputLabel :value="$t('الكورس')" class="font-rabar-021" for="email"/>
                    <Select v-model="form.course_id" class="focus-visible:ring-0">
                        <SelectTrigger class="bg-transparent border-emerald-700 focus:ring-0 mt-2">
                            <SelectValue :placeholder="$t('الكورس')" class="w-full flex justify-end"/>
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem v-for="course in courses" :key="course.id.toString()"
                                        :value="course.id.toString()"

                            >
                                {{ course.name[locale] }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError :message="form.errors.course_id" class="mt-2 font-rabar-022"/>
                </div>

                <div>
                    <InputLabel :value="$t('الفصل')" class="font-rabar-021" for="email"/>

                    <Select v-model="form.chapter_id" class="focus-visible:ring-0">
                        <SelectTrigger class="bg-transparent border-emerald-700 focus:ring-0 mt-2">
                            <SelectValue :placeholder="$t('الفصل')" class="w-full flex justify-end"/>
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem v-for="chapter in chapters" :key="chapter.id.toString()"
                                        :value="chapter.id.toString()">
                                {{ chapter.name[locale] }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError :message="form.errors.chapter_id" class="mt-2 font-rabar-022"/>
                </div>

                <div>
                    <InputLabel :value="$t('رابط يوتيوب')" class="font-rabar-021"/>

                    <Input
                        v-model="form.yt_url"
                        :placeholder="$t('رابط يوتيوب')"
                        autocomplete="off"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                        type="url"
                    />

                    <InputError :message="form.errors['yt_url']" class="mt-2 font-rabar-022"/>
                </div>


                <div>
                    <div class="flex gap-2 items-baseline">
                        <InputLabel :value="$t('ملف')" class="font-rabar-021" for="email"/>
                        <a v-if="typeof form.file === 'string'" :href="`/storage/${form.file}`"
                           class="text-sm text-emerald-700 font-medium" target="_blank">{{ $t('عرض الملف الحالي') }}</a>
                    </div>

                    <Input
                        :placeholder="$t('ملف')"
                        accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/jpeg, image/png"
                        class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                        type="file"
                        @change="form.file = $event.target.files[0]"
                    />
                    <InputError :message="form.errors.file"

                                class="mt-2 font-rabar-022"/>
                </div>


            </div>
            <div class="h-[1px] bg-gray-300/70 mt-4 w-full"></div>
            <LangTabs v-model="currentLang" :langs="['ar', 'ku']" class="mt-4"/>
            <div class="flex justify-end gap-2 mt-4">
                <Button class="h-[unset] p-3" type="button" @click="addQuestionAndAnswers">
                    <Icon icon="material-symbols:add"/>
                </Button>

            </div>

            <div v-for="(question_and_answer, qi) in form.quiz.question_and_answers" :key="`question_and_answer-${qi}`"
                 class="mt-4">
                {{ `${$t('السؤال')} ${qi + 1}` }}
                <div>
                    <div>
                        <div class="flex justify-between items-baseline">
                            <InputLabel :value="currentLang==='ar'? $t('السؤال العربي') : $t('السؤال الكردي')"
                                        class="font-rabar-021"/>
                            <div class="flex justify-end gap-2">
                                <Button class="h-[unset] p-3" type="button" @click="addQuestionAndAnswers">
                                    <Icon icon="material-symbols:add"/>
                                </Button>
                                <Button class="h-[unset] p-2 group border-red-500 hover:bg-red-500" type="button"
                                        variant="outline"
                                        @click="removeQuestionAndAnswers(qi)">
                                    <Icon class="text-red-500 group-hover:text-white" icon="pajamas:remove"/>
                                </Button>
                            </div>
                        </div>

                        <Input
                            v-model="question_and_answer.question[currentLang]"
                            :placeholder="(currentLang==='ar'? question_and_answer.question.ku : question_and_answer.question.ar)"
                            autocomplete="name"
                            autofocus
                            class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "
                            required
                            type="text"
                        />

                        <InputError :message="form.errors[`quiz.question_and_answers.${qi}.question.${currentLang}`]"
                                    class="mt-2 font-rabar-022"/>
                    </div>
                    <div class="space-y-4 mt-4 border border-gray-200 p-2">
                        <div v-for="(answer, ai) in question_and_answer.answers" :key="`answer-${ai}`">
                            <div class="flex justify-between items-baseline">
                                <InputLabel
                                    :value="currentLang === 'ar'? $t('الاجابة العربية') : $t('الاجابة الكردية')"
                                    class="font-rabar-021"/>
                                <Button class="h-[unset] p-2 group border-red-500 hover:bg-red-500" type="button"
                                        variant="outline"
                                        @click="removeAnswer(qi,ai)">
                                    <Icon class="text-red-500 group-hover:text-white" icon="pajamas:remove"/>
                                </Button>
                            </div>
                            <div class="flex justify-between items-center">
                                <Input
                                    v-model="answer.answer[currentLang]"
                                    :placeholder="(currentLang === 'ar'? answer.answer.ku : answer.answer.ar)"
                                    autocomplete="name"
                                    class="mt-2 block w-full bg-transparent border-emerald-700 focus-visible:ring-0 "/>
                                <div class="basis-[2rem] flex justify-center items-baseline">

                                    <div
                                        :class="{
                                        'bg-emerald-900/90' :answer.is_true
                                    }"
                                        class="border-emerald-900/90 border rounded w-4 h-4 flex items-center justify-center text-white"
                                        @click.prevent="onRightAnswerClicked(question_and_answer, answer)"
                                    >
                                        <Icon v-if="answer.is_true" icon="ic:baseline-check"/>
                                    </div>

                                </div>
                            </div>
                            <InputError
                                :message="form.errors[`quiz.question_and_answers.${qi}.answers.${ai}.answer.${currentLang}`]"
                                class="mt-2 font-rabar-022"/>
                        </div>
                        <div
                            class="p-2 border cursor-pointer border-gray-300 hover:bg-gray-100 rounded flex justify-center items-center"
                            @click="addAnswer(qi)">
                            {{ $t('اضافة اجابة') }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-4 ">


                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    :processing="form.processing"
                    class="ms-auto block"
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
import {Input} from "@/components/ui/input/index.js";
import LangTabs from "@/components/LangTabs.vue";
import {onMounted, ref, watch} from "vue";
import {Icon} from "@iconify/vue";
import Swal from "sweetalert2";
import {useI18n} from "vue-i18n";


defineOptions({
    layout: AdminLayout
})

const props = defineProps({
    courses: Array,
    lesson: Object,
})

const page = usePage();
const locale = page.props.locale;
const currentLang = ref('ar');
const chapters = ref([]);
const {t} = useI18n();

const question_and_answers_arr = [];
props.lesson.quiz?.questions.forEach(question => {
    question_and_answers_arr.push({
        ...question,
        answers: question.answers
    })
})
const form = useForm({
    ...props.lesson,
    course_id: props.lesson.course_id.toString(),
    chapter_id: props.lesson.course_id.toString(),
    quiz: {
        name: props.lesson.quiz.name,
        question_and_answers: question_and_answers_arr,

        removed_questions: [],
        removed_answers: [],
    },
    _method: 'PUT',
});


// Function to deeply clone the chapter object
function question_and_answers() {
    return {
        question: {
            ar: '',
            ku: '',
        },
        answers: [
            answer(true),
            answer(false),
        ]
    };
}

function answer(isTrue) {
    return {
        answer: {
            ar: '',
            ku: '',
        },
        is_true: isTrue,
    }
}

function addQuestionAndAnswers() {
    form.quiz.question_and_answers.push(question_and_answers()); // Use deep clone when adding
}

function removeQuestionAndAnswers(index) {
    const question_and_answers = form.quiz.question_and_answers;
    if (question_and_answers[index]?.id) {
        form.quiz.removed_questions.push(question_and_answers[index]?.id)
    }
    question_and_answers.splice(index, 1);
}

function addAnswer(questionIndex) {
    let isTrueExist = false;
    form.quiz.question_and_answers[questionIndex].answers.forEach(answer => {
        if (answer.is_true) {
            isTrueExist = true;
        }
    });
    form.quiz.question_and_answers[questionIndex].answers.push(answer(!isTrueExist));
}


function removeAnswer(questionIndex, answerIndex) {
    const answers = form.quiz.question_and_answers[questionIndex].answers;
    if (answers.length > 2) {
        const isTrue = answers[answerIndex].is_true;
        if (answers[answerIndex]?.id) {
            form.quiz.removed_answers.push(answers[answerIndex]?.id)
        }
        answers.splice(answerIndex, 1);
        if (isTrue) {
            answers[answers.length - 1].is_true = true;
        }
    }
}

function onRightAnswerClicked(question_and_answer, answer) {
    question_and_answer.answers.forEach((answer, i) => {
        answer.is_true = false;
    })
    answer.is_true = true;
}

async function onSubmit() {
    await form.transform((data) => {
        const data2 = {...data}
        data2.quiz.name = data2.name
        return data2;
    }).post(route('admin.lessons.update', {lesson: props.lesson.id}), {
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


watch(form, (newValue, oldValue) => {
    chapters.value = props.courses.filter(item => item.id.toString() === (newValue?.course_id?.toString() ?? form.course_id))[0]?.chapters ?? [];
})

onMounted(() => {
    chapters.value = props.courses.filter(item => item.id.toString() === form.course_id)[0]?.chapters ?? [];

})

</script>
