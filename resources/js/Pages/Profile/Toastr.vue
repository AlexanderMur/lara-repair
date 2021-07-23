<template><h1>{{message}}</h1></template>

<script>
import * as toastr from 'toastr'

export default {
    props: ['popstate', 'type', 'message'],
    components: {
    },
    data() {
        return {
        }
    },
    watch: {
      message: function(test) {
          alert(123)
        console.log(test)
        if (this.popstate === false && message) {
            toastr.success(message)
        }
      }
    },
}
</script>
