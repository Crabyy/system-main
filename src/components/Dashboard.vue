<template>
  <div>
    <div class="row flex flex-col">
      <!-- Container 1: TITLE AND PICTURE -->
      <div class="relative">
        <div class="relative rounded-lg mx-auto mt-4 overflow-hidden shadow-md shadow-black"
          style="height: 250px; width: 100%">
          <!-- Set your desired height and width -->
          <!-- Set your desired height -->
          <img src="src/assets/apartment.jpg" alt="Current Picture" class="object-cover object-center w-full h-full" />
          <!-- EDIT ICON -->
          <a href="#" class="absolute bottom-4 right-4 text-gray-300 hover:text-white" id="changePicture"
            style="font-size: 1.5rem" @click.prevent="openModal">
            <i class="fas fa-edit" v-if="userType === 'admin'"></i>
          </a>
        </div>
      </div>

      <div>
        <div class="row flex flex-col">
          <div class="flex">
            <!-- Container 1: First Image -->
            <div class="rounded-lg mt-10 m-auto ml-0 relative overflow-hidden shadow-md shadow-black"
              style="width: 400px; height: 300px; margin-right: 20px">
              <img src="src/assets/unitStudio.jpg" alt="Studio Unit" class="object-cover object-center w-full h-full" />
              <a href="#" class="absolute bottom-4 right-4 text-gray-300 hover:text-white" id="changePicture"
                style="font-size: 1.5rem" @click="openStudio">
                <i class="fas fa-edit" v-if="userType === 'admin'"></i>
              </a>
            </div>

            <!-- Container 2: Second Image -->
            <div class="rounded-lg mt-10 m-auto ml-0 relative overflow-hidden shadow-md shadow-black"
              style="width: 400px; height: 300px">
              <img src="src/assets/onebed.jpg" alt="OneBed" class="object-cover object-center w-full h-full" />
              <a href="#" class="absolute bottom-4 right-4 text-gray-300 hover:text-white" id="changePicture"
                style="font-size: 1.5rem" @click="openOne">
                <i class="fas fa-edit" v-if="userType === 'admin'"></i>
              </a>
            </div>

            <!-- Container 3: Third Image -->
            <div class="rounded-lg mt-10 m-auto ml-0 relative overflow-hidden shadow-md shadow-black"
              style="width: 400px; height: 300px">
              <img src="src/assets/twobed.jpeg" alt="twoBed" class="object-cover object-center w-full h-full" />
              <a href="#" class="absolute bottom-4 right-4 text-gray-300 hover:text-white" id="changePicture"
                style="font-size: 1.5rem" @click="openTwo">
                <i class="fas fa-edit" v-if="userType === 'admin'"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <ModalPicture ref="modalPicture" />
    <StudioModal ref="studioModal" />
    <OneBedModal ref="oneBedModal" />
    <TwoBedModal ref="twoBedModal" />
  </div>
</template>

<script>
import ModalPicture from "src/pages/DashboardModal/ModalPicture.vue";
import StudioModal from "src/pages/DashboardModal/StudioModal.vue";
import OneBedModal from "src/pages/DashboardModal/OneBedModal.vue";
import TwoBedModal from "src/pages/DashboardModal/TwoModal.vue";

export default {
  name: "AdminDashboard",
  components: {
    ModalPicture,
    StudioModal,
    OneBedModal,
    TwoBedModal,
  },
  methods: {

    openModal() {
      this.$refs.modalPicture.openModal();
    },
    openStudio() {
      this.$refs.studioModal.openStudio();
    },
    openOne() {
      this.$refs.oneBedModal.openOne();
    },
    openTwo() {
      this.$refs.twoBedModal.openTwo();
    },
  },

  computed: {
    userType() {
      return localStorage.getItem('userType')
    }
  }
};
</script>

<style scoped></style>
