<template>
    <div>
        <el-row>
            <el-col :span="12">
                <el-input placeholder="Please input" v-model="input"></el-input>
                <el-select placeholder="Bedrooms" v-model="bedrooms">
                    <el-option label="Any number of bedrooms" :value="null"></el-option>
                    <el-option v-for="n in 10" :key="n" :label="n" :value="n"></el-option>
                </el-select>
                <el-select placeholder="Bathrooms" v-model="bathrooms">
                    <el-option label="Any number of bathrooms" :value="null"></el-option>
                    <el-option v-for="n in 10" :key="n" :label="n" :value="n"></el-option>
                </el-select>
                <el-select placeholder="Garages" v-model="garages">
                    <el-option label="Any number of garages" :value="null"></el-option>
                    <el-option v-for="n in 10" :key="n" :label="n" :value="n"></el-option>
                </el-select>
                <el-select placeholder="Any number of storeys" v-model="storeys">
                    <el-option label="Does not matter" :value="null"></el-option>
                    <el-option v-for="n in 10" :key="n" :label="n" :value="n"></el-option>
                </el-select>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="4">
                <el-input-number v-model="low" :min="0" :controls="false" placeholder="Lowest price"></el-input-number>
            </el-col>
            <el-col :span="4">
                <el-input-number v-model="high" :min="0" :controls="false" placeholder="Highest price"></el-input-number>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="24">
                <el-table
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
    </div>
</template>

<script>
export default {
name: "Home",
    data: () => ({
        input: "",
        bedrooms: null,
        bathrooms: null,
        garages: null,
        storeys: null,
        low: undefined,
        high: undefined,
        loading: false,
        houses: [],
        query: {}
    }),
    watch: {
        input: function (val) {
            console.log('changed')
            this.loading = true;
            this.query.name = val
            axios.get(`/houses`, {params: this.query})
            .then(res => {
                console.log(res.data)
                this.houses = res.data
                this.loading = false
            })
        },
        bedrooms: function (val) {
            this.loading = true;
            this.query.bedrooms = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
        },
        bathrooms: function (val) {
            this.loading = true;
            this.query.bathrooms = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
        },
        garages: function (val) {
            this.loading = true;
            this.query.garages = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
        },
        storeys: function (val) {
            this.loading = true;
            this.query.storeys = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
        },
        low: function (val, old) {
            if (val > this.high) {
                this.low = this.high - 1;
            }
            this.loading = true;
            this.query.low = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
        },
        high: function (val) {
            if (val < this.low) {
                this.high = this.low + 1
            }
            this.loading = true;
            this.query.high = val
            axios.get(`/houses`, {params: this.query})
                .then(res => {
                    console.log(res.data)
                    this.houses = res.data
                    this.loading = false
                })
        }
    },
    mounted() {
        this.loading = true
        axios.get(`/houses?name=${this.input}`)
            .then(res => {
                this.houses = res.data
                this.loading = false
            })
    }
}
</script>

<style scoped>

</style>
