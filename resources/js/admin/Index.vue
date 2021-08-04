<template>
  <div class="wrap-admin">
        <the-side-bar></the-side-bar>
        <the-header :user="user"></the-header>
        <div class="view">
            <router-view></router-view>
        </div>
  </div>
</template>

<script>
import TheHeader from './containers/TheHeader.vue';
import TheSideBar from './containers/TheSideBar.vue';

export default {    
    props: ['user'],
    components:{
        TheSideBar,
        TheHeader
    }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap');
    .wrap-admin {
        width: 100%;
        position: relative;
        background: #222526;
    }
    .view {
        position: absolute;
        top: 9%;
        right: 0;
        background: #222526;
        width: 82%;
    }

    .template {
        color: white;
        font-size: 1.5rem;
        margin-top: 20%;
        margin-left: 3%;
        height: 47rem;
    }

    .template table {
        width: 96%;
    }

   .table-dark th, .table-dark td, .table-dark thead th {
        border-color: gray;
    }

    .tool {
        font-family: 'Merriweather', serif;
        position: fixed;
        top: 26%;
        font-size: 1.5rem;
        padding-left: 3.9rem;
    }

    .tool select.form-select {
        background: black;
        color: gray;
        font-weight: bold;
        border-radius: 4px;
        outline: none;
        width: 18rem;
    }
    .title {
        font-family: 'Merriweather', serif; 
        font-size: 2.5rem;
        font-weight: bold;
        color: #d8c3c3;
        margin-bottom: 2rem;
        position: fixed;
        width: 100%;
        height: 5rem;
        background: #222526;
        top: 16%;
        padding: 1rem 3.5rem;

    }

    .paginate {
        position: fixed;
        bottom: 0;
        font-size: 1.4rem;
        font-weight: bold;
        font-family: 'Lato';
    }

    .addnew {
        margin-left: 1rem;
    }

    .addnew i {
        display: flex;
        align-items: center;
    }

    .addnew a {
        font-size: 2rem;
    }
</style>