<template>
    <v-container>
        <v-card class="pa-4" elevation="2">
            <v-card-title>Lucky Page</v-card-title>
            <v-card-subtitle>Your unique link: {{ getLink() }}</v-card-subtitle>
            <v-divider></v-divider>

            <v-row class="mt-4" justify="center">
                <v-btn color="primary" class="ma-2" @click="generateNewLink">Generate New Link</v-btn>
                <v-btn color="red darken-1" class="ma-2" @click="deactivateLink">Deactivate Link</v-btn>
                <v-btn color="success" class="ma-2" @click="getLucky">I'm Feeling Lucky</v-btn>
                <v-btn color="info" class="ma-2" @click="getWinHistory">History</v-btn>
            </v-row>

            <v-divider class="my-4"></v-divider>

            <v-card v-if="luckyResult" class="mb-4" color="light-blue lighten-5" elevation="1">
                <v-card-title>Lucky Result</v-card-title>
                <v-card-text>
                    <p>
                        <strong>Result: </strong>
                        <span :class="getResultClass(luckyResult.result)">{{ luckyResult.result }}</span>
                    </p>
                    <p><strong>Win Amount:</strong> {{ luckyResult.win_amount }}</p>
                    <p><strong>Random Number:</strong> {{ luckyResult.random_number }}</p>
                </v-card-text>
            </v-card>

            <v-card v-if="history.length > 0" color="lime lighten-5" elevation="1">
                <v-card-title>History (Last 3 Results)</v-card-title>
                <v-list>
                    <v-list-item v-for="item in history" :key="item.id">
                        <v-list-item>
                            <p>
                                <strong>Result: </strong>
                                <span :class="getResultClass(item.result)">{{ item.result }}</span>
                            </p>
                            <p><strong>Win Amount:</strong> {{ item.win_amount }}</p>
                            <p><strong>Random Number:</strong> {{ item.random_number }}</p>
                        </v-list-item>
                    </v-list-item>
                </v-list>
            </v-card>
        </v-card>
    </v-container>
</template>

<script>
import {view, generate, deactivate, getHistory, play} from "../api/win.js";

export default {
    data() {
        return {
            link: this.getLink(),
            userId: null,
            luckyResult: null,
            history: [],
        };
    },
    async mounted() {
        await this.viewLink();
    },
    methods: {
        async viewLink() {
            try {
                const response = await view(this.link);
                const {data} = response.data;
                this.link = data.link;
                this.userId = data.user_id;
            } catch (error) {
                alert("Failed to view page");
            }
        },
        async generateNewLink() {
            try {
                const response = await generate(this.link);
                const {data} = response.data;
                alert("New link generated!"+ data.link);
            } catch (error) {
                alert("Failed to generate new link");
            }
        },
        async deactivateLink() {
            try {
                await deactivate(this.link);
                alert("Link deactivated successfully!");
            } catch (error) {
                alert("Failed to deactivate link");
            }
        },
        async getLucky() {
            try {
                const response = await play(this.link, {user_id: this.userId});
                const {data} = response.data;
                this.luckyResult = data;
                this.history = [];
            } catch (error) {
                alert("Failed to get lucky result");
            }
        },
        async getWinHistory() {
            this.luckyResult = null;
            try {
                const response = await getHistory(this.link, {user_id: this.userId});
                const {data} = response.data;
                this.history = data;
            } catch (error) {
                alert("Failed to fetch history");
            }
        },
        getLink() {
            return this.$route.path.substring(1);
        },
        getResultClass(result) {
            if (result === 'Win') {
                return 'text-green';
            } else if (result === 'Lose') {
                return 'text-red';
            }
            return '';
        },
    },
};
</script>

<style scoped>
.v-container {
    margin-top: 20px;
}

.text-green {
    color: green;
    font-weight: bold;
}

.text-red {
    color: red;
    font-weight: bold;
}
</style>
