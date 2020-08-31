<template>
  <v-dialog v-model="mediaDialog" max-width="300">
    <v-card :loading="mediaLoading">
      <v-card-title class="subtitle-1">Are you sure you want to delete?</v-card-title>
      <v-card-text>Deleting this item will delete the file and hotspot information.</v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <!-- <v-btn :disabled="dialogLoading" color="primary" text @click="actionDialog = false">Cancel</v-btn>
          <v-btn
            :disabled="dialogLoading"
            color="red"
            text
            @click="confirmDelete(dialogItem.id)"
        >Delete</v-btn>-->
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["openMediaFiles"],
  watch: {
    openMediaFiles: function (val) {
      console.log(val);
    },
  },
  data() {
    return {
      mediaDialog: false,
      mediaLoading: false,
    };
  },
  mounted() {},
};
</script>