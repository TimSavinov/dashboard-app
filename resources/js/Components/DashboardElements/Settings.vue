<template>

    <div>
        <div class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="relative mx-auto w-full mt-24">
                <!--content-->
                <div class="border-2 rounded-lg relative flex flex-col bg-white mx-4 my-4 py-10 px-4">

                    <button class="w-10 h-10 right-0 top-0 text-xl absolute mb-4 mt-2 border-2 border-gray-500 mr-2 rounded-full
                                    bg-gray-200" type="button" @click="$emit('closeSettings')">X</button>

                    <span class="h-10 w-5/6 ml-24 text-center left-0 top-0 text-lg absolute my-4">Here you can change the title, resize or toggle the monitors</span>

                    <button class="w-20 h-10 left-0 top-0 text-xl absolute mb-4 mt-2 border-2 border-gray-500 ml-2 rounded-md
                            bg-gray-200"
                            type="button"
                            @click="apply">Apply
                    </button>

                    <div class="flex justify-between">
<!--totals-->
                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 22%; height: 200px;">
                            <div class="flext-col items-center mt-2">
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Title:</span>
                                    <input v-model="items.totals.users_total.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                </div>
                                <div class="text-center mt-2">
                                    <div class="flex justify-center items-center text-lg" @click="items.totals.users_total.toggle = !items.totals.users_total.toggle">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.totals.users_total.toggle}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.totals.users_total.toggle}"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center justify-center text-lg my-2">
                                    <span class="mb-1">Height:</span>
                                    <input v-model="items.totals.users_total.sizes.height"
                                           oninput = "value=value.replace(/[^\d]/g,'')"
                                           maxlength="3"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>

                                </div>
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Width:</span>
                                    <input v-model="items.totals.users_total.sizes.width"
                                           oninput = "value=value.replace(/[^\d]/g,'')"
                                           maxlength="3"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>
                                </div>

                            </div>
                        </div>

                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 22%; height: 200px;">
                            <div class="flext-col items-center mt-2">
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Title:</span>
                                    <input v-model="items.totals.courses_total.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                </div>
                                <div class="text-center mt-2">
                                    <div class="flex justify-center items-center text-lg" @click="items.totals.courses_total.toggle = !items.totals.courses_total.toggle">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.totals.courses_total.toggle}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.totals.courses_total.toggle}"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center justify-center text-lg my-2">
                                    <span class="mb-1">Height:</span>
                                    <input v-model="items.totals.courses_total.sizes.height"
                                           oninput = "value=value.replace(/[^\d]/g,'')"
                                           maxlength="3"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>
                                </div>
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Width:</span>
                                    <input v-model="items.totals.courses_total.sizes.width"
                                           oninput = "value=value.replace(/[^\d]/g,'')"
                                           maxlength="3"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>
                                </div>

                            </div>
                        </div>

                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 22%; height: 200px;">
                            <div class="flext-col items-center mt-2">
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Title:</span>
                                    <input v-model="items.totals.students_total.title"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                </div>
                                <div class="text-center mt-2">
                                    <div class="flex justify-center items-center text-lg"
                                         @click="items.totals.students_total.toggle = !items.totals.students_total.toggle">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out"
                                             :class="{ 'bg-green-400': items.totals.students_total.toggle}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out"
                                                 :class="{ 'translate-x-4': items.totals.students_total.toggle}"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center justify-center text-lg my-2">
                                    <span class="mb-1">Height:</span>
                                    <input v-model="items.totals.students_total.sizes.height"
                                           oninput="value=value.replace(/[^\d]/g,'')"
                                           maxlength="3"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>
                                </div>
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Width:</span>
                                    <input v-model="items.totals.students_total.sizes.width"
                                           oninput="value=value.replace(/[^\d]/g,'')"
                                           maxlength="3"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>
                                </div>

                            </div>
                        </div>

                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 22%; height: 200px;">
                            <div class="flext-col items-center mt-2">
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Title:</span>
                                    <input v-model="items.totals.instructors_total.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                </div>
                                <div class="text-center mt-2">
                                    <div class="flex justify-center items-center text-lg" @click="items.totals.instructors_total.toggle = !items.totals.instructors_total.toggle">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.totals.instructors_total.toggle}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.totals.instructors_total.toggle}"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center justify-center text-lg my-2">
                                    <span class="mb-1">Height:</span>
                                    <input v-model="items.totals.instructors_total.sizes.height"
                                           oninput="value=value.replace(/[^\d]/g,'')"
                                           maxlength="3"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>
                                </div>
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Width:</span>
                                    <input v-model="items.totals.instructors_total.sizes.width"
                                           oninput="value=value.replace(/[^\d]/g,'')"
                                           maxlength="3"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="flex">
                    <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 70%; height: 200px;">
                        <div class="flext-col items-center mt-2">
                            <div class="text-center justify-center text-lg">
                                <span class="mb-1">Title:</span>
                                <input v-model="items.chart_1.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center px-2">
                            </div>
                            <div class="text-center mt-2">
                                <div class="flex justify-center items-center text-lg" @click="items.chart_1.toggle = !items.chart_1.toggle">
                                    <h2>Toggle:</h2>
                                    <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.chart_1.toggle}">
                                        <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.chart_1.toggle}"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center justify-center text-lg my-2">
                                <span class="mb-1">Height:</span>
                                <input v-model="items.chart_1.sizes.height"
                                       oninput="value=value.replace(/[^\d]/g,'')"
                                       maxlength="3"
                                       class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                <span class="mb-1 ml-2">px</span>
                            </div>
                            <div class="text-center justify-center text-lg">
                                <span class="mb-1">Width:</span>
                                <input v-model="items.chart_1.sizes.width"
                                       oninput="value=value.replace(/[^\d]/g,'')"
                                       maxlength="4"
                                       class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                <span class="mb-1 ml-2">px</span>
                            </div>

                        </div>
                    </div>

                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 30%; height: 200px;">
                            <div class="flext-col items-center mt-2">
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Title:</span>
                                    <input v-model="items.chart_2.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                </div>
                                <div class="text-center mt-2">
                                    <div class="flex justify-center items-center text-lg" @click="items.chart_2.toggle = !items.chart_2.toggle">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.chart_2.toggle}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.chart_2.toggle}"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center justify-center text-lg my-2">
                                    <span class="mb-1">Height:</span>
                                    <input v-model="items.chart_2.sizes.height"
                                           oninput="value=value.replace(/[^\d]/g,'')"
                                           maxlength="3"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>
                                </div>
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Width:</span>
                                    <input v-model="items.chart_2.sizes.width"
                                           oninput="value=value.replace(/[^\d]/g,'')"
                                           maxlength="3"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 100%; height: 200px;">
                            <div class="flext-col items-center mt-2">
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Title:</span>
                                    <input v-model="items.users.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                </div>
                                <div class="text-center mt-2">
                                    <div class="flex justify-center items-center text-lg" @click="items.users.toggle = !items.users.toggle">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.users.toggle}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.users.toggle}"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center justify-center text-lg my-2">
                                    <span class="mb-1">Height:</span>
                                    <input v-model="items.users.sizes.height"
                                           oninput="value=value.replace(/[^\d]/g,'')"
                                           maxlength="3"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>
                                </div>
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Width:</span>
                                    <input v-model="items.users.sizes.width"
                                           oninput="value=value.replace(/[^\d]/g,'')"
                                           maxlength="4"
                                           class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                    <span class="mb-1 ml-2">px</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 30%; height: 200px;">
                                <div class="flext-col items-center mt-2">
                                    <div class="text-center justify-center text-lg">
                                        <span class="mb-1">Title:</span>
                                        <input v-model="items.instructors.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                    </div>
                                    <div class="text-center mt-2">
                                        <div class="flex justify-center items-center text-lg" @click="items.instructors.toggle = !items.instructors.toggle">
                                            <h2>Toggle:</h2>
                                            <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.instructors.toggle}">
                                                <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.instructors.toggle}"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center justify-center text-lg my-2">
                                        <span class="mb-1">Height:</span>
                                        <input v-model="items.instructors.sizes.height"
                                               oninput="value=value.replace(/[^\d]/g,'')"
                                               maxlength="3"
                                               class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                        <span class="mb-1 ml-2">px</span>
                                    </div>
                                    <div class="text-center justify-center text-lg">
                                        <span class="mb-1">Width:</span>
                                        <input v-model="items.instructors.sizes.width"
                                               oninput="value=value.replace(/[^\d]/g,'')"
                                               maxlength="3"
                                               class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                        <span class="mb-1 ml-2">px</span>
                                    </div>

                            </div>
                        </div>

                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 30%; height: 200px;">
                                <div class="flext-col items-center mt-2">
                                    <div class="text-center justify-center text-lg">
                                        <span class="mb-1">Title:</span>
                                        <input v-model="items.courses.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                    </div>
                                    <div class="text-center mt-2">
                                        <div class="flex justify-center items-center text-lg" @click="items.courses.toggle = !items.courses.toggle">
                                            <h2>Toggle:</h2>
                                            <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.courses.toggle}">
                                                <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.courses.toggle}"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center justify-center text-lg my-2">
                                        <span class="mb-1">Height:</span>
                                        <input v-model="items.courses.sizes.height"
                                               oninput="value=value.replace(/[^\d]/g,'')"
                                               maxlength="3"
                                               class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                        <span class="mb-1 ml-2">px</span>
                                    </div>
                                    <div class="text-center justify-center text-lg">
                                        <span class="mb-1">Width:</span>
                                        <input v-model="items.courses.sizes.width"
                                               oninput="value=value.replace(/[^\d]/g,'')"
                                               maxlength="3"
                                               class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                        <span class="mb-1 ml-2">px</span>
                                    </div>

                            </div>
                        </div>

                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 30%; height: 200px;">
                                <div class="flext-col items-center mt-2">
                                    <div class="text-center justify-center text-lg">
                                        <span class="mb-1">Title:</span>
                                        <input v-model="items.activities.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                    </div>
                                    <div class="text-center mt-2">
                                        <div class="flex justify-center items-center text-lg" @click="items.activities.toggle = !items.activities.toggle">
                                            <h2>Toggle:</h2>
                                            <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.activities.toggle}">
                                                <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.activities.toggle}"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center justify-center text-lg my-2">
                                        <span class="mb-1">Height:</span>
                                        <input v-model="items.activities.sizes.height"
                                               oninput="value=value.replace(/[^\d]/g,'')"
                                               maxlength="3"
                                               class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                        <span class="mb-1 ml-2">px</span>
                                    </div>
                                    <div class="text-center justify-center text-lg">
                                        <span class="mb-1">Width:</span>
                                        <input v-model="items.activities.sizes.width"
                                               oninput="value=value.replace(/[^\d]/g,'')"
                                               maxlength="3"
                                               class="focus:outline-white focus:ring-transparent bg-white h-10 w-20 ml-4 border-gray-500 border-2 text-center">
                                        <span class="mb-1 ml-2">px</span>
                                    </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
</template>

<script>

export default {
    created() {
        this.getSettings();
    },
    data() {
        return {
            items: {
                totals: {
                    users_total: {
                        sizes: {
                            height: '',
                            width: '',
                        },
                        title: 'Users',
                        toggle: true,
                    },
                    courses_total: {
                        sizes: {
                            height: '',
                            width: '',
                        },
                        title: 'Courses',
                        toggle: true,
                    },
                    students_total: {
                        sizes: {
                            height: '',
                            width: '',
                        },
                        title: 'Students',
                        toggle: true,
                    },
                    instructors_total: {
                        sizes: {
                            height: '',
                            width: '',
                        },
                        title: 'Instructors',
                        toggle: true,
                    },
                },
                chart_1: {
                    sizes: {
                        height: '',
                        width: '',
                    },
                    title: 'Enrollments VS Completions',
                    toggle: true,
                },
                chart_2: {
                    sizes: {
                        height: '',
                        width: '',
                    },
                    title: 'Enrollment methods',
                    toggle: true,
                },
                users: {
                    sizes: {
                        height: '',
                        width: '',
                    },
                    title: 'Search users',
                    toggle: true,
                },
                instructors: {
                    sizes: {
                        height: '',
                        width: '',
                    },
                    title: 'Popular Instructor',
                    toggle: true,
                },
                courses: {
                    sizes: {
                        height: '',
                        width: '',
                    },
                    title: 'Recent Courses',
                    toggle: true,
                },
                activities: {
                    sizes: {
                        height: '',
                        width: '',
                    },
                    title: 'Activity',
                    toggle: true,
                }
            }
        }
    },

    methods: {
        //ajax call
        apply(){
            axios
            .post('settings/update', {settings: this.items})
            .then((res) => {
                if(res.data.success){
                    this.$emit('settingsChanged', {settings: this.items});
                    this.$emit('closeSettings');
                }
            });
        },

        getSettings() {
            axios
                .get('/settings')
                .then((res) => {
                    if(res.data.settings.length > 0) {
                        // CHECK LENGTH TO COVER THE FIRST LOAD
                        let settings = res.data.settings;
                        let setObject = {'totals': {}};
                        settings.forEach(function (set) {
                            let key = Object.keys(set);
                            if (key == 'users_total' || key == 'students_total' || key == 'courses_total' || key == 'instructors_total') {
                                setObject['totals'][key] = set[key];
                            } else {
                                setObject[key] = set[key];
                            }
                        });

                        this.items = JSON.parse(JSON.stringify(setObject));
                    }

                });
        },

    }

}
</script>
