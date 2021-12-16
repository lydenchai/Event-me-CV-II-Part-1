<template>
    <section>
        <div class="text-and-btn">
            <button id="btn-add"  class="kc_fab_main_btn"  @click="showCreateForm" >+</button>
        </div>
        <br>
        <br>
        <my-event-form v-if="isShowForm" @hideForm="discard" @saveForm="discard" @createMyNewEvent='createEvent'></my-event-form>
        <myevent-card :allMyEventData='allMyEvent' @delete="removeEvent"></myevent-card>
    </section>
</template>

<script>

    import axios from '../axios-request.js'
    import MyeventCard from '../components/myEvent/MyEvent.vue';
    import MyEventForm from '../components/myEvent/myEventForm.vue';
    export default{
        components: {'myevent-card':MyeventCard, MyEventForm},
        data() {
            return {
                title: '',
                city: '',
                startdate: '',
                enddate: '',
                description: '',
                image: null,
                categoryList: [],
                isShowForm:false,
                allMyEvent:[],
                url: "http://127.0.0.1:8000/storage/images/",  
                number: 0
            }
        },
        methods: {
            showCreateForm(){
                this.number += 1
                if(this.number %2 !== 0){
                    this.isShowForm = true
                }else{
                    this.isShowForm = false;
                } 
            },
            hideForm() {
                this.$emit('hideForm');
            },
            onFileSelect(event){
                this.image = event.target.files[0];   
            },
            createEvent(myEventData){
                this.isShowForm = false;
                console.log(myEventData);
                axios.post("/myevents", myEventData).then(res => {
                   this.getEvent();
                   return res.data; 
                }) 
            },
            removeEvent(id){
                axios.delete("/myevents/" + parseInt(id)).then(()=>{
                    this.getEvent();
                    console.log("deleted")
                })
            },
            getCategories(){
                axios.get('/category').then(res => {
                    this.categoryList = res.data;
                    console.log(this.categoryList);
                });
            },
            getEvent(){
                let userid = localStorage.getItem('userID');
                this.allMyEvent = [];
                axios.get('/myevents').then(res => {
                    for(let event of res.data){
                        if(event.user_id == userid){
                            this.allMyEvent.push(event);  
                        }
                    }
                });
            }         
        },
        mounted() {
           this.getEvent();  
        },
    }
    
</script>

<style scoped>

    body{
        margin: 0%;
        padding: 0%;
        font-family: sans-serif;
        scrollbar-width: hidden;
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

    .event-btn a{
        margin: 10px;
        width: 80px;
        text-align: center;
        justify-content: center;
        align-items: center;
        display: flex;
        margin-right: 10px;
    }

    #cancel,
    #edit{
        background: rgb(194, 194, 194);
        border: none;
        outline: none;
        height: 30px;
        width: 50px;
        color: rgb(0, 0, 0);
        cursor: pointer;
        border-radius: 5px;
    }
    
    #cancel:hover{
        color: rgb(255, 21, 68);
    }

    #edit:hover{
        color: rgb(9, 136, 255);
    }

</style>