<template>
  <div>
    <nav class="navbar">
      <ul class="navbar-list">
        <li>
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'login' }">Login</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
        </li>
      </ul>
    </nav>
    <router-view></router-view>
  </div>
</template>

<style scoped>

/*@import url('./src/assets/main.css');*/

.navbar {
  background-color: #1f1e1e;
  padding: 15px 0;
  margin: -10px;
}

.navbar ul {
  list-style-type: none;
  margin: 0;
}
.navbar-list {
  list-style-type: none;
  padding: 0;
  margin: 0;
  text-align: center;
}
.navbar-list li {
  display: inline;
  margin-right: 30px;
}
.navbar-list li:last-child {
  margin-right: 0; 
}
.navbar-list a {
  color: #1bc738;
  text-decoration: none;
}
.navbar-list a:hover {
  color: #00ff2a;
}
</style>
