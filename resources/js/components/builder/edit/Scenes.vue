<template>
  <div class="row">
    <div class="col-2 d-flex align-center flex-start">
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
      <h4 class="font-weight-light mr-3">Scenes:</h4>
    </div>
    <div class="col-10">
      <v-skeleton-loader :loading="loading" type="list-item-avatar-two-line">
        <v-sheet v-if="scenes[0]" class="w-100">
          <v-slide-group show-arrows>
            <v-slide-item v-for="item in scenes" :key="item.id">
              <v-card class="my-1 mx-2" active-class="primary" @click="0">
                <v-list-item dense two-line>
                  <v-list-item-avatar
                    size="26"
                    :color="`${item.type == 'panoramic' ? 'orange' : 'teal'}`"
                  >
                    <v-icon
                      dark
                      small
                    >{{ item.type == "panoramic" ? 'mdi-panorama-horizontal' : 'mdi-axis-z-rotate-clockwise' }}</v-icon>
                  </v-list-item-avatar>
                  <v-list-item-content>
                    <v-list-item-title v-html="item.title"></v-list-item-title>
                    <v-list-item-subtitle v-html="item.type"></v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </v-card>
            </v-slide-item>
          </v-slide-group>
        </v-sheet>
        <v-sheet v-else class="w-100">
          <v-alert color="grey lighten-4" dense class="my-1 pa-5 mx-2 caption d-flex align-center justify-center">
            No scene found. Add your <a @click.stop="dialog = true">new scene now</a>.
          </v-alert>
        </v-sheet>
      </v-skeleton-loader>
    </div>
    <v-dialog v-model="dialog" max-width="450">
      <create-scene :product-id="product" @close="closeDialog" @sceneCreated="getScenes"></create-scene>
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
      loading: false,
      dialog: false,
      scenes: [],
    };
  },
  methods: {
    closeDialog(v) {
      this.dialog = v;
    },
    getScenes() {
      this.loading = true;
      axios
        .get("/builder/scenes/product/" + this.product)
        .then((response) => {
          this.scenes = Object.assign({}, response.data.data);
          this.loading = false;
          console.log(this.scenes[0]);
        })
        .catch((error) => {
          console.log("Error: " + error);
          console.log(this.scenes)
        });
    },
    // reloadScenes() {
    //   this.getScenes();
    // },
  },
  mounted() {
    this.getScenes();
  },
};
</script>

<style>
</style>
