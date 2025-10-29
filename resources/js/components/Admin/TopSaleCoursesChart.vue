<template>
    <div class="bg-white p-3 border  rounded">
        <div class="font-bold mb-2">
            {{ $t('الكورسات الاكثر مبيعا') }}
        </div>
        <canvas
            ref="chart"
            class=" h-96 w-full"
        />
    </div>
</template>
<script setup>
import {onMounted, ref} from "vue";
import Chart from 'chart.js/auto';
import {useI18n} from "vue-i18n";
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    data: Array
})
const chart = ref();
const page = usePage();
const locale = page.props.locale;
const {t} = useI18n();
const data = props.data.map(item => item.count);
const labels = props.data.map(item => item.course.name[locale]);
onMounted(() => {
    new Chart(chart.value, {
        type: 'bar',

        data: {
            labels: labels,
            datasets: [{
                label: t('كورس'),
                data,
                borderWidth: 1,
                borderRadius: 14,

            }]
        },
        options: {
            responsive: true,

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
})

</script>
