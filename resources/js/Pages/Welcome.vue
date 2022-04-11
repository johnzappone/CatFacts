<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

/*
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
*/

const form = useForm({
    catfacts: 1,
});

// placeholders for data
let hasFacts = false;
let factList = [];

const submit = () => {
    let tempValue = form.catfacts;

    fetch("/api/cats/" + tempValue, {
        method: "GET",
    })
        .then((response) => {
            if (response.ok) {
                return response.json();
            } else {
                // error handling //console.log(response);
            }
        })
        .then((response) => {
            factList = response.data;
            hasFacts = true;

            // trick to update vdom. need a better solution.
            form.reset();
            form.catfacts = tempValue;
        })
        .catch((err) => {
            console.log(err);
        });
};
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
    >
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div
                class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
            >
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div
                            class="flex justify-center pt-8 sm:justify-start sm:pt-0"
                        >
                            <img
                                src="/img/cat.svg"
                                class="h-16 w-auto sm:h-20"
                            />
                            <p class="p-6">
                                A little birdie told me you wanted to know some
                                facts about Cats.
                            </p>
                        </div>

                        <div
                            class="text-center text-lg leading-7 font-semibold"
                        >
                            How many facts can you handle?
                        </div>

                        <div
                            class="text-center mt-2 text-gray-600 dark:text-gray-400 text-sm"
                        >
                            <form @submit.prevent="submit">
                                <div>
                                    <input
                                        type="number"
                                        id="catfacts"
                                        name="catfacts"
                                        v-model="form.catfacts"
                                        value="1"
                                        min="1"
                                        max="100"
                                        class="shadow appearance-none border rounded py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                    />
                                </div>

                                <div>
                                    <button
                                        type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                    >
                                        Get the facts right meow
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div
                        class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l"
                    >
                        <div class="text-lg leading-7 font-semibold">
                            Just the facts
                        </div>
                        <div
                            class="mt-2 text-gray-600 dark:text-gray-400 text-sm"
                        >
                            <ul v-if="hasFacts">
                                <li
                                    v-for="(factItem, index) in factList"
                                    :key="`factItem-${index}`"
                                    class="mb-4"
                                >
                                    <b class="mr-2">Fact #{{ index + 1 }}</b>
                                    {{ factItem.fact }}
                                </li>
                            </ul>

                            <div v-else>
                                <p>
                                    Fill out the form to the left and I will get
                                    those facts over to you.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / end of main section -->
        </div>
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
