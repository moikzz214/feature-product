<template>
  <div>
    <div class="d-flex align-center mb-5">
      <h4 class="font-weight-light">Scene Settings</h4>
    </div>
    <v-card>
      <v-list dense>
        <v-list-item>
          <v-list-item-avatar size="36" color="cyan">
            <v-icon dark small>mdi-cog</v-icon>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title>LAYOUT</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item>
          <v-list-item-avatar size="36" color="cyan">
            <v-icon dark small>mdi-panorama-horizontal</v-icon>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title>HOTSPOTS</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-card>
  </div>
</template>

<script>
import CreateScene from "./CreateScene";
export default {
  props: {
    product: {
      type: String,
      default: "",
    },
  },
  components: {},
  data() {
    return {};
  },
  methods: {},
  mounted() {},
};
</script>

<style>
</style>
