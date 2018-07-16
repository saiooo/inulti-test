<template>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ result.name }}</h5>
                <p class="card-text raudona">{{ result.description }}</p>
                <button class="btn btn-primary" @click="getIncludedProducts(result.id), getNotIncludedProducts(result.id)">See products</button>
            </div>
        </div>

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
                                    <p>Products included: </p>
                                    <ul>
                                        <li v-for="product in products" :key="product.id">
                                            {{ product.name }} <button class="btn btn-sm btn-danger" @click="removeProductFromBundle(result.id, product.id)">Delete</button>
                                        </li>
                                    </ul>

                                    <p>Products to add: </p>
                                    <ul>
                                        <li v-for="avproduct in avproducts" :key="avproduct.id">
                                            {{ avproduct.name }} <button class="btn btn-sm btn-success" @click="addProductToBundle(result.id, avproduct.id)">Add</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                                    <!--<button type="button" class="btn btn-primary" @click="addProduct(), showModal = false">Add Product To Bundle</button>-->
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
    props: ['result'],

    data: function() {
        return {
            products: [],
            avproducts: [],
            showModal: false
        }
    },

    methods: {

        getIncludedProducts (id) {
            axios.get('api/bundleproducts/' + id)
            .then((response) => {
                this.products = response.data,
                this.showModal = true
            })
            .catch((e) => console.log(e));
        },

        removeProductFromBundle(bundleid, productid) {
            axios.delete('api/bundleproducts/' + bundleid + '/' + productid)
            .then((response) => this.showModal = false)
            .catch((e) => console.log(e));
        },

        getNotIncludedProducts(bundleid) {
            axios.get('api/bundleproductsnot/' + bundleid)
            .then((response) => {
                this.avproducts = response.data,
                this.showModal = true
            })
            .catch((e) => console.log(e));
        },

        addProductToBundle(bundleid, productid) {
            axios.post('api/bundleproducts/' + bundleid + '/' + productid)
            .then(() => this.showModal = false)
            .catch((e) => console.log(e));
        }

    }

}
</script>
