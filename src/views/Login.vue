<template>
<div>


  
<Header />



            <section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Login				
							</h1>	
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->				  

			<!-- Start contact-page Area -->
			<section class="contact-page-area section-gap">
				<div class="container">
					<div class="row">

						<div class="col-lg-12">
							<form @submit.prevent="login" class="form-area contact-form text-right" id="myForm">
								<div class="row">	
									<div class="col-lg-6 form-group">
									
										<input v-model= "user.email" name="email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" required="" type="email">

										<input v-model= "user.password" name="password" placeholder="Enter password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter password'" class="common-input mb-20 form-control" required="" type="password">
										
									</div>
									<div class="col-lg-12">
										<div class="alert-msg" style="text-align: left;"></div>
										<button  class="genric-btn primary" style="float: left;">Login</button>
									</div>
								</div>
							</form>	
						</div>
					</div>
				</div>	
			</section>
			<!-- End contact-page Area -->




<Footer />

</div>
</template>
<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'



export default {
    name: 'login',
    components: {
        Footer,
        Header
    },
    data() {
		return {

			user: {
				email: '',
				password: '',
			},
			submitting: false,
			error: false,
			errorMsg: '',
			userAuth: false,
		}
	},

	methods: {
		async login() {
			console.log(this.user);

			const canLogin = await this.$store.dispatch('user/loginUser', this.user);
			if (canLogin) {
				//console.log(this.$store.getters('user/getUser'));
				//this.$store.commit
				//console.log(this.$store.getters.loginUser);
				console.log(this.$store.getters['user/getUser']);
				this.$router.push({ path: '/message/1' });
			}
            //else alert("Wrong email or password");
		},
	},
    mounted() {
    },
    computed: {
                       
    },
}
</script>