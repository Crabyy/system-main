<template>
  <div class="q-pa-md relative">
    <q-carousel arrows animated v-model="slide" height="300px">
      <q-carousel-slide name="first" img-src="src/assets/unitStudio.jpg">
        <div class="absolute-bottom custom-caption">
          <div class="text-h2">Studio Unit</div>
          <div class="text-subtitle1"></div>
        </div>
      </q-carousel-slide>
      <q-carousel-slide name="second" img-src="src/assets/onebed.jpg">
        <div class="absolute-bottom custom-caption">
          <div class="text-h2">One Bedroom</div>
          <div class="text-subtitle1"></div>
        </div>
      </q-carousel-slide>
      <q-carousel-slide name="third" img-src="src/assets/twobed.jpeg">
        <div class="absolute-bottom custom-caption">
          <div class="text-h2">Two Bedroom</div>
          <div class="text-subtitle1"></div>
        </div>
      </q-carousel-slide>
    </q-carousel>
    <a href="#" class="absolute bottom-6 right-6 text-gray-300 hover:text-white" id="changePicture"
      style="font-size: 1.5rem" @click.prevent="openStudioUnit">
      <i class="fas fa-edit" v-if="userType === 'admin'"></i>
    </a>
  </div>
  <StudioUnitModal ref="studioUnitModal" />

  <!-- Table -->
  <div class="q-md">
    <q-btn class="q-ml-md mb-3" color="primary" label="Create" @click.prevent="openCreateUnit"
      v-if="userType === 'admin'" />
    <q-table class="my-sticky-virtscroll-table" virtual-scroll flat bordered v-model:pagination="pagination"
      :rows-per-page-options="[5]" :virtual-scroll-sticky-size-start="48" row-key="id" :rows="rows" :columns="columns">
      <template v-slot:body-cell-action="props">
        <q-td :props="props">
          <q-btn label="Remove" color="negative" @click="removeRow(props.row)" />
        </q-td>
      </template>
    </q-table>
  </div>

  <createUnit ref="createUnit" />
</template>

<script>
import StudioUnitModal from "src/pages/UnitSelectModal/StudioUnitModal.vue";
import { ref, onMounted } from "vue";
import createUnit from "src/pages/createUnit.vue"

export default {

  components: {
    StudioUnitModal,
    createUnit,
  },

  computed: {
    userType() {
      return localStorage.getItem("userType");
    },
  },

  methods: {
    openCreateUnit() {
      this.$refs.createUnit.openModal();
    },

    closeCreateUnit() {
      this.showCreateUnit = false;
    },
  },

  setup() {

    const columns = [
      {
        name: "unitno",
        required: true,
        label: "Unit no.",
        field: "unitno",
        format: (val) => `${val}`,
        align: "left",
        sortable: true,
      },
      {
        name: "unitname",
        required: true,
        label: "Unit Name",
        field: "unitname",
        format: (val) => `${val}`,
        align: "left",
        sortable: true,
      },
      {
        name: "unitstatus",
        required: true,
        label: "Status",
        field: "unitstatus",
        format: (val) => `${val}`,
        align: "left",
        sortable: true,
      },
      {
        name: "unitposition",
        required: true,
        label: "Position",
        field: "unitposition",
        format: (val) => `${val}`,
        align: "left",
        sortable: true,
      },
      {
        name: "unitprice",
        required: true,
        label: "Monthly Price",
        field: "unitprice",
        format: (val) => `${val}`,
        align: "left",
        sortable: true,
      },
      {
        name: "unittype",
        required: true,
        label: "Unit Type",
        field: "unittype",
        format: (val) => `${val}`,
        align: "left",
        sortable: true,
      },
      {
        name: "Action",
        required: true,
        label: "Action",
        align: "left",
        field: "id",
        format: (val) => `${val}`,
        sortable: false,
      },
    ];

    const rows = ref([]);

    const pagination = ref({
      rowsPerPage: 0,
    });

    const fetchData = async () => {
      try {
        const response = await fetch('http://localhost/system-main/database/include/admin/unitSelection.php');
        const data = await response.json();
        rows.value = data.map((row, index) => ({ ...row, id: index }));
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    onMounted(fetchData);

    const removeRow = async (row) => {
      try {
        const response = await fetch('http://localhost/system-main/database/include/admin/unitSelection.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'remove',
            id: row.id,
          }),
        });

        const result = await response.json();

        if (response.ok) {
          console.log(result.message);
          fetchData();
        } else {
          console.error(result.error);
        }
      } catch (error) {
        console.error('Error removing unit:', error);
      }
    };

    return {
      columns,
      rows,
      pagination,
      removeRow,
      slide: ref("first"),
    };
  },
};
</script>

<style lang="sass" scoped>
.custom-caption
  text-align: center
  padding: 12px
  color: white
  background-color: rgba(0, 0, 0, .3)

.my-sticky-virtscroll-table
  /* height or max-height is important */
  height: 220px
  border: solid black 2px

  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th /* bg color is important for th; just specify one */
    background-color: whitesmoke
    font-size: 15px
    border-bottom: solid 2px

  thead tr th
    position: sticky
    z-index: 1
  /* this will be the loading indicator */
  thead tr:last-child th
    /* height of all previous header rows */
    top: 48px
  thead tr:first-child th
    top: 0

  /* prevent scrolling behind sticky top row on focus */
  tbody
    /* height of all previous header rows */
    scroll-margin-top: 48px
</style>
