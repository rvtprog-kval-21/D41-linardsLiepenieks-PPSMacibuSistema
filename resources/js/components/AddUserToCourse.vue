<template>
    <div class="container">
        <form @submit.prevent="submit">

            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="box-body" style="font-size: 20px;">


                        <div class="row d-flex justify-content-center overflow-auto"
                             style="color: black; height: 30rem;">
                            <div class="col-6 PPS-content-wrapper">

                                <div class="row mb-2">
                                    <input type="search" class="form-control rounded col" placeholder="Meklēt"
                                           aria-label="Search"
                                           id="searchBar"
                                           aria-describedby="search-addon"
                                           v-model="message"
                                           @input="searchBarChangeAdd(message)"/>
                                    <span class="input-group-text border-0 col-2 " id="search-addon">
                     <i class="fas fa-search"></i></span>
                                </div>

                                <div v-for="(user) in avaliableUsersShow">
                                    <div @click="addExercise(user)"
                                         class="row m-0 mb-1 p-1 PPS-content-wrapper PPS-user text-center align-items-center rounded"
                                         style="background-color: white;">
                                        <div class=""><i class="fas fa-plus-square PPS-add-button p-0"></i></div>
                                        <div class="col text-center">{{ user.name }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 PPS-content-wrapper">

                                <div class="row mb-2">
                                    <input type="search" class="form-control rounded col" placeholder="Meklēt"
                                           aria-label="Search"
                                           id="searchBarRemove"
                                           aria-describedby="search-addon"
                                           v-model="messageRemove"
                                           @input="searchBarChangeRemove(messageRemove)"/>
                                    <span class="input-group-text border-0 col-2 " id="search-addon-remove">
                     <i class="fas fa-search"></i></span>
                                </div>

                                <div v-for="(user) in addedUsersShow">
                                    <div @click="removeExercise(user)"
                                         class="row m-0 mb-1 p-1 PPS-content-wrapper PPS-user text-center align-items-center rounded"
                                         style="background-color: white;">
                                        <div class=""><i class="fas fa-minus-square PPS-delete-button p-0"></i></div>
                                        <div class="col text-center">{{ user.name }}</div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div>
                            <button type="submit" class="btn PPS-info-button">Saglabāt</button>
                        </div>
                        <div class="box-footer">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</template>

<script>

export default {

    props: ['users', 'course', 'courseUsers', 'path'],
    data() {
        return {
            avaliableUsers: [],
            avaliableUsersShow: [],
            addedUsers: [],
            addedUsersShow: [],
            message: '',
            messageRemove: '',
            fields: {},
            errors: {},


        };
    },

    mounted() {

        console.log(this.users);
        this.avaliableUsers = this.users;

        this.courseUsers.forEach(function (user) {
            this.addedUsers.push(user);
            this.addedUsersShow.push(user);
            this.avaliableUsers.splice(this.avaliableUsers.findIndex((element)=>element.id == user.id), 1);

        }.bind(this));
        this.avaliableUsersShow = this.avaliableUsers;



    },


    methods: {

        addExercise(user) {

            this.avaliableUsers.splice(this.avaliableUsers.indexOf(user), 1);
            this.addedUsers.push(user);
            this.addedUsersShow = this.addedUsers;
            this.messageRemove = '';
            this.searchBarChangeAdd('');


        },
        removeExercise(user) {
            this.addedUsers.splice(this.addedUsers.indexOf(user), 1);
            this.avaliableUsers.push(user);
            this.messageRemove = '';
            this.searchBarChangeRemove('');


        },

        searchBarChangeAdd(input) {

            input = input.toLowerCase();

            if (input === '') {
                this.avaliableUsersShow = this.avaliableUsers;
                return
            }
            this.avaliableUsersShow = this.avaliableUsers.filter(
                item => item.name.toLowerCase().indexOf(input) > -1);
        },
        searchBarChangeRemove(input) {

            input = input.toLowerCase();

            if (input === '') {
                this.addedUsersShow = this.addedUsers;
                return
            }
            this.addedUsersShow = this.addedUsers.filter(
                item => item.name.toLowerCase().indexOf(input) > -1);
        },
        submit() {
            this.errors = {};
            this.fields.users = this.addedUsers;
            axios.post(this.path + this.course.id + '/users', this.fields).then(response => {
                console.log(response);
                window.location.href = this.path+"show/" + this.course.id;

            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
        },


    }
}
</script>
