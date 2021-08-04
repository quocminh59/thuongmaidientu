<template>
  <div>
      <breadcrumb :links="links"></breadcrumb>
      <div class="title">Danh sách Linh kiện</div>
      <div class="tool d-flex">
          <select class="form-select"  >
            <option value="">Toàn bộ danh mục</option>      
        </select>
        <div class="addnew">
            <router-link :to="{name: 'laptop.create'}" class="btn btn-dark">
                <i class="material-icons-outlined" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Thêm mới laptop">add</i>
            </router-link>
        </div>
      </div>
      <div class="laptop template">
          <div v-if="loading">
              <spinner :type="'flicker'" :size="'large'"></spinner>
          </div>
          <div v-else>
              <table class="table table-dark table-bordered">
                  <thead>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Content</th>
                        <th scope="col">Specifications</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Access time</th>
                        <th scope="col">Category</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Update At </th>
                        <th scope="col" class="local" :style="{textAlign: 'center'}">Manipulation</th>
                  </thead>
                  <tbody>
                      
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    components: { },
    data() {
        return {
            links: ['Home', 'Product Management', 'Linhkien'],
            loading: false
        }
    }
}
</script>

<style>

</style>