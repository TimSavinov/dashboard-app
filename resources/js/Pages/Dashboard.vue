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

               <div class="flex justify-between">
                   <div class="w-2/3 bg-white border-gray-100 border-2 rounded-md m-4">
                       <div class="flex my-4 px-4">
                           <div class="flex-1 pl-2">
                               <div class="text-gray-900 font-semibold text-left">
                                   Enrollments vs Completions
                               </div>
                           </div>
                       </div>
                       <hr class="boder-b-0 w-full"/>
                       <highcharts :options="firstChartOptions" class="w-full"></highcharts>
                   </div>

                   <div class="w-1/3 bg-white border-gray-100 border-2 rounded-md m-4">
                       <div class="flex my-4 px-4">
                           <div class="flex-1 pl-2">
                               <div class="text-gray-900 font-semibold text-left">
                                   Enrollment methods
                               </div>
                           </div>
                       </div>
                       <hr class="boder-b-0 w-full"/>
                       <highcharts :options="secondChartOptions" class="w-full"></highcharts>
                   </div>
               </div>

               <div class="mx-4">
                   <div class="border-2 rounded-md bg-white">
                   <div class="pt-2 relative mx-auto text-gray-600">
                       <button type="submit" class="absolute top-0 mt-5 ml-4" @click="searchUsersByName">
                           <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                                xml:space="preserve"
                                width="512px" height="512px">
                        <path
                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                         </svg>
                       </button>

                       <!--                       export-->
                       <button type="button" class="hover:border-blue-600 hover:shadow-md flex absolute top-0 right-0
                       mt-5 mr-32 border-2 rounded-md border-gray-200 w-20 px-2"
                       @click="exportAllUsers()">
                           <span class="pr-2 text-gray-600 text-sm">Export</span>
                           <svg  class="text-gray-600 text-sm" height="24px" width="24px" viewBox="0 0 512 512"
                                 xmlns="http://www.w3.org/2000/svg">
                               <path d="m409.785156 278.5-153.785156 153.785156-153.785156-153.785156 28.285156-28.285156 105.5 105.5v-355.714844h40v355.714844l105.5-105.5zm102.214844 193.5h-512v40h512zm0 0"/></svg>
                       </button>


                       <!--                       filter -->
                       <button type="button" class="hover:border-blue-600 hover:shadow-md flex absolute top-0 right-0
                       mt-5 mr-4 border-2 rounded-md border-gray-200 w-20 px-2"
                       @click="toggleFilterModal">
                           <span class="pr-2 text-gray-600 text-sm">Filter</span>
                           <svg class="text-gray-600 text-sm" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="0" fill="none" width="24" height="24"/><g><path d="M10 19h4v-2h-4v2zm-4-6h12v-2H6v2zM3 5v2h18V5H3z"/></g></svg>
                       </button>


                       <input class="focus:outline-white focus:ring-transparent border-none bg-white h-10 w-1/3 pl-10 text-sm"
                              type="search" name="search" placeholder="Search users" v-model="search" @keyup.enter="searchUsersByName">
                       <hr class="boder-b-0 ml-4 my-1 w-1/3"/>
                   </div>

                   <!--                   top-->
                   <div class="bg-blue-50">
                   <div class="flex items-center justify-between my-4 px-4 pt-4 text-center">
                       <div class="flex-1 pl-2">
                           <div class="text-gray-600 font-bold uppercase">
                               name
                           </div>
                       </div>
                       <div class="flex-1 pl-2">
                           <div class="text-gray-600 font-bold uppercase" @click="sortByEnrol">
                              enrollment
                           </div>
                       </div>
                       <div class="flex-1 pl-2">
                           <div class="text-gray-600 font-bold uppercase">
                               course
                           </div>
                       </div>
                       <div class="flex-1 pl-2">
                           <div class="text-gray-600 font-bold uppercase">
                               status
                           </div>
                       </div>
                       <div class="flex-1 pl-2">
                           <div class="text-gray-600 font-bold uppercase">
                               course progress
                           </div>
                       </div>
                       <div class="flex-1 pl-2">
                           <div class="text-gray-600 font-bold uppercase">
                               role
                           </div>
                       </div>
                           <div class="text-gray-600 font-bold uppercase">
                               Edit
                           </div>
                   </div>
                   <hr class="boder-b-0 my-4"/>
                   </div>
<!--                   top end-->

<!--                   item-->
                   <div class="flex items-center justify-between my-4 px-4" v-for="user in $page.props.users.init">
                       <div class="w-16">
                           <img class="w-12 h-12 rounded-full" src="https://source.unsplash.com/50x50/?water">
                       </div>
                       <div class="flex-1 pl-2">
                           <div class="text-gray-700 font-semibold">
                               {{ user.name }}
                           </div>
                           <div class="text-gray-600 font-thin">
                               {{ user.email }}
                           </div>
                       </div>
                       <div class="flex-1 pl-2">
                           <div class="text-gray-700 font-semibold">
                               {{ user.enroll_type || 'Undefined'}}
                           </div>
                           <div class="text-gray-600 font-thin">
                               {{ tsToDate(user.enroll_time) }}
                           </div>
                       </div>
                       <div class="flex-1 pl-2">
                           <div class="text-gray-600 font-thin">
                               {{ user.course || 'Undefined'  }}
                           </div>
                       </div>
                       <div class="flex-1 pl-2">
                           <div class="text-gray-600 font-thin">
                               <div class="flex" v-if="user.status === 1">
                                   <div
                                       class="h-4 w-4 mr-2 mt-1 z-2 border-2 border-white rounded-full bg-green-400"></div>
                                   Active
                               </div>
                                   <div class="flex" v-if="user.status === 0">
                                       <div
                                           class="h-4 w-4 mr-2 mt-1 z-2 border-2 border-white rounded-full bg-yellow-400"></div>
                                       Suspended
                                   </div>
                                       <div class="flex" v-if="user.status === null">
                                           <div
                                               class="h-4 w-4 mr-2 mt-1 z-2 border-2 border-white rounded-full bg-gray-400 "></div>
                                           Undefined
                                       </div>
                           </div>
                       </div>
                       <div class="flex-1 pl-2 relative">
                           <div class="text-gray-600 font-thin">
                               <div class="relative pt-1 px-2 flex items-center">
                                   <span>{{ user.progress ? user.progress : 0 }}%</span>
                                   <div class="overflow-hidden h-1 w-3/4 b-4 ml-4 text-xs flex rounded bg-green-200">
                                       <div :style="{width: user.progress ? user.progress + '%' : '1%'}"
                                            class="shadow-none flex flex-col text-center whitespace-nowrap
                                            text-white justify-center bg-green-500"></div>
                                   </div>
                               </div>
                           </div>
                       </div><div class="flex-1 pl-2">
                           <div class="text-gray-600 font-thin text-center">
                               {{ user.role || 'Undefined' }}
                           </div>
                       </div>
                       <div class="border-2 border-gray-300 text-gray-500 rounded-md w-16 text-right pr-2 ">
                           <a target="_blank" href="https://moodle.org/login/index.php" class="flex justify-center text-gray-500 fill-current">
                               <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    width="58.002px" height="58.002px" viewBox="0 0 58.002 58.002"
                                    xml:space="preserve"  class="w-4 h-4 mt-1 mr-1">
                                <g>
	                                <polygon points="8.083,52.088 9.672,53.645 36.425,26.959 30.979,21.513 4.168,48.256 5.763,49.818 	"/>
                                    <path d="M0.684,57.807l1.381-0.529L0.588,55.76l-0.52,1.409C-0.137,57.73,0.138,58.016,0.684,57.807z"/>
                                    <polygon points="7.676,55.012 8.513,54.193 3.658,49.441 2.793,50.288 1.183,54.446 3.363,56.58 	"/>
                                    <path d="M37.133,26.253l0.549,0.548c0.944-0.953,1.933-1.981,2.943-3.06l0.354,0.353l0.353,0.353l0.383,0.383L31.005,35.537
		                            c-0.391,0.391-0.391,1.023,0,1.414l0.155,0.154c0.391,0.392,1.024,0.392,1.414,0L48.24,21.44c0.391-0.391,0.391-1.024,0-1.414
		                            l-0.155-0.155c-0.391-0.391-1.023-0.391-1.414,0l-2.189,2.19L43.98,21.56l-0.353-0.352l-0.354-0.355
		                            c1.592-1.77,3.194-3.612,4.737-5.449c1.476-1.757,2.895-3.505,4.191-5.174c2.583-3.321,4.686-6.323,5.8-8.431l-1.673-1.672
		                            c-2.119,1.119-5.141,3.24-8.481,5.84c-2.356,1.834-4.869,3.909-7.339,6.041c-3.307,2.856-6.531,5.813-9.181,8.44l0.359,0.359
		                            L37.133,26.253z"/>
                                </g>
                               </svg>

<!--                           temprorary left site URL, for production case &#45;&#45; an API for USER editing / iframe with site should be added -->
                           Edit</a>
                       </div>
                   </div>
<!--                   item end-->
                   </div>
                   <div class="flex items-center justify-between mt-6 pb-6">
                       <div class="bg-white flex-col w-1/3 mx-3 px-5 border-2 border-gray-100 rounded-md">
                           <div class="flex my-4 px-4">
                               <div class="flex-1 pl-2">
                                   <div class="text-gray-900 font-semibold text-left">
                                       Popular Instructor
                                   </div>
                               </div>
                           </div>
                           <div v-for="instructor in $page.props.recents.instructors">
                           <hr class="boder-b-0 w-full"/>
                           <!--                           user-->
                           <div class="flex my-6 px-4">
                               <div class="w-16">
                                   <img class="w-12 h-12 rounded-full" src="https://source.unsplash.com/50x50/?nature">
                               </div>
                               <div class="flex-1 pl-2">
                                   <div class="text-gray-700 font-semibold">
                                       {{ instructor.name }}
                                   </div>
                                   <div class="text-gray-600 font-thin">
                                       <span class="font-bold">{{ instructor.courses }}</span> courses
                                       <span class="font-bold">{{ instructor.students }}</span> students
                                   </div>
                               </div>
                           </div>
                           </div>
                       </div>
                       <div class="bg-white flex-col w-1/3 mx-3 px-5 border-2 border-gray-100 rounded-md">
                           <div class="flex my-4 px-4">
                               <div class="flex-1 pl-2">
                                   <div class="text-gray-900 font-semibold text-left">
                                       Recent courses
                                   </div>
                               </div>
                           </div>
                           <div v-for="course in $page.props.recents.courses">
                           <hr class="boder-b-0 w-full"/>
                           <!--                           course-->
                           <div class="flex my-4 px-4">
                               <div class="w-50">
                                   <img class="w-40 h-16 rounded-md" src="https://source.unsplash.com/100x100/?tech">
                               </div>
                               <div class="flex-1 pl-2">
                                   <div class="text-gray-700 font-semibold">
                                      {{ course.name }}
                                   </div>
                                   <div class="text-gray-600 font-thin flex">
                                       <div class="w-6 mr-2">
                                           <img class="h-6 rounded-full" src="https://source.unsplash.com/50x50/?water">
                                       </div>
                                       {{ course.instructor }}
                                   </div>
                               </div>
                           </div>
                           </div>
                       </div>
                       <div class="bg-white flex-col w-1/3 mx-3 px-5 border-2 border-gray-100 rounded-md">
                           <div class="flex my-4 px-4">
                               <div class="flex-1 pl-2">
                                   <div class="text-gray-900 font-semibold text-left">
                                       Activity
                                   </div>
                               </div>
                           </div>
                           <hr class="boder-b-0 w-full"/>
                           <!--                           user-->
                           <div class="flex mt-4 px-4">
                               <div class="w-16">
                                   <img class="w-12 h-12 rounded-full" src="https://source.unsplash.com/50x50/?book">
                               </div>
                               <div class="flex-1 pl-2">
                                   <div class="text-gray-700 font-semibold text-sm">
                                       {{   $page.props.recents.activity[0].user }}
                                   </div>
                                   <div class="text-gray-600 font-thin">
                                       {{ getActivityText($page.props.recents.activity[0].type,
                                       $page.props.recents.activity[0].course,
                                       $page.props.recents.activity[0].score) }}
                                   </div>
                               </div>
                           </div>
                           <div class="text-gray-600 text-xs font-thin ml-20 mt-4 absolute">
                               {{ getTimeFromNowByTs($page.props.recents.activity[0].ts) }} ago
                           </div>

                           <!--connector line, maybe re-style for FOREACH loop-->
                           <div class="border-l-2 border-gray-200 h-20 absolute ml-10 pb-2 pt-5"></div>
                           <!--                           end user -->
                           <!--                           user-->
                           <div class="flex mt-20 px-4">
                               <div class="w-16">
                                   <img class="w-12 h-12 rounded-full" src="https://source.unsplash.com/50x50/?book">
                               </div>
                               <div class="flex-1 pl-2">
                                   <div class="text-gray-700 font-semibold text-sm">
                                       {{   $page.props.recents.activity[1].user }}
                                   </div>
                                   <div class="text-gray-600 font-thin">
                                       {{ getActivityText($page.props.recents.activity[1].type,
                                       $page.props.recents.activity[1].course,
                                       $page.props.recents.activity[1].score) }}
                                   </div>
                               </div>
                           </div>
                           <div class="text-gray-600 text-xs font-thin ml-20 mt-4 absolute">
                               {{ getTimeFromNowByTs($page.props.recents.activity[1].ts) }} ago
                           </div>

                           <div class="border-l-2 border-gray-200 h-16 absolute ml-10 pb-2 pt-5"></div>
                           <!--                           end user -->
                           <!--                           user-->
                           <div class="flex mt-16 px-4">
                               <div class="w-16">
                                   <img class="w-12 h-12 rounded-full" src="https://source.unsplash.com/50x50/?book">
                               </div>
                               <div class="flex-1 pl-2">
                                   <div class="text-gray-700 font-semibold text-sm">
                                       {{   $page.props.recents.activity[2].user }}
                                   </div>
                                   <div class="text-gray-600 font-thin">
                                       {{ getActivityText($page.props.recents.activity[2].type,
                                       $page.props.recents.activity[2].course,
                                       $page.props.recents.activity[2].score) }}
                                   </div>
                               </div>
                           </div>
                           <div class="text-gray-600 text-xs font-thin ml-20 mt-4 absolute">
                               {{ getTimeFromNowByTs($page.props.recents.activity[2].ts) }} ago
                           </div>

                           <div class="border-l-2 border-gray-200 h-16 absolute ml-10 pb-2 pt-5"></div>
                           <!--                           end user -->
                           <!--                           user-->
                           <div class="flex mt-16 mb-16 px-4">
                               <div class="w-16">
                                   <img class="w-12 h-12 rounded-full" src="https://source.unsplash.com/50x50/?book">
                               </div>
                               <div class="flex-1 pl-2">
                                   <div class="text-gray-700 font-semibold text-sm">
                                       {{   $page.props.recents.activity[3].user }}
                                   </div>
                                   <div class="text-gray-600 font-thin">
                                       {{ getActivityText($page.props.recents.activity[3].type,
                                       $page.props.recents.activity[3].course,
                                       $page.props.recents.activity[3].score) }}
                                   </div>
                               </div>
                               <div class="text-gray-600 text-xs font-thin ml-16 mt-20 absolute">
                                   {{ getTimeFromNowByTs($page.props.recents.activity[3].ts) }} ago
                               </div>
                           </div>

                           <!--                           end user -->
                       </div>
                   </div>

               </div>

<!--               {{ $page.props }}-->

<!--               modal-->
               <div>
                   <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
                       <div class="relative my-6 mx-auto w-full">
                           <!--content-->
                           <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-1/4 bg-white outline-none focus:outline-none float-right mr-4">
                               <!--header-->
                               <div
                                   class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                                   <h3 class="text-lg font-semibold">
                                       Filter Users
                                   </h3>
                                   <button class="p-1 ml-auto bg-transparent border-0 text-gray-600
                                   float-right text-lg font-semibold outline-none focus:outline-none"
                                           @click="toggleFilterModal">
                                    <span class="bg-transparent text-black h-6 w-6 text-lg block outline-none focus:outline-none"> X
                                        </span>
                                   </button>
                               </div>
                               <!--body-->
                               <div class="relative p-6 flex-col space-y-6">

                                   <div class="text-gray-600">
                                       <div class="relative w-full ">
                                           <span class="text-gray-600 text-xs uppercase font-bold">Role</span>
                                           <div class="flex items-center">
                                               <label class="text-gray-700">
                                                   <input class="form-checkbox text-blue-600"
                                                          type="checkbox"
                                                          v-model="filterResults.role.all"
                                                          @click="filterCheck"/>
                                                   <span class="ml-1">All</span>
                                               </label>
                                               <label class="text-gray-700 ml-20">
                                                   <input class="form-checkbox text-blue-600"
                                                          type="checkbox"
                                                          v-model="filterResults.role.students"
                                                          @click="filterCheck"/>
                                                   <span class="ml-1">Student</span>
                                               </label>
                                           </div>
                                       </div>
                                   </div>

                                   <div class="flex items-center justify-between">
                                       <label class="w-1/2">
                                           <span class="text-gray-600 text-xs uppercase font-bold">Enrollment method</span>
                                           <select class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border
                                       rounded-lg appearance-none focus:shadow-outline" v-model="filterResults.enroll">
                                           <option>Any</option>
                                           <option v-for="enroll in filter.enrolls">{{ enroll.enrol }}</option>
                                       </select>
                                       </label>
                                       <label class="w-1/2 mx-2">
                                           <span class="text-gray-600 text-xs uppercase font-bold">Status</span>
                                           <select class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border
                                       rounded-lg appearance-none focus:shadow-outline" v-model="filterResults.status">
                                               <option>Any status</option>
                                               <option>Active</option>
                                               <option>Suspended</option>
                                           </select>
                                       </label>
                                   </div>

                                   <div>
                                   <label class="mx-2 my-4">
                                       <span class="text-gray-600 text-xs uppercase font-bold">Course</span>
                                       <select class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border
                                       rounded-lg appearance-none focus:shadow-outline" v-model="filterResults.course">
                                           <option>Any course</option>
                                           <option v-for="course in filter.courses">{{ course.shortname }}</option>

                                       </select>
                                   </label>
                                   </div>

                               </div>
                               <!--footer-->
                               <div class="flex justify-center p-4">
                                   <button class="rounded-md text-white bg-blue-700 font-bold py-2 text-sm outline-none
                                   focus:outline-none w-4/5" type="button" @click="applyFilters">
                                       Apply
                                   </button>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
               </div>

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


        created(){
            this.getFilterInfo();
            this.getEnrollmentsAndCompletions();
        },

        data() {
            return {
                filterResults: {
                    role: {
                        all: true,
                        students: false
                    },
                    enroll: "Any",
                    status: "Any status",
                    course: "Any course"
                },
                search: '',
                filter: {},
                firstChartInfo: {},
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
                standardYear: {January: 0, February: 0, March: 0, April: 0, May: 0, June: 0, July: 0,
                    August: 0, September: 0, October: 0, November: 0, December: 0},
                firstChartOptions: {
                    chart: {
                        type: 'spline',
                        scrollablePlotArea: {
                            minWidth: 600,
                            scrollPositionX: 1
                        },
                    },
                    title: {
                        text: undefined,
                    },

                    yAxis: {
                        title: {
                            text: undefined
                        }
                    },

                    xAxis: {
                        // type: 'datetime',
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                        plotLines: [{
                            color: 'gray',
                            width: 1,
                            dashStyle: 'shortDash',
                            value: new Date().getMonth(),
                            label: {
                                text: 'Current month'
                            }
                        }],

                },
                    series: [{
                        name: 'Enrollments',
                        color: 'purple',
                        // adding dump data , just so it looks NICE
                        data: [0, 3, 2, 10, 5, 3]
                    }, {
                        name: 'Completions',
                        color: 'blue',
                        // same here --- adding dump data , just so it looks NICE
                        data: [5, 1, 16, 1, 8, 3]
                    }],
                    legend: {
                        enabled: false
                    },
                    responsive: {
                        rules: [{
                            condition: {
                                maxWidth: 500
                            },
                        }]
                    }

                },
                secondChartOptions: {
                    chart: {
                        type: 'pie'
                    },
                    title: {
                        text: undefined,
                    },
                    plotOptions: {
                        series: {
                            enableMouseTracking: false
                        },
                        pie: {
                            allowPointSelect: false,
                            shadow: false,
                            colors: ['#A312F6', '#6e57f5', '#cbc2fa', '#e7e3fd'],
                            center: ['50%', '50%'],
                            states: {
                                hover: {
                                    enabled: false
                                }
                            },
                            showInLegend: true
                        }
                    },
                    tooltip: {
                        enabled: false,
                    },
                    series: [{
                        name: 'Versions',
                        colorByPoint: true,
                        data: [{name: 'first', y: 30}, {name: 'second', y: 10}, {name: 'third', y: 50}, {name: 'fourth', y: 10}],
                        // borderWidth:0,
                        size: '100%',
                        innerSize: '80%',

                        dataLabels: {
                            enabled: false,
                        },
                        allowPointSelect: false,
                        stickyTracking: false,
                    }]
                },
                showModal: false
            }
        },
        methods:{
            setEnrollments(enrol){
                let exY = JSON.parse(JSON.stringify(this.standardYear));
                let yearEn = Object.assign(exY, enrol);
                this.firstChartOptions.series[0].data =  Object.values(yearEn);
            },

            setCompletions(complet){
                let exYt = JSON.parse(JSON.stringify(this.standardYear));
                let yearCom = Object.assign(exYt, complet);
                this.firstChartOptions.series[1].data =  Object.values(yearCom);
            },

            tsToDate(ts) {
                let res = '';
                if (!ts) res = 'Undefined';
                else {
                    let dateObj = new Date(ts * 1000);

                    let dd = dateObj.getDate();
                    let mm = dateObj.getMonth() + 1;
                    let yy = dateObj.getFullYear();

                    res = (dd < 10 ? dd = '0' + dd : dd) + '.'
                        + (mm < 10 ? mm = '0' + mm : mm) + '.' + yy
                }
                return res;
            },

            toggleFilterModal() {
                this.showModal = !this.showModal;
            },

            filterCheck() {
                this.filterResults.role.all = !this.filterResults.role.all; this.filterResults.role.students = !this.filterResults.role.students;
            },

            applyFilters() {
                this.toggleFilterModal();
                this.filterUsers();
                console.log('filters', this.filterResults);
            },



            // AJAX calls
            searchUsersByName() {
                axios
                    .post('/dashboard/search', {'query': this.search})
                    .then((res) => {
                        if(res.data.users.length > 0) {
                            this.$page.props.users.init = res.data.users;
                        } else { alert('Nothing found, please try another search query')}

                        console.log('ress', res.data.users.length);
                    });
                this.search = '';
            },

            getFilterInfo() {
                axios
                    .get('/dashboard/filter')
                    .then((res) => {
                        console.log('asdasdasd', res.data.filter_info);
                        this.filter = res.data.filter_info;
                    });
            },

            getEnrollmentsAndCompletions() {
                axios
                    .get('/dashboard/charts')
                    .then((res) => {
                        let firstChartInfo = res.data.chart_1;
                        this.setEnrollments(firstChartInfo.enrollments);
                        this.setCompletions(firstChartInfo.completions);

                        this.setSecondChart(res.data.chart_2);
                        console.log('res', res.data.chart_2);
                    });
            },

            exportAllUsers() {
                axios
                    .get('/dashboard/export-users')
                    .then((response) => {
                        const url = window.URL.createObjectURL(
                            new Blob([response.data], { type: "text/csv" })
                        );

                        // Create dynamic <a> element
                        const link = document.createElement("a");
                        link.href = url;
                        link.setAttribute("download", 'lms_users.csv');
                        document.body.appendChild(link);

                        link.click();
                    });
            },

            filterUsers() {
                axios
                .post('/dashboard/filter', this.filterResults)
                    .then((res) => {
                        console.log(res.data)
                    });
            },

            getActivityText(action, course, score=0) {
                let text = '';
                switch (action) {
                    case 'enroll':
                        text = 'Just started the course ' + course;
                        break;
                    case 'completion':
                        text = 'Completed the course '  + course;
                        break;
                    default:
                        text = 'Just graded from the course ' + course + ' with the score of ' + Math.trunc(score);
                }

                return text;
            },

            getTimeFromNowByTs(ts){
                // few records dont have a timestamp
                !ts ? ts = 1542743536 : '';
                let now = new Date()
                let old = new Date(ts * 1000);

                // displaying time in days cz most records are few years old, SHOULD BE ADJUSTED TO HOURS - MINUTES - MONTH
                // FILTER FOR THE REAL ON-LINE ACTIVITY CASES

                let timeDiff = now.getTime() - old.getTime();
                let daysDiff = timeDiff / (1000 * 3600 * 24);

                return Math.floor(daysDiff) + ' days'
            },

            setSecondChart(data){
                let chartData = [];
                for (const [key, value] of Object.entries(data)) {
                    let enrollType = {name: key, y: value };
                    chartData.push(enrollType);
                }

                this.secondChartOptions.series[0].data = chartData;
                console.log('chartData', chartData);

            }

        }
    }
</script>
