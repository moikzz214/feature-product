<template>
  <div>
    <v-dialog v-if="dialog == true" v-model="mediaDialog" persistent max-width="800">
      <v-card :loading="mediaLoading">
        <div class="overline px-3">Media Files</div>
        <v-divider></v-divider>
        <div style="min-height:450px;">
          <v-tabs v-model="tab" background-color="transparent">
            <v-tab>Upload</v-tab>
            <v-tab>Media Files</v-tab>

            <v-tab-item>
              <v-card color="basil" flat>
                <v-card-text>This is upload</v-card-text>
              </v-card>
            </v-tab-item>
            <v-tab-item>
              <v-card color="basil" flat>
                <v-card-text>This is media files</v-card-text>
              </v-card>
            </v-tab-item>
          </v-tabs>
        </div>
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
  },
  watch: {
    open: function (val) {
      this.mediaDialog = val;
    },
  },
  data() {
    return {
      mediaDialog: false,
      mediaLoading: false,
      tab: null,
    };
  },
  methods: {
    closeMediaDialog() {
      this.mediaDialog = false;
      this.$emit("close", false);
    },
  },
  mounted() {
    // console.log(this.dialog);
  },
};
</script>