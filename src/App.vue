<template>
<div>
  <app-header></app-header>
  <router-view></router-view>
</div>
</template>

<script>
import Header from './components/Header.vue';
export default {
  
  
  data () {
    return {
      domain:'',
      url:'',
      fetchUr: '/admin/static/ins.php?url=',
      short: '',
      gotShort: false,
      ss:'',
    }
  },
  components: {
    appHeader: Header,
  },
  methods: {
    
    created() {
      
     this.domain = document.location.href;

    }
  }
}
</script>

<style>

</style>
