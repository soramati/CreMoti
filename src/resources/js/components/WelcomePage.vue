<template>
  <div class="welcome">
    <div class="welcome_box">
      <p class="animate__animated animate__fadeIn title0">Creator's motivation</p>
      <span class="span"></span>
      <p class="animate__animated animate__fadeIn title1">"The best way to predict the future is to create it."</p>
      <p class="animate__animated animate__fadeIn title1">「未来を予測する最善の方法は、それを自分で創ることだ。」</p>
      <p class="animate__animated animate__fadeIn title2">— Peter Drucker </p>
      <div class="button_box">
        <a class="button-30 " href="/register">新規登録</a>
        <span class="span"> </span>
        <a class="button-30" href="/login">ログイン</a>
      </div>
    </div>


  </div>
</template>

<script>
import { ref } from 'vue';
import { Doughnut } from 'vue-chartjs';



export default {
  data() {
    return {

    }
  },
}


</script>



<style scoped>
.title0 {
  font-family: "ivymode-variable", sans-serif;
  font-variation-settings: "ital" 0, "wght" 700;

  font-size: 2rem;
  /* font-weight: ; */
  text-align: center;
  color: #f8f8f8;
}

.button_box {
  margin-top: 23px;
}

.span {
  margin: 0 10px;
}

.title1 {
  font-family: "a-otf-ryumin-pr6n", serif;
  font-weight: 500;
  font-style: normal;
  font-size: 1rem;
  font-weight: bold;
  text-align: center;
  color: #f8f8f8;
}

.title2 {
  font-family: "a-otf-ryumin-pr6n", serif;
  font-weight: 500;
  font-style: normal;
  font-weight: bold;
  text-align: center;
  color: #f8f8f8;
}

.button-30 {
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  max-width: 250px;
  /* width: 100%; */
  margin: 0 auto;
  padding: .6em 2em;
  /* border: 1px solid #5ce5b4; */
  border-radius: 5px;
  background-color: #fff;
  color: #5ce5b4;
  font-size: 1.3rem;
}

.button-30:disabled {

  color: #fff;
  background-color: #b0aeaeb6;

}

.botton {
  display: block;
  width: 100px;
  height: 50px;
  margin: 0 auto;
  margin-top: 20px;
  text-align: center;
  line-height: 50px;
  background-color: #f8f8f8;
  border-radius: 5px;
  color: #333;
  text-decoration: none;
  font-size: 16px;
  font-weight: bold;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.welcome {
  text-align: center;

  width: 100%;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

}

.welcome_box {
  min-width: 300px;
  width: 50%;
  height: 300px;

}
</style>