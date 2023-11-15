<template>
  <div id="yandex-map"></div>
</template>
<script>

export default {
  data() {
    return {
      map: null,
    };
  },
  props: ["card"],

  created() {
    // Установить скрипты для использования яндекс карты
    // doc https://yandex.com/dev/jsapi-v2-1/doc/en/v2-1/dg/concepts/geoobjects#geoobject_collections
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
        let map = new ymaps.Map("yandex-map", {
          center: [59.906641, 30.331462],
          zoom: 10,
          controls: ["fullscreenControl"],
          searchControlProvider: "yandex#search",
        });
        
        this.setMarkers(map);
        
      });
    },
    setMarkers(map) {
      
      let collectionGeoObjects = new ymaps.GeoObjectCollection(
        {},
        {
          preset: "twirl#redIcon", //все метки красные
          draggable: true, // и их можно перемещать
        }
      );

      for (let i = 0; i < this.card.mapCoordinates[0].length; i++) {

        let placemark = new ymaps.Placemark([
          Number(this.card.mapCoordinates[0][i].latitude),
          Number(this.card.mapCoordinates[0][i].longitude),
        ]);

        collectionGeoObjects.add(placemark);
        
      }
      
      map.geoObjects.add(collectionGeoObjects);
      
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