<template>
    <form class="review-form" @submit.prevent="read">
        <label class="relative block w-1/2">
            <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Name..." type="text" v-model="name"/>
        </label>
        <label class="relative block w-1/2">
            <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Bedrooms..." type="text" v-model="bedrooms"/>
        </label>
        <label class="relative block w-1/2">
            <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Bathrooms..." type="text" v-model="bathrooms"/>
        </label>
        <label class="relative block w-1/2">
            <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Storeys..." type="text" v-model="storeys"/>
        </label>
        <label class="relative block w-1/2">
            <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Garages..." type="text" v-model="garages"/>
        </label>
        <label class="relative block w-1/2">
            <input class="placeholder:italic inline w-1/4 placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Price from..." type="text" v-model="priceFrom"/>
            <input class="placeholder:italic inline w-1/4 placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Price to..." type="text" v-model="priceTo"/>
        </label>
        <p>
            <input type="submit" value="Submit">
        </p>

    </form>
    <div v-for="house in this.houses" class="border-2 border-indigo-600">
        <div>Name: {{house.name}}</div>
        <div>Bedrooms: {{house.bedrooms}}</div>
        <div>Bathrooms: {{house.bathrooms}}</div>
        <div>Storeys: {{house.storeys}}</div>
        <div>Garages: {{house.garages}}</div>
        <div>Price: {{house.price}}</div>
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
            mute: false
        }
    },
    methods: {
       async read() {
            this.mute = true
            const { data } = await axios.get('/store/',{params: {
                name: this.name,
                bedrooms: this.bedrooms,
                bathrooms: this.bathrooms,
                storeys: this.storeys,
                garages: this.garages,
                priceFrom: this.priceFrom,
                priceTo: this.priceTo,
            }});
            this.mute = false
            this.houses = []
            data.forEach(house => this.houses.push(new House(house)));
        },
    }
}
</script>
