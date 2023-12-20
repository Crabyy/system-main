<template>
  <div v-if="showModal" class="fixed inset-0 z-50 overflow-auto bg-smoke-dark flex select-none backdrop-blur-sm">
    <div class="relative p-8 bg-white w-full max-w-2xl m-auto flex-col flex rounded-lg shadow-black border mongos">
      <button @click="closeModal" class="absolute top-0 right-0 p-4">
        <svg class="fill-current text-grey" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
          <path d="M0 0h24v24H0z" fill="none" />
          <path
            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
        </svg>
      </button>
      <div class="text-center"></div>

      <form @submit.prevent="submit">
        <div>
          <!-- Rectangular Picture with Edit Icon -->
          <div class="relative rounded-lg mx-auto mt-4 shadow-black img1">
            <img :src="imagePath" alt="Rectangular Picture" class="object-cover object-center w-full h-48 rounded-lg" />
            <input ref="fileInput" type="file" style="display: none" @change="handleFileChange" />
            <!-- EDIT ICON -->
            <div>
              <a href="#" class="absolute bottom-2 right-1 text-gray-300 overflow-hidden" id="ChangeIcon"
                style="font-size: 1.3rem">
                <i class="fas fa-edit" v-if="userType === 'admin'"></i>
                <input type="file" class="absolute bottom-2 right-1 text-gray-300 overflow-hidden cursor-pointer" />
              </a>
            </div>
            <!-- Unit Name -->
            <div class="mt-3 absolute bottom-0 left-2">
              <input v-if="userType === 'admin'" type="text" id="title" placeholder="Apartment Name"
                class="block mb-2 border w-full text-base px-2 py-1 pl-8 focus:outline-none focus:ring-0 focus:border-gray-600 rounded-lg" />
            </div>
          </div>

          <!-- Big Square for Text -->
          <div class="bg-white p-8 rounded-lg mt-6 shadow-md shadow-black mongo1">
            <p class="text-white"></p>
            <q-input v-model="textareaModel" filled clearable type="textarea" color="gray-800" label="Text Area"
              :shadow-text="textareaShadowText" @keydown="processTextareaFill" @focus="processTextareaFill" />
          </div>
        </div>

        <div class="flex items-center justify-between mt-6">
          <button type="submit" v-if="userType === 'admin'"
            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 ml-auto w rounded-lg focus:outline-none focus:shadow-outline">
            Save
          </button>
        </div>

      </form>

    </div>
  </div>
</template>

<script>

export default {
  name: "ModalPicture",

  data() {
    return {
      showModal: false,
      imagePath: "src/assets/apartment.jpg",
      uploadedImage: null,
    };
  },

  methods: {
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },

  },

  computed: {
    userType() {
      return sessionStorage.getItem("userType");
    },
  },
};
</script>

<style scoped>
.mongos {
  box-shadow: 0 0 10px rgba(0, 0, 0, 1);
}

.mongo1 {
  box-shadow: 0 0 10px rgba(0, 0, 0, 1);
}

.img1 {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
}
</style>
