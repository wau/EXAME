<template>
<div class="single-menu-list row justify-content-between align-items-center">
    <div class="col-lg-9">
        <a href="#"><h4>{{order.product_name}}</h4></a>
        <p>
            Order #{{order.id}} Date: {{order.created_at}}
        </p>
    </div>
    <div class="col-lg-3 flex-row d-flex price-size">
        <div class="s-price col">
            
            <span>${{order.product_price}}</span>
        </div>
                                            
    </div>
</div>	
</template>

<script>
    export default {
        props: ['order'],

        data() {
            return {
                product: null,
            };
        },
        
        computed: {

        },

        created() {
            //this.product = this.$store.getters['products/getProduct], ;
        },
    }  

</script>
