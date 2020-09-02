<template>
  <div class="row">
    <div class="col-12 col-md-2 d-flex align-center flex-start">
      <v-card class="text-center pa-3" @click.stop="openMediaFiles">
        <v-icon>mdi-plus</v-icon>
        <h4 class="font-weight-light">Add Scene</h4>
      </v-card>
    </div>
    <div class="col-12 col-md-10">
      <v-skeleton-loader :loading="loading" type="list-item-avatar-two-line">
        <v-sheet v-if="scenes[0]">
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
        <v-sheet
          v-else
          class="grey lighten-4 pa-5 caption d-flex align-center justify-center"
          style="min-height:75px;"
        >
          <p class="ma-0">
            No scene found. Add your
            <a @click.stop="openMediaFiles">new scene now</a>.
          </p>
        </v-sheet>
      </v-skeleton-loader>
    </div>
    <div class="col-12">
      <v-sheet
        class="grey lighten-4 mr-auto pa-3 d-flex justify-center align-center"
        style="min-height:480px;"
      >
        <p>
          Add your
          <a @click.stop="openMediaFiles">new scene now</a>.
        </p>
      </v-sheet>
    </div>
    <media-files :mediaOptions="mediaFilesSettings" @responded="mediaResponse" />
    <!-- <v-dialog v-model="dialog" max-width="450">
      <create-scene :product-id="product" @close="closeDialog" @sceneCreated="getScenes"></create-scene>
    </v-dialog>-->
  </div>
</template>

<script>
import MediaFiles from "../../MediaFiles";
import CreateScene from "./CreateScene";
export default {
  props: {
    product: {
      type: String,
      default: "",
    },
    authUser: {
      type: Object,
      default: null,
    },
  },
  components: {
    MediaFiles,
    CreateScene,
  },
  data() {
    return {
      loading: false,
      dialog: false,
      scenes: [],

      // Media Files
      mediaFilesSettings: {
        dialog: true,
        dialogStatus: false,
        user: this.authUser,
        data: null,
      },
    };
  },
  methods: {
    mediaResponse() {
      this.mediaFilesSettings.dialogStatus = false;
      console.log("media files responded");
    },
    openMediaFiles() {
      this.mediaFilesSettings.dialogStatus = !this.mediaFilesSettings
        .dialogStatus;
      console.log(this.mediaFilesSettings.dialogStatus);
    },
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
          // console.log(this.scenes[0]);
        })
        .catch((error) => {
          console.log("Error: " + error);
          console.log(this.scenes);
        });
    },
  },
  created() {
    this.getScenes();
  },
};
</script>

<style>
</style>
