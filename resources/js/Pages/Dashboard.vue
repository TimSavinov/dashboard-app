<template>
    <breeze-authenticated-layout>
        <template #header-nav>
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
               <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-5">

                  <TotalsCard  :title="`total users`"
                            :icon_1="usersIcon"
                            :icon_1_viewbox="usersIconViewbox"
                            :amount="$page.props.totals.users.count"
                            :progress="$page.props.totals.users.last"
                            :progress-title="`Registered this week`"></TotalsCard>

                   <TotalsCard :title="`courses`"
                            :icon_1="coursesIcon"
                            :icon_1_viewbox="coursesIconViewbox"
                            :amount="$page.props.totals.courses.count"
                            :progress="$page.props.totals.courses.last"
                            :showArrow="false"
                            :standardProgressColor="false"
                            :progress-title="`Created this week`"></TotalsCard>

                   <TotalsCard :title="`students`"
                            :icon_1="studentsIcon"
                            :icon_1_viewbox="studentsIconViewbox"
                            :amount="$page.props.totals.students.count"
                            :progress="$page.props.totals.students.last"
                            :progress-title="`Enrolled this week`"></TotalsCard>

                   <TotalsCard :title="`instructor`"
                            :icon_1="instructorIcon"
                            :icon_1_viewbox="instructorIconViewbox"
                            :amount="$page.props.totals.teachers.count"
                            :progress="$page.props.totals.teachers.last"
                            :progress-title="`Registered this week`"></TotalsCard>


               </div>
               {{ $page.props }}
               <highcharts :options="chartOptions"></highcharts>
           </div>
        </template>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import TotalsCard from '@/Components/DashboardElements/TotalsCard'
    import BreezeButton from '@/Components/Button'
    import {Chart} from 'highcharts-vue'


    export default {
        components: {
            BreezeAuthenticatedLayout,
            highcharts: Chart,
            BreezeButton,
            TotalsCard
        },

        data() {
            return {
                usersIconViewbox: `0 0 24 24`,
                coursesIconViewbox: `0 0 412.72 412.72`,
                studentsIconViewbox: `0 0 1000 1000`,
                instructorIconViewbox: `0 0 1000 1000`,
                usersIcon: `M 5.75 3 A 1.0001 1.0001 0 0 0 4.8867188 3.4960938 L 3.1367188 6.4960938 A
                1.0001 1.0001 0 0 0 3 7 L 3 19 C 3 20.093063 3.9069372 21 5 21 L 19 21 C 20.093063 21 21
                20.093063 21 19 L 21 7 A 1.0001 1.0001 0 0 0 20.863281 6.4960938 L 19.113281 3.4960938 A
                1.0001 1.0001 0 0 0 18.25 3 L 5.75 3 z M 6.3242188 5 L 17.675781 5 L 18.841797 7 L
                5.1582031 7 L 6.3242188 5 z M 5 9 L 19 9 L 19 19 L 5 19 L 5 9 z M 9 11 L 9 13 L 15
                13 L 15 11 L 9 11 z`,
                coursesIcon: `M404.72,82.944c-0.027,0-0.054,0-0.08,0h0h-27.12v-9.28c0.146-3.673-2.23-6.974-5.76-8
                c-18.828-4.934-38.216-7.408-57.68-7.36c-32,0-75.6,7.2-107.84,40c-32-33.12-75.92-40-107.84-40
                c-19.464-0.048-38.852,2.426-57.68,7.36c-3.53,1.026-5.906,4.327-5.76,8v9.2H8c-4.418,0-8,3.582-8,8v255.52c0,4.418,3.582,8,8,8
                c1.374-0.004,2.724-0.362,3.92-1.04c0.8-0.4,80.8-44.16,192.48-16h1.2h0.72c0.638,0.077,1.282,0.077,1.92,0
                c112-28.4,192,15.28,192.48,16c2.475,1.429,5.525,1.429,8,0c2.46-1.42,3.983-4.039,4-6.88V90.944
                C412.72,86.526,409.139,82.944,404.72,82.944z M16,333.664V98.944h19.12v200.64c-0.05,4.418,3.491,8.04,7.909,8.09
                c0.432,0.005,0.864-0.025,1.291-0.09c16.55-2.527,33.259-3.864,50-4c23.19-0.402,46.283,3.086,68.32,10.32
                C112.875,307.886,62.397,314.688,16,333.664z M94.32,287.664c-14.551,0.033-29.085,0.968-43.52,2.8V79.984
                c15.576-3.47,31.482-5.241,47.44-5.28c29.92,0,71.2,6.88,99.84,39.2l0.24,199.28C181.68,302.304,149.2,287.664,94.32,287.664z
                M214.32,113.904c28.64-32,69.92-39.2,99.84-39.2c15.957,0.047,31.863,1.817,47.44,5.28v210.48
                c-14.354-1.849-28.808-2.811-43.28-2.88c-54.56,0-87.12,14.64-104,25.52V113.904z M396.64,333.664
                c-46.496-19.028-97.09-25.831-146.96-19.76c22.141-7.26,45.344-10.749,68.64-10.32c16.846,0.094,33.663,1.404,50.32,3.92
                c4.368,0.663,8.447-2.341,9.11-6.709c0.065-0.427,0.095-0.859,0.09-1.291V98.944h19.12L396.64,333.664z`,
                studentsIcon: `M944.1,982.3H300.9c-25.4,0-45.9-20.6-45.9-45.9c0-65.9,27.8-145.7,74.4-213.4c38.9-56.6,86.8
                -99.2,138.5-124c-22.8-20.7-42.4-46-57.9-74.8c-24.9-46.2-38-99.6-38-154.4c0-76.2,25.1-148.2,70.6-202.7c47.5
                -56.9,111.4-88.2,180-88.2s132.4,31.3,180,88.2c45.5,54.5,70.6,126.5,70.6,202.7c0,54.8-13.2,108.2-38,154.4c
                -15.5,28.8-35.1,54.1-57.9,74.8c51.7,24.9,99.5,67.5,138.5,124c46.6,67.7,74.4,147.5,74.4,213.4C990,961.8,
                969.4,982.3,944.1,982.3z M352.7,890.5h539.6c-8.8-37.6-27.3-78.8-52.4-115.3c-39.7-57.6-89.2-95.3-139.4-106.2c-21.2-4.6-36.3-23.3-36.3-44.9v-32.8c0-16.5,
                8.9-31.8,23.2-39.9c56.9-32.4,93.7-103.6,93.7-181.5c0-109.8-71.2-199.1-158.7-199.1s-158.7,89.3-158.7,
                199.1c0,77.9,36.8,149.1,93.7,181.5c14.4,8.2,23.2,23.4,23.2,39.9v32.8c0,21.6-15.1,40.3-36.3,44.9c-50.2,
                10.8-99.7,48.5-139.4,106.2C380,811.6,361.5,852.8,352.7,890.5z M198.6,829.2h-91c8.8-37.6,27.3-78.8,
                52.4-115.3c39.7-57.6,89.2-95.3,139.4-106.2c21.2-4.6,36.3-23.3,36.3-44.9V530c0-16.5-8.9-31.8-23.2-39.9c-56.9-32.4-93.7-103.6-93.7-181.5c0-109.8,
                71.2-199.1,158.7-199.1c6,0,11.9,0.4,17.7,1.2c25.2-28.1,53.8-50.9,84.8-68c-31.8-16.5-66.5-25.2-102.5-25.2c-68.5,0-132.4,
                31.3-180,88.2c-45.5,54.5-70.6,126.5-70.6,202.7c0,54.8,13.2,108.2,38,154.4c15.5,28.8,35.1,54,57.9,
                74.8c-51.7,24.9-99.5,67.5-138.5,124C37.8,729.5,10,809.3,10,875.2c0,25.4,20.6,45.9,45.9,45.9h126.7C184,
                891.4,189.5,860.4,198.6,829.2L198.6,829.2z`,
                instructorIcon: `M990,718c0-17.6-14.3-32-32-32c-8.7,0-16.6,3.5-22.4,9.1l-0.2-0.2L763.7,866.7l-99-99l-0.6,
                0.7c-5.7-4.4-12.9-7-20.6-7c-18.8,0-34,15.2-34,34c0,10.9,5.1,20.6,13.1,26.8l116.9,116.9c0.1,0.1,0.2,0.2,
                0.3,0.3c0.1,0.1,0.2,0.2,0.3,0.3l2,2l0.1-0.1c10.7,8.5,26,8.2,36.4-0.8l0,0c0.5-0.4,0.9-0.8,1.4-1.3c0.4-0.4,
                0.8-0.8,1.2-1.2l196.8-194.9l-0.1-0.2C985.2,737.2,990,728.2,990,718z M638.3,694.8c7.3,9.1,18.6,15,31.2,
                15c22.1,0,39.8-17.9,40.1-40.1c0.2-12.3-5-23.9-16.4-34.7l0,0C652,597.3,603,568,549,549.7c79.9-46,
                133.7-132.2,133.7-231c0-147.1-119.3-266.4-266.6-266.4c-147.2,0-266.6,119.3-266.6,266.4c0,99,54.1,185.5,
                134.4,231.4C138.3,599.9,29.7,729.3,10,886.4h0c0,25.5,20.7,46.1,46.1,46.1c25.5,0,43.6-20.7,43.6-46.1h0c23.4-156,
                158-275.6,320.6-275.6c83.9,0,160.4,31.9,217.9,84.1C638.3,694.8,638.3,694.8,638.3,694.8z M420.3,
                499.1c-104.9,0-189.9-85-189.9-189.9c0-104.9,85-189.9,189.9-189.9s189.9,85,189.9,189.9C610.1,414.1,
                525.1,499.1,420.3,499.1z`,
                chartOptions: {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Fruit Consumption'
                    },
                    xAxis: {
                        categories: ['Apples', 'Bananas', 'Oranges']
                    },
                    yAxis: {
                        title: {
                            text: 'Fruit eaten'
                        }
                    },
                    series: [{
                        name: 'Jane',
                        data: [1, 0, 4]
                    }, {
                        name: 'John',
                        data: [5, 7, 3]
                    }]
                }
            }
        },
        methods:{

        }
    }
</script>
