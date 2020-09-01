<template>
    <form method="POST">
        <div class="mb-3">
            <label for="street" class="form-label">{{ $t('Street') }}</label>
            <input type="text" class="form-control disabled" id="street" disabled>
        </div>
        <div class="mb-3">
            <label for="street2" class="form-label">{{ $t('Street line 2') }}</label>
            <input type="text" class="form-control disabled" id="street2" disabled>
        </div>
        <div class="row g-1">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="countries" class="form-label">{{ $t('Country') }}</label>
                    <select :disabled="isLoading" v-model="country" @change="getRegions(country)" class="form-select" id="countries">
                        <option selected :value="null">{{ $t('Open this to select country') }}</option>
                        <option v-for="country in countries"
                                :value="country.name" v-text="country.name"></option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="region" class="form-label">{{ $t('Region') }}</label>
                    <select :disabled="isLoading" v-model="region" @change="getProvince(region)" class="form-select" id="region">
                        <option selected :value="null">{{ $t('Open this to select region') }}</option>
                        <option v-for="region in regions"
                                :value="region.name" v-text="region.name"></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row g-1">
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="province" class="form-label">{{ $t('Province') }}</label>
                    <select :disabled="isLoading" v-model="province" @change="getCity(province)" class="form-select" id="province">
                        <option selected :value="null">{{ $t('Open this to select province') }}</option>
                        <option v-for="province in provinces"
                                :value="province.name" v-text="province.name"></option>
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="city" class="form-label">{{ $t('City') }}</label>
                    <select :disabled="isLoading" v-model="city" class="form-select" id="city">
                        <option selected :value="null">{{ $t('Open this to select city') }}</option>
                        <option v-for="city in cities"
                                :value="city.name" v-text="city.name"></option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="mb-3">
                    <label for="postal" class="form-label">{{ $t('Postal') }}</label>
                    <input type="text" class="form-control disabled" id="postal" disabled>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    name: 'TestAddressComponent',

    props: {
        token: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            isLoading: false,
            country: null,
            countries: [],
            region: null,
            regions: [],
            province: null,
            provinces: [],
            city: null,
            cities: [],

            axiosConfig: {
                headers: { Authorization: `Bearer ${this.token}` }
            }
        }
    },

    created() {
        this.isLoading = true

        axios.get('/api/v1/en/countries', this.axiosConfig).then(response => {
            this.countries = response.data.countries
        }).finally(() => {
            this.isLoading = false
        })
    },

    methods: {
        getRegions: function (name) {
            this.isLoading = true

            axios.get(`/api/v1/en/countries/${name}/regions`, this.axiosConfig).then(response => {
                this.regions = response.data.regions
            }).finally(() => {
                this.isLoading = false
            })
        },

        getProvince: function (name) {
            this.isLoading = true

            axios.get(`/api/v1/en/regions/${name}/provinces`, this.axiosConfig).then(response => {
                this.provinces = response.data.provinces
            }).finally(() => {
                this.isLoading = false
            })
        },

        getCity: function (name) {
            this.isLoading = true

            axios.get(`/api/v1/en/provinces/${name}/cities`, this.axiosConfig).then(response => {
                this.cities = response.data.cities
            }).finally(() => {
                this.isLoading = false
            })
        }
    }
}
</script>

<style scoped>

</style>
