<template> 
    <section>    
        <div class="container">
            <div id="myevent-container">  
                <div class="event-img">
                    <img :src="url + allEventList.image" alt="">
                </div>
                <div class="event-description">
                    <div class="category-name">
                        <label for="">{{allEventList.category.name}}</label>
                    </div>
                    <div class="event-title">
                        <h1>{{allEventList.title}}</h1>
                    </div>
                    <div class="event-member">
                        <label for="">{{allEventList.city}}, {{allEventList.country}}</label><br>
                        <label for="">{{allEventList.join.length}} joined </label>
                    </div>
                </div>
                <div class="event-time">
                    <h5>Start-date: {{allEventList.start_date}}</h5>
                    <h5>End-date: {{allEventList.end_date}}</h5>
                </div>
                <div class="event-btn">
                    <a id="join" @click="join(allEventList.id)" v-if="isJoinEvent" class="fa fa-check-circle-o" style="font-size:20px">Join</a>
                    <a id="quit" @click="quit(allEventList.id)" v-else class="fa fa-times-circle-o" style="font-size:20px">Quit</a>
                </div>
            </div> 
        </div>
    </section>
</template> 
 
<script> 
    import axios from '../../axios-request.js'
    export default {
        props: ["allEventList"],
        data() {
            return {
                allEvents: [],  
                url: "http://127.0.0.1:8000/storage/images/" ,
                isJoinEvent: true,
                userid: "",
                joinList: [],  
            }
        },
        methods: {
            join(id) {
                let eventjoin = {
                    user_id: this.userid,
                    myevent_id : id,
                }
                console.log(eventjoin);
                axios.post("/joins", eventjoin).then(res => {
                    console.log(res.data);
                    this.getJoinslist();
                })
                this.isJoinEvent = !this.isJoinEvent;
            },
            quit(id) {
                let eventid = "";
                for(let join of this.joinList){
                    if(join.myevent_id == id){
                        eventid = join.id;
                    }
                }
                axios.delete("/joins/" + eventid).then(res => {
                    console.log(res.data);
                    this.getJoinslist();
                });
                this.isJoinEvent = !this.isJoinEvent;
            },
            getJoinslist() {
                axios.get("/joins").then(res => {
                    this.joinList = res.data;
                })
            },
        },
        mounted() {
            this.getJoinslist()
            this.userid = localStorage.getItem('userID');
            if(this.allEventList != null){
                for(let join of this.allEventList.join){
                    if(this.userid == join.user_id){
                        this.isJoinEvent = false
                    }
                }
            }
        },
    } 
    
</script> 
 
<style scoped> 

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
        margin: 20px;
        align-items: center;
        justify-content: center;
        margin-left: -10px;   
    }   

    .event-member{
        margin-top: -5px;
        width: 120%;
    }

    .event-title{
        border-radius: 5px;
        width: 100%;
        height: 7vh;
        align-items: center;
        justify-content: center;
        margin-top: -5px;
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