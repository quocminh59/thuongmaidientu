<template>
    <div>
        <!-- Success -->
        <div class="notification success" v-if="type == 'success' && show">
            <span class="fal fa-check-circle"></span>
            <div class="text">
                {{ content }}
            </div>
        </div>
        
        <!-- Error -->
        <div class="notification error" v-if="type == 'error' && show">
            <span class="fal fa-exclamation-triangle"></span>
            <div class="text">
                {{ content }}
            </div>
        </div> 
    </div>
</template>

<script>
export default {
    props: {
        type: String,
        content: String,
        show: Boolean,
    },
}
</script>

<style>
    .notification {
        width: 26rem;
        height: 4rem;
        display: flex;
        align-items: center;
        position: fixed;
        color: white;
        font-size: 1.5rem;
        justify-content: center;
        border-radius: 5px;
        right: 2.5%;
        top: 18%;
    }

    .success {
        background: green;
    }
    
    .text {
        margin-left: 1rem;
        font-weight: bolder;
    }

    .error {
        background: red;
    }
</style>