<template>
  <v-card class="mr-auto pa-3" max-width="600">
    <v-form ref="form" @submit.prevent="saveProduct" v-model="valid" lazy-validation>
      <h3 class="font-weight-light">New Product</h3>
      <v-text-field
        v-model="title"
        :rules="titleRules"
        v-on:keyup.enter="saveProduct"
        label="Product Title"
        required
      ></v-text-field>
      <v-btn
        :disabled="!valid"
        color="primary"
        small
        class="mr-4"
        @click.prevent="saveProduct"
      >Create</v-btn>
    </v-form>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      valid: true,
      title: "",
      titleRules: [(v) => !!v || "Name is required"],
    };
  },
  methods: {
    saveProduct() {
      this.valid = false;
      let data = {
        title: this.title,
        slug: slugify(this.title),
      };
      console.log(data);
      axios
        .post("/builder/product/store", data)
        .then((response) => {
        //   console.log(response.data.product);
          this.valid = true;
          this.$router.push("/builder/product/edit/" + response.data.product);
        })
        .catch((error) => {
          console.log("invalid");
          console.log(error.response);
          //   if (error.response.status == 403) {
          //     this.errorUI(error);
          //   }
          //   if (error.response && error.response.status == 422) {
          //     this.errors.setErrors(error.response.data.errors);
          //     this.errorUI("Unprocessable Entity");
          //     // Input error messages
          //     if (this.errors.hasError("slug")) {
          //       this.slugError = true;
          //       this.slugErrMsg = this.errors.first("slug");
          //     }
          //     if (this.errors.hasError("position")) {
          //       this.positionError = true;
          //       this.positionErrMsg = this.errors.first("position");
          //     }
          //   }
        });
    },
  },
};
</script>
