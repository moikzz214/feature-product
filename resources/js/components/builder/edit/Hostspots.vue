<template>
  <div>
    <v-btn small class="primary mb-3" @click="createHotspot">Add Hotspot</v-btn>
    <v-dialog v-model="newHotspotDialog" color="white" width="500">
      <v-card class="mr-auto pa-3" max-width="600">
        <v-form ref="form" @submit.prevent="submitNewHotspot" lazy-validation>
          <h3 class="font-weight-light">New Hotspot</h3>
          <v-text-field
            v-model="hotspotTitle"
            v-on:keyup.enter="submitNewHotspot"
            label="Hotspot Title"
            required
          ></v-text-field>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn text color="grey" @click.prevent="newHotspotDialog = false">Cancel</v-btn>
            <v-btn color="primary" @click.prevent="submitNewHotspot">Create</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
    <div v-if="itemHotspots.length == 0" class="pa-3 text-center mt-3">No Hotspot Found</div>
    <v-card v-else class="custom-scroll">
      <v-expansion-panels accordion flat>
        <v-expansion-panel v-for="(hotspot, index) in itemHotspots" :key="index">
          <v-expansion-panel-header class="pa-3" style="min-height:30px;">{{hotspot.title}}</v-expansion-panel-header>
          <v-expansion-panel-content color="grey lighten-5">
            <div class="d-flex justify-end py-2">
              <v-btn small icon color="info" @click="editHotspot(hotspot)">
                <v-icon small>mdi-pencil</v-icon>
              </v-btn>
              <v-btn small icon color="error" @click="deleteHotspot(hotspot)">
                <v-icon small>mdi-trash-can</v-icon>
              </v-btn>
            </div>
            <!-- && hotspotForm == hotspot.id" -->
            <form v-if="editing == true && hotspotData == hotspot.id">
              <v-text-field v-model="title" outlined label="Title" required class="py-0" dense></v-text-field>
              <v-select :items="types" label="Type" outlined required class="py-0" dense></v-select>
              <v-textarea
                v-model="description"
                outlined
                dense
                label="Description"
                class="py-0"
                value
              ></v-textarea>
              <v-text-field
                v-model="ctaLabel"
                outlined
                dense
                label="CTA Label"
                required
                class="py-0"
              ></v-text-field>
              <v-text-field v-model="ctaUrl" outlined dense label="CTA URL" required class="py-0"></v-text-field>
              <v-checkbox
                v-model="ctaNewTab"
                outlined
                dense
                label="Open in new tab?"
                class="py-0 ma-0"
              ></v-checkbox>
              <div class="d-flex">
                <v-text-field
                  v-model="image"
                  outlined
                  dense
                  label="Image URL"
                  required
                  class="py-0 mr-1"
                ></v-text-field>
                <v-btn class="mt-2" small icon @click="openMediaFiles">
                  <v-icon small>mdi-folder-image</v-icon>
                </v-btn>
              </div>
              <div class="d-flex justify-end">
                <v-btn small class="mr-1" text color="grey" @click="editing = false">cancel</v-btn>
                <v-btn small class="primary" @click="updateHotspot(hotspot.id)">update</v-btn>
              </div>
            </form>
            <div v-else>
              <small>Title</small>
              <p class="body-2 grey lighten-3 py-1 px-3">{{hotspot.title}}</p>
              <small>Type</small>
              <p class="body-2 grey lighten-3 py-1 px-3">{{hotspot.hotspot_type}}</p>
              <small>Description</small>
              <p
                class="body-2 grey lighten-3 py-1 px-3"
              >{{JSON.parse(hotspot.content) && JSON.parse(hotspot.content).description ? JSON.parse(hotspot.content).description : 'No description is set'}}</p>
              <small>Image</small>
              <p
                class="body-2 grey lighten-3 py-1 px-3"
              >{{JSON.parse(hotspot.content) && JSON.parse(hotspot.content).image ? JSON.parse(hotspot.content).image : 'No image is set'}}</p>
              <small>CTA</small>
              <p class="body-2 grey lighten-3 py-1 px-3">
                <a
                  v-if="JSON.parse(hotspot.content) && JSON.parse(hotspot.content).ctaUrl"
                  :href="JSON.parse(hotspot.content).ctaUrl"
                  target="_blank"
                >{{JSON.parse(hotspot.content).ctaTitle}}</a>
                <span v-else>No CTA is set</span>
              </p>
              <div>
                <v-btn
                  v-model="setButton.status"
                  small
                  rounded
                  :class="`${setButton.status == true ? 'primary' : 'error'}`"
                  @click="setHotspot(hotspot)"
                :disabled="toDisableHotspot.includes(hotspot.id) ? true : false"
                >set</v-btn>
                <p v-if="setButton.status == false" class="ma-0 red--text caption">{{setButton.msg}}</p>
              </div>
            </div>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-card>
    <media-files :mediaOptions="mediaFilesSettings" @responded="mediaResponse" />
  </div>
</template>

<script>
/**
 * Hotspot Process
 * 1. Select Item/Scene
 * 2. Add Hotpots
 *    a. Multiple Hotspots in 1 Item
 *    b. Save on stop
 * 3. Save Hotspot Settings in current Item
 * repeat
 */
import MediaFiles from "../../MediaFiles";
export default {
  props: {
    product: {
      type: String,
      default: "",
    },
    item: {
      type: Number,
      default: null,
    },
    authUser: {
      type: Object,
      default: null,
    },
  },
  components: {
    MediaFiles,
  },
  data() {
    return {
      disableSet: false,
      toDisableHotspot: [],

      setButton: {
        status: true,
        msg: "",
      },

      // Form
      title: "",
      description: "",
      ctaLabel: "",
      ctaUrl: "",
      ctaNewTab: "",
      image: "",
      types: ["info", "scene"],
      hotspotContent: "",

      editing: false,
      hotspotData: null,

      newHotspotDialog: false,
      hotspotTitle: "",
      itemHotspots: [],

      selectedItem: [],

      // Media Files
      mediaFilesSettings: {
        dialog: true,
        dialogStatus: false,
        user: this.authUser,
        action: "save",
        data: null,
        product: this.product,
        itemType: "panorama",
      },
    };
  },
  watch: {
    item: function (val) {
      this.selectedItem = val;
      // console.log(val)

      // Set Button
      this.setButton.status = true;
      // console.log(this.selectedItem.id);
    },
  },
  methods: {
    createHotspot() {
      this.newHotspotDialog = true;
    },
    submitNewHotspot() {
      let data = {
        title: this.hotspotTitle,
        product_id: this.product,
      };
      axios
        .post("/hotspot/new", data)
        .then((response) => {
          // console.log(response);
          this.newHotspotDialog = false;
          this.getAllHotspots();
        })
        .catch((error) => {
          console.log("Error fetching items");
          console.log(error);
        });
    },
    mediaResponse(v) {
      // console.log(v);
    },
    openMediaFiles() {
      this.mediaFilesSettings.dialogStatus = !this.mediaFilesSettings
        .dialogStatus;
    },
    updateHotspot(hotspotID) {
      axios
        .post("/hotspot/update/"+ hotspotID, {
          id: hotspotID,
          title: this.title,
          hotspot_type: "info",
          product_id: 1,
          content: JSON.stringify(this.hotspotContent),
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log("Error updating hotspot");
          console.log(error);
        });
    },
    editHotspot(h) {
      // Toggle form
      this.editing = !this.editing;
      this.hotspotData = h.id;
      // Setup Form Data
      let theContent = h.content !== null ? JSON.parse(h.content) : null;
      this.title = h.title ? h.title : "Title is not set";
      this.description =
        theContent !== null && theContent.description !== null
          ? theContent.description
          : "";
      this.ctaLabel =
        theContent !== null && theContent.ctaLabel !== undefined
          ? theContent.ctaLabel
          : "";
      this.ctaUrl =
        theContent !== null && theContent.ctaUrl !== undefined
          ? theContent.ctaUrl
          : "";
      this.ctaNewTab =
        theContent !== null && theContent.ctaNewTab !== undefined
          ? theContent.ctaNewTab
          : "";
      this.image =
        theContent !== null && theContent.image !== undefined
          ? theContent.image
          : "";
      this.hotspotContent = {
        description: this.description,
        cta_label: this.ctaLabel,
        cta_url: this.ctaUrl,
        cta_new_tab: this.ctaNewTab,
        image: this.image,
      };
    },
    deleteHotspot() {
      console.log("delete");
    },
    setHotspot(h) {
      let hotspotToEmit = {
        hotspotObjectToEmit: h,
        itemIdToEmit: this.selectedItem,
      };
      console.log(this.selectedItem);
      if (this.selectedItem.length != 0) {
        this.$emit("emitHotspot", hotspotToEmit);
        this.toDisableHotspot.push(h.id);
      } else {
        this.setButton.status = false;
        this.setButton.msg = "Please select an item first";
      }
    },
    getAllHotspots() {
      axios
        .get("/hotspot/by-product/" + this.product)
        .then((response) => {
          this.itemHotspots = response.data;
        })
        .catch((error) => {
          console.log("Error fetching items");
          console.log(error);
        });
    },
  },
  created() {
    this.getAllHotspots();
  },
};
</script>
<style lang="scss" scoped>
.custom-scroll {
  overflow-y: scroll;
  max-height: 550px;
}
.custom-scroll::-webkit-scrollbar {
  width: 10px;
}
.custom-scroll::-webkit-scrollbar-track {
  background-color: #f9f9f9;
}
.custom-scroll::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.15);
  box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.15);
}
</style>
