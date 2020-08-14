<template>
  <div>
    <div class="d-flex align-center mb-5">
      <v-btn
        @click.stop="dialog = true"
        class="mr-3 text--primary"
        elevation="2"
        fab
        dark
        x-small
        color="white"
      >
        <v-icon dark>mdi-plus</v-icon>
      </v-btn>
      <h4 class="font-weight-light">Scenes</h4>
    </div>
    <v-card>
      <v-list two-line dense>
        <v-list-item v-for="item in scenes" :key="item.id" @click="0">
          <v-list-item-avatar size="36" :color="`${item.type == 'Panoramic' ? 'orange' : 'teal'}`">
            <v-icon
              dark
              small
            >{{ item.type == "Panoramic" ? 'mdi-panorama-horizontal' : 'mdi-axis-z-rotate-clockwise' }}</v-icon>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title v-html="item.title"></v-list-item-title>
            <v-list-item-subtitle v-html="item.type"></v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-card>
    <v-dialog v-model="dialog" max-width="450">
      <create-scene :product-id="product" @close="closeDialog"></create-scene>
    </v-dialog>
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
  components: {
    CreateScene,
  },
  data() {
    return {
      dialog: false,
      scenes: [],
    };
  },
  methods: {
    closeDialog(v) {
      this.dialog = v;
    },
    getScenes() {
      axios
        .get("/builder/scenes/all")
        .then((response) => {
          this.scenes = Object.assign({}, response.data.data);
          console.log(this.scenes);
        })
        .catch((error) => {
          console.log("Error: " + error);
          //   console.log("Error: " + error);
        });
    },
  },
  mounted() {
    this.getScenes();
    // console.log(this.product);
  },
};
</script>

<style>
</style>
