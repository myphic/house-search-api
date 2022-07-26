<template>
    <div class="grid grid-cols-2">
        <div>
            <form class="review-form" @submit.prevent="read">
                <div class="relative block">
                    <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Name..." type="text" v-model="name"/>
                </div>
                <div class="relative block">
                    <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Bedrooms..." type="text" v-model="bedrooms"/>
                </div>
                <div class="relative block">
                    <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Bathrooms..." type="text" v-model="bathrooms"/>
                </div>
                <div class="relative block">
                    <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Storeys..." type="text" v-model="storeys"/>
                </div>
                <div class="relative block">
                    <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Garages..." type="text" v-model="garages"/>
                </div>
                <div class="relative block">
                    <input class="placeholder:italic inline w-1/3 placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Price from..." type="text" v-model="priceFrom"/>
                    <input class="placeholder:italic inline w-1/3 placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Price to..." type="text" v-model="priceTo"/>
                </div>
                <div>
                    <input type="submit" class="bg-blue-500 cursor-pointer hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" value="Submit">
                </div>
            </form>
        </div>
        <div>
            <div v-if="loading">Loading...</div>
            <div v-else-if="error">No data found.</div>
            <div v-else v-for="house in this.houses" class="border-2 border-indigo-600 my-4">
                <div>Name: {{house.name}}</div>
                <div>Bedrooms: {{house.bedrooms}}</div>
                <div>Bathrooms: {{house.bathrooms}}</div>
                <div>Storeys: {{house.storeys}}</div>
                <div>Garages: {{house.garages}}</div>
                <div>Price: {{house.price}}</div>
            </div>
        </div>
    </div>
</template>
<script>
function House({ id, name, price, bedrooms, bathrooms, garages, storeys, priceFrom, priceTo}) {
    this.id = id;
    this.name = name;
    this.price = price;
    this.bedrooms = bedrooms;
    this.bathrooms = bathrooms;
    this.garages = garages;
    this.storeys = storeys;
    this.priceFrom = priceFrom;
    this.priceTo = priceTo;
}
export default {
    data() {
        return {
            houses: [],
            name: null,
            bedrooms: null,
            bathrooms: null,
            storeys: null,
            garages: null,
            priceFrom: null,
            priceTo: null,
            loading: false,
            error: false,
        }
    },
    methods: {
       async read() {
            this.loading = true;
            const { data } = await axios.get('/store/',{params: {
                name: this.name || null,
                bedrooms: this.bedrooms || null,
                bathrooms: this.bathrooms || null,
                storeys: this.storeys || null,
                garages: this.garages || null,
                priceFrom: this.priceFrom || null,
                priceTo: this.priceTo || null,
            }});
            this.loading = false;
            this.houses = [];

            data.forEach(house => this.houses.push(new House(house)));
            this.error = this.houses.length === 0;
        },
    }
}
</script>
