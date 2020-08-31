<template>
  <div>
    <v-dialog v-if="dialog == true" v-model="mediaDialog" scrollable persistent max-width="80%">
      <v-card :loading="mediaLoading" style="min-height:500px;">
        <v-card-title class="overline px-3 py-0">Media Files</v-card-title>
        <v-divider></v-divider>
        <v-card-title class="overline px-3">
          <v-btn text @click="uploadTab">Upload</v-btn>
          <v-btn text @click="mediaTab">Media Files</v-btn>
        </v-card-title>
        <!-- style="min-height:500px" -->
        <v-card-text v-show="tabItem == 'upload'">
          <p>This is upload tab</p>
        </v-card-text>
        <!-- style="min-height:450px" -->
        <v-card-text v-show="tabItem == 'mediafiles'">
          <v-row class="px-2">
            <v-col v-for="file in files" :key="file.id" cols="2">
              <v-card @click="selectedFile(file.id)">
                <v-img
                  :src="baseUrl+'/storage/uploads/user-'+userId+'/'+file.path"
                  max-height="200"
                  contain
                  class="grey darken-4"
                ></v-img>
              </v-card>
              <div class="overline">{{file.title}}</div>
            </v-col>
          </v-row>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="grey" text @click="closeMediaDialog">Cancel</v-btn>
          <v-btn color="primary" text @click="0">Select</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  props: {
    open: {
      type: Boolean,
      default: false,
    },
    dialog: {
      type: Boolean,
      default: false,
    },
    user: {
      type: Object,
      default: null,
    },
  },
  watch: {
    open: function (val) {
      this.mediaDialog = val;
    },
  },
  data() {
    return {
      tabItem: "upload",
      userId: this.user.id,
      files: [],
      baseUrl: window.location.origin,
      mediaDialog: false,
      mediaLoading: false,
      tab: null,
    };
  },
  methods: {
    mediaTab() {
      this.tabItem = "mediafiles";
      this.getUserFiles();
    },
    uploadTab() {
      this.tabItem = "upload";
    },
    selectedFile(id) {
      console.log(id);
    },
    closeMediaDialog() {
      this.mediaDialog = false;
      this.$emit("close", false);
    },
    getUserFiles() {
      if (this.files.length == 0) {
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
    // console.log(this.dialog);
  },
};
</script>