<template>
    <div class="container-fluid mt-3">
        <div class="container mt-5">
            <div v-if="success" class="alert alert-success" role="alert">
                Message Sended!
            </div>
            <div class="border border-danger rounded-3 p-3">
                <form @submit.prevent="sendForm">
                    <!-- <div class="form-check">
                    <label class="form-check-label" for="number">
                        {{$route.params.id}}
                    </label>
                    <input checked v-model="apartment_id" class="form-check-input" type="radio" name="visible" id="number" v-bind:value="($route.params.id)">
                </div>  -->

                    <div class="form-group mb-5">
                        <label for="name">Name</label>
                        <input
                            v-model="name"
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                        />
                        <p
                            class="alert alert-danger"
                            v-for="(error, index) in errors.name"
                            :key="index"
                        >
                            {{ error }}
                        </p>
                    </div>
                    <div class="form-group mb-5">
                        <label for="email">Email</label>
                        <input
                            v-model="email"
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="name@example.com"
                        />
                        <p
                            class="alert alert-danger"
                            v-for="(error, index) in errors.email"
                            :key="index"
                        >
                            {{ error }}
                        </p>
                    </div>
                    <div class="form-group mb-5">
                        <label for="message">Messagge</label>
                        <textarea
                            v-model="text"
                            class="form-control"
                            id="text"
                            name="text"
                            rows="3"
                        ></textarea>
                        <p
                            class="alert alert-danger"
                            v-for="(error, index) in errors.text"
                            :key="index"
                        >
                            {{ error }}
                        </p>
                    </div>

                    <button type="submit" class="btn btn-danger text-white">
                        {{ sending ? "Sending mail..." : "Send" }}
                    </button>
                    <button type="text" class="btn btn-danger text-white">
                        <a
                            href="javascript:history.back()"
                            class="text-decoration-none text-white"
                            >Back</a
                        >
                    </button>
                </form>
            </div>
        </div>
        <footer class="bg-light text-center text-white footer-content">
            <div class="text-center p-3 row" style="background-color: #032f6d;">
                <section class="mb-4 col-2 col-md-3">
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="https://www.linkedin.com/in/angelo-d-al%C3%B2-290325234/" role="button"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="https://github.com/AngeloDalo" role="button"><i class="fab fa-github"></i></a>
                    <span>Angelo D'Alo'</span>
                </section>
                <section class="mb-4 col-2 col-md-3">
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="https://www.linkedin.com/in/cristian-guzman-45178b157/" role="button"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="https://github.com/Guz117" role="button"><i class="fab fa-github"></i></a>
                    <span>Cristian Guzman</span>
                </section>
                <section class="mb-4 col-2 col-md-3">
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="https://www.linkedin.com/in/giandosaba/" role="button"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="https://github.com/GiandoSaba" role="button"><i class="fab fa-github"></i></a>
                    <span>Giandomenico Sabato</span>
                </section>
                <section class="mb-4 col-2 col-md-3">
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="https://www.linkedin.com/in/daniele-simonetti-/" role="button"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="https://github.com/Daniele-Simonetti" role="button"><i class="fab fa-github"></i></a>
                    <span>Daniele Simonetti</span>
                </section>
                <p class="love">Made with <span>&hearts;</span></p>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    name: "contact",
    data() {
        return {
            name: null,
            email: null,
            text: null,
            success: false,
            sending: false,
            apartment_id: null,
            errors: {},
        };
    },
    mounted() {
        this.apartment_id = this.$route.params.id;
        console.log(this.$route.params.id);
    },
    methods: {
        sendForm() {
            console.log(this.name, this.apartment_id);
            this.sending = true;
            this.success = false;

            axios
                .post("/api/v1/contacts", {
                    name: this.name,
                    email: this.email,
                    text: this.text,
                    apartment_id: this.apartment_id,
                })
                .then((response) => {
                    if (!response.data.success) {
                        this.success = false;
                        this.errors = response.data.errors;
                    } else {
                        this.success = true;
                        this.errors = {};
                        this.name = "";
                        this.email = "";
                        this.text = "";
                    }
                    this.sending = false;
                })
                .catch((error) => {
                    console.log(error.response.data);
                    this.sending = false;
                });
        },
    },
};
</script>

<style lang="scss" scoped>
.footer-content {
    position: fixed;
    bottom: 0;
    width: 100%;
}
</style>
