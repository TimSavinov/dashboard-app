<template>

    <div>
        <div class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="relative mx-auto w-full mt-24">
                <!--content-->
                <div class="border-2 rounded-lg relative flex flex-col bg-white mx-4 my-4 py-10 px-4">

                    <button class="w-10 h-10 right-0 top-0 text-xl absolute mb-4 mt-2 border-2 border-gray-500 mr-2 rounded-full
                                    bg-gray-200" type="button" @click="$emit('closeSettings')">X</button>

                    <button class="w-20 h-10 left-0 top-0 text-xl absolute mb-4 mt-2 border-2 border-gray-500 ml-2 rounded-md
                            bg-gray-200"
                            type="button"
                            @click="">Apply
                    </button>

                    <div class="flex justify-between">
<!--totals-->
                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 22%; height: 200px;">
                            <div class="flext-col items-center mt-2">
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Title:</span>
                                    <input v-model="items.totals.users.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                </div>
                                <div class="text-center mt-2">
                                    <div class="flex justify-center items-center text-lg" @click="items.totals.users.show = !items.totals.users.show">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.totals.users.show}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.totals.users.show}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 22%; height: 200px;">
                            <div class="flext-col items-center mt-2">
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Title:</span>
                                    <input v-model="items.totals.courses.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                </div>
                                <div class="text-center mt-2">
                                    <div class="flex justify-center items-center text-lg" @click="items.totals.courses.show = !items.totals.courses.show">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.totals.courses.show}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.totals.courses.show}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 22%; height: 200px;">
                            <div class="flext-col items-center mt-2">
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Title:</span>
                                    <input v-model="items.totals.students.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                </div>
                                <div class="text-center mt-2">
                                    <div class="flex justify-center items-center text-lg" @click="items.totals.students.show = !items.totals.students.show">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.totals.students.show}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.totals.students.show}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 22%; height: 200px;">
                            <div class="flext-col items-center mt-2">
                                <div class="text-center justify-center text-lg">
                                    <span class="mb-1">Title:</span>
                                    <input v-model="items.totals.instructor.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                                </div>
                                <div class="text-center mt-2">
                                    <div class="flex justify-center items-center text-lg" @click="items.totals.instructor.show = !items.totals.instructor.show">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.totals.instructor.show}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.totals.instructor.show}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex">
                    <div class="m-4 border-2 border-gray-700 rounded-md" style="width: 70%; height: 200px;">
                        <div class="flext-col items-center mt-2">
                            <div class="text-center justify-center text-lg">
                                <span class="mb-1">Title:</span>
                                <input v-model="items.chart_1.title" class="focus:outline-white focus:ring-transparent bg-white h-10 w-auto ml-4 border-gray-500 border-2 text-center">
                            </div>
                            <div class="text-center mt-2">
                                <div class="flex justify-center items-center text-lg" @click="items.chart_1.show = !items.chart_1.show">
                                    <h2>Toggle:</h2>
                                    <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.chart_1.show}">
                                        <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.chart_1.show}"></div>
                                    </div>
                                </div>
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
                                    <div class="flex justify-center items-center text-lg" @click="items.chart_2.show = !items.chart_2.show">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.chart_2.show}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.chart_2.show}"></div>
                                        </div>
                                    </div>
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
                                    <div class="flex justify-center items-center text-lg" @click="items.users.show = !items.users.show">
                                        <h2>Toggle:</h2>
                                        <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.users.show}">
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.users.show}"></div>
                                        </div>
                                    </div>
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
                                        <div class="flex justify-center items-center text-lg" @click="items.instructors.show = !items.instructors.show">
                                            <h2>Toggle:</h2>
                                            <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.instructors.show}">
                                                <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.instructors.show}"></div>
                                            </div>
                                        </div>
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
                                        <div class="flex justify-center items-center text-lg" @click="items.courses.show = !items.courses.show">
                                            <h2>Toggle:</h2>
                                            <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.courses.show}">
                                                <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.courses.show}"></div>
                                            </div>
                                        </div>
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
                                        <div class="flex justify-center items-center text-lg" @click="items.activities.show = !items.activities.show">
                                            <h2>Toggle:</h2>
                                            <div class="ml-4 w-8 h-5 flex items-center bg-gray-300 rounded-full duration-300 ease-in-out" :class="{ 'bg-green-400': items.activities.show}">
                                                <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-4': items.activities.show}"></div>
                                            </div>
                                        </div>
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
    data() {
        return {
            items: {
                totals: {
                    users: {
                        sizes: {},
                        title: 'Users',
                        show: true,
                    },
                    courses: {
                        sizes: {},
                        title: 'Courses',
                        show: true,
                    },
                    students: {
                        sizes: {},
                        title: 'Students',
                        show: true,
                    },
                    instructor: {
                        sizes: {},
                        title: 'Instructors',
                        show: true,
                    },
                },
                chart_1: {
                    sizes: {},
                    title: 'Enrollments VS Completions',
                    show: true,
                },
                chart_2: {
                    sizes: {},
                    title: 'Enrollment methods',
                    show: true,
                },
                users: {
                    sizes: {},
                    title: 'Search users',
                    show: true,
                },
                instructors: {
                    sizes: {},
                    title: 'Popular Instructor',
                    show: true,
                },
                courses: {
                    sizes: {},
                    title: 'Recent Courses',
                    show: true,
                },
                activities: {
                    sizes: {},
                    title: 'Activity',
                    show: true,
                }
            }
        }
    }

}
</script>
