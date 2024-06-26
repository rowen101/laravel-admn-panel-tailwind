<script setup>
import { ref } from "vue";

const props = defineProps({ title: String ,isExpanded:Boolean});
const active = ref(props.isExpanded);
</script>
<template>
  <div class="">
    <div class="tab__header">
      <a
        href="#"
        class="tab__link p-4 block bg-blue-dark hover:bg-blue-darker no-underline border-b-2  flex justify-between"
        @click.prevent="active = !active"
      >
        <strong>{{ title }}</strong>
        <span class="down-Arrow" v-show="!active">&#9660;</span>
        <span class="up-Arrow" v-show="active">&#9650;</span>
      </a>
    </div>
    <div class="tab__content p-2" v-show="active"><slot /></div>
  </div>
</template>

<style lang="scss" scoped></style>
