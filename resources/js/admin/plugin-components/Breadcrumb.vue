<template>
    <div class="breadcrumbs">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" v-for="(link, index) in newLinks" :key="index">
                    <router-link :to="{name: changeLowerCase(link) }" v-if="index != 1">{{ link }}</router-link>
                    <router-link :to="{}" v-else :style="style" >{{ link }}</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ links[n-1] }}</li>
            </ol>
        </nav>
    </div>
</template>

<script>
export default {
    props: {
        links: Array
    },
    data() {
        return {
            style: {
                textDecoration: "none",
                color: '#3490dc',
                fontWeight: "bold"
            }
        };
    },
    computed: {
        n: function() {
            return this.links.length;
        },
        newLinks: function(){
            var array = new Array();
            for(let i = 0; i< this.n; i++) {
                if(i < (this.n-1)) array.push(this.links[i]);
            }
            return array;
        }
    },
    methods: {
        changeLowerCase: function(value) {
            return value.toString().toLowerCase();
        },
    }
}
</script>

<style>
     .breadcrumbs {
        position: fixed;
        width: 100%;
        height: 5rem;
        top:9%;
    }

    .breadcrumb {
        background: #181A1B;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        width: 100%;
        height: 5.1rem;
        padding-left: 3rem;
        border-top: 1px solid #464141;
        border-bottom: 1px solid #464141;
        border-radius: inherit;
    }

</style>