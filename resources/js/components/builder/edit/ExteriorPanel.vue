<template>
  <div>
    <div v-if="withItems == false">
      <v-card class="mr-auto d-flex justify-center align-center">
        <upload-form @uploaded="getImagesByProduct"></upload-form>
      </v-card>
    </div>
    <div v-else>
      <spritespin v-bind:options="options" v-if="show" ref="spritespin" style="margin:0 auto;" />
      <v-card class="mt-3">
        <v-slide-group v-model="model" class="pa-1" active-class="red" show-arrows>
          <v-slide-item
            v-for="(item, index) in items"
            :key="index"
            v-slot:default="{ active, toggle }"
          >
            <v-card
              :color="active ? undefined : 'grey'"
              class="ma-1"
              height="auto"
              width="75"
              @click="toggle"
            >
              <v-img
                @click="selected(index)"
                :aspect-ratio="16/9"
                class="white--text align-end"
                :src="baseUrl+'/storage/uploads/user-1/'+item.user_file.path"
                style="border:0;opacity:.75;"
              >
                <v-card-text>{{index+1}}</v-card-text>
              </v-img>
            </v-card>
          </v-slide-item>
        </v-slide-group>
      </v-card>
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
          console.log(data.frame);
        },
      },
    };
  },
  methods: {
    selected(index) {
      this.$refs.spritespin.api.updateFrame(index);
    },
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
          //   this.$emit("loadedItems", response.data.items);
          this.withItems = true;
          this.items = response.data.items;

          // Setup 360
          this.options.frames = response.data.items.length;
          //   this.items.map(function (item, index) {
          //     this.options.source.push(
          //       window.location.origin +
          //         "/storage/uploads/user-1/" +
          //         item.user_file.path
          //     );
          //   });
          this.options.source = response.data.items.map(
            (item) =>
              window.location.origin +
              "/storage/uploads/user-1/" +
              item.user_file.path
          );
          setTimeout(() => {
            // $(this.$el).spritespin(this.options);
            this.show = true;
          }, 1);
          //   console.log(this.options);
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
