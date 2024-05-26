<script setup>
import { ref } from "vue";

const model = defineModel({
  type: String,
  required: true,
});

const input = ref(null);
</script>

<template>
  <v-text-field type="text" variant="outlined" v-model="model" ref="input" />
</template>
