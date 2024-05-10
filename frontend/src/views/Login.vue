<template>
  <div>
    <h2>Login</h2>
    <form @submit.prevent="login">
      <input type="email" v-model="user.email" placeholder="Digite seu email">
      <input type="password" v-model="user.password" placeholder="Digite sua senha">
      <button type="submit">Login</button>
      <p v-if="errorMessage">{{ errorMessage }}</p>
    </form>
  </div>
</template>

<script setup>
import http from '@/services/http.js'
import { reactive, ref } from 'vue';
import { useAuthStore } from '@/stores/auth.js'

const auth = useAuthStore()

const user = reactive({
  email: '',
  password: ''
})

const errorMessage = ref('')

async function login(){
  try {
    const { data } = await http.post('/login', user)
    
    if(data?.status == false){
      errorMessage.value = 'Email ou senha incorretos'
    }
    else{
      console.log('Login certo')
      auth.setToken(data.token)
      auth.setUser(data.user)
    }
  }
  catch (error) {
    console.log(error?.response?.data)
    errorMessage.value = 'Erro ao realizar login'
  }
}
</script>

<style>
form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #0a0a0a;
  border-radius: 5px;
  background-color: #f9f9f9;
}

h2 {
  text-align: center;
}

input[type="email"],
input[type="password"],
button {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #0a0a0a;
  border-radius: 40px;
}

button {
  background-color: #00ff2a;
  color: #0a0a0a;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #1bc738;
}

p.error-message {
  color: red;
  text-align: center;
}
</style>
