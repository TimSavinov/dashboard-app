<template>
    <div class="bg-white rounded-md" :style="{'width': width, 'height': height, 'min-height': minHeight, 'min-width': minWidth}">
        <div class="py-2">
            <div class="flex justify-between px-4">
                <div class="text-gray-600 uppercase text-sm font-bold">{{ title }}</div>
                <svg class="text-purple-500 fill-current h-6 w-6" :viewBox="icon_1_viewbox">
                    <path :d="icon_1"/>
                </svg>
            </div>
            <div class="text-gray-900 text-xl font-bold px-4 py-2">{{ amount }}</div>
            <div class="flex justify-start px-4">
                <svg v-if="showArrow" class="text-green-500 fill-current h-6 w-6" viewBox="0 0 512 512" >
                    <path d="m63.633 422-63.633-63.633 192.997-193 90 90 103.945-103.945-30.454-30.425 155.512-30.997-31 155.509-30.425-30.454-167.578 167.578-90-90z"/>
                </svg>
                <span class="font-bold" :class="standardProgressColor ? `text-green-500 px-2` : `text-red-800`">
                    {{ standardProgressColor ? '+' : ''}}{{ progress | 0 }}{{ standardProgressColor ? '' : '+'}}</span>
                <div class="text-gray-600 px-1">{{ progressTitle }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        width: String,
        height: String,
        icon_1: String,
        icon_1_viewbox: String,
        amount: Number,
        progress: Number | Array,
        progressTitle: String,
        showArrow: {
            type: Boolean,
            default: true,
        },
        standardProgressColor: {
            type: Boolean,
            default: true,
        },
    },
    data() {
        return {
            minWidth: '130px',
            minHeight: '120px',
        }
    }
}
</script>
