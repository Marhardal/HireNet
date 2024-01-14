import { reactive } from "vue";

export default function inputs() {
    const values = reactive({
        job_id: '',
        num: '',
        arrangement_id: '1',
        location: '',
        about: '',
        skill_id: '',
        duty_id: '',
        certificate_id: '',
        organisation_id: '',
        due_date: '',
    });

    return { values, }
}