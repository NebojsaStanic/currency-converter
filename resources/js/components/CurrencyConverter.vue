<template>
    <div class="currency-converter">
        <h1>Currency Converter</h1>
        <span class="input_description">Select currency:</span>
        <select v-model="selectedCurrency" class="currency-select">
            <option v-for="currency in currencies" :key="currency.id">{{ currency.code }}</option>
        </select>
        <div class="amount-input">
            <span class="input_description">Enter USD amount</span>
            <input
                v-model.number="amount"
                min="0"
                placeholder="Amount"
                type="number"
                class="amount-input-field"
            />
        </div>
        <p class="calculated-amount">Calculated Amount: {{ calculatedAmount }}</p>
        <p class="total-amount">Total Amount: {{ totalAmount }}</p>
        <button @click="purchaseCurrency" :disabled="purchaseInProgress || amount == 0" class="purchase-button">Purchase</button>
        <p v-if="purchaseSuccess" class="success-message">Order saved! Thank you for your purchase.</p>
    </div>
</template>

<script>

import { useCurrencyStore } from "../stores/CurrencyStore.js";
import { storeToRefs } from "pinia";
import { watch } from "vue";

export default {
    setup() {
        const currencyStore = useCurrencyStore();

        currencyStore.getCurrencies()
        currencyStore.getExchangeRates()
        currencyStore.getSurcharges()

        const {
            selectedCurrency,
            currencies,
            amount,
            calculatedAmount,
            totalAmount,
            purchaseInProgress,
            purchaseSuccess
        } = storeToRefs(currencyStore)

        const watchValues = () => {
            currencyStore.calculateAmount();
        };

        watch([selectedCurrency, amount], watchValues);
        const purchaseCurrency = () => {
            currencyStore.purchaseCurrency({
                'currency_code' : selectedCurrency.value,
                'foreign_amount': amount.value,
            })
        };

        return {
            selectedCurrency,
            currencies,
            amount,
            calculatedAmount,
            totalAmount,
            purchaseCurrency,
            purchaseInProgress,
            purchaseSuccess
        };
    },
};
</script>
