<template>
  <div>
    <input
      type="search"
      class="input"
      :placeholder="placeholder"
      v-on:input="getList"
      v-on:blur="checInput"
    />
    <div :class="`monumnets-list ${className[isVisible * 1]}`">
      <div class="row th">
        <div class="col-xs-12 col-sm-4">{{ data.lang.monumentName }}</div>
        <div class="col-xs-12 col-sm-4">{{ data.lang.city }}</div>
        <div class="col-xs-12 col-sm-4">{{ data.lang.price }}</div>
      </div>
      <div class="row td" v-for="item in data.monuments" :key="item.id">
        <div class="col-xs-12 col-sm-4">{{ item.name }}</div>
        <div class="col-xs-12 col-sm-4">{{ findCity(item.city) }}</div>
        <div class="col-xs-12 col-sm-4">
          {{ item.tickets.full.toFixed(2) }} N /
          {{ item.tickets.half.toFixed(2) }} U
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Monuments",
  components: {},
  data() {
    return {
      isVisible: 0,
      className: ["hidden", "visible"],
      placeholder: "",
      url: "",
      data: {
        monuments: {},
        cities: {},
        lang: {},
      },
    };
  },

  mounted: function () {
    this.placeholder = this.$parent.$props.placeholder;
    this.url = this.$parent.$props.url;
  },

  methods: {
    checInput(ev) {
      let th = this;
      let search = ev.target.value.trim();

      if (!search || search.length == 0) {
        th.clearData();
        return;
      }
    },
    getList(ev) {
      let th = this;
      let search = ev.target.value.trim();

      if (search.length < 1) {
        th.clearData();
        return;
      }

      axios.get(this.url + search).then((response) => {
        th.isVisible = true;
        th.data.monuments = response.data.monuments;
        th.data.cities = response.data.cities;
        th.data.lang = response.data.lang;

        //prevent display if val is fast delete from input
        setTimeout(th.checInput(ev), 1000);
      });
    },
    clearData() {
      let th = this;
      th.isVisible = false;
      th.data.monuments = {};
      th.data.cities = {};
    },
    findCity(id) {
      let city = this.data.cities.find((el) => {
        if (el.id == id) return el.name;
      });

      return typeof city.name != "undefined" ? city.name : "";
    },
  },
};
</script>

