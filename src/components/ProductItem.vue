<template>
<div class="single-menu-list row justify-content-between align-items-center">
    <div class="col-lg-9">
        <a href="#"><h4>{{product.name}}</h4></a>
        <p>
            {{product.description}}
        </p>
    </div>
    <div class="col-lg-3 flex-row d-flex price-size">
        <div class="s-price col">
            
            <span>${{product.price}}</span> <br />

            <button v-if="userAuth == true" type="button" class="btn btn-dark btn-block btn-lg"
                  @click="makeOrder()"
                    data-mdb-ripple-color="dark">Order</button>
            
            <p v-else>Login to place order!</p>
        </div>
                                            
    </div>
</div>	
</template>

<script>
    export default {
        props: ['product'],

        data() {
            return {
                userAuth: false,
            }
        },
        
        computed: {

        },

        methods: {
            async makeOrder() {
                //{"customer_id":"19","product_id":"3","product_price":"10"}<br />
                if (!this.userAuth)
                    return;
                    
                const order = {
                    customer_id: this.$store.getters['user/getUser'].id, 
                    product_id: this.product.id,
                    product_price: this.product.price
                }

                const placeOrder = await this.$store.dispatch('orders/newOrder', order)
                    if (placeOrder)
                        this.$router.push({ path: '/message/3' });
            },
        },

        created() {
            //console.log(this.product);
            this.userAuth = this.$store.getters['user/getUser'].id != undefined;
            console.log(this.$store.getters['user/getUser']);
        },
    }  

</script>
