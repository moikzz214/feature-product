<template>
  <v-row class="px-3">
    <div class="col-12">
      <div class="d-flex align-center">
        <h3 class="font-weight-light">Edit Product</h3>
      </div>
    </div>
    <div class="col-3">
      <Scenes :product="this.$route.params.id" />
    </div>
    <div class="col-9" style="min-height:768px;">
      <div class="d-flex align-center mb-5">
        <h4 class="font-weight-light">Settings</h4>
        <v-btn
          @click.stop="0"
          class="ml-3 text--primary"
          elevation="2"
          fab
          dark
          x-small
          color="white"
        >
          <v-icon small dark>mdi-cog</v-icon>
        </v-btn>
        <v-btn
          @click.stop="0"
          class="ml-3 text--primary"
          elevation="2"
          small
          rounded
          color="white"
        >Hotspots</v-btn>
        <v-btn
          @click.stop="0"
          class="ml-3 text--primary"
          elevation="2"
          small
          rounded
          color="white"
        >Preview</v-btn>
      </div>
      <v-card class="mr-auto pa-3">
        <v-card-text>This is the builder</v-card-text>
      </v-card>
    </div>
  </v-row>
</template>

<script>
import Scenes from "./edit/Scenes";
export default {
  components: {
    Scenes,
  },
  data() {
    return {};
  },
  methods: {},
  mounted() {
    // console.log(this.$route.params.id);
  },
};
</script>
