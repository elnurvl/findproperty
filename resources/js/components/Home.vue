<template>
    <div>
        <el-row>
            <el-col :span="12">
                <el-input placeholder="Please input" v-model="input"></el-input>
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
        loading: false,
        houses: []
    }),
    watch: {
        input: function (val) {
            console.log('changed')
            this.loading = true;
            axios.get(`/houses?name=${this.input}`)
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
