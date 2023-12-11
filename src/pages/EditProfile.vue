<template>
  <div v-if="showModal" class="fixed inset-0 z-50 overflow-auto bg-smoke-dark flex">
    <div class="relative p-8 bg-white w-full max-w-2xl m-auto flex-col flex rounded-lg shadow-lg" style="color: black;">
      <button @click="closeModal" class="absolute top-0 right-0 p-4">
        <svg class="fill-current text-grey" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
          <path d="M0 0h24v24H0z" fill="none" />
          <path
            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
        </svg>
      </button>
      <div class="text-center">
        <h2 class="text-3xl text-blue-700 font-bold">EDIT PROFILE</h2>
      </div>
      <form @submit.prevent="register" class="flex flex-wrap">
        <div class="w-full sm:w-1/2">
          <!-- Fields for the first column -->

          <div class="mt-3 relative">
            <input type="text" v-model="givenname" id="givenname" name="givenname" placeholder="Given Name"
              class="block mb-2 border w-full text-base px-2 py-1 pl-8 focus:outline-none focus:ring-0 focus:border-gray-600 rounded-lg">
            <i class="fa-solid fa-user absolute top-3 left-2 text-gray-500"></i>
          </div>

          <div class="mt-3 relative">
            <input type="text" v-model="middlename" id="middlename" name="middlename" placeholder="Middle Name"
              class="block mb-2 border w-full text-base px-2 py-1 pl-8 focus:outline-none focus:ring-0 focus:border-gray-600 rounded-lg">
            <i class="fa-solid fa-user absolute top-3 left-2 text-gray-500"></i>
          </div>

          <div class="mt-3 relative">
            <input type="text" v-model="surname" id="surname" name="surname" placeholder="Surname"
              class="block mb-2 border w-full text-base px-2 py-1 pl-8 focus:outline-none focus:ring-0 focus:border-gray-600 rounded-lg">
            <i class="fa-solid fa-user absolute top-3 left-2 text-gray-500"></i>
          </div>

          <div class="mt-3 relative">
            <input type="text" v-model="email" id="Email" placeholder="Email"
              class="block mb-2 border w-full text-base px-2 py-1 pl-8 focus:outline-none focus:ring-0 focus:border-gray-600 rounded-lg" />
            <i class="fa-solid fa-envelope absolute top-3 left-2 text-gray-500"></i>
          </div>

          <div class="mt-3 relative">
            <input type="text" v-model="username" id="username" placeholder="Username"
              class="block mb-2 border w-full text-base px-2 py-1 pl-8 focus:outline-none focus:ring-0 focus:border-gray-600 rounded-lg" />
            <i class="fa-solid fa-user absolute top-3 left-2 text-gray-500"></i>
          </div>

        </div>
        <div class="w-full sm:w-1/2 pl-4">
          <!-- Fields for the second column -->

          <div class="mt-3 relative">
            <input type="text" v-model="contactnumber" id="contactnumber" placeholder="Contact Number"
              class="block mb-2 border w-full text-base px-2 py-1 pl-8 focus:outline-none focus:ring-0 focus:border-gray-600 rounded-lg" />
            <i class="fa-solid fa-mobile-screen absolute top-3 left-2 text-gray-500"></i>
          </div>

          <div class="mt-3 relative">
            <input type="date" v-model="calendar" id="calendar" placeholder="Select Date"
              class="block mb-2 border w-full text-base px-2 py-1 pl-8 focus:outline-none focus:ring-0 focus:border-gray-600 rounded-lg text-gray-400" />
            <i class="fa-solid fa-calendar absolute top-3 left-2 text-gray-500"></i>
          </div>

          <div class="mt-3 relative">
            <label for="gender" class="block text-base text-left font-medium text-gray-700 mb-2 ml-3">Choose
              Gender</label>
            <div class="flex items-center">
              <div class="flex items-center">
                <label class="inline-flex items-center">
                  <i class="fa-solid fa-mars text-gray-500 mr-4 mt-1 text-sm"></i>
                  <input type="radio" v-model="gender" id="male" name="gender" value="Male"
                    class="form-radio h-5 w-5 text-blue-500">
                  <span class="ml-2 text-sm">Male</span>
                </label>
                <label class="inline-flex items-center ml-6">
                  <i class="fa-solid fa-venus text-gray-500 mr-4 mt-1 text-sm"></i>
                  <input type="radio" v-model="gender" id="female" name="gender" value="Female"
                    class="form-radio h-5 w-5 text-pink-500">
                  <span class="ml-2 text-sm">Female</span>
                </label>
              </div>
            </div>
          </div>

        </div>
      </form>
      <div class="flex items-center justify-between mt-6">
        <button type="submit"
          class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 ml-auto w rounded-lg focus:outline-none focus:shadow-outline">
          Submit
        </button>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: "EditProfile",

  data() {
    return {
      showModal: false,
      email: "",
      username: "",
      contactnumber: "",
      selectedGender: "",
    };
  },

  methods: {
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    register() {
      console.log("Password:", this.email);
      console.log("Password:", this.username);
      console.log("selectedGender:", this.selectedGender);
      console.log("Password:", this.contactnumber);

      // Close the modal after registration
      this.closeModal();
    },
  },
};
</script>
