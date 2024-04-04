import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        authUser: null,
        authToken: null,
        authRole: null,
        authErrors: []
    }),

    getters: {
        User: (state) => state.authUser,
        Errors: (state) => state.authErrors,
    },

    actions: {
        async getToken() {
            await axios.get(`http://127.0.0.1:8000/sanctum/csrf-cookie/`);
        },

        async getUser() {
            await this.getToken();
            this.authToken = localStorage.getItem('authToken');
            const response = await axios.get(`http://127.0.0.1:8000/api/user/`, {
                headers: {
                    Authorization: `Bearer ${this.authToken}`
                }
            });
            this.authRole = response.data.role;
            this.authUser = response.data.user;
        },

        async Login(data){
            // this.authErrors = [];
            await this.getToken();
            try{
                const response = await axios.post(`http://127.0.0.1:8000/api/sign-in`, data)
                this.authUser = response.data.user;
                this.authToken = response.data.token;
                localStorage.setItem('authToken', this.authToken);
                this.router.push('/')
            }
            catch(error){
                    this.authErrors = error.response.data;
            }
        },

        async Register(data){
            await this.getToken();
            if (localStorage.getItem('organisation_id')) {
                data['organisation_id'] = localStorage.getItem('organisation_id');
            }
            try{
                console.log(data);
                const response = await axios.post("http://127.0.0.1:8000/api/sign-up", data)
                this.authUser = response.data.user;
                this.authToken = response.data.token;
                localStorage.setItem('authToken', this.authToken);
                localStorage.removeItem('organisation_id');
                this.router.push('/')
            }
            catch(error){
                this.authErrors = error.response.data;
            };
        },

        async Logout(){
            this.authToken = localStorage.getItem('authToken');
            // console.log( `Bearer ${this.authToken}`);
            try {
                await axios.post("http://127.0.0.1:8000/api/sign-out", {
                    headers: {
                        Accept: 'application/json',
                        Authorization: `Bearer ${this.authToken}`
                    }
                });
                localStorage.removeItem('authToken');
                $router.push('/sign-in')
            } catch (error) {
                console.log("Failed to Logout user.", error);
            }
        }
    },
});