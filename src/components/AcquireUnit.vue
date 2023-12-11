<template>
  <div
    class="bg-gray-800 text-white w-[auto] h-[91vh] rounded-lg flex flex-col justify-end"
  >
    <h1 class="text-xl text-bold p-2">PAYMENT METHOD:</h1>
    <div class="bg-gray-700 p-10 m-full rounded-lg">
      <div class="q-pa-md q-gutter-sm flex">
        <q-btn
          align="left"
          class="btn-fixed-width"
          color="primary"
          label="Credit Card"
          icon="fa-solid fa-credit-card text-lg"
          @click.prevent="openCredit"
        />
        <q-btn
          align="right"
          class="btn-fixed-width"
          color="primary"
          label="E-Wallet"
          icon="fa-solid fa-money-bills text-lg"
          @click.prevent="openWallet"
        />
        <q-btn
          align="between"
          class="btn-fixed-width border border-white"
          color="primary"
          label="Cash"
          icon="fa-solid fa-credit-card text-lg"
          @click.prevent="openCash"
        />
      </div>
    </div>
    <CreditModal ref="creditModal" />
    <WalletModal ref="walletModal" />
    <CashModal ref="cashModal" />
  </div>
</template>

<script>
import CreditModal from "src/pages/PaymentModal/CreditModal.vue";
import WalletModal from "src/pages/PaymentModal/WalletModal.vue";
import CashModal from "src/pages/PaymentModal/CashModal.vue";
export default {
  components: {
    CreditModal,
    WalletModal,
    CashModal,
  },
  methods: {
    openCredit() {
      this.$refs.creditModal.openCredit();
    },
    openWallet() {
      this.$refs.walletModal.openWallet();
    },
    openCash() {
      this.$refs.cashModal.openCash();
    },
  },
};
</script>

<style></style>
