<script setup lang="ts">
import { ref, onMounted } from 'vue';

interface Property {
    id: number;
    name: string;
    price: number;
    bedrooms: number;
    bathrooms: number;
    storeys: number;
    garages: number;
    created_at: string;
}

interface Filters {
    name: string;
    price_min: number | null;
    price_max: number | null;
    bedrooms: number | null;
    bathrooms: number | null;
    storeys: number | null;
    garages: number | null;
}

const properties = ref<Property[]>([]);
const loading = ref(false);

const filters = ref<Filters>({
    name: '',
    price_min: null,
    price_max: null,
    bedrooms: null,
    bathrooms: null,
    storeys: null,
    garages: null
});

const fetchProperties = async () => {
    try {
        loading.value = true;

        const params = new URLSearchParams();

        if (filters.value.name) params.append('name', filters.value.name);
        if (filters.value.price_min) params.append('price_min', filters.value.price_min.toString());
        if (filters.value.price_max) params.append('price_max', filters.value.price_max.toString());
        if (filters.value.bedrooms) params.append('bedrooms', filters.value.bedrooms.toString());
        if (filters.value.bathrooms) params.append('bathrooms', filters.value.bathrooms.toString());
        if (filters.value.storeys) params.append('storeys', filters.value.storeys.toString());
        if (filters.value.garages) params.append('garages', filters.value.garages.toString());

        const response = await fetch(`/api/properties?${params.toString()}`);
        properties.value = await response.json();
    } catch (error) {
        console.error('Error fetching properties:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchProperties();
});
</script>

<template>
    <div class="properties-container">
        <el-card class="filter-card">
            <el-form :model="filters" label-position="top">
                <el-row :gutter="20">
                    <el-col :span="12">
                        <el-form-item label="Name">
                            <el-input
                                v-model="filters.name"
                                placeholder="Name"
                                @input="fetchProperties"
                                clearable
                            />
                        </el-form-item>
                    </el-col>
                    <el-col :span="6">
                        <el-form-item label="Min price">
                            <el-input-number
                                v-model="filters.price_min"
                                :min="0"
                                placeholder="Min price"
                                @change="fetchProperties"
                                style="width: 100%"
                            />
                        </el-form-item>
                    </el-col>

                    <el-col :span="6">
                        <el-form-item label="Max price">
                            <el-input-number
                                v-model="filters.price_max"
                                :min="0"
                                placeholder="Max price"
                                @change="fetchProperties"
                                style="width: 100%"
                            />
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :span="6">
                        <el-form-item label="Bedrooms">
                            <el-input-number
                                v-model="filters.bedrooms"
                                :min="0"
                                placeholder="Bedrooms"
                                @change="fetchProperties"
                                style="width: 100%"
                            />
                        </el-form-item>
                    </el-col>
                    <el-col :span="6">
                        <el-form-item label="Bathrooms">
                            <el-input-number
                                v-model="filters.bathrooms"
                                :min="0"
                                placeholder="Bathrooms"
                                @change="fetchProperties"
                                style="width: 100%"
                            />
                        </el-form-item>
                    </el-col>

                    <el-col :span="6">
                        <el-form-item label="Storeys">
                            <el-input-number
                                v-model="filters.storeys"
                                :min="0"
                                @change="fetchProperties"
                                placeholder="Storeys"
                                style="width: 100%"
                            />
                        </el-form-item>
                    </el-col>

                    <el-col :span="6">
                        <el-form-item label="Garages">
                            <el-input-number
                                v-model="filters.garages"
                                :min="0"
                                @change="fetchProperties"
                                placeholder="Garages"
                                style="width: 100%"
                            />
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>

            <el-table
                :data="properties"
                v-loading="loading"
                stripe
                style="margin-top: 20px"
            >
                <template #empty>
                    No results found
                </template>
                <el-table-column prop="id" label="ID" />
                <el-table-column prop="name" label="Name" />
                <el-table-column prop="price" label="Price" />
                <el-table-column prop="bedrooms" label="Bedrooms" />
                <el-table-column prop="bathrooms" label="Bathrooms" />
                <el-table-column prop="storeys" label="Storeys" />
                <el-table-column prop="garages" label="Garages" />
            </el-table>
        </el-card>
    </div>
</template>

<style scoped>
.properties-container {
    min-height: 100vh;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.filter-card {
    margin-bottom: 20px;
}
</style>