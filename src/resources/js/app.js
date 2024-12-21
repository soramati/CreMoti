import './bootstrap';
import { createApp } from 'vue';
import CountDownTimer from './components/CountDownTimer.vue';
import BarChart from './components/BarChart.vue';
import GraphDoughnut from './components/GraphDoughnut.vue';



const app = createApp({});
app
    .component('count-down-timer', CountDownTimer)
    .component('bar-chart', BarChart)
    .component('graph-doughnut', GraphDoughnut)
    .mount('#app');