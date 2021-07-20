<template>
    <breeze-authenticated-layout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
                <breeze-button>
                    Settings
                </breeze-button>
            </div>
        </template>

        <template #dashboard-content>
           <div>
               {{ $page.props }}
           </div>
        </template>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import BreezeButton from '@/Components/Button'


    export default {
        components: {
            BreezeAuthenticatedLayout,
            BreezeButton,
        },
    }
</script>
