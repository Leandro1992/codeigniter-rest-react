<template>
  <div>{{this.role}} Cheguei e to passando props</div>
</template>

<script>
export default {
  mounted() {
    console.log("Store mounted.");
  },
  props: ["products", "role"]
};
</script>