<template>
  <div class="admin-profile-container bg-gray-800 rounded-lg text-white border-1 text-lg">
    <!-- My Profile Section -->
    <div class="my-profile">
      <h2 class="ml-[10px] text-[40px] pb-7 text-bold">My Profile</h2>
      <!-- Circular Image -->

      <!-- Name, Age -->
      <div class="profile-details text-[20px] pl-[20px] flex-col">
        <p class="pb-[5px]" v-if="selectedUser">
          Name: {{ selectedUser.surname }}, {{ selectedUser.givenname }} {{ selectedUser.middlename }}
        </p>
        <p class="pb-[5px]">Age:</p>
      </div>

      <div class="flex items-center justify-between mt-6 pb-4">
        <button type="submit"
          class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 ml-auto w rounded-lg focus:outline-none focus:shadow-outline"
          @click.prevent="openModal">
          Edit Profile
        </button>
      </div>

      <EditProfile ref="ProfileEditModal" />

      <!-- Horizontal Rule -->
      <hr class="my-auto border-[2px] rounded-lg" />
    </div>

    <!-- Two Column Information -->
    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-2">
      <!-- First Column: Given name, Middle name, Surname, Birthdate, Gender -->
      <div class="p-4">
        <p class="pb-2">Birthdate: </p>
        <p class="pb-2">Gender:</p>
        <p>Email:</p>
      </div>

      <!-- Second Column: Email, Username, Password, Contact number -->
      <div class="p-2 md:p-2">
        <p class="pb-2">Username:</p>
        <div class="flex items-center">
          <label for="password" class="pr-2 font-medium text-gray-900 dark:text-white">Password:</label>
          <button id="toggleModalBtn" class="text-blue-700 font-mediumunderline focus:outline-none" type="button"
            @click="showModal">
            Change Password
          </button>
        </div>
        <p class="text-lg pt-1">Contact Number:</p>
      </div>
    </div>
  </div>
  <!-- Main modal -->
  <div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="modal-content relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4">
          <h3 class="text-2xl font-semibold text-gray-900 dark:text-black">
            Change Password
          </h3>
          <button type="button"
            class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="authentication-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 md:p-5">
          <form class="space-y-4" action="#">
            <div>
              <input type="Password" name="Current Password" id="Current Password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-500 dark:placeholder-gray-400"
                placeholder="Current Password" required />
            </div>
            <div>
              <input type="password" name="New password" id="New password" placeholder="New Password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-500 dark:placeholder-gray-400"
                required />
            </div>
            <div>
              <input type="password" name="Confirm password" id="Confirm password" placeholder="Confirm Password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-500 dark:placeholder-gray-400"
                required />
            </div>
            <div class="flex justify-end">
              <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import EditProfile from "../pages/EditProfile.vue";

export default {
  name: "ProfileComponent",
  components: {
    EditProfile,
  },
  data() {
    return {
      profileName: "",
      age: "",
      givenName: "",
      middleName: "",
      surname: "",
      birthdate: "",
      gender: "",
      email: "",
      username: "",
      contactNumber: "",
    };
  },

  methods: {
    // Function to show the modal
    showModal() {
      document
        .getElementById("authentication-modal")
        .classList.remove("hidden");
    },
    // Function to hide the modal
    hideModal() {
      document.getElementById("authentication-modal").classList.add("hidden");
    },
    // Function to close the modal
    closeModal() {
      this.hideModal();
    },
    openModal() {
      // Access the RegisterModal component using the ref and call its openModal method
      this.$refs.ProfileEditModal.openModal();
    },
  },

  mounted() {
    // Attach event listener to the button to toggle the modal
    document
      .getElementById("toggleModalBtn")
      .addEventListener("click", this.showModal);

    // Attach event listener to the close button inside the modal
    document
      .querySelector('[data-modal-hide="authentication-modal"]')
      .addEventListener("click", this.closeModal);
  },
};
</script>

<style scoped>
/* Add your styling for the component here */
.admin-profile-container {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  padding: 50px;
  height: 85vh;
}

.my-profile {
  align-items: center;
  margin-top: 10px;
}

.two-column-info {
  display: flex;
  padding: 10px 0 0 20px;
  justify-content: center;
}

.column {
  width: 100%;
}

.admin-profile-container {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  padding: 50px;
  height: 85vh;
}

.my-profile {
  align-items: center;
  margin-top: 10px;
}

.two-column-info {
  display: flex;
  padding: 10px 0 0 20px;
}

.column {
  width: 43%;
}

/* Center the modal */
#authentication-modal {
  display: flex;
  justify-content: center;
  align-items: center;
}

@media screen and (max-width: 768px) {
  .column {
    width: 100%;
    /* Set the width to 100% for all screen sizes */
  }
}
</style>
