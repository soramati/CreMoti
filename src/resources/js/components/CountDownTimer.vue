  <template>
    <div>
      <div>
        <graph-doughnut  :time="time" :key="time" :start="deadline.int_full" />
      </div>
    </div>
  </template>

  <script>
  import { ref } from 'vue';
  


  export default {
    data() {
      return {
        someDate: '2019-02-01',
        count: 1,
        time: this.getTime(),
        y: 0,
        m: 0,
        d: 0,
        s: 0,
        h: 0

      };
    },

    mounted() {
      setInterval(() => {
        this.time = this.time - 1;
        this.s = this.time % 60;
        this.m = Math.floor(this.time / 60);
        this.m = this.m % 60;
        this.h = Math.floor(this.time / 60 / 60);
        this.d = Math.floor(this.time / 60 / 60 / 24);
        console.log(this.d);
      }, 1000);
    },
    methods: {
      counter() {
        this.count++;
      },
      getTime() {
        console.log(this.deadline);
        console.log(this.deadline.days);
        return this.deadline.int;
    }

    },
    props: {
      deadline: {
        type: String,
        required: true
      },
      fullTime: {
        type: String,
        required: true
      }
    }
  }

  </script>

  <style scoped>
  .btn {
    background-color: blue;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
  }
  </style>
