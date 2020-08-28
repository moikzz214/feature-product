<template>
  <div>
    <div v-if="withItems == false">
      <v-card class="mr-auto d-flex justify-center align-center">
        <upload-form @uploaded="getImagesByProduct"></upload-form>
      </v-card>
    </div>
    <div v-else>
      <v-card class="mr-auto d-flex justify-center align-center">
        <div
          style="width:800px; height:450px; margin:0 auto; background-color:#eee;border-radius:0;"
        >
          <spritespin v-bind:options="options" v-if="show" ref="spritespin" />
        </div>
      </v-card>
      <v-sheet elevation="0" class="mt-3 w-100" color="grey lighten-4">
        <v-slide-group v-model="model" class="pa-1" active-class="success" show-arrows>
          <v-slide-item v-for="item in items" :key="item.id" v-slot:default="{ active, toggle }">
            <v-card
              :color="active ? undefined : 'grey lighten-1'"
              class="ma-1"
              height="75"
              width="75"
              @click="toggle"
            >
              <v-img
                :aspect-ratio="16/9"
                class="white--text align-end"
                :src="baseUrl+'/storage/uploads/user-1/'+item.user_file.path"
              >
                <v-card-text>{{item.product}}</v-card-text>
              </v-img>
            </v-card>
          </v-slide-item>
        </v-slide-group>
      </v-sheet>
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
        width: 1366,
        height: 650,
        frames: 0,
        framesX: 6,
        // sense: -1,
      },
    };
  },
  methods: {
    getImagesByProduct() {
      axios
        .get("/items/by-product/" + this.product)
        .then((response) => {
          this.withItems = true;
          this.items = response.data.items;

          // Setup 360
          this.options.frames = response.data.items.length;
          this.options.source = this.items.map(function (item, index) {
            return (
              window.location.origin +
              "/storage/uploads/user-1/" +
              item.user_file.path
            );
          });
        })
        .catch((error) => {
          this.withItems = false;
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
