  <template>
    <div v-if="responseData.isData === '0'">
      <p>データがありません</p>
    </div>
    
    <h2>達成済み</h2>
    <div class="card_content grid gap-7 sm:grid-cols-2 md:gap-8 xl:grid-cols-3">
      
      <div v-for="goal in doneList" :key="goal.id">
        <div class="card" @click="startGoal(goal.id)">
          <div>
            <div class="card_title">
              <h4>
                <a :href="'/goals/' + goal.id">{{ goal.goals_name }}</a>
              </h4>
            </div>
            <p>期限：{{ goal.goals_deadline }}</p>
            <p>条件：{{ goal.goals_conditions }}</p>
            <p>ごほうび：{{ goal.goals_reward }}</p>
            <p>達成済み{{ goal.goals_is_achieved }}</p>
          </div>
          <div class="content mt-10">
            <button class="button" type="button" @click="resetGoal(goal.id)">あとでやる</button>
          </div>
          <div class="content">
            <button class="button" type="button" @click="deleteGoal(goal.id)">delete</button>
          </div>
        </div>
      </div>
    </div>
    <h2>下書き</h2>
    <div class="card_content grid gap-7 sm:grid-cols-2 md:gap-8 xl:grid-cols-3">
    <div v-for="goal in unSetedList" :key="goal.id">
      <div class="card" >
        <div>
          <div class="card_title">
            <h4>
              <a :href="'/goals/' + goal.id">{{ goal.goals_name }}</a>
            </h4>
            </div>
            <p>期限：{{ goal.goals_deadline }}</p>
            <p>条件：{{ goal.goals_conditions }}</p>
            <p>ごほうび：{{ goal.goals_reward }}</p>
          </div>
          <div class="content mt-10">
            <button class="button" type="button" @click="startGoal(goal.id)">スタート</button>
          </div>
          <div class="content">
            <button class="button" type="button" @click="deleteGoal(goal.id)">delete</button>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  import axios from 'axios';
  import { ref, computed } from 'vue';

  export default {
    data() {
      return {
        responseData: [],
        noneSetList: ref([]),
      };
    },
    computed: {
      doneList() {
        const list = this.responseData.data;
        if (list.length === 0) {
          return 'データがありません';
        }
        let newList = [];
        list.forEach((item) => {
          if (item.goals_is_achieved === 1) {
            newList.push(item);
          }
        });
        return newList;
      },
      unSetedList() {
        const list = this.responseData.data;
        if (list.length === 0) {
          return 'データがありません';
        }
        let newList = [];
        list.forEach((item) => {
          if (item.goals_is_set === 0) {
            newList.push(item);
          }
        });
        return newList;
      },
    },
    mounted() {
      this.getAllGoals();
    },
    methods: {
      startGoal(id) {
        alert('セットしますか？');
        axios.post('/api/start/' + id)
          .then(response => {
            alert('セットしました');
            window.location.href = '/';
          })
          .catch(error => {
            alert(error);
          });
      },
      getListNone() {
        console.log(this.responseData);
        this.noneSetList = this.responseData.data.filter((item) => {
          return item.goals_is_set === 0;
        });
      },
      getAllGoals() {
        axios.get('/api/get', {})
          .then(response => {
            this.responseData = response.data;
          })
          .catch(error => {
            alert(error);
          });
        this.getListNone();
      },
      deleteGoal(id) {
        axios.post('/destroy/' + id)
          .then(response => {
            alert('削除しました');
            window.location.href = '/';
          })
          .catch(error => {
            alert(error);
          });
      },
      resetGoal(id) {
        axios.post('/reset/' + id)
          .then(response => {
            alert('リセットしました');
            window.location.href = '/';
          })
          .catch(error => {
            this.responseData = null;
          });
      },
    },
  };
  </script>

  <style scoped>
  .btn {
    background-color: blue;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
  }
  .card :hover {
    opacity: 0.5;
  }
  </style>
