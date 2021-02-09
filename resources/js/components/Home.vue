<template>
    <div>
        <el-container>
            <el-aside width="400px">
                <el-row>
                    <el-col>
                        <h1>Filters</h1>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-select size="mini" placeholder="Bedrooms" v-model="bedrooms">
                            <el-option label="Any number of bedrooms" :value="null"></el-option>
                            <el-option v-for="n in 10" :key="n" :label="n" :value="n"></el-option>
                        </el-select>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-select size="mini" placeholder="Bathrooms" v-model="bathrooms">
                            <el-option label="Any number of bathrooms" :value="null"></el-option>
                            <el-option v-for="n in 10" :key="n" :label="n" :value="n"></el-option>
                        </el-select>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-select size="mini" placeholder="Garages" v-model="garages">
                            <el-option label="Any number of garages" :value="null"></el-option>
                            <el-option v-for="n in 10" :key="n" :label="n" :value="n"></el-option>
                        </el-select>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-select size="mini" placeholder="Storeys" v-model="storeys">
                            <el-option label="Any number of storeys" :value="null"></el-option>
                            <el-option v-for="n in 10" :key="n" :label="n" :value="n"></el-option>
                        </el-select>
                    </el-col>
                </el-row>

                <el-row>
                    <el-col :span="8">
                        <el-input-number size="mini" v-model="low" :min="0" :controls="false" placeholder="Lowest price"></el-input-number>
                    </el-col>
                    <el-col :span="8">
                        <el-input-number size="mini" v-model="high" :min="0" :controls="false" placeholder="Highest price"></el-input-number>
                    </el-col>
                </el-row>
            </el-aside>
            <el-main>
                <el-row>
                    <el-col>
                        <h1>Property search</h1>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-input placeholder="Name of the property" v-model="input"></el-input>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-table
                            size="mini"
                            v-loading="loading"
                            :data="houses"
                            style="width: 100%">
                            <el-table-column
                                prop="name"
                                label="Name"
                                width="180">
                            </el-table-column>
                            <el-table-column
                                prop="price"
                                label="Price">
                            </el-table-column>
                            <el-table-column
                                prop="bedrooms"
                                label="Bedrooms"
                                width="180">
                            </el-table-column>
                            <el-table-column
                                prop="bathrooms"
                                label="Bathrooms"
                                width="180">
                            </el-table-column>
                            <el-table-column
                                prop="garages"
                                label="Garages"
                                width="180">
                            </el-table-column>
                            <el-table-column
                                prop="storeys"
                                label="Storeys"
                                width="180">
                            </el-table-column>
                        </el-table>
                    </el-col>
                </el-row>
            </el-main>
        </el-container>
    </div>
</template>

<script>
export default {
name: "Home",
    data: () => ({
        input: '',
        bedrooms: null,
        bathrooms: null,
        garages: null,
        storeys: null,
        low: undefined,
        high: undefined,
        loading: false,
        houses: [],
        query: {},
        errorMessage: undefined
    }),
    methods: {
        finalizeRequest() {
            this.loading = false
        },
        reportErrors(err) {
            this.errorMessage = err
            this.houses = []
        }
    },
    watch: {
        errorMessage: function (val, old) {
            if (old === undefined) {
                this.$notify.error({
                    title: 'Error',
                    message: val,
                    onClose: () => {
                        this.errorMessage = undefined
                    }
                })
            }
        },
        input: function (val) {
            console.log('changed')
            this.loading = true
            this.query.name = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
                .catch(err => {
                    this.reportErrors(err)
                })
                .finally(this.finalizeRequest)
        },
        bedrooms: function (val) {
            this.loading = true
            this.query.bedrooms = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
                .catch(err => {
                    this.reportErrors(err)
                })
                .finally(this.finalizeRequest)
        },
        bathrooms: function (val) {
            this.loading = true
            this.query.bathrooms = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
                .catch(err => {
                    this.reportErrors(err)
                })
                .finally(this.finalizeRequest)
        },
        garages: function (val) {
            this.loading = true
            this.query.garages = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
                .catch(err => {
                    this.reportErrors(err)
                })
                .finally(this.finalizeRequest)
        },
        storeys: function (val) {
            this.loading = true
            this.query.storeys = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
                .catch(err => {
                    this.reportErrors(err)
                })
                .finally(this.finalizeRequest)
        },
        low: function (val) {
            if (val > this.high) {
                this.low = this.high - 1
            }
            this.loading = true
            this.query.low = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
                .catch(err => {
                    this.reportErrors(err)
                })
                .finally(this.finalizeRequest)
        },
        high: function (val) {
            if (val < this.low) {
                this.high = this.low + 1
            }
            this.loading = true
            this.query.high = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
                .catch(err => {
                    this.reportErrors(err)
                })
                .finally(this.finalizeRequest)
        }
    }
}
</script>

<style scoped>
.el-row {
    margin-bottom: 5px;
}
.el-aside {
    margin: 20px;
}

.el-table {
    margin-top: 50px;
}
</style>
