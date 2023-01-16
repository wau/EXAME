<template>
    <div>


    
    <Header />    

    <section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Menu List				
							</h1>	
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start menu-list Area -->
			<section class="menu-list-area section-gap">
				<div class="container">
					<div class="row">
						<div class="menu-cat mx-auto">
							<ul class="nav nav-pills" id="pills-tab" role="tablist">
							  <li class="nav-item">
							    <a class="nav-link active" id="pizza-tab" data-toggle="pill" href="#pizza" role="tab" aria-controls="pizza" aria-selected="true">Pizza</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="pills-bread-tab" data-toggle="pill" href="#pills-bread" role="tab" aria-controls="pills-bread" aria-selected="false">Breads</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="pills-burger-tab" data-toggle="pill" href="#pills-burger" role="tab" aria-controls="pills-burger" aria-selected="false">Burgers</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="pills-chicken-tab" data-toggle="pill" href="#pills-chicken" role="tab" aria-controls="pills-chicken" aria-selected="false">Chicken</a>
							  </li>						  
							</ul>							
						</div>

					</div>
					<div id="pills-tabContent" class="tab-content absolute">
						<div class="tab-pane fade show active" id="pizza" role="tabpanel" aria-labelledby="pizza-tab">
                            <ProductItem  v-for="product in filters('Pizza')" :key=product.id :product="product"/>																																																							
						</div>
	
						<div class="tab-pane fade show " id="pills-bread" role="tabpanel" aria-labelledby="pills-bread-tab">
                            <ProductItem  v-for="product in filters('Breads')" :key=product.id :product="product"/>																																										
						</div>					

						<div class="tab-pane fade show " id="pills-burger" role="tabpanel" aria-labelledby="pills-burger-tab">
							<ProductItem  v-for="product in filters('Burgers')" :key=product.id :product="product"/>																					
					
						</div>

						<div class="tab-pane fade show " id="pills-chicken" role="tabpanel" aria-labelledby="pills-chicken-tab">
		
                            <ProductItem  v-for="product in filters('Chicken')" :key=product.id :product="product"/>																					
                    
						</div>

					</div>
				</div>	
			</section>
    <Footer />

    </div>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
import ProductItem from '@/components/ProductItem.vue'

export default {

    components: {
        Footer,
        Header,
        ProductItem,
    },
  

    data() {
        return {
            products: [],
            userAuth: false,
            /*pizzas: [],
            breads: [],
            burgers: [],
            chicken: [],*/
        }
    },
    mounted() {
        this.fetchProducts();
        this.userAuth = this.$store.getters['user/getUser'].id != undefined;
    },
    methods: {
        filters(cat_name) {
            return this.products.filter(item => item.cat_name === cat_name);
        },

        async fetchProducts() {
            await this.$store.dispatch('products/getProductsFromDB');
            this.products = this.$store.getters['products/getProducts'];

           /* for (let i = 0; i < this.products.length; i++) {
                if (this.products[i].cat_name === "Pizza") {
                    //console.log(this.pizzas.length);
                    this.pizzas[this.pizzas.length] = this.products[i]; 
                }

                else if (this.products[i].cat_name === "Breads")
                    this.breads[this.breads.length] = this.products[i];
                else if (this.products[i].cat_name === "Burgers")
                    this.burgers[this.burgers.length] = this.products[i];
                else if (this.products[i].cat_name === "Chicken")
                    this.chicken[this.chicken.length] = this.products[i];
            }
            //console.log(this.pizzas);
            console.log(this.chicken);
            this.testchickem = this.chicken[0];*/
        }

    },
    computed: {

    },    
}
</script>

<style scoped>
.thumbwrap {
    position:relative;
}

.thumb span { 
    position:absolute;
    visibility:hidden;
}
.thumb:hover, .thumb:hover span { 
    visibility:visible;
    top:-30px;
    left:-35px; 
    z-index:1;
}
</style>