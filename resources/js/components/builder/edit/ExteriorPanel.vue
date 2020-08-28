<template>
  <div>
    <div v-if="withItems == false">
      <v-card class="mr-auto d-flex justify-center align-center">
        <upload-form @uploaded="getImagesByProduct"></upload-form>
      </v-card>
    </div>
    <div v-else>
      <!-- <v-card class="mr-auto d-flex justify-center align-center" style="border-radius:0;">
        <div
          style="background-color:#eee;"
      >-->
      <spritespin v-bind:options="options" v-if="show" ref="spritespin" style="margin:0 auto;" />
      <!-- </div>
      </v-card>-->
    </div>
  </div>
</template>

<script>
import UploadForm from "./UplooadForm";
export default {
  props: ["product"],
  components: {
    UploadForm,
  },
  data() {
    return {
      withItems: false,
      model: null,
      items: [],
      baseUrl: window.location.origin,

      // 360
      show: true,
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
        // plugins: ["drag", "360", "zoom"],
        // sense: -1,
      },
    };
  },
  methods: {
    getImagesByProduct() {
      axios
        .get("/items/by-product/" + this.product)
        .then((response) => {
          // If no items found
          if (response.data.items.length == 0) {
            this.withItems = false;
            return;
          }

          // Emit Items
          this.$emit("loadedItems", response.data.items);
          this.withItems = true;

          // Setup 360
          this.options.frames = response.data.items.length;
          this.options.source = this.items.map(function (item, index) {
            return (
              window.location.origin +
              "/storage/uploads/user-1/" +
              item.user_file.path
            );
          });
          setTimeout(() => {
            $(this.$el).spritespin(this.options);
          }, 300);
          console.log(this.options);
        })
        .catch((error) => {
          console.log("Error fetching items");
          console.log(error);
        });
    },
  },
  mounted() {
    this.getImagesByProduct();
  },
};
</script>
