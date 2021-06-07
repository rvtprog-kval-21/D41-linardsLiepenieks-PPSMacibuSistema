<template>
    <div class="p-3">
        <div v-for="(user, index) in Lusers"
             class="row justify-content-around align-items-center text-center PPS-content-wrapper p-2 rounded mb-2"
             style="font-size: 1vw;">

            <div class="col text-truncate">{{ user.name }}</div>
            <div class="col-3 text-truncate">{{ user.email }}</div>
            <div class="col row text-center d-flex justify-content-center p-0">
                <div class="col text-right p-0">
                    <input
                        type="checkbox"
                        id="admin_checkbox"
                        v-model="user.admin"
                        true-value="1"
                        false-value="0"
                        @change="changeAdmin($event, user)"
                    >
                </div>
                <label class="col text-left">{{ user.admin == 0 ? 'NAV' : 'IR' }}</label>

            </div>

            <div class="col row text-center d-flex justify-content-center">
                <div class="col text-right">
                    <input
                        type="checkbox"
                        id="teacher_checkbox"
                        v-model="user.teacher"
                        true-value="1"
                        false-value="0"
                        @change="changeTeacher($event, user)"
                    >
                </div>
                <label class="col text-left">{{ user.teacher == 0 ? 'NAV' : 'IR' }}</label>

            </div>
                <button class=" col-1 btn PPS-delete-button"
                        @click="deleteUser(user, index)"
                        type="button"><i
                    class="fas fa-trash"></i>
                </button>
        </div>
        <div>
            <button @click="formSubmit($event)" type="submit" class="btn PPS-info-button">Saglabāt izmaiņas</button>
        </div>
    </div>

</template>

<script>
export default {

    props: ['users'],

    mounted() {
    },


    data() {
        return {
            Lusers: this.users,
            delete: [],
        };
    },

    methods: {
        changeAdmin($event, user) {
            if ($event.target.checked === true) {
                user.admin = 1;
            } else {
                user.admin = 0;
            }
        },
        changeTeacher($event, user) {
            if ($event.target.checked === true) {
                user.teacher = 1;
            } else {
                user.teacher = 0;
            }
        },

        deleteUser(user, index) {
            if (confirm('Vai tiešām izdzēst lietotāju: ' + user.name + '\n izmaiņas tiks veiktas, kad nospiedīsiet pogu "saglabāt"')) {
                this.Lusers.splice(index, 1);
                this.delete.push(user);
            }
            console.log(this.delete);
        },
        formSubmit(event) {
            //prevent triggering controller
            console.log(this.delete);
            axios.post("/admin/users", {
                update: this.Lusers,
                delete: this.delete,
            })
                .then(res => {
                    //console.log(res.data);
                    alert("Izmaiņas saglabātas");
                }).catch(err => {
                alert(err);
                console.log(err)
            });

            location.reload();


        },
    }


}
</script>
