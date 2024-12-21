<template>
  <div>
    <h2>{{ responseData }}</h2>
   <p> {{ showModal }}</p>
    <button @click="getData">testApi</button>

    <button @click="showModal = !showModal">もーだる</button>
    <div>
      
      <div v-if="showModal" @click="toggleModal" class="day_modal">
        <div class="modal_content">
          <div class="modal_text">
            <h1>いつまでに達成したいですか?</h1>
            <div class="relative z-0 w-full mb-5 group">
              <input type="datetime-local" 
              name="goal[goals_deadline]"
              value="{{ old('goal.goals_deadline') }}" id="date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
              <label for="date" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">達成したい日</label>
            </div>
            <div class="btn_wrapper">
              <button type="submit" class="text-white bg-green-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">スタート</button>
              <button type="submit" class="text-white bg-gray-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">あとでやる</button>
            </div>
          </div> 
                </div>  
              </div>
              <button   id="modal_btn" onclick="toggleModal()">トグル</button>
                    
      </div>
    </div>
  </template>

  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  let showModal = ref(false);  
  export default {
    setup() {
      return { showModal };
    },
    data() {
      return {
        responseData: [],
      }
    },

    methods: {
      toggleModal() {
        console.log('clicked');
        console.log(showModal.value);
        showModal.value = !showModal.value;
      },
      getData() {
            axios.get('/testApi', {})
            .then(response => {
                this.responseData = response.data;
            })
            .catch(error => {
                alert('API ERROR');
            })
            .finally()
        },
        mounted() {
        this.getData();
    },

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
