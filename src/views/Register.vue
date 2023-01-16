<template>
<div>


  
<Header />
<section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Register				
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
							<form @submit.prevent="register" class="form-area contact-form text-right" >
								<div class="row">	
									<div class="col-lg-6 form-group">
										<input v-model="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mb-20 form-control" required="" type="text">
									
										<input v-model="email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" required="" type="email">

										<input v-model="password" placeholder="Enter password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter password'" class="common-input mb-20 form-control" required="" type="password">
										
										<input v-model="passwordConfirm" placeholder="Repeat password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Repeat password'" class="common-input mb-20 form-control" required="" type="password">
									</div>
									<div class="col-lg-12">
										<div class="alert-msg" style="text-align: left;"></div>
										<button  class="genric-btn primary" style="float: left;">Register</button>
									</div>
								</div>
							</form>	
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

export default {
    name: 'register',
    components: {
        Footer,
        Header,
    },

    data() {
        return {
            name: '',
            email: '',
            password: '',
            passwordConfirm: '',
            error: false,
			errorMsg: '',        
        }
    },

    mounted() {
    },

    methods: {

		validateForm() {
			var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

			console.log(this.password + " " + this.passwordConfirm);

			if (!this.email.match(validRegex)) {
				this.error = true;
				this.errorMsg = 'Invalid email format';
                alert(this.errorMsg);
				return false;
			}
			else if (this.password !== this.passwordConfirm) {

				this.error = true;
				this.errorMsg = 'Passwords dont match!';
                alert(this.errorMsg);
				return false;
			}
			else if (this.password.length < 6) {
				this.error = true;
				this.errorMsg = 'Passwords must be at least 6 characters long';
                alert(this.errorMsg);
				return false;
			}

			this.error = false;
			this.errorMsg = '';
			return true;
		},

		async register() {
			if (!this.validateForm()) {
                console.log('error')
				return;
			}
            const user = {
                name: this.name,
                email: this.email,
                password: this.password,
            };

			const exists = await this.$store.dispatch('user/userExists', user);
			if (exists) {
				console.log("existe na BD");
                alert("email já existe na bd");
			}
			else { //add user to database
				console.log("teste aq");
				const addedUser = await this.$store.dispatch('user/addUser');
				this.$router.push({ path: '/message/0' });
			}
		},
	},
    computed: {
                
    },

}
</script>