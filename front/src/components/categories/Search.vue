<template>
    <section> <br><br><br>
        <div class="form-contain"><br>
            <div class="category">
                <form class="search-category" @submit.prevent="" action="#">
                    <input  @keyup="search" id="search-category" name="search" v-model="name" type="text" placeholder="Search Category...">
                    <button type="submit" @click="clear" class="fa fa-close"></button>
                </form>
            </div>
            <h2>Categories</h2>
        </div>
        <div class="add">
            <button id="btn-add"  class="kc_fab_main_btn"  @click="showFormCategory">+</button>
        </div>
    </section>
</template>

<script>
    export default {
    emit: ["showFormCategory", "addName"],
        data() {
            return {
                name: ''
            };
        },
        methods: {
            showFormCategory() {
                this.$emit("showForm");
            },
            search(){
                this.$emit('addName', this.name);
            },
            clear(){
                this.$emit('get-categories')
                this.name = "";           
            }
        },
    };
</script>

<style scoped>

    .form-contain{
        width: 100%;
        display: flex;
        flex-direction: column;
        margin-top: 10px;
        margin: auto;
    }

    .form-contain h2{
        margin-left: 327px;
    }

    .category{
        margin-left: 24%;
        width: 93%;
        height: 10vh;
    }
    
    .search-category{
        display: flex;
    }

    input[type="text"]{
        background: rgb(255, 255, 255);
        box-shadow: 0px 2px 8px 2px rgba(150, 150, 150, 0.25);
        border-radius: 5px;
        font-size: 18px;
        height: 50px;
        padding: 8px;
        width: 50%;
        margin: 5px;
        box-sizing: border-box;
        outline: none;
        border: none;
    }

    button{
        background: #f3381f;
        font-size:25px; 
        color:rgb(255, 255, 255); 
        box-shadow: 0px 2px 8px 2px rgba(150, 150, 150, 0.25);
        height: 50px; 
        margin-top: 5px; 
        width: 5%;
        outline: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover{
        background: #cf240d;
    }

    .kc_fab_main_btn {
        background-color: #F44336;
        width: 60px;
        height: 60px;
        border-radius: 100%;
        background: #F44336;
        border: none;
        outline: none;
        color: #FFF;
        font-size: 36px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        transition: .3s;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        position: fixed;
        left: 200vh;
        top: 87vh;
    }

    .kc_fab_main_btn:focus {
        transform: scale(1.1);
        transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
    }
    
</style>