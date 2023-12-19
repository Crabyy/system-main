<template>
  <div v-if="showModal" class="fixed inset-0 z-50 overflow-auto bg-smoke-dark flex">
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
          <div class="relative rounded-lg mx-auto mt-4 shadow-md shadow-black img1">
            <img :src="imagePath" alt="Rectangular Picture" class="object-cover object-center w-full h-48" />
            <input ref="fileInput" type="file" style="display: none" @change="handleFileChange" />
            <a href="#" class="absolute bottom-4 right-4 text-gray-300 hover:text-white" id="changePicture"
              style="font-size: 1.5rem" @click.prevent="MoEdit">
              <i class="fas fa-edit"></i>
            </a>
          </div>

          <!-- Big Square for Text -->
          <div class="bg-white p-8 rounded-lg mt-6 shadow-md shadow-black mongo1">
            <p class="text-white"></p>
            <q-input v-model="textareaModel" filled clearable type="textarea" color="gray-800" label="Text Area"
              :shadow-text="textareaShadowText" @keydown="processTextareaFill" @focus="processTextareaFill" />
          </div>
        </div>
      </form>
      <div class="flex items-center justify-between mt-6">
        <button type="submit"
          class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 ml-auto w rounded-lg focus:outline-none focus:shadow-outline">
          Save
        </button>
      </div>
    </div>
    <ModalEdit ref="modalEdit" />
  </div>
</template>

<script>
import ModalEdit from "src/pages/DashboardModal/ModalEdit.vue";
import { event } from "quasar";
import { ref, computed } from "vue";

const { stopAndPrevent } = event;
export default {
  name: "ModalPicture",
  components: {
    ModalEdit,
  },

  data() {
    return {
      showModal: false,
      imagePath: "src/assets/apartment.jpg",
    };
  },

  methods: {
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    MoEdit() {
      this.$refs.modalEdit.MoEdit();
    },

    methods: {
      async submit() {
        const formData = new FormData();
        formData.append('image', this.$refs.fileInput.files[0]);

        try {
          // Upload image
          const response = await fetch('http://localhost/system-main/database/include/admin/apartmentHeader.php', {
            method: 'POST',
            body: formData,
          });

          const data = await response.json();

          if (data.status === 'success') {
            // Update the image path
            this.imagePath = data.path;
            // Close the modal
            this.closeModal();
          } else {
            console.error('Image upload failed:', data.message);
          }
        } catch (error) {
          console.error('Error uploading image:', error);
        }
      },

      handleFileChange() {
        // Handle file change if needed
      },
    },


  },
  setup() {
    const inputModel = ref("");
    const inputFillCancelled = ref(false);
    const inputShadowText = computed(() => {
      if (inputFillCancelled.value === true) {
        return "";
      }

      const t = "Text filled when you press TAB";
      const empty =
        typeof inputModel.value !== "string" || inputModel.value.length === 0;

      if (empty === true) {
        return t;
      } else if (t.indexOf(inputModel.value) !== 0) {
        return "";
      }

      return t.split(inputModel.value).slice(1).join(inputModel.value);
    });

    const textareaModel = ref("");
    const textareaFillCancelled = ref(false);
    const textareaShadowText = computed(() => {
      if (textareaFillCancelled.value === true) {
        return "";
      }

      const t =
        "This text\nwill be filled\non multiple lines\nwhen you press TAB",
        empty =
          typeof textareaModel.value !== "string" ||
          textareaModel.value.length === 0;

      if (empty === true) {
        return t.split("\n")[0];
      } else if (t.indexOf(textareaModel.value) !== 0) {
        return "";
      }

      return t
        .split(textareaModel.value)
        .slice(1)
        .join(textareaModel.value)
        .split("\n")[0];
    });

    return {
      inputModel,
      inputFillCancelled,
      inputShadowText,

      processInputFill(e) {
        if (e === void 0) {
          return;
        }

        if (e.keyCode === 27) {
          if (inputFillCancelled.value !== true) {
            inputFillCancelled.value = true;
          }
        } else if (e.keyCode === 9) {
          if (
            inputFillCancelled.value !== true &&
            inputShadowText.value.length > 0
          ) {
            stopAndPrevent(e);
            inputModel.value =
              (typeof inputModel.value === "string" ? inputModel.value : "") +
              inputShadowText.value;
          }
        } else if (inputFillCancelled.value === true) {
          inputFillCancelled.value = false;
        }
      },

      textareaModel,
      textareaFillCancelled,
      textareaShadowText,

      processTextareaFill(e) {
        if (e === void 0) {
          return;
        }

        if (e.keyCode === 27) {
          if (textareaFillCancelled.value !== true) {
            textareaFillCancelled.value = true;
          }
        } else if (e.keyCode === 9) {
          if (
            textareaFillCancelled.value !== true &&
            textareaShadowText.value.length > 0
          ) {
            stopAndPrevent(e);
            textareaModel.value =
              (typeof textareaModel.value === "string"
                ? textareaModel.value
                : "") + textareaShadowText.value;
          }
        } else if (textareaFillCancelled.value === true) {
          textareaFillCancelled.value = false;
        }
      },
    };
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
