<script setup lang="ts">
import { Chart as ChartJS, ArcElement, Tooltip, Title, Legend } from 'chart.js'
import { Doughnut } from 'vue-chartjs'
import { defineProps, onMounted } from 'vue'
import { ref } from 'vue'

ChartJS.register(ArcElement, Tooltip, Title, Legend)

let props = defineProps(['time', 'start', 'text']);
let time = ref(props.time);
let start = ref(props.start);

let y = time.value / start.value * 100;
let x = (start.value - time.value) / start.value * 100;

let s = time.value % 60;
let m = Math.floor(time.value / 60);
m = m % 60;
let h = Math.floor(time.value / 60 / 60);
let d = Math.floor(time.value / 60 / 60 / 24);
let text = `${h}時間${m}分${s}秒`;
let day = `(${d}days)`;

// チャート用のデータ
const data = {
  datasets: [{
    data: [x, y],
    backgroundColor: [
      'RGBA(255, 255, 255,0.8)',
      'RGBA(255, 255, 255,0)'
    ],
  }]
};

// チャート描画のオプション
const options = {
  responsive: true,
  maintainAspectRatio: false,
  animation: {
    animateScale: false,
    animateRotate: false
  },
  cutout: '85%',
  plugins: {
    title: {
      display: true,
      text: '',
      font: {
        weight: 'bold',
        size: 16
      },
    },
    legend: {
      display: true,
      position: 'bottom',
      reverse: true,
      labels: {
        font: {
          size: 20
        }
      }
    },
  }
}

// ドーナツチャートの中央に表示させるプラグインを定義する
const ratioText = {
  id: 'ratio-text',
  beforeDraw(chart: any) {
    const { ctx, chartArea: { top, width, height } } = chart
    ctx.save()
    //チャート描画部分の中央を指定
    ctx.fillRect(width / 2, top + (height / 2), 0, 0)
    //フォントのスタイル指定
    ctx.font = 'bold 1.5rem Roboto'
    ctx.fillStyle = '#fff'
    ctx.textAlign = 'center'
    ctx.textBaseline = 'middle'
    // ctx.fillText(day, width / 2, top + (height / 1.8))
    // ctx.fillText(text, width / 2, top + (height / 2.2))
  }
}
</script>

<template>
  <div>
    <div class="doughnut-graph">
      <!-- ドーナツチャートの描画 -->
      <Doughnut class="doughnut" :data="data" :options="options" :plugins="[ratioText]" />
    </div>
  </div>
</template>

<style>
.doughnut-graph {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  max-width: 1100px;

  z-index: -1;

 

}

@media (max-width: 768px) {
  .doughnut-graph {
    min-height: 100dvw;
  }
}

</style>
