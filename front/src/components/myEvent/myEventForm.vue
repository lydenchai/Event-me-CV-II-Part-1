<template>
    <section>
        <div class="myevent-container">
            <form action="#">
                <div class="form-container">
                    <div class="form-input">
                        <label for="">CREATE AN EVENT</label>
                        <input type="text" placeholder="Title" v-model="title">
                        <select  name="categories" id="categories" v-model="category" >
                            <option value="" disabled>Select category</option>
                            <option v-for="category of categoryList" :key="category.id" :value = category.id>{{category.name}}</option>
                        </select>
                        <div class="select-city-and-country">
                            <select name="country"  id="country" v-model="country">
                                <option value="" disabled>Select Country</option>
                                <option v-for="country in countries" :key="country"> {{country}} </option>
                            </select>
                            <select name="cities" id="cities" v-model="city">
                                <option value="" disabled>Select City</option>
                                <option v-for="city of allCountry[country]" :key="city" >{{city}}</option>
                            </select>
                        </div><br>
                        <div class="date-and-time">
                            <div class="date-detail">
                                <label for="start-date"  id="start-date" class="start-date">Start date:</label>
                                <label for="end-date" id="end-date" class="end-date">End date:</label>
                            </div>
                            <div class="specifice-time-and-date">
                                <input id="start-date" type="datetime-local" placeholder="Start date" v-model="startdate">
                                <input id="end-date" type="datetime-local" placeholder="End date" v-model="enddate">
                            </div>
                        </div>
                        <textarea name="" id="" cols="30" rows="10" placeholder="Description..." v-model="description"></textarea>
                    </div>
                    <div class="form-contain">
                        <div id="choose-img">
                            <img :src="previewimage" alt="">
                            <input type="file" ref="file" id="up" @change = "onFileSelect" >
                        </div>
                        <div class="form-btn">
                            <button class="discard-btn">DISCARD</button>
                            <button class="submit-btn" @click="sendMyeventData">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>

<script>

    import axios from '../../axios-request.js'
    export default {
        data() {
            return{
                title: '',
                city: '',
                country: '',
                startdate: '',
                enddate: '',
                description: '',
                image: null,
                categoryList: [],
                allCountry: [],
                countries: [],
                previewimage: null,
             }
        },
        methods: {
            onFileSelect(event){
                this.image = event.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(this.image);
                reader.onload = event => {
                    this.previewimage = event.target.result;
                } 
            },
            sendMyeventData(){
                let user_id = localStorage.getItem('userID');
                const newEvent = new FormData();
                newEvent.append('category_id', this.category);
                newEvent.append('user_id', user_id);
                newEvent.append('title', this.title);
                newEvent.append('start_date', this.startdate);
                newEvent.append('end_date', this.enddate);
                newEvent.append('city', this.city);
                newEvent.append('country', this.country);
                newEvent.append('description', this.description);
                newEvent.append('image', this.image);
                this.$emit('createMyNewEvent',newEvent)
            },
            getCategories(){
                axios.get('/category').then(res => {
                    this.categoryList = res.data;
                    console.log(this.categoryList);
                });
            },            
        },
        mounted() {
            this.getCategories();
            axios.get('/countries').then(res =>{
                this.allCountry = res.data;
                for(let country in this.allCountry) {
                    this.countries.push(country);
                    console.log(country)
                }
           });
        },
    }
</script>

<style scoped>

    .myevent-container{
        width: 100%;
        margin-top: 5%;
    }

    p{
        margin-left: -15px;
    }
    
    form{
        width: 45%;
        height: 65vh;
        background: rgb(255, 255, 255);
        box-shadow: 0px 2px 8px 2px rgba(99, 99, 99, 0.25);
        margin-left: 27%;
        border-radius: 5px;
        align-items: center;
        justify-content: center;
    }

    form .form-container{
        display:flex;
        box-sizing: border-box;
    }

    .form-input{
        margin-top: 10px;
        width: 60%;
        height: 100%;
    }

    .form-contain{
        width: 40%;
        height: 68vh;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    label{
        width: 100%;
        margin-top: 10px;
        margin: 20px;
        font-weight: bold;
    }

    input[type="text"]{
        width: 85%;
        margin: 15px;
        height: 30px;
        align-items: center;
        justify-content: center;
        border: none;
        outline: none;
        border-radius: 3px;
        padding: 5px;
        margin-left: 5%;
        font-size: 15px;
        background: rgb(209, 209, 209);
    }

    .select-city-and-country{
        display: block;
    }

    #cities,
    #country{
        background: rgb(209, 209, 209);
        width: 40.5%;
        height: 40px;
        border: none;
        outline: none;
        border-radius: 3px;
        margin: 5px;
        margin-left: 5%;
        font-size: 15px;   
    }

    select{
        width: 88%;
        margin: 15px;
        height: 40px;
        border: none;
        outline: none;
        border-radius: 3px;
        padding: 5px;
        margin-left: 5%;
        font-size: 15px;
        background: rgb(209, 209, 209);
    }

    textarea{
        width: 88%;
        height: 70px;
        box-sizing: border-box;
        border: none;
        outline: none;
        border-radius: 3px;
        padding: 5px;
        margin: 15px;
        margin-left: 5%;
        font-size: 15px;
        background: rgb(209, 209, 209);
    }

    .date-detail,
    .specifice-time-and-date{
        display: flex;
    }

    #start-date,
    #end-date{
        margin-top: -4px;
    }

    .start-date{
        margin-left: 18px;
    }

    .end-date{
        margin-left: -5px;
    }

    input[type="datetime-local"]{
        background: rgb(209, 209, 209);
        width: 40.5%;
        height: 40px;
        border: none;
        outline: none;
        border-radius: 3px;
        margin: 5px;
        margin-left: 5%;
        font-size: 15px;   
    }

    #choose-img{
        width: 90%;
        height: 39.5%;
        margin-top: 39.5px;
        border-radius: 5px;
        align-content: center;
        justify-content: center;
        box-sizing: border-box;
        background: rgb(209, 209, 209);
        border: 2px solid rgb(184, 184, 184);
    }

    #up{
        margin-top: 10%;
        margin-left: 10%;
        box-sizing: border-box;
    }

    #choose-img > img{
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: center;
        display: flex;
        box-sizing: border-box;
    }

    .form-btn{
        margin-top: 48%;
        margin-left: -8%;
    }

    .submit-btn,
    .discard-btn{
        width: 95px;
        height: 40px;
        justify-content: space-around;
        align-items: center;
        margin: 10px;
        cursor: pointer;
        border: none;
        outline: none;
        border-radius: 5px;
    }

    .submit-btn{
        background: rgb(9, 136, 255);
        color: #fff;
    }

    .discard-btn{
        background: #f3381f;
        color: #fff;
    }

    .submit-btn:hover{
        background: rgb(8, 111, 207);
    }

    .discard-btn:hover{
        background: #cf240d;
    }

</style>