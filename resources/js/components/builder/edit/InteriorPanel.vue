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
        <!-- <v-sheet v-if="scenes[0]"> -->
        <v-sheet v-if="scenes">
          <v-slide-group show-arrows>
            <v-slide-item v-for="item in scenes" :key="item.id">
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
      <div id="panorama" style="min-height: 450px;"></div>
    </div>
    <media-files :mediaOptions="mediaFilesSettings" @responded="mediaResponse" />
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
    loadPanorama(i) {
      console.log(i);
      this.thePanorama = pannellum.viewer("panorama", {
        hotSpotDebug: true,
        default: {
          firstScene: "circle",
          // author: "Matthew Petroff",
          sceneFadeDuration: 1000,
        },
        scenes: {
          circle: {
            // title: "Mason Circle",
            // hfov: 92.49266381856185,
            hfov: 50,
            pitch: -16.834687202204037,
            yaw: -36.30724382948786,
            type: "equirectangular",
            panorama:
              this.baseUrl +
              "/storage/uploads/user-" +
              this.authUser.id +
              "/" +
              i.media_file.path,
            autoLoad: true,
            hotSpots: [
              {
                pitch: -14.94618622367452,
                yaw: -174.5048581866088,
                type: "scene",
                text: "Passenger Seats",
                sceneId: "back",
              },
              {
                pitch: -27.263801777525146,
                yaw: 5.051667495791323,
                type: "info",
                text: "Dashboard",
                cssClass: "custom-hotspot",
                // createTooltipFunc: hotspot,
                createTooltipArgs:
                  "<p>Sample Dashboard</p><img width='100%' height='auto' src='images/panoramic/dashboard.png' alt='Gallega Demo'/>",
              },
            ],
          }, // Circle
        },
      });
    },
    selectedScene(i) {
      this.selectedItem = Object.assign({}, i);
      setTimeout(() => {
        this.loadPanorama(this.selectedItem);
      }, 300);
    },
    mediaResponse(v) {
      this.mediaFilesSettings.dialogStatus = false;
      if (v.status == "success") {
        this.scenes = [];
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
      if (this.scenes.length == 0) {
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
      }
    },
  },
  created() {
    this.getScenes();
  },
};
</script>

<style>
</style>
