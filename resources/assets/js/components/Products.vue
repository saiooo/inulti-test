<template>
  <div class="container">
    <h2>Existing products</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Product Name</th>
          <th scope="col">Handle Action</th>
        </tr>
      </thead>
      <tbody>

        <product v-for="(product, index) in products" v-bind:key="product.id" v-bind:product="product" v-on:delete-me="deleteRow(index)"></product>

      </tbody>
    </table>

    <button class="btn btn-primary" @click="showModal = true">Add new product</button>

    <div v-if="showModal">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">

            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showModal = false">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="text" v-model="newProduct" placeholder="Enter New Product">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                  <button type="button" class="btn btn-primary" @click="addProduct(), showModal = false">Add Product</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      products: [],
      showModal: false,
      newProduct: ''
    }
  },

  created() {
    axios.get('api/products')
      .then(response => {
        this.products = response.data
      })
      .catch(e => console.log(e));
  },

  methods: {
    deleteRow(index) {
      this.products.splice(index, 1);
    },

    addProduct() {
      axios.post('api/products', {name: this.newProduct})
      .then( (response) => {
        this.products.push(response.data)
      })
      .catch(e => console.log(e));
    }
  }
}
</script>