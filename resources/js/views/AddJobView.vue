<template>
    <section class="bg-purple-50">
        <div class="container m-auto max-w-2xl py-24">
            <div
                class="bg-white px-6 py-8 mb-4 shadow-md rounded-md border m-4 md:m-0"
            >
                <form @submit.prevent="handleSubmit">
                    <h2 class="text-3xl text-center font-semibold mb-6">
                        Add Job
                    </h2>

                    <div class="mb-4">
                        <label
                            for="type"
                            class="block text-gray-700 font-bold mb-2"
                            >Job Type</label
                        >
                        <select
                            v-model="form.type"
                            id="type"
                            name="type"
                            class="border rounded w-full py-2 px-3"
                            required
                        >
                            <option value="Full-Time">Full-Time</option>
                            <option value="Part-Time">Part-Time</option>
                            <option value="Remote">Remote</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2"
                            >Job Listing Name</label
                        >
                        <input
                            type="text"
                            id="name"
                            name="name"
                            v-model="form.title"
                            class="border rounded w-full py-2 px-3 mb-2"
                            placeholder="eg. Beautiful Apartment In Miami"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="description"
                            class="block text-gray-700 font-bold mb-2"
                            >Description</label
                        >
                        <textarea
                            id="description"
                            name="description"
                            v-model="form.description"
                            class="border rounded w-full py-2 px-3"
                            rows="4"
                            placeholder="Add any job duties, expectations, requirements, etc"
                        ></textarea>
                    </div>

                    <div class="mb-4">
                        <label
                            for="type"
                            class="block text-gray-700 font-bold mb-2"
                            >Salary</label
                        >
                        <select
                            id="salary"
                            v-model="form.salary"
                            name="salary"
                            class="border rounded w-full py-2 px-3"
                            required
                        >
                            <option value="Under $50K">under $50K</option>
                            <option value="$50K - $60K">$50 - $60K</option>
                            <option value="$60K - $70K">$60 - $70K</option>
                            <option value="$70K - $80K">$70 - $80K</option>
                            <option value="$80K - $90K">$80 - $90K</option>
                            <option value="$90K - $100K">$90 - $100K</option>
                            <option value="$100K - $125K">$100 - $125K</option>
                            <option value="$125K - $150K">$125 - $150K</option>
                            <option value="$150K - $175K">$150 - $175K</option>
                            <option value="$175K - $200K">$175 - $200K</option>
                            <option value="Over $200K">Over $200K</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">
                            Location
                        </label>
                        <input
                            v-model="form.location"
                            type="text"
                            id="location"
                            name="location"
                            class="border rounded w-full py-2 px-3 mb-2"
                            placeholder="employer Location"
                            required
                        />
                    </div>

                    <h3 class="text-2xl mb-5">employer Info</h3>

                    <div class="mb-4">
                        <label
                            for="employer"
                            class="block text-gray-700 font-bold mb-2"
                            >employer Name</label
                        >
                        <input
                            type="text"
                            id="name"
                            v-model="form.employer.name"
                            name="name"
                            class="border rounded w-full py-2 px-3"
                            placeholder="employer Name"
                        />
                    </div>

                    <div class="mb-4">
                        <label
                            for="employer_description"
                            class="block text-gray-700 font-bold mb-2"
                            >employer Description</label
                        >
                        <textarea
                            id="employer_description"
                            v-model="form.employer.description"
                            name="description"
                            class="border rounded w-full py-2 px-3"
                            rows="4"
                            placeholder="What does your employer do?"
                        ></textarea>
                    </div>

                    <div class="mb-4">
                        <label
                            for="contact_email"
                            class="block text-gray-700 font-bold mb-2"
                            >Contact Email</label
                        >
                        <input
                            type="email"
                            id="contact_email"
                            v-model="form.employer.contactEmail"
                            name="contactEmail"
                            class="border rounded w-full py-2 px-3"
                            placeholder="Email address for applicants"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="contact_phone"
                            class="block text-gray-700 font-bold mb-2"
                            >Contact Phone</label
                        >
                        <input
                            type="tel"
                            id="contact_phone"
                            v-model="form.employer.contactPhone"
                            name="contactPhone"
                            class="border rounded w-full py-2 px-3"
                            placeholder="Optional phone for applicants"
                        />
                    </div>

                    <div>
                        <button
                            class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-full w-full focus:outline-none focus:shadow-outline"
                            type="submit"
                        >
                            Add Job
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script setup>
import router from "@/router";
import { reactive } from "vue";
import { useToast } from "vue-toastification";
import axios from "axios";

const form = reactive({
    type: "Full-Time",
    title: "",
    description: "",
    salary: "",
    location: "",
    employer: {
        name: "",
        description: "",
        contactEmail: "",
        contactPhone: "",
    },
});

const toast = useToast();

const handleSubmit = async () => {
    const newJob = {
        employer: {
            name: form.employer.name,
            description: form.employer.description,
            contactEmail: form.employer.contactEmail,
            contactPhone: form.employer.contactPhone,
        },
        job: {
            title: form.title,
            type: form.type,
            description: form.description,
            salary: form.salary,
            location: form.location,
        },
    };

    try {
        const res = await axios.post("/jobs/", newJob);
        toast.success("Job Added Successfully", {
            timeout: 2000,
        });
        Object.assign(form, {
            employer: {
                name: "",
                description: "",
                contactEmail: "",
                contactPhone: "",
            },
            title: "",
            type: "",
            description: "",
            salary: "",
            location: "",
        });
        console.log(res.data.data.id);
        router.push(`/jobs/${res.data.data.id}`);
    } catch (error) {
        console.error("Error fetch job ", error);
        toast.error("Job was not Added", {
            timeout: 2000,
        });
    }
};
</script>

<style lang="scss" scoped></style>
