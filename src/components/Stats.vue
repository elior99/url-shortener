<template>
 <div class="col-lg-12">

  <table class="table table-sm  table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Url</th>
      <th scope="col">Short Link</th>
      <th scope="col">Clicks</th>
    </tr>
  </thead>
  <tbody style="font-size:14px;">
    <tr v-for="(l,i) in log" :key="i">
      <th scope="row">{{l.id}}</th>
      <td class="linktd"><a target="_blank" :href="l.url">{{l.url}}</a></td>
      <td><a target="_blank" :href="'https://' + l.short_link">{{l.short_link}}</a></td>
      <td>{{l.clicks}}</td>
    </tr>
  </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    
    <li v-if="checkz" class="page-item"><a class="page-link" href="log/1">First</a></li>
    <li  v-if="checkz" class="page-item"><a class="page-link" :href="'log/'+(parseInt(this.$route.params.id)-1)">{{ parseInt(this.$route.params.id) + -1 }}</a></li>
        <li class="page-item active"><a class="page-link" :href="'log/'+(parseInt(this.$route.params.id))">{{ parseInt(this.$route.params.id) }}</a></li>
    <li class="page-item"><a class="page-link" :href="'log/'+(parseInt(this.$route.params.id)+1)">{{ parseInt(this.$route.params.id) + 1 }}</a></li>
    <li class="page-item"><a class="page-link" :href="'log/'+(parseInt(this.$route.params.id) + 1)">Next</a></li>
  </ul>
</nav>
</div>
</template>

<script>

export default {
  
  
  data () {
    return {
      domain:'',
      url:'',
      fetchUr: '/admin/static/list.php?c=',
      short: '',
      gotShort: false,
      log:[],
      checkz: false,
    }
  },

  methods: {

    isZero() {

        if((parseInt(this.$route.params.id)-1) == 0) {
          this.checkz = false;
        }
        else {
          this.checkz = true;
        }
        
    },
    
    sendReq() {
      
      fetch(this.fetchUr,{
                  credentials: 'include',   
              })
                .then(res => {
                    
                    return res.json()
                })
                .then(res => {
                    
                   this.log = res.log
                       console.log(this.log);
                })

    },
  },
  created() {
    
          this.fetchUr = this.fetchUr + this.$route.params.id;
          
         this.domain = document.location.href;
         this.sendReq();
         this.isZero();
    }
}
</script>

<style>
.linktd {
  word-break: break-all;
}
</style>
