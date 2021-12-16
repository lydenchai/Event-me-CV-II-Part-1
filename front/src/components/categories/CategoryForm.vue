<template>
    <div>
        <form action="" class="create-category-form">
            <div><br>
                <input class="txt-input-category" type="text" placeholder="Event category"  v-model="categoryName"/>
            </div>
            <div class="actionBtn">
                <button class="add" v-if="this.isCreated" @click="create">CREATE</button>
                <button class="add" v-else @click.prevent="edit">UPDATE</button>
                <button class="discard" @click="discard" >DISCARD</button>
            </div>
        </form>
        <br>
    </div> 
</template>

<script>

    export default {
        emit: ['create', 'edit', 'discard'],
        props: ['isShowForm', 'isEditing',"cateName","cate","isCreated"],
        data() {
            return {
                categoryName: '',
            }
        },
        methods: {
            create() {
                this.$emit('addCategory', this.categoryName);
                this.categoryName = ""
            },
            edit() {
                this.$emit('editCategory',this.categoryName, this.cate.id);
                console.log(this.cate)
                this.categoryName = "";
            },
            discard() {
                this.$emit('hideForm')
                this.categoryName =''
            },
        },
        mounted(){
            this.categoryName = this.cateName;
        }
    }

</script>

<style scoped>

    .create-category-form{
        width: 51.5%;
        height: 22vh;
        background: rgb(255, 255, 255);
        box-shadow: 0px 2px 8px 2px rgba(99, 99, 99, 0.25);
        margin: auto;
        border-radius: 5px;
        margin-top: -10px;
        box-sizing: border-box;
    }

    .txt-input-category{
        border-radius: 5px;
        width: 92.5%;
        height: 50px;
        justify-content: center;
        align-items: center;
        display: flex;
        margin: 25px;
        margin-left: 2%;
        margin-top: 0;
        border: none;
        outline: none;
        padding: 10px;
        font-size: 20px;
        background: rgb(209, 209, 209);
    }

    .actionBtn{
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-top: -25px;
        margin-right: 1%;
    }

    .discard,
    .add{
        width: 100px;
        height: 30px;
        border: none;
        outline: none;
        margin: 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .discard{
        background: rgb(248, 16, 16);
        color: #fff;
    }
    .add{
        background: rgb(21, 76, 255);
        color: #fff;
    }

</style>