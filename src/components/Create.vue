<template>
<div class="container">
<div style="padding-top:10%;" class="row">
  <div class="col-10 offset-1 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 ">
    <br />
      <h1>Url Shortener</h1>
        <div class="input-group mb-3">
          <input v-model="jsend.url" type="text" class="form-control" placeholder="Link" aria-label="Link" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button @click="sendReq" class="btn btn-outline-secondary" type="button" id="button-addon2">Go!</button>
          </div>
        </div>
        <div v-if="gotShort" class="alert alert-info" role="alert">
          <div class="text-center">
         <h5>Your Short Url Is:</h5> 
         <div  class="alert alert-light" role="alert" style="margin-top: 10px"><a style="padding: 10px;font-weight: 500;
    color: #032952;" :href="short">{{domain + short}}</a></div>
        
         <input type="hidden" id="clink" :value="domain + short">
         <button @click="copyIt" class="btn btn-info" type="button">Copy</button></div>
        </div>
        
        
     

  </div>
</div>
</div>
</template>

<script>

export default {
  
  data () {
    return {
      domain:'',
      jsend:{
        url: '',
      },
      fetchUr: '/admin/static/ins.php?url=1',
      short: '',
      gotShort: false,
      ss:'',
    }
  },
  components: {

  },
  methods: {
    sendReq() {
      
      fetch(this.fetchUr,{
                  credentials: 'include', 
                  method: 'POST',  
                  body: JSON.stringify(this.jsend)
              })
                .then(res => {
                    
                    return res.json()
                })
                .then(res => {
                    
                   this.short = res.link
                       this.gotShort = true;
                    })

    },
    copyIt () {
          let testingCodeToCopy = document.querySelector('#clink');
          testingCodeToCopy.setAttribute('type', 'text') ;
          testingCodeToCopy.select();
          document.execCommand('copy');
             testingCodeToCopy.setAttribute('type', 'hidden')
          window.getSelection().removeAllRanges()
        },
  },
  created() {
    this.domain = document.location.href;
  
  }
}
</script>

<style>

</style>
