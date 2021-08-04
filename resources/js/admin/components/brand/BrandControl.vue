<template>
    <td class="local">

        <router-link :to="{name: 'brand.edit', params: {id: id}}" class="edit ">
            <i class="fal fa-edit "></i>
            <span>Edit</span>
        </router-link>

        <a class="delete " @click="isActive = false" >
            <i class="fal fa-trash-alt"></i>
            <span>Delete</span>
        </a>
        
        <notification :type="message.type" :content="message.content" :show="display"></notification>

        <div class="category-delete">
            <div class="modal" :class="{display: isActive}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title d-flex">
                                <i class="fal fa-exclamation-triangle"></i>
                                CẢNH BÁO
                            </h5>
                            <button type="button" class="close"  aria-label="Close" @click="isActive = true">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <strong>Bạn có muốn xóa thương hiệu này không ?</strong>
                            <br>
                            <i>Lưu ý nếu xóa thương hiệu thì các sản phẩm thuộc thương hiệu này sẽ bị xóa theo.</i>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="isActive = true">Close</button>
                            <button type="button" class="btn btn-danger" @click="del()">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>   
</template>

<script>
import base from './../../baseurl';
export default {
    props: {
        id: Number
    },
    data() {
        return  {
            isActive: true,
            message:{
                type: '',
                content: ''
            },
            display: null,
            warning: null,
        }
    },
    methods: {
        del: function() {
            axios.post(`${base}/admin/brand/delete/${this.id}`).then(()=>{
                this.message.type = "success";
                this.message.content = "Xóa thương hiệu thành công";
                this.isActive = true;
                this.changeDisplay();
                this.reload();
            }).catch((error)=>{
                this.isActive = true;
                this.message.type = "error";
                this.message.content = "Xóa thương hiệu thất bại: " + error.message;
                this.changeDisplay();
            })
        },
        changeDisplay: function() {
            this.display = true;
            setTimeout(()=> {
                this.message = {};
            },1000);
            setTimeout(()=> {
                this.display = false;
            },1000);
        },
        reload: function() {
            axios.get(`${base}/admin/brand`).then((response)=>{
                this.$emit('reload', response.data);
            })
        },
    }
};

</script>

<style>
    .local {
        width: 20rem;
    }

    .local a {
        width: 8rem;
        text-decoration: none;
        display: inline-flex;
        font-size: 1.6rem;
        padding-left: 1rem;
        cursor: pointer;
        justify-content: space-around;
    }

    a.edit:hover{
        color: green;
    }

    a.delete:hover{
        color: #9f0808;
    }

    .edit {
        color: #0ffb0f;
    }

    .delete {
        color:#ff2020;
    }

    .category-delete {
        color: crimson;
    }

    .modal-content {
        font-size: 1.5rem;
        background-color: #343a40;
    }

    .modal-header {
        border-bottom: 1px solid #c61f1f;
        background: repeating-linear-gradient(45deg, black, transparent 100px);
    }

    .modal-header i {
        font-size: 2rem;
    }

    .modal-header h5 {
        width: 13rem;
        font-size: 1.8rem;
        font-weight: bolder;
        color: red;
        justify-content: space-around;
        align-items: baseline;
    }

    .modal-body strong {
        font-size: 1.7rem;
        color: #e7bfbf;
    }

    .modal-footer {
        border: none;
    }

    .modal-footer button {
        font-size: 1.5rem;
    }

    .modal {
        display: block;
        background: #000000ad;
    }

    .display {
        display: none;
    }
</style>