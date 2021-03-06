<template>
  <div>
    <v-dialog
      v-if="mediaOptions.dialog == true"
      v-model="mediaDialog"
      scrollable
      persistent
      max-width="80%"
    >
      <v-card :loading="mediaLoading" style="min-height:450px;">
        <v-card-title class="overline px-3 py-0">
          Media Files
          <v-spacer></v-spacer>
          <v-icon color="red" @click="closeMediaDialog">mdi-close</v-icon>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-title class="overline px-3">
          <v-btn
            class="mr-3"
            :class="`${tabItem == 'upload' ? 'primary' : ''}`"
            depressed
            @click="uploadTab"
          >
            Upload
            <v-icon small right>mdi-cloud-upload</v-icon>
          </v-btn>
          <v-btn :class="`${tabItem == 'mediafiles' ? 'primary' : ''}`" depressed @click="mediaTab">
            Media Files
            <v-icon small right>mdi-panorama</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text class="blue-grey lighten-5 pt-3" v-show="tabItem == 'upload'">
          <upload-zone :add-items="false" @uploaded="uploadZoneResponse" />
        </v-card-text>
        <v-card-text class="blue-grey lighten-5 pt-3" v-show="tabItem == 'mediafiles'">
          <v-row class="px-2">
            <v-col v-for="file in files" :key="file.id" cols="2" class="pa-2">
              <v-card
                @click="selectFile(file)"
                :class="`pa-1 elevation-0 ${selected.includes(file.id) == true || selected.includes(file.path) == true ? 'primary dark' : 'transparent'}`"
              >
                <v-img
                  :src="baseUrl+'/storage/uploads/user-'+userId+'/'+file.path"
                  max-height="200"
                  contain
                  class="grey darken-4"
                >
                  <v-icon
                    v-if="selected.includes(file.id) == true"
                    class="primary"
                    dark
                    small
                  >mdi-check</v-icon>
                </v-img>
              </v-card>
              <div
                class="caption"
              >{{file.title.substring(0, 20)}}{{file.title.length > 20 ? '...': ''}}</div>
            </v-col>
          </v-row>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions v-if="tabItem == 'mediafiles'">
          <v-spacer></v-spacer>
          <v-btn color="grey" text @click="closeMediaDialog">Cancel</v-btn>
          <v-btn color="primary" text @click="submitSelected()">Select</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import UploadZone from "./UploadZone";
export default {
  props: {
    mediaOptions: {
      type: Object,
      default: null,
    },
  },
  components: {
    UploadZone,
  },
  watch: {
    mediaOptions: {
      handler(val) {
        this.mediaDialog = val.dialogStatus;
      },
      deep: true,
    },
  },
  data() {
    return {
      tabItem: "upload",
      userId: this.mediaOptions.user.id,
      files: [],
      baseUrl: window.location.origin,
      mediaDialog: false,
      mediaLoading: false,
      tab: null,

      return_url: this.mediaOptions.returnUrl
        ? this.mediaOptions.returnUrl
        : false,

      submitAction: this.mediaOptions.action
        ? this.mediaOptions.action
        : "save",
      // Selected File
      multiple: this.mediaOptions.multiple ? this.mediaOptions.multiple : false,
      selected: [],
    };
  },
  methods: {
    uploadZoneResponse() {
      this.selected = [];
      this.tabItem = "mediafiles";
      this.getUserFiles();
    },
    mediaTab() {
      this.tabItem = "mediafiles";
      this.getUserFiles();
    },
    uploadTab() {
      this.tabItem = "upload";
    },
    selectFile(file) {
      // console.log(file)
      let i = file.id;

      if (this.multiple == false) {
        if (this.selected.length < 1) {
          // If Return URL used in hotspot images
          if (this.return_url == true) {
            this.selected.push(file.path);
          } else {
            this.selected.push(i);
          }
        } else {
          let index = this.selected.indexOf(i);
          if (index > -1) {
            this.selected.pop(i);
          }
        }
      } else {
        if (this.selected.includes(i)) {
          // if already exist pop out
          let index = this.selected.indexOf(i);
          if (index > -1) {
            this.selected.splice(index, 1);
          }
        } else {
          // otherwise push
          this.selected.push(i);
        }
      }
    },
    submitSelected() {
      // Save to Item Table

      // If only needs to return the url of the selected image
      if (this.return_url == true) {
        let toReturlUrl =
          this.baseUrl +
          "/storage/uploads/user-" +
          this.userId +
          "/" +
          this.selected[0];
        this.$emit("responded", toReturlUrl);
        this.selected = [];
      } else {
        // Replace Item 360 Image
        let data = {
          selected: this.selected,
          item: this.mediaOptions.data ? this.mediaOptions.data.id : null,
          item_type: this.mediaOptions.itemType
            ? this.mediaOptions.itemType
            : null,
          action: this.submitAction,
          product: this.mediaOptions.product ? this.mediaOptions.product : null,
        };
        axios
          .post("/item/save/" + JSON.stringify(data))
          .then((response) => {
            // console.log(response.data);
            if (response.data.status == "success") {
              this.$emit("responded", response.data);
              this.selected = [];
            }
          })
          .catch((error) => {
            this.selected = [];
            console.log("Error Fetching Files");
            console.log(error);
          });
      }
    },
    closeMediaDialog() {
      this.mediaDialog = false;
      this.$emit("responded", false);
    },
    getUserFiles() {
      if (this.selected.length == 0) {
        axios
          .get("/user/files/" + this.userId)
          .then((response) => {
            console.log("requested");
            this.files = Object.assign({}, response.data.data);
          })
          .catch((error) => {
            console.log("Error Fetching Files");
            console.log(error);
          });
      }
    },
  },
  mounted() {
    // console.log(this.mediaOptions);
  },
};
</script>
