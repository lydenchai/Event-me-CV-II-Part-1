<template>
    <div class="login-page">
        <div class="start-page">
            <h1>Welcome to Event Me!</h1>
            <p id="welcome">Sign up to continue</p>
            <p>©Copyright by PNC 2021 VC Team 2</p>
        </div>
        <div class="form-signup">
            <form @submit.prevent="" action="#">
                <div class="txt-signup">
                    <h2>SIGN UP</h2>
                </div>
                <div class="form-input">
                    <div class="left">
                        <div> 
                            <label for="username" class="username">Username</label><br>
                            <input type="text" id="username" v-model="username">
                        </div><br>
                        <div>
                            <label for="email" class="email">Email</label>
                            <input type="text" id="email" v-model="email">
                        </div>
                    </div>
                    <div class="right">
                        <div>
                            <label for="password" class="password">Password</label><br>
                            <input type="password" id="password" v-model="password">
                        </div><br>
                        <div >
                            <label for="c-password" class="c-password" >Confirm Password</label><br>
                            <input type="password" id="c-password" v-model="password_confirmation">
                        </div>   
                    </div>
                </div>
                <div class="error">
                    <p>{{errorMessage}}</p>
                </div>
                <button @click="signUp" id="loginBtn" class="hvr-grow">Sign Up</button>
                <p>- OR -</p>
                <div class="to-login"> 
                    <p>Already have account? </p> 
                    <router-link :to="{name: 'SignIn'}">Sign in</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

    import axios from '../axios-request.js'
    export default {
        emits: ['signup'],
        data() {
            return {
                username: '',
                email: '',
                password: '',
                password_confirmation: "",
                errorMessage: "",
                signup : true,
            }
        }, 
        methods: {
            signUp(){
                const newUser = {
                    username: this.username,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }
                axios.post("/register", newUser).then(res => {
                    localStorage.setItem('userID', res.data.data.id);
                    this.$router.push('/myEvents');
                    this.$emit('signup', this.signup);
                    this.userLists.push(res.data.data.username);
                    this.errorMessage = "";
                }).catch(error => {
                    let statusCode = error.response.status;
                    if(statusCode === 422) {
                        this.errorMessage = 'Your input is not valid, please try again!';
                    }
                })
                this.username = "";
                this.email = "";
                this.password = "";
                this.password_confirmation = "";
            }
        },       
    }
    
</script>

<style scoped>

    .login-page{
        height: 100vh;
        width: 100%;
        background-image: url('../assets/Inkedbg_LI.jpg');
        background-position: center;
        background-size: cover;
        display: flex;
        overflow-x: hidden;
        overflow-y: hidden;
    }

    .start-page{
        margin-left: 6%;
        margin-top: 9%;
    }

    .start-page > h1{
        color: #f8a917;
        margin-left: -3%;
        font-size: 50px;
    }

    .start-page > p{
        margin-left: 5%;
        font-size: 25px;
    }

    .start-page > #welcome{
        margin-left: 25%;
        font-size: 25px;
    }

    .form-signup{
        box-shadow: 0px 4px 8px 4px rgba(0, 0, 0, 0.25);
        box-sizing: border-box;
        border-radius:20px;
        background: #fff;
        margin-top: 4%;
        height: 80vh;
        width: 40%; 
        margin-left: 4%;      
    }

    .form-signup > form > .txt-signup > h2{
        color: #f8a917;
        text-align: center;
        margin-top: 60px;
        font-size: 40px;
    }

    .form-signup > form > p {
        margin-top: 20px;
        margin-left: 47%;
    }

    .form-signup > form > .form-input{
        margin: 5px;
        display: flex;
    }

    .form-signup > form > .form-input > .left, 
    .form-signup > form > .form-input > .right{
        width: 45%;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"]{
        background: #d1d1d1;
        border-radius: 7px;
        margin-top: 15px;
        font-size: 20px;
        padding: 15px;
        outline: none;
        height: 20px;
        border: none;
        width: 82%;  
        margin-left: 4%;
    }

    #username,
    #email,
    #password,
    #c-password{
        font-size: 20px;
        margin-left: 15%;
        margin-top: 0%;
    }

    .username,
    .email,
    .password,
    .c-password{
        margin-left: 15%;
        font-size: 15px;
    }
    #sing-up{
        text-decoration: none;
        color: #fff;
    }
    
    #loginBtn{
        background: #f8a917;       
        border-radius: 7px;
        margin-top: 15px;
        cursor: pointer;
        font-size: 30px;
        outline: none;
        height: 60px;
        border: none;
        color: #fff;
        width: 40%;
        margin-left: 31%;
    }

    .to-login{
        margin: 5px;
        margin-left: 34%;
        display: flex;
        width: 100%;
    }

    .form-signup > form >.to-login > p{
        color: #f8a917;
        margin-top: 0px;
        font-size: 15px;
    }

    .form-signup > form >.to-login > a{
        color: rgb(0, 162, 255);
        font-weight: bold;
        font-size: 15px;
    }

    .error{
        text-align: center;
        color: red;
    }

</style>