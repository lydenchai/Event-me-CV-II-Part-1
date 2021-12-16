<template>
    <section>
        <search-event @addTitle="searchTitle" @addCity="searchCity" @allEventList='getEvents'></search-event>
        <h2>All Events</h2>
        <event v-for="event of allEvents" :key="event.id" :allEventList="event" ></event>
    </section>
</template>

<script>
    import axios from '../axios-request.js'
    import Event from '../components/Event/Event.vue';
    import SearchEvent from '../components/Event/SearchEvent.vue';
    export default {
      components: { Event, SearchEvent},
      data() {
        return {
          allEvents: [],  
          url: "http://127.0.0.1:8000/storage/images/",
        }
      },
      methods: {
        getEvents(){
          let userID = localStorage.getItem('userID');
          axios.get('/myevents').then(res =>{
            for(let event of res.data){
              if (event.user_id != userID){
                console.log(event);
                this.allEvents.unshift(event);
              }
            }  
          });
        },
        searchTitle(title) {
          if(title !== '') {
            axios.get("/myevents/search/" + title).then(res => {
              this.allEvents = res.data;
            })
          }else {
            this.getEvents();
          }
        },
        searchCity(city){
          if(city !== ''){
            axios.get("/myevents/searchCity/" + city).then(res => {
              this.allEvents = res.data;
            })
          }else{
            this.getEvents();
          }
        }
      },
      mounted() {
        this.getEvents();
      },
    }

</script>
    
<style scoped>
  h2{
    margin-left: 20.2%;
  }
</style>