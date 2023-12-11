const tokenKey = "authToken";
let authToken = localStorage.getItem(tokenKey);

export function checkIfUserIsAuthenticated() {
  return authToken !== null && authToken !== undefined;
}

export function simulateLogin() {
  authToken = generateAuthToken();
  localStorage.setItem(tokenKey, authToken);
}

export function simulateLogout() {
  authToken = null;
  localStorage.removeItem(tokenKey);
  localStorage.removeItem("userType");
  localStorage.removeItem("userFirstName");
}

function generateAuthToken() {
  // Generate a secure token, you can use a library like uuid or any other method
  // For simplicity, let's use a basic example
  return Math.random().toString(36).substring(2) + Date.now().toString(36);
}
