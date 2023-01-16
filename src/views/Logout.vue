<template>
	<div>

	</div>
</template>

<script>

export default {

	data() {
		return {
			success: false,
			user: {},
		}
	},


	methods: {


	},
   
	created: async function () {
		this.$store.commit('user/logoutUser');
		this.$router.push({ path: '/message/2'});
		
	},

}
</script>
