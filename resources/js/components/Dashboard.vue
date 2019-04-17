<template>
  <div class="App">
    <h1>SO FAST</h1>
  </div>
</template>

<script>
import gmapsInit from "../gmaps";

export default {
  name: "App",
  async mounted() {
    try {
      const google = await gmapsInit();
      const geocoder = new google.maps.Geocoder();
      const map = new google.maps.Map(this.$el);

      geocoder.geocode({ address: "Austria" }, (results, status) => {
        if (status !== "OK" || !results[0]) {
          throw new Error(status);
        }

        map.setCenter(results[0].geometry.location);
        map.fitBounds(results[0].geometry.viewport);
      });
    } catch (error) {
      console.error(error);
    }
  }
};
</script>





<style scoped>
h1 {
  color: purple;
}

#map {
  height: 100%;
}

.App {
  width: 100vw;
  height: 100vh;
}
</style>
