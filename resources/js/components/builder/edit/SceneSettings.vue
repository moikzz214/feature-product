<template>
  <div>
    <v-card>
      <v-list>
        <v-subheader>Settings</v-subheader>
        <v-list-item-group v-model="item" color="primary">
          <v-list-item v-for="(item, i) in items" :key="i">
            <v-list-item-icon class="mr-1">
              <v-icon small v-text="item.icon"></v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title v-text="item.text"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
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
    return {
      item: 1,
      items: [
        { text: "Layout", icon: "mdi-crop-free" },
        { text: "Hotspots", icon: "mdi-crosshairs-gps" },
      ],
    };
  },
};
</script>

<style>
</style>
