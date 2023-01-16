<template>
<div>


  
<Header />

            <section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								My Orders				
							</h1>	
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start menu-list Area -->
			<section class="menu-list-area section-gap">
				<div class="container">


                    <MyOrderItem  v-for="order in orders" :key=order.id :order="order"/>																					
                            																					

				</div>	
			</section>






<Footer />

</div>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
import MyOrderItem from '@/components/MyOrderItem.vue'


export default {
	name: 'dishes',
    components: {
		Footer,
        Header,
        MyOrderItem,
	},
	data() {
		return {
            orders: [],
		}
	},
	mounted() {

	},

    created() {
        this.userAuth = this.$store.getters['user/getUser'].id != undefined;
        if (this.userAuth)
            this.fetchOrders();
    },
	methods: {      
        async fetchOrders() {
            await this.$store.dispatch('orders/getMyOrdersFromDB', this.$store.getters['user/getUser'].id);
            
            this.orders = this.$store.getters['orders/getOrders'];

            console.log(this.orders);
            /*let j = this.orders.length;
            for (let i = 0; i < this.orders.length; i++) {
                this.orders[i].order_num = j;
                j--;
            }*/

        }
	},
    computed: {

    },
}
</script>

<style scoped>
</style>