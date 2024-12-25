import './bootstrap';
import { createApp } from 'vue';
import CountDownTimer from './components/CountDownTimer.vue';
import BarChart from './components/BarChart.vue';
import GraphDoughnut from './components/GraphDoughnut.vue';
import CreateModal from './components/CreateModal.vue';
import HeaderNav from './components/HeaderNav.vue';
import TaskCard from './components/TaskCard.vue';
import CreatePage from './components/CreatePage.vue';



const app = createApp({});
app
    .component('count-down-timer', CountDownTimer)
    .component('bar-chart', BarChart)
    .component('graph-doughnut', GraphDoughnut)
    .component('create-modal', CreateModal)
    .component('header-nav', HeaderNav)
    .component('task-card', TaskCard)
    .component('create-page', CreatePage)
    .mount('#app');