  <template>
    <div class="top_page">
      <div>

        <div class="nokori_box ">
          <p class="nokoei_small">{{data.goals_name}}<br>まで残り...</p>
          <div class="sec_box d-flex">
            <p class="nokori sec">{{time}}</p>
            <small class="tani">秒</small>
          </div>
          <p  class="nokori parsent nokoei_small">{{nokoriParsent}}%</p>
          <p class="nokori min nokoei_small">{{nokoriMin}}分</p>
          <p class="nokori week nokoei_small">{{nokoriWeek}}週間</p>
          <p class="nokori day nokoei_small">{{nokoriDay}}日</p>

        </div>
        <graph-doughnut :time="time" :key="time" :start="getCreatedToDeadline()"  />
      </div>
    </div>
   

    
      <button @click="doneApi" class="button-30 done_btn">できた！</button>
      <button @click="toggleShowModal()" class="button-30 done_btn">編集する</button>
      <!-- <button @click="toggleMenu">➖</button> -->
      <div v-show="isShowMenu" class="pullMenu">
        <div class="content mt-10">
          <button class="button" type="button" @click="resetGoal()">あとでやる</button>
        </div>
        <div class="content">
          <button class="button" type="button" @click="deleteGoal()">delete</button>
        </div>
      </div>
      <create-modal v-if="showModal" :responseData="responseData" :key="responseData" ></create-modal>
      <div  @click="toggleShowModal()" v-show="showModal" class="modal_wrapper">
      </div>
  </template>

<script>
  import { ref,computed,defineProps } from 'vue';
  import axios from 'axios';


  export default {
    data() {
      return {
        someDate: '2019-02-01',
        count: 1,
        time: 0,
        y: 0,
        m: 0,
        d: 0,
        s: 0,
        h: 0,
        responseData: [],
        isShowMenu: false,
        start: ref(0),
        nowPercent: 0,
        showModal: ref(false),
        isShowLoading: true,
      };
    },
    props: {
      data: {
        type: Object,
        required: true
      }
    },
    computed: {

      nokoriParsent() {
        return Math.ceil(this.time / this.getCreatedToDeadline() * 100 * 100) / 100;
      },
      nokoriSec() {
        return this.time;
      },
      nokoriMin() {
        return Math.floor(this.time / 60);
      },
      nokoriDay() {
        return Math.floor(this.time / 60 / 60 / 24);
      },
      nokoriWeek() {
        return Math.floor(this.time / 60 / 60 / 24 / 7);
      },
      timeMsg() {
        let timeMsg = `${this.d}日${this.h}時間${this.m}分${this.s}秒`;

        return timeMsg;
      }
    },
    
    mounted() {
      this.getdiffSec();
      this.setTime(0);
      setInterval(() => {
        this.setTime(1);
        this.isShowLoading = false;
      }, 1000);
      // console.log(this.responseData);
      console.log('this.responseData');
    },
    methods: {
      setTime(int){
        this.time = this.time - int;
        this.s = this.time % 60;
        this.m = Math.floor(this.time / 60) % 60;
        this.h = Math.floor(this.time / 60 / 60);
        this.d = Math.floor(this.time / 60 / 60 / 24);
      },
      doneApi() {
        axios.post('/done/' + this.data.id)
          .then(response => {
            alert('おめでとうございます！');
            window.location.href = '/';
          })
          .catch(error => {
            alert(error);
          });
      },
      getCreatedToDeadline(){
        const date = new Date(this.data.goals_deadline);
        const now = new Date(this.data.created_at);
        const diff = date - now;
      const diffSec = diff / 1000;
      return Math.floor(diffSec);
      },
        
      
      toggleMenu() {
        this.isShowMenu = !this.isShowMenu;
      },
      formData(date) {

        let dateData = new Date(date);
        let year = dateData.getFullYear();
        let month = dateData.getMonth() + 1;
        let day = dateData.getDate();
        let hour = dateData.getHours();
        let min = dateData.getMinutes();
        let sec = dateData.getSeconds();
        return year + '/' + month + '/' + day+ " " + hour + ':' + min;

      },
      counter() {
        this.count++;
      },
      getdiffSec() {
      const deadline = new Date( this.data.goals_deadline);
      const now = new Date();
      const diff = deadline - now;
         this.time = diff;

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
      toggleShowModal() {
        console.log('toggleShowModal');
        console.log(this.responseData);
        this.showModal = !this.showModal;
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

    }
  }
  </script>

  <style scoped>
  .top_page{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 50px;

  }
  @media  (max-width:768px){
    .top_page{
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .top {

padding: 3rem 0;
background: #5CE5B4;
height: 100vh;
}
  }
  .btn {
    background-color: blue;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
  }

  .card_footer {
 width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .done_btn{
    margin-top: 2rem;
  }
  </style>
