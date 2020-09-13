<template>
  <div class="row">
    <div class="col-12">
      <v-btn @click="videoDialog = true" class="primary mb-3">New Video</v-btn>
      <v-data-table :headers="headers" :items="desserts" hide-default-footer class="elevation-1">
        <!-- <template v-slot:[`item.title`]="{ item }"> -->
        <template v-slot:[`item.title`]="{ item }">
          <v-icon
            small
            title="Edit Hotspot"
            color="primary"
            class="mr-2"
            @click="editVideo(item)"
          >mdi-pencil</v-icon>
          <v-icon small title="Delete Hotspot" @click="deleteVideo(item)">mdi-trash-can</v-icon>
        </template>
      </v-data-table>
    </div>
    <v-dialog v-model="editDialog" max-width="600px">
      <v-card>
        <v-card-title>
          <h4 class="pb-2">Manage Hotspot</h4>
        </v-card-title>
        <v-card-text>
          <form>
            <v-text-field v-model="title" outlined label="Title" required class="py-0" dense></v-text-field>
            <div class="d-flex">
              <v-text-field
                v-model="videoPath"
                outlined
                dense
                label="Video URL"
                required
                class="py-0 mr-1"
              ></v-text-field>
              <v-btn class="mt-2" small icon @click="openMediaFiles">
                <v-icon small>mdi-folder-image</v-icon>
              </v-btn>
            </div>
            <div class="d-flex justify-end">
              <v-btn class="mr-1" text color="grey" @click="editDialog = false">cancel</v-btn>
              <v-btn class="primary" @click="updateHotspot()">update</v-btn>
            </div>
          </form>
        </v-card-text>
      </v-card>
    </v-dialog>
    <!-- <v-card-title class="subtitle-1">Confirm delete</v-card-title> -->
    <!-- <v-card-text>
          Are you sure you want to delete
          <strong class="black--text">{{title ? title : 'this hotspot'}}</strong>?
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="grey" text @click="deleteDialog = false">cancel</v-btn>
          <v-btn color="primary" text @click="confirmDelete">Confirm</v-btn>
    </v-card-actions>-->
     <media-files :mediaOptions="mediaFilesSettings" @responded="mediaResponse" />
  </div>
</template>

<script>
export default {
    props:{
        product: {
            type: String,
            default: "",
        },
        authUser: {
            type: Object,
            default: null,
        },
    },
  data() {
    return {
      dialogVideo: [],
      editDialog: false,
      title: "",
      videoPath: "",

        // Media Files
        mediaFilesSettings: {
            dialog: true,
            dialogStatus: false,
            user: this.authUser,
            action: "save",
            data: null,
            product: this.product,
            itemType: "video",
            returnUrl: true,
        },


      headers: [
        {
          text: "Videos",
          align: "start",
          value: "title",
          sortable: false,
        },
        { text: "Actions", align: "end", value: "actions", sortable: false },
      ],
      desserts: [
        {
          title: "Frozen Yogurt",
        },
        {
          title: "Ice cream sandwich",
        },
        {
          title: "Eclair",
        },
        {
          title: "Cupcake",
        },
        {
          title: "Gingerbread",
        },
        {
          title: "Jelly bean",
        },
        {
          title: "Lollipop",
        },
      ],
    };
  },
  methods: {
    mediaResponse(v) {
      console.log(v);
      this.mediaFilesSettings.dialogStatus = !this.mediaFilesSettings
        .dialogStatus;
    },
    openMediaFiles() {
      this.mediaFilesSettings.dialogStatus = !this.mediaFilesSettings
        .dialogStatus;
    },
    editVideo(v) {
      this.videoPath = "hey";
      this.title = "hey";
      this.editDialog = true;
      console.log(v);
    },
  },
};
</script>
