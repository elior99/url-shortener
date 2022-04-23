<template>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Url Shortener</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
        
        <router-link  to="/log/1" active-class="nav-item nav-link active" class="nav-item nav-link">Home</router-link>
        <router-link  to="/create" active-class="nav-item nav-link active" class="nav-item nav-link">Generate</router-link>
        
    </div>
  </div>
</nav>
</template>



<style>

</style>
<script>

    export default{
        methods: {
           
        
        }
    }
</script>
