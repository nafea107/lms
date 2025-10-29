<template>
    <div class="px-3 mx-auto max-w-7xl py-5 w-full">
        <Head :title="quiz.name[locale]"/>
        <div class="">

            <div v-for="(question,qi) in quiz.questions" :key="`question-${question.id}`">
                <h4 class="text-lg font-rabar-021 bg-[#1a3637] text-white p-2">
                    {{ qi + 1 }} - {{ question.question[locale] }}
                </h4>
                <div class="mt-3">
                    <div v-for="(answer, ai) in question.answers" :key="`question-${question.id}-${answer.id}`"
                         class="p-2 flex items-center gap-2 text-gray-700">
                        <input :id="`question-${question.id}-${answer.id}`"
                               :disabled="isFinished"
                               :name="`question-${question.id}`"
                               :value="answer.id"
                               type="radio"
                               @input="onAnswerChange($event,question.id)"/>
                        <label :for="`question-${question.id}-${answer.id}`">
                            {{ answer.answer[locale] }}
                        </label>
                        <div v-if="isFinished">

                            <div v-if="answer.is_true">

                                <Icon
                                    class="text-xl text-emerald-900"
                                    icon="gg:check-o"/>
                            </div>
                            <Icon v-if="!answer.is_true && answers[question.id] == answer.id"
                                  class="text-xl text-red-500"
                                  icon="raphael:no"/>
                        </div>

                    </div>
                </div>


            </div>

            <div class="flex justify-end">
                <Button v-if="!isFinished"
                        @click="onSubmit">
                    {{ $t('ارسال') }}
                </Button>
            </div>
        </div>
</template>

<script setup>
import {usePage, Head, Link} from "@inertiajs/vue3";
import LandingLayout2 from '@/Layouts/LandingLayout2.vue'

defineOptions({
    layout: LandingLayout2
})
import {Icon} from "@iconify/vue";
import {ref} from "vue";
import {Button} from "@/components/ui/button/index.js";
import Swal from "sweetalert2";
import {useI18n} from "vue-i18n";

const props = defineProps({
    quiz: Object
})
const page = usePage()
const locale = page.props.locale;
const answers = ref({});
const isFinished = ref(false);
const {t} = useI18n();


function onAnswerChange(event, id) {
    if (!isFinished.value) {
        answers.value[id] = event.target.value;
    }
}

function onSubmit() {
    isFinished.value = true
    let totalDegree = 0;
    let studentDegree = 0
    for (const question of props.quiz.questions) {
        totalDegree += 1;
        studentDegree += 1;
        for (const answer of question.answers) {
            if (answer.is_true && answers.value[question.id] != answer.id) {
                studentDegree -= 1
            }
        }
    }
    Swal.fire(
        {
            title: `${t('النتيجة')}  ${(studentDegree / totalDegree * 100).toFixed(2)}%`,
            icon: 'success'
        }
    )
}
</script>
