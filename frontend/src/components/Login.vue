<script lang="ts">
  import Cookie from 'js-cookie'
  import { useRouter } from 'vue-router';

  export default {
    name: 'Login',
    data() {
      return {
        email: '',
        password: '', 
        errorMessage: ''
      
      }
    },
    created() {
      this.router = useRouter();
    },
    methods: {
      submit(){
        const router = this.router;
        const payload = {
          email: this.email,
          password: this.password
        }

        fetch("http://localhost:8000/api/login" , {
          method: 'POST', 
          headers: {
            'Content-Type': 'application/json',
            'Access' : 'application/json'
          },
          body: JSON.stringify(payload)
        }).then(response => response.json()).then(res =>{
          
          if (res.token === undefined){
            this.errorMessage = 'Credenciais inválidas. Por favor, tente novamente.';
          }
          else{
            Cookie.set('token', res.token)
          }
          
        if (router) {
            router.push({ name: 'Home' });
        }
        })
      }
    },
  }
</script>
<template>
  
  <main class="form-signin">
    <form @submit.stop.prevent="submit">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating">
        <input v-model="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input v-model="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      <p v-if="errorMessage" style="color: red;">{{ errorMessage }}</p>
      <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
  </main>

</template>
<style>

html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
