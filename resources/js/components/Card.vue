<template>
  <div id="yandex-map"></div>
</template>
<script>

export default {
  data() {
    return {
      map: null,
      collectionGeoObjects: null,
      placemark: null,
    };
  },
  props: ["card"],

  created() {
    // Установить скрипты для использования яндекс карты
    let scriptYandexMap = document.createElement("script");
    scriptYandexMap.setAttribute(
      "src",
      "https://api-maps.yandex.ru/2.1/?apikey=516c90cd-d4fe-4764-ace5-30e0fb75d745&lang=ru_RU"
    );
    document.head.appendChild(scriptYandexMap);

    // Инициализировать яндекс карту
    scriptYandexMap.addEventListener("load", this.initializeYandexMap);
  },
  methods: {
    initializeYandexMap() {
      ymaps.ready(() => {
        this.map = new ymaps.Map("yandex-map", {
          center: [59.906641, 30.331462],
          zoom: 10,
          controls: ["fullscreenControl"],
          searchControlProvider: "yandex#search",
        });
        //this.map.behaviors.disable('scrollZoom');
        console.log(this.map);
        this.setMarkers();
        // this.coordinates.then(() => this.setMarkers());
      });
    },
    setMarkers() {
      console.log(this.card.mapCoordinates[0]);
      this.collectionGeoObjects = new ymaps.GeoObjectCollection(
        {},
        {
          preset: "twirl#redIcon", //все метки красные
          draggable: true, // и их можно перемещать
        }
      );

      for (let i = 0; i < this.card.mapCoordinates[0].length; i++) {
        console.log([
          Number(this.card.mapCoordinates[0][i].latitude),
          Number(this.card.mapCoordinates[0][i].longitude),
        ]);

        this.placemark = new ymaps.Placemark([
          Number(this.card.mapCoordinates[0][i].latitude),
          Number(this.card.mapCoordinates[0][i].longitude),
        ]);
        console.log(this.placemark);

        this.collectionGeoObjects.add(this.placemark);
        console.log(this.collectionGeoObjects);
      }
      // let placemark2 = new ymaps.Placemark([
      //   Number(this.card.mapCoordinates[0][2].latitude),
      //   Number(this.card.mapCoordinates[0][2].longitude),
      // ]);
      this.map.geoObjects.add(this.collectionGeoObjects);
      // this.map.geoObjects.add(placemark2);
      // this.map.setBounds(this.collectionGeoObjects.getBounds());
    },
  },
};
</script>
<style>
body {
  margin: 0;
}

#yandex-map {
  width: 75vw;
  height: 75vh;
}
</style>