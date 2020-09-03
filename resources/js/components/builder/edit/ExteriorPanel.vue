<template>
  <div>
    <div>
      <div style="min-height:450px;">
        <upload-zone v-if="uploader == true" :add-items="true" @uploaded="getImagesByProduct"></upload-zone>
        <spritespin
          v-bind:options="options"
          v-if="show && uploader == false"
          ref="spritespin"
          style="margin:0 auto;"
        />
      </div>
      <div class="d-flex" v-if="withItems == true">
        <v-card class="mt-3" style="width:90%;">
          <v-slide-group v-model="model" class="pa-1" active-class="grey" show-arrows>
            <v-slide-item
              v-for="(item, index) in items"
              :key="index"
              v-slot:default="{ active, toggle }"
            >
              <v-card class="ma-1 elevation-0">
                <v-card
                  :color="active ? undefined : 'white'"
                  class="ma-1"
                  height="auto"
                  width="100"
                  @click="toggle"
                >
                  <v-img
                    @click="selected(index, item)"
                    :aspect-ratio="16/9"
                    class="white--text align-end"
                    :src="baseUrl+'/storage/uploads/user-1/'+item.media_file.path"
                    style="border:0;opacity:.75;"
                  >
                    <v-card-text>{{index+1}}</v-card-text>
                  </v-img>
                </v-card>
                <div class="d-flex justify-center py-1">
                  <v-btn x-small icon @click="editItem(item)">
                    <v-icon x-small color="primary">mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn x-small icon @click="deleteItem(item)">
                    <v-icon x-small color="red">mdi-trash-can-outline</v-icon>
                  </v-btn>
                </div>
              </v-card>
            </v-slide-item>
          </v-slide-group>
        </v-card>
        <v-card
          dark
          :class="`mt-3 ml-2 d-flex align-center justify-center ${uploader == false ? 'primary' : 'error'}`"
          active-class="red"
          style="width:10%"
          @click="uploader = !uploader"
        >
          <v-icon>{{uploader == false ? 'mdi-image-plus' : 'mdi-image-remove'}}</v-icon>
        </v-card>
      </div>
    </div>
    <v-dialog v-model="actionDialog" max-width="300">
      <v-card :loading="dialogLoading">
        <v-card-title
          class="subtitle-1"
        >Are you sure you want to delete {{dialogItem && dialogItem.media_file.path}}?</v-card-title>
        <v-card-text>Deleting this item will delete the file and hotspot information.</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn :disabled="dialogLoading" color="primary" text @click="actionDialog = false">Cancel</v-btn>
          <v-btn
            :disabled="dialogLoading"
            color="red"
            text
            @click="confirmDelete(dialogItem.id)"
          >Delete</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <media-files :mediaOptions="mediaFilesSettings" @responded="mediaResponse"></media-files>
  </div>
</template>

<script>
import MediaFiles from "../../MediaFiles";
import UploadZone from "../../UploadZone";
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
    UploadZone,
  },
  data() {
    return {
      // MediaFiles
      mediaFilesSettings: {
        dialog: true,
        dialogStatus: false,
        user: this.authUser,
        action: "replace",
        data: null,
      },

      dialogLoading: false,
      dialogItem: null,
      actionDialog: false,
      withItems: false,
      model: null,
      items: [],
      baseUrl: window.location.origin,

      // 360
      uploader: true,
      show: false,
      options: {
        source: [],
        animate: false,
        // responsive: true,
        // width: 1920,
        // height: 1080,
        width: 800,
        height: 450,
        frames: 0,
        framesX: 6,
        plugins: ["drag", "360", "zoom"],
        sense: -1,
        onFrame: function (e, data) {
          // console.log(data.frame);
        },
      },
    };
  },
  methods: {
    mediaResponse(res) {
      // console.log(res.status);
      if (res.status == "error") {
        return;
      }
      this.mediaFilesSettings.dialogStatus = false;
      this.getImagesByProduct();
    },
    editItem(item) {
      // Toggle Dialog
      this.mediaFilesSettings.dialogStatus = !this.mediaFilesSettings
        .dialogStatus;
      this.mediaFilesSettings.data = item;
    },
    deleteItem(item) {
      this.actionDialog = true;
      this.dialogItem = Object.assign({}, item);
    },
    confirmDelete(item) {
      this.dialogLoading = true;
      axios
        .post("/item/delete/" + item)
        .then((response) => {
          this.dialogLoading = false;
          this.actionDialog = false;
          this.getImagesByProduct();
        })
        .catch((error) => {
          this.dialogLoading = false;
          this.actionDialog = false;
          console.log("Error Deleting Items");
          console.log(error);
        });
    },
    selected(index, id = null) {
      this.$refs.spritespin.api.updateFrame(index);
      this.$emit("selectedItem", id);
    },
    getImagesByProduct() {
      this.show = false;
      axios
        .get("/items/by-product/" + this.product)
        .then((response) => {
          console.log(response.data.items);
          // If no items found
          if (response.data.items.length == 0) {
            this.withItems = false;
            this.uploader = true;
            return;
          }

          this.withItems = true;
          this.uploader = false;
          this.items = response.data.items;

          // Setup 360
          this.options.frames = response.data.items.length;
          this.options.source = response.data.items.map(
            (item) =>
              window.location.origin +
              "/storage/uploads/user-" +
              this.authUser.id +
              "/" +
              item.media_file.path
          );

          // console.log(this.items);
          setTimeout(() => {
            this.show = true;
            console.log("show: " + this.show);
          }, 1);
        })
        .catch((error) => {
          console.log("Error fetching items");
          console.log(error);
        });
    },
  },
  created() {
    // console.log(this.mediaFilesSettings.dialogStatus);
    this.getImagesByProduct();
  },
};
</script>
