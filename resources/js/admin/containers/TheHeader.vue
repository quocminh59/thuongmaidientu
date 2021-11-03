<template>
    <div class="header">
        <div class="search-bar input-group">
            <input type="text" class="form-control bg-dark border-0 small" placeholder="Seach for...">
            <div class="input-group-adppend">
                <button type="button">
                    <i class="fal fa-search" ></i>
                </button>
            </div>
        </div>
        <div class="area-admin">
            <span class="name-admin">{{ user.username }}</span>
            <div class="user-admin">
                <i type="button" class="fal fa-user-circle" @click="show = !show"></i>
                <div class="feature-table" v-if="show == true">
                    <a @click="logout()">
                        <span class="fal fa-lock-alt"></span>
                        <span>Logout</span>
                    </a>
                </div>
            </div>  
        </div>
    </div>
</template>

<script>
import base from './../baseurl';
export default {
    props: ['user'],
    data() {
        return {
            show: false,
        };
    },
    methods: {
        logout: function() {
            axios.post(`${base}/admin/auth/logout`)
            .then(function(){
                window.location.href=`${base}/admin/auth/login`;
            })
            .catch(function(error){
                alert(error);
            })
        }
    },
    created () {
        console.log(this.user);
    },
}
</script>

<style>
    .header {
        width: 82%;
        height: 9%;
        position: fixed;
        right: 0;
        background: #181A1B;
        z-index: 1;
        display: flex;
        align-items: center;
    }

    .search-bar {
        width: 30%;
        margin-left: 3rem;
    }

    .search-bar  input {
        height: 4rem;
        font-size: 1.5rem;
        padding: 1.5rem;
        color: gray !important;
    }

    .input-group-adppend {
        position: absolute;
        right: -4rem;
    }

    .input-group-adppend button {
        width: 4rem;
        height: 4rem;
        display: flex;
        justify-content:center;
        align-items:center;
        background: black !important;
        border:none;
        color: white;
        border-radius: 0px 3px 3px 0px;
    }

    .input-group-adppend button:hover{
        transition: 1s;
        transform: scale(1.1);
    }

    .area-admin {
        width: 9%;
        color: white;
        position: absolute;
        font-size: 1.5rem;
        right: 4%;
        display: flex;
        align-items: center;
    }

    .area-admin i {
        font-size:3rem;
    }

    .user-admin {
        width: 3rem;
        height:10rem;
        position: absolute;
        right: -1rem;
        top: -2px;
    }

    .user-admin i {
        position: absolute;
        color: gray;
    }

    .user-admin i:hover {
        transform: scale(1.3);
        transition: 0.5s;
        color: white;
    }

    .feature-table {
        width: 14rem;
        height: 5rem;
        position: absolute;
        right: 0;
        bottom: 0px;
        border: 2px solid #0a1563;
        border-radius: 4px;
        cursor: pointer;
        background: black;
        display: flex;
        justify-content: center;
        align-items: center;   
    }

    .feature-table a {
        display: flex;
        justify-content: center;
        align-items: center;
    }



   
   


</style>