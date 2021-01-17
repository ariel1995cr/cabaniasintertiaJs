<template>
<div class="flex flex-col h-screen">
    <Header></Header>
    <div class="bg-gray-600 flex-grow">
        <div class="flex flex-col text-gray-300 justify-center pt-8 sm:justify-start sm:pt-0">
            <div class="flex-1 text-center"> 
                <p class="font-black tracking-widest text-7xl">Bienvenidos a {{data.nombreComplejo}}</p>
            </div>
            <div class="grid grid-cols-6 gap-4">
            <div class="col-start-2 col-span-4" v-if="images != null">
                <Galleria :value="images" :responsiveOptions="responsiveOptions" :numVisible="3" style="max-width: 100%;"
                :showThumbnails="false" :showIndicators="true" :changeItemOnIndicatorHover="true" :showIndicatorsOnItem="true" :autoPlay="true" :transitionInterval="2000">
                <template #item="slotProps">
                    <img :src="slotProps.item.itemImageSrc" :alt="slotProps.item.alt" style="width: 80%; display: block;" />
                </template>
                </Galleria>
            </div>
            <div class="col-start-2 border-t-2 border-gray-300 border-opacity-75 col-span-4">             
                <p class="font-mono whitespace-normal italic text-justify text-gray-300 text-xl">
                   {{data.descripcion }}
                </p>
            </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-700 ">footer</div>
</div>
</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script>
import Header from '../Layouts/Header.vue'
import Galleria from 'primevue/galleria';
    export default {
        components:{
            Header,
            Galleria
        },
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
            data: Object,
        },
        data(){
            return{
                images:[
                    {
                        "itemImageSrc": "http://cabanias.test/storage/cabanias/1.jpeg",
                        "thumbnailImageSrc": "http://cabanias.test/storage/cabanias/1.jpeg",
                        "alt": "Description for Image 1",
                        "title": "Title 1"
                    },
                    {
                        "itemImageSrc": "http://cabanias.test/storage/cabanias/2.jpeg",
                        "thumbnailImageSrc": "http://cabanias.test/storage/cabanias/2.jpeg",
                        "alt": "Description for Image 1",
                        "title": "Title 1"
                    },
                    {
                        "itemImageSrc": "http://cabanias.test/storage/cabanias/3.jpg",
                        "thumbnailImageSrc": "http://cabanias.test/storage/cabanias/3.jpg",
                        "alt": "Description for Image 1",
                        "title": "Title 1"
                    },
                ],
                responsiveOptions: [
				{
                    breakpoint: '1024px',
                    numVisible: 3
                },
                {
                    breakpoint: '960px',
                    numVisible: 3
                },
                {
                    breakpoint: '768px',
                    numVisible: 3
                },
                {
                    breakpoint: '560px',
                    numVisible: 1
                }
			    ],
            }
        }
    }
</script>
