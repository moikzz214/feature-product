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
                  @click="selected(index)"
                  :aspect-ratio="16/9"
                  class="white--text align-end"
                  :src="baseUrl+'/storage/uploads/user-1/'+item.user_file.path"
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
    </div>
    <v-dialog v-model="actionDialog" max-width="300">
      <v-card>
        <v-card-title class="subtitle-1">Are you sure you want to delete?</v-card-title>
        <v-card-text>Deleting this item will delete the file and hotspot information.</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="actionDialog = false">Cancel</v-btn>
          <v-btn color="red" text @click="actionDialog = false">Delete</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
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
      dialogItem: null,
      actionDialog: false,
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
          // console.log(data.frame);
        },
      },
    };
  },
  methods: {
    editItem(item) {
      this.actionDialog = true;
      this.dialogItem = Object.assign({}, item);
      console.log(this.dialogItem);
    },
    deleteItem(item) {
      this.actionDialog = true;
      this.dialogItem = Object.assign({}, item);
      console.log(this.dialogItem.user_file.path);
    },
    selected(index) {
      this.$refs.spritespin.api.updateFrame(index);
    },
    getImagesByProduct() {
      axios
        .get("/items/by-product/" + this.product)
        .then((response) => {
          console.log(response.data.items);
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
