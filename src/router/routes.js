import { checkIfUserIsAuthenticated } from "./auth";

const routes = [
  {
    path: "/",
    name: "SignIn",
    component: () => import("src/layouts/SignInLayout.vue"),
  },

  {
    path: "/",
    component: () => import("../layouts/SideBar.vue"),
    children: [
      {
        path: "/Profile",
        name: "Profile",
        component: () => import("../components/ProfileComponent.vue"),
      },
      {
        path: "/Dashboard",
        name: "Dashboard",
        component: () => import("../components/Dashboard.vue"),
      },
      {
        path: "/UnitSelection",
        name: "UnitSelection",
        component: () => import("../components/UnitSelection.vue"),
      },
      {
        path: "/AcquireUnit",
        name: "AcquireUnit",
        component: () => import("../components/AcquireUnit.vue"),
      },
      {
        path: "/ClientAccount",
        name: "ClientAccountManagement",
        component: () => import("../components/ClientAccountManagement.vue"),
      },
      {
        path: "/AdminAccount",
        name: "AdminAccountManagement",
        component: () => import("../components/AdminAccountManagement.vue"),
      },
    ],
    beforeEnter: (to, from, next) => {
      if (checkIfUserIsAuthenticated()) {
        next();
      } else {
        // Redirect to the root path for unauthorized access
        next("/");
      }
    },
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
