<template>
    <div>
        <b-alert
            :show="errorCountdown"
            dismissible
            fade
            variant="danger"
            @dismiss-count-down="errorCountdownChanged"
        >
            Une erreur est survenue, consulter la console pour plus d'infos
        </b-alert>

        <div class="text-center mb-3" v-if="loading">
            <b-spinner style="width: 3rem; height: 3rem;"></b-spinner>
        </div>

        <template v-else-if="!filleulCount">
            <h3>C'est dans la boite !</h3>
            <p class="font-weight-bold">Nous vous souhaitons à tous une bonne année :)</p>

            <p>
                Pensez à rejoindre le groupe Facebook et le Discord<br/>
                (Récapitulatif du parrainage disponible sur le groupe Facebook)
            </p>
        </template>

        <template v-else>
            <table class="col-12 mb-3">
                <tr>
                    <td>
                        <b-button variant="danger" @click="rm1Click">
                            <i class="fas fa-user-times"></i>
                        </b-button>
                    </td>
                    <td>{{ filleulName }}</td>
                </tr>
                <tr><td colspan="2" class="text-center">
                    sera parrainé(e) par
                </td></tr>
                <transition name="fade">
                    <tr v-if="showParrain">
                        <td>
                            <b-button variant="danger" @click="rm2Click">
                                <i class="fas fa-user-times"></i>
                            </b-button>
                        </td>
                        <td>
                            <span v-if="showParrain">{{ parrainName }}</span>
                        </td>
                    </tr>
                </transition>
            </table>

            <b-button block variant="primary" :disabled="loading" @click="nextClick">
                >>>
            </b-button>
        </template>

        <hr/>

        <div class="row">
            <div class="col-12">
                Parrains restants :<br/>
                <b-progress :value="parrainCount" :max="parrainTotalComp" animated></b-progress>
            </div>
            <div class="col-12 mt-2">
                Progression :<br/>
                <b-progress :value="progress" :max="filleulTotalComp" animated></b-progress>
            </div>
            <div class="col-12 mt-3">
                <a :href="homeRoute" class="btn btn-secondary btn-block">
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            filleulName: function () {
                if (this.filleul) {
                    return this.filleul.lastname + " " + this.filleul.firstname
                } else {
                    return "";
                }
            },
            filleulTotalComp: function () {
                return Math.max(this.filleulTotal, 1);
            },
            parrainName: function () {
                if (this.parrain) {
                    return this.parrain.lastname + " " + this.parrain.firstname;
                } else {
                    return "";
                }
            },
            parrainTotalComp: function () {
                return Math.max(this.parrainTotal, 1);
            },
            progress: function() {
                return this.filleulTotal - this.filleulCount;
            }
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                errorDefaultCountdown: 5,
                errorCountdown: 0,
                filleul: undefined,
                filleulCount: 0,
                filleulTotal: 0,
                loading: true,
                parrain: undefined,
                parrainCount: 0,
                parrainTotal: 0,
                showParrain: false
            }
        },
        methods: {
            errorCountdownChanged(countdown) {
                this.errorCountdown = countdown;
            },
            nextClick(event) {
                if (this.showParrain) {
                    this.sendRequest(
                        "DUOVALID",
                        {
                            'filleul': this.filleul.id,
                            'parrain': this.parrain.id
                        },
                        () => {
                            this.requestDuo();
                        }
                    );
                }

                this.showParrain = !this.showParrain;
            },
            rm1Click(event) {
                this.sendRequest(
                    "FILLEULABS",
                    this.filleul.id,
                    (response) => {
                        const data = response.data;
                        this.filleul = data['filleul'];
                        this.setProgress(data);
                    }
                );
            },
            rm2Click(event) {
                this.sendRequest(
                    "PARRAINABS",
                    this.parrain.id,
                    (response) => {
                        const data = response.data;
                        this.parrain = data['parrain'];
                        this.setProgress(data);
                    });
            },
            requestDuo() {
                this.sendRequest(
                    "GETDUO",
                    undefined,
                    (response) => {
                        const data = response.data;

                        this.showParrain = false;
                        this.filleul = data['filleul'];
                        this.parrain = data['parrain'];
                        this.setProgress(data);
                    }
                );
            },
            sendRequest(action, value, onSuccess) {
                this.loading = true;

                let params = {
                    '_token': this.csrf,
                    'action': action
                };
                if (typeof value !== "undefined") {
                    params['data'] = value;
                }

                axios.post(this.apiRoute, params)
                     .then((response) => {
                         onSuccess(response);
                         this.loading = false;
                     })
                     .catch((error) => {
                         this.errorCountdown = this.errorDefaultCountdown;
                         console.error(error);
                     });
            },
            setProgress(data) {
                this.filleulCount = data['filleulCount'];
                this.filleulTotal = data['filleulTotal'];
                this.parrainCount = data['parrainCount'];
                this.parrainTotal = data['parrainTotal'];
            }
        },
        mounted() {
            this.requestDuo();
        },
        props: ['apiRoute', 'homeRoute']
    }
</script>

<style scoped>
    .fade-enter-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave, .fade-leave-to {
        opacity: 0;
    }
</style>
