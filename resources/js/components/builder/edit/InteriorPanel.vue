<template>
  <div class="row">
    <div class="col-12 col-md-12 d-flex align-center flex-start">
      <v-card class="text-center pa-2 mr-2" @click.stop="openMediaFiles">
        <v-icon small>mdi-plus</v-icon>
        <h5 class="font-weight-light">Add Scene</h5>
      </v-card>
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
    <div v-if="selectedItem.length == 0" class="col-12 pb-0">
      <v-sheet
        class="grey lighten-4 mr-auto pa-3 d-flex justify-center align-center elevation-1"
        style="min-height:480px;"
      >
        <p v-if="scenes.length == 0">
          Add your
          <a @click.stop="openMediaFiles">new scene now</a>.
        </p>
        <p v-else>Please select a scene</p>
      </v-sheet>
    </div>
    <div v-else class="col-12 pb-0">
      <div id="panorama" class="elevation-1" style="height:400px;width:100%;margin:0 auto;"></div>
    </div>
    <div class="col-12 pt-0 d-flex justify-space-between align-center">
      <v-toolbar dense class="elevation-1">
        <v-toolbar-title>Title</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn small text class="primary--text" @click="addHotspot(555)">
          <v-icon small class="mr-1">mdi-check</v-icon>Save Hotspots
        </v-btn>
      </v-toolbar>
    </div>
    <media-files :mediaOptions="mediaFilesSettings" @responded="mediaResponse" />

    <v-dialog v-model="deleteDialog" max-width="290">
      <v-card>
        <v-card-title class="subtitle-1">Are you sure you want to delete?</v-card-title>
        <v-card-text>Deleting this item will delete the file and hotspot information.</v-card-text>
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
var toSaveHotspot = [];
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
    selectedInteriorHotspot: {
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

      hotspotText: "this is the hotspot Text",
    };
  },
  watch: {
    selectedInteriorHotspot: function (v) {
      console.log("the selected hotspot: " + v.id);
      this.addHotspot(v);
    },
  },
  methods: {
    removeHotspot() {
      // need hotspotid
      // this.thePanorama.removeHotSpot();
    },
    addHotspot(selectedHotspot) {
      this.thePanorama.addHotSpot(
        {
          id: "test",
          draggable: true,
          pitch: this.thePanorama.getPitch(),
          yaw: this.thePanorama.getYaw(),
          hfov: this.thePanorama.getHfov(),
          type: "info",
          text: this.hotspotText,
          cssClass: "custom-iba "+selectedHotspot.id,
          createTooltipFunc: this.hotspotUi,
          createTooltipArgs: "<p>" + selectedHotspot.title + "</p>",
          //   sceneId: sceneTitle,
        }
        // sceneTitle
      );
      let dPanorama = this.thePanorama;
      this.onMouseUp(dPanorama, selectedHotspot.id);
    },
    hotspotUi(hotSpotDiv, args) {
      // console.log(hotSpotDiv);
      // console.log(args);
      hotSpotDiv.classList.add("custom-tooltip");
      var span = document.createElement("span");
      span.innerHTML = args;
      hotSpotDiv.appendChild(span);
      span.style.width = span.scrollWidth - 20 + "px";
      span.style.marginLeft =
        -(span.scrollWidth - hotSpotDiv.offsetWidth) / 2 + "px";
      span.style.marginTop = -span.scrollHeight - 12 + "px";
    },
    onMouseUp(p, id) {
      
      setTimeout(() => {
        $(".custom-iba."+id).on("mouseup", function (e) {
          toSaveHotspot[id] = p.mouseEventToCoords(e);
          // push to global variable
          // console.log(p.mouseEventToCoords(e));  
           console.log(toSaveHotspot);
        });
      }, 500);
       
    },
    onDebugger() {
      this.debugger = !this.debugger;
      console.log(this.debugger);
    },

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
    loadPanorama(i = null) {
      // console.log(i.media_file.original_name);
      let sceneTitle = "";
      sceneTitle = i !== null ? i.media_file.original_name : "not-set";
      this.thePanorama = pannellum.viewer("panorama", {
        hotSpotDebug: true,
        autoLoad: false,
        default: {
          // author: "Matthew Petroff",
          firstScene: sceneTitle,
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

      // this.thePanorama.addHotSpot(
      //   {
      //     draggable: true,
      //     pitch: -14.94618622367452,
      //     yaw: -174.5048581866088,
      //     type: "scene",
      //     text: "Passenger Seats",
      //     //   sceneId: sceneTitle,
      //   }
      //   // sceneTitle
      // );

      this.thePanorama.addHotSpot(
        {
          draggable: true,
          pitch: -15.691242114430711,
          yaw: -31.176752681058826,
          type: "info",
          cssClass: "custom-iba madami",
          createTooltipFunc: this.hotspotUi,
          createTooltipArgs: "<p>Sample Dashboard</p>",
        }
        // sceneTitle
      );
      // mouseup
      // this.thePanorama.on("touchend", function (event) {
      //       // console.log(event);
      //       // For pitch and yaw of center of viewer
      //       console.log(this.thePanorama.getPitch(), this.thePanorama.getYaw());
      //       // For pitch and yaw of mouse location
      //       // console.log(this.thePanorama.mouseEventToCoords(event));
      //     });
      // let dPanorama = null;
      // dPanorama = this.thePanorama;

      //   // console.log(event);
      //   // console.log("yoyoyoyoyoyo");
      //   // For pitch and yaw of center of viewer
      //   // console.log(dPanorama.getPitch(), dPanorama.getYaw());
      //   // console.log(this.thePanorama.getPitch(), this.thePanorama.getYaw());
      //   // For pitch and yaw of mouse locationF
      // this.onMouseUp(dPanorama);
    },
    selectedScene(i) {
      this.selectedItem = Object.assign({}, i);
      if (this.thePanorama != null) {
        console.log("Item is null");
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
    },
    getScenes() {
      this.loading = true;
      axios
        .get("/item/scenes/by-product/" + this.product)
        .then((response) => {
          this.scenes = Object.assign({}, response.data);
          this.loading = false;
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