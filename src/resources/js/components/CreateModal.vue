<template>
  <div>
    <div class="modal_content">
      <div class="modal_text">
        <div v-show="modal_num === 1" class="change_text">
          <h1>何をクリアしたいか書いてみましょう（{{ goals_name.length }}/20字）</h1>
          <div class="relative z-0 w-full mb-5 group">
            <input v-model="goals_name" type="text" id="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="goal[goals_name]" :value="goals_name" placeholder="" required />
            <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">タイトル</label>
            <small class="error_msg">{{ errormsg(goals_name.length) }}</small>
            <p class="title__error" style="color:red"></p>
            <div class="btn_wrapper">
              <button type="submit" @click="beforePabe" class="text-white bg-gray-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">もどる</button>
              <button :disabled="showBtn(goals_name)" type="submit" @click="nextPage" class="text-white bg-green-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">次へ</button>
            </div>
          </div>
        </div>
        <div v-show="modal_num === 2" class="change_text">
          <h1>いつまでに達成したいですか?</h1>
          <div class="relative z-0 w-full mb-5 group">
            <input v-model="goals_deadline" type="datetime-local" name="goal[goals_deadline]" id="date"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="date" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">達成したい日</label>
            <small class="error_msg">{{ errormsg(goals_name.length) }}</small>
          </div>
          <p v-show="isPastDate(goals_deadline)" class="error_msg">過去の日付は入力できません</p>
          <div class="btn_wrapper">
              <button type="submit" @click="beforePabe" class="text-white bg-gray-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">もどる</button>
              <button :disabled="isPastDate(goals_deadline)" type="submit" @click="nextPage" class="text-white bg-green-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">次へ</button>
            </div>
        </div>
        <div v-show="modal_num === 3" class="change_text">
          <h1>クリア達成の条件を明確に書きましょう（{{ goals_conditions.length }}/20字）</h1>
          <small>{{ goals_conditions }}</small>
          <div class="relative z-0 w-full mb-5 group">
            <input v-model="goals_conditions" type="text" maxlength="20" name="goal[goals_conditions]" id="goals_conditions" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="goals_conditions" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">達成する条件</label>
            <small class="error_msg">{{ errormsg(goals_conditions.length) }}</small>
          </div>
          <div class="btn_wrapper">
              <button type="submit" @click="beforePabe" class="text-white bg-gray-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">もどる</button>
              <button :disabled="showBtn(goals_conditions)" type="submit" @click="nextPage" class="text-white bg-green-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">次へ</button>
            </div>
        </div>
        <div v-show="modal_num === 4" class="change_text">
          <h1>ごほうびはどんなものにしましょうか？（{{ goals_reward.length }}/20字）</h1>
          <div class="relative z-0 w-full mb-5 group">
            <input v-model="goals_reward" type="text" name="goal[goals_reward]" id="goals_reward" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{ }}" required />
            <label for="goals_reward" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">達成したら貰えるごほうび</label>
            <small class="error_msg">{{ errormsg(goals_reward.length) }}</small>
          </div>
          <div class="btn_wrapper">
              <button type="submit" @click="beforePabe" class="text-white bg-gray-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">もどる</button>
              <button :disabled="showBtn(goals_reward)" type="submit" @click="nextPage" class="text-white bg-green-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">次へ</button>
            </div>
        </div>
        <div v-show="modal_num === 5" class="change_text">
          <h1>この内容でスタートしてよろしいでしょうか？</h1>
          <div class="relative z-0 w-full mb-5 group">
            <p>タイトル：{{ goals_name }}</p>
            <p>クリア期限：{{ goals_deadline }}</p>
            <p>クリア条件：{{ goals_conditions }}</p>
            <p>ごほうび：{{ goals_reward }}</p>
            <p class="body__error" style="color:red"></p>
          </div>
          <div class="btn_wrapper" >
            <button type="submit" @click="beforePabe" class="text-white bg-gray-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">もどる</button>
            <button type="submit" @click="submit" class="text-white bg-green-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">スタート</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref ,computed} from 'vue';
import axios from 'axios';

let showModal = ref(false);

export default {
  setup() {
    return { showModal };
  },
  data() {
    return {
      responseData: [],
      modal_num: 1,
      goals_name: ref(''),
      goals_deadline: ref(''),
      goals_conditions: ref(''),
      goals_reward: ref(''),
      isVri: ref(false),
    
    }
  
  },
  methods: {
    isPastDate(date) {
      let now = new Date();
      let inputDate = new Date(date);
      if (inputDate < now) {
        return true;
      }
      return false;
    },
    showBtn(str) {
      if (str.length < 1) {
        return true;
      }
      if (str.length > 20) {
        return true;
      }
      return false;
    },
    errormsg(lng) {
      let msg = '';
      if (lng > 20) {
        return '文字数オーバーです';
      }
      if (lng === 0) {
        return '入力してください';
      }
      return msg;
    },
    toggleModal() {
      showModal.value = !showModal.value;
    },
    nextPage() {
      if (this.modal_num < 5) {
        this.modal_num++;
      }
    },
    beforePabe() {
      if (this.modal_num > 1) {
        this.modal_num--;
      }
    },
    submit() {
      let data = {
        goals_name: this.goals_name,
        goals_deadline: this.goals_deadline,
        goals_conditions: this.goals_conditions,
        goals_reward: this.goals_reward,
        goals_is_set: 1
      };
      axios.post('/api/store', data).catch(error => {
        alert(error);
      });
      console.log(data);
      window.location.reload();
    },
    mounted() {
      this.goals_deadline = this.getToday();


    },
  
  },
};
</script>

<style scoped>
.error_msg {
  color: red;
}
.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}
.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}
.btn {
  background-color: blue;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
}
.hidden {
  display: none;
}
.create_page {
  width: 95%;
  min-height: 80vh;
  margin-top: 10vh;
  margin-left: auto;
  margin-right: auto;
}
.d_col {
  display: flex;
  flex-direction: column;
}
.btn_wrapper {
  display: flex;
  justify-content: space-between;
  width: 100%;
}
@media (max-width: 768px) {
  .modal_content {
    min-width: 98dvw;
    min-height: 66vh;
  }
  .modal_text {
    width: 90%;
  }
}
</style>
