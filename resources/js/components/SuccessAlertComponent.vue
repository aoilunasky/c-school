<template>
  <div class="alert alert-dismissible" id="msg" v-if="message" :class="this.$props.type">
    <p>{{message}}</p>
    <span class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></span>
  </div>
</template>
<script>
export default {
  props: ["msg",'type'],
  data: () => ({
    message: "",
  }),
  mounted() {
    this.message = this.$props.msg;
    setTimeout(() => (this.message = ''), 2000);
  },
};
</script>