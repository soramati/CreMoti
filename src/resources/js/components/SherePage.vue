<template>
  
  <loading-component v-if="isShowLoading" />
  <div class="home">
    <div class="col">

      <div class="count_page">
        <div  class="count_down">
          <shere-count-down-timer :data="data" :key="data"/>
        </div>
      </div>
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
    data: {
      type: Object,
      required: true
    }
  },
  mounted() {
    this.isShowLoading = false;

   
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

          this.responseData = this.data
          this.SelectSetGoal();
          this.isShowLoading = false;
       
    },
    SelectSetGoal() {  
      this.responseData.data.filter((data) => {
        if (data.goals_is_set === 1) {
          this.setGoal = data;
      
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
