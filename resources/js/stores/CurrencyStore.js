import { defineStore } from 'pinia';
const appUrl = import.meta.env.VITE_APP_URL;

export const useCurrencyStore = defineStore('currency', {
  state: () => ({
    currencies: [],
    selectedCurrency: 'JPY',
    amount: 0,
    calculatedAmount: 0,
    exchangeRates: [],
    surcharges: [],
    purchaseInProgress: false,
    purchaseSuccess: false
  }),
  getters: {
    exchangeRate(state) {
        if (state.selectedCurrency && state.exchangeRates.length) {
            const quote = state.exchangeRates.find(exRate => state.selectedCurrency === exRate.code.slice(-3)).quote;
            return quote ?? 1;
        }

        return 1;
    },
    surcharge(state) {
        if (state.selectedCurrency && state.surcharges.length) {
            const percentage = state.surcharges.find(surcharge => state.selectedCurrency === surcharge.currency_code).percentage;
            return percentage ?? 0;
        }

        return 0;
    },
    totalAmount(state) {
        const discount = state.selectedCurrency === 'EUR' ? 2 : 0
        return state.calculatedAmount + state.amount * this.surcharge - discount;
    },
  },
  actions: {
    async getCurrencies() {
        const res = await fetch(`${appUrl}/api/currencies`);
        this.currencies = await res.json();
    },
    async getExchangeRates() {
        const res = await fetch(`${appUrl}/api/exchange-rates`);
        this.exchangeRates = await res.json();
    },
    async getSurcharges() {
        const res = await fetch(`${appUrl}/api/surcharges`);
        this.surcharges = await res.json();
    },
    calculateAmount() {
        this.calculatedAmount = this.amount * this.exchangeRate;
    },
    async purchaseCurrency(order) {
        this.purchaseInProgress = true;
        const res = await fetch(`${appUrl}/api/place-order`, {
            method: 'POST',
            body: JSON.stringify(order),
            headers: {'Content-Type': 'application/json'}
        })

        if (res.error) {
            console.log(res.error);
        }

        this.purchaseSuccess = true
        this.purchaseInProgress = false

        setTimeout(() => {
            this.resetFields()
        },1000)
    },
    resetFields() {
        this.selectedCurrency = 'JPY'
        this.purchaseSuccess = false
        this.amount = 0
    }
  },
});
