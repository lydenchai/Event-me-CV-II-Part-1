<template> 
    <section>
        <div class="container" >
            <div id="myevent-container"  v-for="event of events" :key="event.id">  
                <div class="event-img">
                    <img :src="url + event.image" alt="">
                </div>
                <div class="event-description">
                    <div class="category-name">
                        <label for="">{{event.category.name}}</label>
                    </div>
                    <div class="event-title">
                        <h1>{{event.title}}</h1>
                    </div>
                    <div class="event-member">
                        <label for="">{{event.join.length}} members</label>
                    </div>
                </div>
                <div class="event-time">
                    <h5>Start-date: {{event.end_date}}</h5>
                    <h5>End-date: {{event.end_date}}</h5>
                </div>

                <slot></slot>

            </div> 
        </div>
    </section>
</template> 
 
<script> 
     import axios from '../../axios-request.js'
    export default {
        props:['events'],
        data() {
            return {
                allEvents: [],  
                url: "http://127.0.0.1:8000/storage/images/" 
            }
        },
        methods: {
            getEvents(){
                axios.get('/myevents').then(res =>{
                    let userID = localStorage.getItem('userID');
                    for(let event of res.data){
                        if (event.user_id != userID){
                            console.log(event);
                            this.allEvents.unshift(event);
                        }
                    }  
                });
            }
        },
        mounted() {
            this.getEvents();
        },
    } 
    
</script> 
 
<style scoped> 

    section h2{
        margin-left: 20%;
    }

    #myevent-container{
        background: rgb(255, 255, 255);
        box-shadow: 0px 2px 8px 2px rgba(99, 99, 99, 0.25);
        width: 60%;
        height: 25vh;
        border-radius: 5px;
        margin: 15px;
        margin-left: 20%;
        display: flex;
        padding: 0px;
        box-sizing: border-box;
    }
    .event-img{
        height: 94%;
        margin: 5px;
        width: 25%;
        box-sizing: border-box;
    }
    img{
        width: 100%;
        height: 100%;
    }
    .event-description{
        height: 100%;
        width: 25%;
        margin-left: 15px;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;

    }

    .category-name,
    .event-title,
    .event-member{
        margin: 23px;
        align-items: center;
        justify-content: center;
        margin-left: -10px;
    }
    .event-title{
        border-radius: 5px;
        width: 100%;
        height: 7vh;
        align-items: center;
        justify-content: center;
        margin-top: -10px;
        background: rgb(194, 194, 194);
    }
    .event-title h1{
        padding: 10px;
    }
    
    .event-time{
        margin-top: 20px;
        margin-left: 50px;
        text-align: center;
        align-items: center;
        justify-content: center;
    }
    .event-btn{
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
        height: 100%;
        width: 20%;
        margin-left: 100px;
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
    #quit{
        background: rgb(194, 194, 194);
        border: none;
        outline: none;
        height: 30px;
        width: 90px;
        color: rgb(255, 21, 68);
        cursor: pointer;
        border-radius: 5px;
    }
    #join{
        border: none;
        outline: none;
        color: rgb(9, 95, 255);
        cursor: pointer;
        width: 90px;
        height: 30px;
        border-radius: 5px;
        background: rgb(194, 194, 194);
    }
    
</style>