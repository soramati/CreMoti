  <template>
    <div>
      <div>

        <graph-doughnut :time="time" :key="time" :start="deadline.int_full" />
      </div>


      <div class="card">
        <div>
          <div class="card_title">
            <h4>
              <a href="/goals/{{ responseData.id }}">{{ responseData.goals_name }}</a>
            </h4>
          </div>
          <p>id{{ responseData.id }}</p>
          <p>期限：{{ responseData.goals_deadline }}</p>
          <p>条件：{{ responseData.goals_conditions }}</p>
          <p>ごほうび：{{ responseData.goals_reward }}</p>
        </div>
        <div class="content mt-10">
      
          <button class="button" type="button" @click="resetGoal()">あとでやる</button>
    
        </div>
        <div class="content">

            <button class="button" type="button" @click="deleteGoal()">delete</button>
      
        </div>
      </div>

    </div>
  </template>

  <script>
  import { ref } from 'vue';
  import axios from 'axios';

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
        h: 0,
        responseData: [],
      };
    },
    mounted() {
      this.getData();
      setInterval(() => {
        this.time = this.time - 1;
        this.s = this.time % 60;
        this.m = Math.floor(this.time / 60) % 60;
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
        return this.deadline.int;
      },
      getData() {
        axios.get('/testApi', {})
          .then(response => {
            this.responseData = response.data;
          })
          .catch(error => {
            alert('API ERROR');
          });
      },
      deleteGoal() {
        axios.post('/destroy/' + this.responseData.id)
          .then(response => {
            alert('削除しました');
            window.location.href = '/';
          })
          .catch(error => {
            alert(error);
          });

      },
      resetGoal() {
        axios.post('/reset/' + this.responseData.id)
          .then(response => {
            alert('リセットしました');
            window.location.href = '/';
          })
          .catch(error => {
            alert(error);
          });
      },
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
