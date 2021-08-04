<template>
    <div>
        <div class="roll" v-if="type == 'flicker'">      
            <div 
                class="spinner-grow text-light mr-3" role="status"
                v-for="(i, index) in 5"
                :key="index"
                :class="{'spinner-grow-sm': isActive}"
            ></div>
            
        </div>
        <div class="roll" v-if="type == 'line-up'">               
            <ul class="drops blue">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="roll" v-if="type == 'roll'">               
            <img src="./../assets/images/loading.gif" alt="">
        </div>
    </div>
</template>

<script>
export default {
    props: {
        type: String,
        size: String,
    },
    computed: {
        isActive: function() {
            if(this.size == 'small') return true;
            return false;
        }
    }
}
</script>

<style>
@import url(https://fonts.googleapis.com/css?family=Advent+Pro:700);
/* Meat and potatoes */
    .drops {
        list-style: none;
        position: relative;
        height: 10px;
        width: 140px;
        margin-left: 12%;   
    }
    .drops li {
        position: absolute;
        top: 15px;
        height: 10px;
        width: 10px;
        background-color: white;
        border-radius: 5px;  
        animation-name: loading;
        animation-duration: 4s;
        animation-timing-function: ease-in-out;
        animation-iteration-count: infinite;
        animation-direction: normal;
    }
    .drops li:nth-child(1) {
        animation-delay: 0ms;
    }
    .drops li:nth-child(2) {
        animation-delay: 100ms;
    }
    .drops li:nth-child(3) {
        animation-delay: 200ms;
    }
    .drops li:nth-child(4) {
        animation-delay: 300ms;
    }
    .drops li:nth-child(5) {
        animation-delay: 400ms;
    }
    @keyframes loading {
        0% { margin-left: 0px; }
        54% { margin-left: 65rem;}
        100% { margin-left: 0px; }
    }
</style>