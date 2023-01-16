<template>
	<div class="logout">
			<h1 class="success-message" style="text-align: center;">{{message}}</h1>
	
	</div>
</template>

<script>

export default {
	
    data() {
        return {
            message: ''
        }
	},
	mounted() {
		this.setMessage()
	},


	methods: {
        setMessage() {
				if (this.$route.params.id == 0) {
                	this.message = "Welcome! You can now login";
                }
				else if (this.$route.params.id == 1) {
                	this.message = "Welcome back " + this.$store.getters['user/getUser'].name + "!";
                }
				else if (this.$route.params.id == 2) {
                	this.message = "Bye, come back soon!";
                }
				else if (this.$route.params.id == 3) {
					this.message = "Order sucess!";
				}	
																			
				var timeleft = 2;
				var downloadTimer = setInterval(() => {
					if(timeleft <= 0){
						clearInterval(downloadTimer)
						this.$router.push('/menu')
					}
				timeleft -= 1
				}, 1000)
		},


	},
   

}
</script>

<style scoped>
	.logout {
	margin: 0 auto;
	max-width: 800px;
	}

	.success-message {
	color: #32a95d;
	}

	.error-message {
	color: #d33c40;
	}

</style>



