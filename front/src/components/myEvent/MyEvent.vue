<template> 
    <section>
        <div class="container">
            <h2>My Events</h2>
            <div id="myevent-container" v-for="event of allMyEventData" :key="event.id"> 
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
                    <div class="description">
                        <label for="">{{event.description}}</label>
                    </div>
                </div>
                <div class="event-time">
                    <h5>Start-date: {{event.start_date}}</h5>
                    <h5>End-date: {{event.end_date}}</h5>
                </div>
                <div class="event-btn">
                    <a id="edit" class="fa fa-pencil" style="font-size:20px"></a>
                    <a id="cancel" class="fa fa-times" style="font-size:20px"  @click="showDeleteRessource(event.id)"></a>
                </div>
            </div> 
            <base-dialog v-if="dialogDisplayed" :title="dialogTitle" @close="closeDialog">
                <h2 id="ask" v-if="dialogMode == 'delete' "><i class="fa fa-exclamation-triangle" ></i> Do you want to delete this event?</h2>
                <template #actions>
                    <button @click="onConfirm">{{ dialogButtton }}</button>
                </template>
            </base-dialog>
        </div>
    </section>
</template> 
 
<script> 
    import BaseDialog from '../UI/BasDialog.vue';
    export default {
        props:["allMyEventData"],
        emit: ["showFormMyEvent", "delete"],
        components:{BaseDialog},
        data() {
            return {
                allEventLists: [],
                url: "http://127.0.0.1:8000/storage/images/",
                dialogDisplayed: false,
                dialogTextField: '',
                eventId: null,
            }
        },
         computed: {
            dialogTitle() {
                return this.dialogMode === 'edit' ? 'EDIT RESSOURCE' : 'DELETE RESSOURCE';
            },
            dialogButtton() {
                return this.dialogMode ===  'edit' ? 'EDIT' : 'DELETE';
            },
        },
        methods: {
            
            showFormMyEvent(){
                this.$emit("");
            },
            closeDialog() {
                this.dialogDisplayed = false;
                this.eventId = null;
            },
            showDeleteRessource(id) {
                this.dialogMode = 'delete';
                this.dialogDisplayed = true;
                this.eventId = id;
            },
            onConfirm() {
                if (this.dialogMode === 'delete') {
                    console.log(this.eventId);
                    this.$emit('delete', this.eventId);
                } 
                this.closeDialog(); 
            },
        },
    }   
    
</script> 
 
<style scoped> 

    .container{
        margin-top: 3%;
    }

    .container h2{
        margin-left: 20%;
        
    }
    #myevent-container{
        background: rgb(255, 255, 255);
        box-shadow: 0px 2px 8px 2px rgba(99, 99, 99, 0.25);
        width: 60%;
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
        width: auto;
        margin-left: 15px;
        width: 25%;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
    }
    .category-name,
    .event-title{
        margin: 23px;
        align-items: center;
        justify-content: center;
        margin-left: -10px;
    }
    .description{
        width: 100%;
        margin-left: -10px;
    }
    .event-title{
        border-radius: 5px;
        width: auto;
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
    #cancel{
        background: rgb(194, 194, 194);
        border: none;
        outline: none;
        height: 30px;
        width: 90px;
        color: rgb(0, 0, 0);
        cursor: pointer;
        border-radius: 5px;
    }
    
    #edit{
        border: none;
        outline: none;
        color: rgb(0, 0, 0);
        cursor: pointer;
        width: 90px;
        height: 30px;
        border-radius: 5px;
        background: rgb(194, 194, 194);
    }
    #cancel:hover{
        color: rgb(255, 21, 68);
    }
    #edit:hover{
        color: rgb(9, 136, 255);
    }
    .fa-exclamation-triangle{
        color: rgb(255, 21, 21);
        margin-right: 10px;
        font-size: 30px;
    }

    #ask{
        text-align: center;
    }

    button{
        padding: 15px;
        border: none;
        font-weight: bold;
        background: #f3381f;
        color: white;
        outline: none;
        width: 20%;
        border-radius: 10px;
        font-size: 20px;
    }
</style>