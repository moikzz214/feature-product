<template>
  <div>
    <v-card>
      <v-list rounded dense>
        <v-subheader>HOTSPOTS</v-subheader>
        <v-list-item-group v-model="item" color="primary">
          <v-list-item v-for="(item, i) in items" :key="i">
            <v-list-item-icon>
              <v-icon v-text="item.icon"></v-icon>
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
        { text: "Engine", icon: "mdi-crosshairs-gps" },
        { text: "Head light", icon: "mdi-crosshairs-gps" },
        { text: "Door", icon: "mdi-crosshairs-gps" },
        { text: "Dashboard", icon: "mdi-crosshairs-gps" },
        { text: "Front seat", icon: "mdi-crosshairs-gps" },
        { text: "Rear", icon: "mdi-crosshairs-gps" },
      ],
    };
  },
};
</script>

<style>
</style>
