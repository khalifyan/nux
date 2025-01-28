<template>
    <v-container>
        <v-card class="pa-4" elevation="2">
            <v-card-title>Register</v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid">
                    <v-text-field
                        v-model="username"
                        label="Username"
                        :rules="[rules.required]"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="phoneNumber"
                        label="Phone Number"
                        :rules="[rules.required, rules.phone]"
                        required
                    ></v-text-field>
                    <v-btn
                        color="primary"
                        :disabled="!valid"
                        class="mt-3"
                        @click="handleRegister"
                    >
                        Register
                    </v-btn>
                </v-form>
            </v-card-text>
            <v-card-subtitle v-if="uniqueLink">
                Your unique link: <v-btn :to="{ path: uniqueLink }">{{uniqueLink}}</v-btn>
            </v-card-subtitle>
        </v-card>
    </v-container>
</template>

<script>
import {register} from "../api/user.js";

export default {
    data() {
        return {
            username: "",
            phoneNumber: "",
            uniqueLink: "",
            valid: false,
            rules: {
                required: (value) => !!value || "This field is required.",
                phone: (value) =>
                    /^[0-9]{10,15}$/.test(value) || "Phone number must be valid.",
            },
        };
    },
    methods: {
        async handleRegister() {
            try {
                const response = await register({
                    username: this.username,
                    phone_number: +this.phoneNumber,
                });
                const {data} = response.data;
                this.uniqueLink = data.unique_link;
                this.valid = false;
            } catch (error) {
                alert("Registration failed: " + error.response.data.message);
            }
        },
    },
};
</script>

<style scoped>
.v-container {
    margin-top: 20px;
}
</style>
