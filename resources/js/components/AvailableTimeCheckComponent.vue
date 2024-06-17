<template>
  <div
    @click="toogle"
    :class="{ active: value, 'bg-gray-400': disable}"
    class=" text-center "
    style="padding: 0.75rem"
  >
    {{ text }}
    <input type="hidden" :name="date + '[]'" :value="value" />
    <input type="hidden" name="hasData[]" :value="value" />
  </div>
</template>

<script>
export default {
  props: ["date", "time", "selected"],
  data() {
    return {
      value: this.$props.selected ? this.$props.time : "",
      text: this.$props.time,
      disable: false,
    };
  },
  mounted() {
    var d = new Date();
    let today = [
      d.getFullYear(),
      ("0" + (d.getMonth() + 1)).slice(-2),
      ("0" + d.getDate()).slice(-2),
    ].join("-");
    if (today > this.date) {
      this.disable = true;
      this.text = 'closed';
    } else {
      this.disable = false;
    }
  },
  methods: {
    toogle() {
      if (!this.disable) {
        if (this.value != "") {
          this.value = "";
        } else {
          this.value = this.time;
        }
      }
    },
  },
};
</script> 
<style scoped>
.active {
  background-color: lightblue;
}
</style>
