<template>
    <tr>
        <th scope="row">{{ bProduct.id }}</th>
        <td>{{ bProduct.name }}</td>
        <td>
            <button @click="showModal = true" class="btn btn-success" id="edit-btn">Edit</button>
            <button @click="deleteProduct(bProduct.id)" class="btn btn-danger">Delete</button>
        </td>

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
                                    <input type="text" :placeholder="product.name" v-model="newProductName">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                                    <button type="button" class="btn btn-primary" @click="updateProductName(bProduct.id), showModal = false">Save changes</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </transition>
        </div>
    </tr>
</template>



<script>
export default {

    props: ['product'],

    data: function() {
        return {
            bProduct: this.product,
            showModal: false,
            newProductName: ''
        }
    },



    methods: {

        updateProductName(id) {
            axios.put('api/products/' + id, { name: this.newProductName })
                .then((response) => {
                    this.bProduct.name = response.data;
                })
                .catch(e => console.log(e));
        },

        deleteProduct(id) {
            axios.delete('api/products/' + id)
                .then(() => {
                    this.$emit('delete-me');
                })
                .catch(e => console.log(e));

            console.log(id);
        }
    }
}

</script>
