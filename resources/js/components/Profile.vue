<style>
.widget-user-header {
  background-position: center center;
  background-size: cover;
  height: 250px !important;
}
.widget-user .card-footer {
  padding: 0;
}
</style>






<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 mt-3">
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div
            class="widget-user-header text-white"
            style="background-image:url('./img/user-cover.jpg')"
          >
            <h3 class="widget-user-username"></h3>
            <h5 class="widget-user-desc"></h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header"></h5>
                  <span class="description-text"></span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header"></h5>
                  <span class="description-text"></span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header"></h5>
                  <span class="description-text"></span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
      </div>

      <div class="col-md-12 mt-3">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link active show" href="#activity" data-toggle="tab">Activity</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
              </li>
            </ul>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active show" id="activity"></div>

              <!-- /.tab-pane -->
              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-12 control-label">Name</label>

                    <div class="col-sm-12">
                      <input
                        type="text"
                        v-model="form.name"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('name') }"
                        id="inputName"
                        placeholder="Name"
                      >
                      <has-error :form="form" field="name"></has-error>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-12 control-label">Email</label>

                    <div class="col-sm-12">
                      <input
                        type="email"
                        v-model="form.email"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('email') }"
                        id="inputEmail"
                        placeholder="Email"
                      >
                      <has-error :form="form" field="email"></has-error>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="bio" class="col-sm-12 control-label">About</label>

                    <div class="col-sm-12">
                      <textarea
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('bio') }"
                        v-model="form.bio"
                        id="inputExperience"
                        placeholder="Short user bio here(optional)"
                      ></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="photo" class="col-sm-12 control-label">Profile Photo</label>
                    <div class="col-sm-12">
                      <input type="file" @change="updateProfile" name="photo" class="form-input">
                    </div>
                  </div>

                  <div class="form-group">
                    <label
                      for="password"
                      class="col-sm-12 control-label"
                    >Password(leave empty if not changing)</label>
                    <div class="col-sm-12">
                      <input
                        type="password"
                        v-model="form.password"
                        id="password"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('password') }"
                      >
                      <has-error :form="form" field="password"></has-error>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-12">
                      <button
                        @click.prevent="updateInfo"
                        type="submit"
                        class="btn btn-success"
                      >Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
    </div>
  </div>
</template>



<script>
export default {
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        password: "",
        type: "",
        bio: "",
        photo: ""
      })
    };
  },
  mounted() {
    console.log("Component mounted.");
  },

  methods: {
    getProfilePhoto() {
      //default avatar pic if there is no photo of user
      let photo = "img/profile";
      //returns the current path of the
      if (this.form.photo) {
        if (this.form.photo.indexOf("base64") != -1) {
          photo = this.form.photo;
        } else {
          photo = "img/profile/" + this.form.photo;
        }
        return photo;
      }
      return photo;
    },

    updateInfo() {
      this.$Progress.start();
      this.form
        .put("api/profile")
        .then(() => {
          Fire.$emit("AfterCreate");
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    updateProfile(e) {
      let file = e.target.files[0];
      //console.log(file);
      let reader = new FileReader();
      if (file["size"] < 2111775) {
        reader.onloadend = file => {
          //console.log("RESULT", reader.result);
          this.form.photo = reader.result;
        };

        reader.readAsDataURL(file);
      } else {
        Swal.fire({
          type: "error",
          title: "Oops...",
          text: "You are uploading a large file",
          footer: "Maximum file size is 2mb"
        });
      }
    }
  },

  created() {
    axios.get("api/profile").then(({ data }) => this.form.fill(data));
  }
};
</script>
