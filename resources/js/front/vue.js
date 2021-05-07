import Vue from "vue";
import Monuments from "../../vue/dist/Monuments.vue";

const el = document.getElementById('app');

if (el) {
  new Vue({
    propsData: { ...el.dataset },
    props: ["placeholder","url"],
    render: (h) => h(Monuments),
  }).$mount(el)
}

