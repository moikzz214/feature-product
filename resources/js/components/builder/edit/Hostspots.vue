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
    <v-expansion-panels v-else accordion>
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
          <div v-if="editing == false && (hotspotForm == null || hotspotForm == hotspot.id)">
            <small>Title</small>
            <p class="subtitle-2 grey lighten-3 py-1 px-3">{{hotspot.title}}</p>
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
            <div class="d-flex justify-end">
              <v-btn small rounded class="primary" @click="setHotspot(hotspot)">set</v-btn>
            </div>
          </div>
          <form v-else-if="hotspotForm == hotspot.id">
            <v-text-field v-model="title" outlined label="Title" required class="py-0" dense></v-text-field>
            <v-select :items="types" label="Type" outlined required class="py-0" dense></v-select>
            <v-textarea v-model="description" outlined dense label="Description" class="py-0" value></v-textarea>
            <v-text-field v-model="ctaLabel" outlined dense label="CTA Label" required class="py-0"></v-text-field>
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
              <v-btn small class="primary" @click="saveHotspot">update</v-btn>
            </div>
          </form>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
    <media-files :mediaOptions="mediaFilesSettings" @responded="mediaResponse" />
  </div>
</template>

<script>
import MediaFiles from "../../MediaFiles";
export default {
  props: {
    product: {
      type: String,
      default: "",
    },
    item: {
      type: Object,
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
      editing: false,
      // Form
      title: "",
      description: "",
      ctaLabel: "",
      ctaUrl: "",
      ctaNewTab: "",
      image: "",
      types: ["info", "scene"],

      newHotspotDialog: false,
      hotspotTitle: "",
      itemHotspots: [],
      hotspotForm: null,

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
      this.itemHotspots = val.hotspots;
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
      console.log(data);
      axios
        .post("/hotspot/new", data)
        .then((response) => {
          console.log(response);
          this.newHotspotDialog = false;
          this.getAllHotspots();
        })
        .catch((error) => {
          console.log("Error fetching items");
          console.log(error);
        });
    },
    mediaResponse(v) {
      console.log(v);
    },
    openMediaFiles() {
      this.mediaFilesSettings.dialogStatus = !this.mediaFilesSettings
        .dialogStatus;
    },
    saveHotspot() {
      console.log("save");
    },
    editHotspot(h) {
      this.editing = !this.editing;
      this.hotspotForm = h.id;
      console.log(this.editing);
    },
    deleteHotspot() {
      console.log("delete");
    },
    setHotspot() {},
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
    console.log(this.editing);
  },
};
</script>

<style>
</style>
