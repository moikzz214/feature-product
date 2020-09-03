<template>
  <div class="row">
    <div class="col-12 col-md-2 d-flex align-center flex-start">
      <v-card class="text-center pa-2" @click.stop="openMediaFiles">
        <v-icon small>mdi-plus</v-icon>
        <h5 class="font-weight-light">Add Scene</h5>
      </v-card>
    </div>
    <div class="col-12 col-md-10">
      <v-skeleton-loader :loading="loading" type="list-item-avatar-two-line">
        <v-sheet v-if="scenes">
          <v-slide-group show-arrows>
            <v-slide-item v-for="item in scenes" :key="item.id">
              <div class="text-right" style="position:relative;">
                <v-btn
                  fab
                  style="position:absolute;right:0;top:0;z-index:9;height:15px;width:15px;"
                  color="red"
                  class="elevation-0"
                  x-small
                  dark
                  @click="deleteScene(item.id)"
                >
                  <v-icon x-small>mdi-close</v-icon>
                </v-btn>
                <v-card class="my-1 mx-2" active-class="primary" @click="selectedScene(item)">
                  <v-list-item dense two-line>
                    <v-list-item-avatar size="26" color="orange">
                      <v-icon dark small>mdi-panorama-horizontal</v-icon>
                    </v-list-item-avatar>
                    <v-list-item-content>
                      <v-list-item-title v-html="item.media_file.title.substring(0, 15)"></v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-card>
              </div>
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
    <div v-if="selectedItem.length == 0" class="col-12">
      <v-sheet
        class="grey lighten-4 mr-auto pa-3 d-flex justify-center align-center"
        style="min-height:480px;"
      >
        <p v-if="scenes.length == 0">
          Add your
          <a @click.stop="openMediaFiles">new scene now</a>.
        </p>
        <p v-else>Please select a scene</p>
      </v-sheet>
    </div>
    <div v-else class="col-12">
      <div id="panorama" style="height:400px;width:100%;margin:0 auto;"></div>
    </div>
    <media-files :mediaOptions="mediaFilesSettings" @responded="mediaResponse" />

    <v-dialog v-model="deleteDialog" max-width="290">
      <v-card>
        <v-card-title class="subtitle-1">Confirm Delete?</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="grey" text @click="deleteDialog = false">Cancel</v-btn>
          <v-btn color="error" text @click="confirmDelete(toDelete)">Delete</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
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
      toDelete: [],
      deleteDialog: false,
      loading: false,
      scenes: [],
      selectedItem: [],

      thePanorama: null,
      baseUrl: window.location.origin,

      // Media Files
      mediaFilesSettings: {
        dialog: true,
        dialogStatus: false,
        user: this.authUser,
        action: "save",
        data: null,
        product: this.product,
        itemType: "panorama",
      },
    };
  },
  methods: {
    deleteScene(i) {
      this.toDelete = i;
      this.deleteDialog = true;
    },
    confirmDelete(item) {
      axios
        .post("/item/delete/" + item)
        .then((response) => {
          this.getScenes();
          this.deleteDialog = false;
          this.selectedItem = [];
          console.log(response);
        })
        .catch((error) => {
          console.log("Error: " + error);
          console.log(this.scenes);
        });
    },
    loadPanorama(i) {
      // console.log(i.media_file.original_name);
      let sceneTitle = "";
      sceneTitle = i.media_file.original_name;
      this.thePanorama = pannellum.viewer("panorama", {
        autoLoad: false,
        default: {
          firstScene: sceneTitle,
          // author: "Matthew Petroff",
          sceneFadeDuration: 1000,
        },
        scenes: {},
      });

      this.thePanorama.addScene(sceneTitle, {
        // title: "Mason Circle",
        // hfov: 92.49266381856185,
        hfov: 50,
        pitch: -16.834687202204037,
        yaw: -36.30724382948786,
        type: "equirectangular",
        // panorama: "http://127.0.0.1:8000/product/images/panoramic/20200826_120720.jpg",
        // panorama: "http://127.0.0.1:8000/product/images/panoramic/panoramic-4k-optimized.jpg",
        panorama:
          this.baseUrl +
          "/storage/uploads/user-" +
          this.authUser.id +
          "/" +
          i.media_file.path,
        hotSpots: [],
      });
      this.thePanorama.loadScene(sceneTitle);

      this.thePanorama.addHotSpot(
        {
          pitch: -14.94618622367452,
          yaw: -174.5048581866088,
          type: "scene",
          text: "Passenger Seats",
          //   sceneId: sceneTitle,
        }
        // sceneTitle
      );

      this.thePanorama.addHotSpot(
        {
          pitch: -27.263801777525146,
          yaw: 5.051667495791323,
          type: "info",
          text: "Dashboard",
          //   cssClass: "custom-hotspot",
          //   createTooltipFunc: hotspot,
          //   createTooltipArgs:
          //     "<p>Sample Dashboard</p><img width='100%' height='auto' src='images/panoramic/dashboard.png' alt='Gallega Demo'/>",
        }
        // sceneTitle
      );

      console.log(this.thePanorama);
    },
    selectedScene(i) {
      this.selectedItem = Object.assign({}, i);
      if (this.thePanorama != null) {
        console.log('is null')
        this.thePanorama.destroy();
      }
      setTimeout(() => {
        this.loadPanorama(this.selectedItem);
      }, 300);
    },
    mediaResponse(v) {
      this.mediaFilesSettings.dialogStatus = false;
      if (v.status == "success") {
        // this.scenes = [];
        this.getScenes();
      }
    },
    openMediaFiles() {
      this.mediaFilesSettings.dialogStatus = !this.mediaFilesSettings
        .dialogStatus;
      // this.mediaFilesSettings.data = item;
      // console.log(this.mediaFilesSettings.dialogStatus);
    },
    getScenes() {
      // if (this.scenes.length == 0) {
      this.loading = true;
      axios
        .get("/item/scenes/by-product/" + this.product)
        .then((response) => {
          this.scenes = Object.assign({}, response.data);
          this.loading = false;
          // console.log(this.scenes);
        })
        .catch((error) => {
          console.log("Error: " + error);
          console.log(this.scenes);
        });
      // }
    },
  },
  created() {
    this.getScenes();
  },
};
</script>

<style>
</style>
