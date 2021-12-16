<template>
  <div>
    <navbar v-if="islogin" @log_out="logout" class="navigation"></navbar>
    <router-view @login_user="loginUser" @signup="signup_user"></router-view> 
  </div> 
</template>

<script>

  import Navbar from './components/menu/Navigation.vue';
  export default {
    components: {
      'navbar': Navbar
    },
    data(){
      return{
        islogin: false,
      }
    },
    methods: {
      loginUser(action){
        this.islogin = action;
        console.log("Login successfully!" + action);
      },
      signup_user(signup){
        this.islogin = signup;
      },
      logout(logout){
        this.islogin = logout;
        console.log("logout" + logout);
      }
    },
    mounted() {
      let user = localStorage.getItem('userID');
      if(user !== null){
        this.islogin = true;
        this.$router.push('/myEvents');
        console.log('LOGIN');
      }else{
        this.islogin = false;
      }
    }
  }
  
</script>

<style>

  body{
    background: rgba(218, 208, 208, 0.616);
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
  }

  .navigation{
    position: fixed;
    width: 100%;
  }
  
</style>