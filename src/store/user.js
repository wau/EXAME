const user = {
  namespaced: true,
  state: {
      user: { 
      //"id":"1",
      //"name":"Peter Kinget",
      //"email":"peter.kinget@gmail.com",  
      },
      tmp_user:{
      //"email":"abc@yahoo.com"
      //"name":"abc"
      //"password":"123456"			
      },
  },
  getters: {
      getUser (state) {
          return state.user;
      },   
  }, 
  mutations: {
      loginUser(state, user){
          state.user = user
      },
      logoutUser(state){
          state.user = {}
      },
      tmpUser(state, user){
          state.tmp_user = user
      },           
  },
  actions: {
    async userExists({commit}, user) {
      try {
        const response = await fetch(`http://daw.deei.fct.ualg.pt/~a72730/EXAME/api/users.php?email=${user.email}`, {
          method: 'GET',
        })
        const data = await response.json()
        console.log('userExists', data)
        if ( data !== null) {
            alert('Email already exists')
            return true
        }
        else {
            //remember temporary user
            commit('tmpUser', user)
            return false
        }                   
      } 
      catch (error) {
        console.error(error)
        alert('Error: Database connection failed in phase 1')
        return false
      }
    }, 
    async addUser({state}) {
      try {
          const response = await fetch('http://daw.deei.fct.ualg.pt/~a72730/EXAME/api/users.php', {
            method: 'POST',
            body: JSON.stringify(state.tmp_user),
            headers: { 'Content-type': 'text/html; charset=UTF-8' },
          })
        const data = await response.json()
        console.log('received data:', data)
        return true
      } 
      catch (error) {
        console.error(error)
        alert('Error: Database connection failed in phase 2')	
        return false			
      }
    },
    async loginUser({commit}, user) {
      try {
        const response = await fetch(`http://daw.deei.fct.ualg.pt/~a72730/EXAME/api/users.php?email=${user.email}&password=${user.password}`)
        const data = await response.json()
        if ( data == null) {
          alert('Error: Wrong credentials')
          return false
        }
        else {
          //add new user
          console.log('received data:', data)
          commit('loginUser', data)
          return true
        }
      } 
      catch (error) {
        console.error(error)
        alert('Error: Database connection failed')	
        return false			
      }
    },   
  }

}
export default 
user