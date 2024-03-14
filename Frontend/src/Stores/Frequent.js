import { defineStore } from "pinia";
import axios from "axios";

export const useFrequent = defineStore("frequent", {
    state: () => ({
        authToken: null,
        skills: null,
        duties: null,
        referrals: null,
        education: null
    }),

    actions: {
        async getSkills () {
            this.authToken = localStorage.getItem('authToken');
            const response = await axios.get('http://127.0.0.1:8000/api/skills', {
                headers: {
                    Accept: 'application/json',
                    Authorization: `Bearer ${authToken}`
                }
            })
            this.skills = response.data.skills.map((skill) => ({ value: skill.id, label: skill.name }));
        },
    }
});