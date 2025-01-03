<template> 
  <loading-component v-if="isShowLoading" />
  <div class="home">
    <div class="col">
      <div class="count_page">
        <div v-if="isSetGoal" class="count_down">
          <count-down-timer :data="setGoal" :key="setGoal"/>
        </div>
        <div v-else>
          <div>
            <top-page />
          </div>                 
        </div>
      </div>
      <div class="center create_bar">
            <!-- <create-page></create-page> -->
           
        </div>
    </div>
    <div class="cards_wrapper w-full">
       
            <goal-list  />
</div>
  </div>
</template>

<script>
import { ref, computed } from 'vue';
import axios from 'axios';
import LoadingComponent from './LoadingComponent.vue';

export default {
  data() {
    return {
      responseData: {},
      showModal: ref(false),
      setGoal: [],
      isShowLoading: true,
    }
  },
  props: {
    deadline: {
      type: Object,
      required: true
    }
  },
  mounted() {
    this.getData();
  },
  computed: {
    isSetGoal() {
      return this.setGoal.length !== 0;
    }
  },
  methods: {
    is_set_goals(int) {
      return int === 1;
    },
    toggleShowModal() {
      this.showModal = !this.showModal;
    },
    getData() {
      axios.get('/api/get', {})
        .then(response => {
          this.responseData = response.data;
          this.SelectSetGoal();
          this.isShowLoading = false;  
        })
        .catch(error => {
          this.isShowLoading = false;
        });
    },
    SelectSetGoal() {  
      this.responseData.data.filter((data) => {
        if (data.goals_is_set === 1) {
          this.setGoal = data;
          console.log(this.setGoal);
        }
      })
    },
  }
};
</script>

<style scoped>

.col {

display: flex;
flex-direction: column;
justify-content: center;
  height: 100vh;
  margin: bottom 50px;
}
.count_page {
 

  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
@media (max-width: 768px) {
  .count_page {
    width: 100%;
    display: flex;
    flex-direction: column;
  }
  .top {
    padding: 3rem 0;
    background: #5CE5B4;
    height: 100vh;
  }
}
</style>
