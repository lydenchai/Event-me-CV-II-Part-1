<template>
    <section>
        <br>
        <h3>Find event</h3>
        <div class="event-city">
            <div class="search-and-city">
                <input @keyup="searchTitle" type="text" v-model="title" placeholder="Search..." >
                <button class="fa fa-close" @click="clearTitle"></button>
                <input @keyup="searchCity" type="text" v-model="city" placeholder="City...">
                <button class="fa fa-close" @click="clearCity"></button>
            </div>
        </div>
    </section>
</template>

<script>

    export default {
        emit: ["addTitle", "addCity"],
        data() {
            return {
                title: '',
                city: '',
            }
        },
        methods: {
            searchTitle(){
                this.$emit('addTitle', this.title);
            },
            clearTitle(){
                this.$emit('allEventList')
                this.title = "";           
            },
            searchCity(){
                this.$emit('addCity', this.city);
            },
            clearCity(){
                this.$emit('allEventList')
                this.city = "";           
            },
        },
    }

</script>

<style scoped>

    h3{
        margin-left: 20.3%;
    }

    .event-city{
        margin-left: 20%;
        width: 60%;
        height: 10vh;
    }
    
    .search-and-city{
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
        display: flex;
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
        width: 7%;
        outline: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover{
        background: #cf240d;
    }

</style>