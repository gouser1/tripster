<template>
  <div class="App"></div>
</template>

<script>
import MarkerClusterer from "@google/markerclusterer";
import gmapsInit from "../gmaps";

export default {
  name: "App",
  async mounted() {
    try {
      const google = await gmapsInit();
      const geocoder = new google.maps.Geocoder();
      const map = new google.maps.Map(this.$el);

      geocoder.geocode({ address: "Austria" }, (results, status) => {
        mapTypeId: google.maps.MapTypeId.ROADMAP;
        if (status !== "OK" || !results[0]) {
          throw new Error(status);
        }

        map.setCenter(results[0].geometry.location);
        map.fitBounds(results[0].geometry.viewport);
      });
    } catch (error) {
      console.error(error);
    }
    if (navigator.geolocation) {
      //check if geolocation is available
      navigator.geolocation.getCurrentPosition(function(position) {
        console.log(position);
      });
    }
  }
};
</script>

<style>
.App {
  width: 100vw;
  height: 100vh;
}
</style>