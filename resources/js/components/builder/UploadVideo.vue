<template>
  <v-row>
    <v-col cols="6" class="mx-auto">
      <v-file-input v-model="video" ref="video" show-size label="Upload a video"></v-file-input>
      <v-btn :loading="loading" color="primary" @click="uploadVideo">Upload</v-btn>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      video: null,
    };
  },
  methods: {
    uploadVideo() {
      this.loading = true;
      console.log(this.video);
      let data = new FormData();
      data.append("video", this.video);
      data.append("title", this.video.name);
      data.append("description", this.video.name);
      axios
        .post("/video/store", data, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.loading = false;
          console.log(response);
        })
        .catch((error) => {
          this.loading = false;
          console.log(error.response);
        });
    },
  },
};
</script>