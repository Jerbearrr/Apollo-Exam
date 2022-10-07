<!--TEMPLATES-->
<template>
  <svg
    xmlns:svg="http://www.w3.org/2000/svg"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 150 744 1052"
    id="svg2"
    version="1"
  >
    <path
      id="spiral"
      stroke-dashoffset="6265"
      stroke-dasharray="6265"
      d="m351 487c0 8-11 4-14-1-6-11 4-24 15-27 19-5 37 11 40 30 4
    27-18 50-44 53-35 4-64-25-66-59-3-42 32-77 73-79 50-3 90 39 92 88 2 57-46
    104-102 105-65 2-117-53-119-117-1-72 60-131 131-132 80-1 144 67 145 146 1
    87-74 158-160 158-95 0-171-81-171-175 0-102 88-185 190-184 110 1 198 95 197
    204C557 615 456 709 340 708 215 706 115 598 117 475 119 342 233 236 364 238
    504 240 616 361 614 500 611 648 484 766 337 763 182 760 58 626 61 472 65 309
    206 179 367 183c170 4 306 151 302 320-4 178-158 319-335 315"
    />
    <text>
      <textPath href="#spiral">
        {{ breakdowns }}
      </textPath>
    </text>
  </svg>
</template>

<!-- SCRIPTS -->
<script setup>
import axios from "axios";
import { ref, onMounted, onUpdated } from "vue";

let breakdowns = ref("");
let id = ref(1);
const totalRandoms = ref(0);

// WHEN MOUNTED
onMounted(async () => {
  const { data } = await axios.get(`/api/random/${id.value}`);
  totalRandoms.value = await (await axios.get('/api/total-randoms')).data;

  data.forEach(({ values }) => {
    breakdowns.value += values;
  });
  console.log("teste");
  id.value++;
});

// WHEN UPDATED 
onUpdated(() => {
  if (id.value <= totalRandoms.value) {
    setTimeout(async () => {
      const { data } = await axios.get(`/api/random/${id.value}`);

      data.forEach(({ values }) => {
        breakdowns.value += values;
      });
      console.log("teste");
      id.value++;
    }, 1000);
  }
});
</script>

<!--STYLES-->
<style scoped>
.inline {
  display: inline;
}

svg {
  width: 100%;
  height: 100%;
}

#spiral {
  fill: none;
}

svg text {
  font-size: 48px;
  pointer-events: none;
}
</style>
