<template>
    <div class="container">
        <form @submit.prevent="submit">

            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="box-body" style="font-size: 20px;">

                        <div>
                            <label for="name" style="font-size: 20px;">Sacensību Tips</label>

                            <div>
                                <input type="radio" id="olimp" name="type" value="olimp" v-model="fields.type">
                                <label for="olimp">Olimpiāde</label>
                            </div>

                            <div>
                                <input type="radio" id="contest" name="type" value="contest" v-model="fields.type">
                                <label for="contest">Sacensības</label>
                            </div>

                            <div v-if="errors && errors.type" style="font-size: 20px;">{{ errors.type[0] }}</div>

                        </div>

                        <div class="form-group" style="display: block;">
                            <label for="private" style="display: inline;">Privāts</label>
                            <input type="checkbox" style="display: inline;"
                                   id="private"
                                   name="private"
                                   value="1"
                                   v-model="fields.private">
                        </div>
                        <div class="form-group" style="display: block;">
                            <label for="minScore" style="display: inline;">Minimālais punktu skaits</label>
                            <input type="number" style="display: inline;"
                                   id="minScore"
                                   name="minScore"
                                   v-model="fields.minScore">
                            <div v-if="errors && errors.minScore" style="font-size: 20px;">Norādiet minimālo punktu skaitu</div>

                        </div>

                        <!-- Ievadlauks start -->
                        <div class="form-group PPS-page-title">
                            <label for="name" style="font-size: 20px;">Sacensību nosaukums</label>
                            <input class="form-control" type="text"
                                   id="name"
                                   name="name"
                                   maxlength="256"
                                   v-model="fields.name"
                            >
                            <div v-if="errors && errors.name" style="font-size: 20px;">{{ errors.name[0] }}</div>
                        </div>

                        <!-- Ievadlauks start -->


                        <!-- Ievadlauks start -->
                        <div class="form-group PPS-page-title">
                            <label for="apraksts" style="font-size: 20px">Sacensību apraksts</label>


                            <textarea class="form-control" type="text"
                                      id="apraksts"
                                      name="apraksts"

                            ></textarea>


                            <div v-if="errors && errors.apraksts" style="font-size: 20px;">{{
                                    errors.apraksts[0]
                                }}
                            </div>

                        </div>
                        <div v-if="errors && errors.startTime || errors.endTime" style="font-size: 20px; color:red;">
                            Norādiet sacensību sākuma un beigu laiku
                        </div>

                        <div class="form-group PPS-page-title p-0 m-3 d-flex">
                            <label style="font-size: 20px;">Iestatīt Sacensību sākuma un beigu laiku</label>
                            <input style="font-size: 15px;" type="datetime-local" id="startTime" name="startTime"
                                   v-model="fields.startTime">
                            <input style="font-size: 15px;" type="datetime-local" id="endTime" name="endTime"
                                   v-model="fields.endTime">
                        </div>



                        <h2 style="color: black;">Pievienot Sacensībām uzdevumus</h2>
                        <div class="row d-flex justify-content-center overflow-auto"
                             style="color: black; height: 17rem;">

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

                                <div v-for="(exercise) in avaliableExercisesShow">
                                    <div @click="addExercise(exercise)"
                                         class="row m-0 mb-1 p-1 PPS-content-wrapper PPS-exercise text-center align-items-center rounded"
                                         style="background-color: white;">
                                        <div class=""><i class="fas fa-plus-square PPS-add-button p-0"></i></div>
                                        <div class="col text-center">{{ exercise.nosaukums }}</div>
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

                                <div v-for="(exercise) in addedExercisesShow">
                                    <div @click="removeExercise(exercise)"
                                         class="row m-0 mb-1 p-1 PPS-content-wrapper PPS-exercise text-center align-items-center rounded"
                                         style="background-color: white;">
                                        <div class=""><i class="fas fa-minus-square PPS-delete-button p-0"></i></div>
                                        <div class="col text-center">{{ exercise.nosaukums }}</div>
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
import tinymce from "../../../public/vendor/tinymce";

export default {

    props: ['exercises', 'course'],

    mounted() {
        this.avaliableExercises = this.exercises;
        this.avaliableExercisesShow = this.avaliableExercises;
        this.fields.type = 'contest';
        this.fields.private = false;

        tinymce.init({
            selector: "textarea",
            elements: "editor",
            theme: "silver"
        });
    },

    data() {
        return {
            avaliableExercises: [],
            avaliableExercisesShow: [],
            addedExercises: [],
            addedExercisesShow: [],
            message: '',
            messageRemove: '',
            fields: {},
            errors: {},
            picked: '',


        };
    },


    methods: {

        addExercise(exercise) {
            this.avaliableExercises.splice(this.avaliableExercises.indexOf(exercise), 1);
            this.addedExercises.push(exercise);
            this.addedExercisesShow = this.addedExercises;
            this.messageRemove = '';
            this.searchBarChangeAdd('');


        },
        removeExercise(exercise) {
            this.addedExercises.splice(this.addedExercises.indexOf(exercise), 1);
            this.avaliableExercises.push(exercise);
            this.messageRemove = '';
            this.searchBarChangeRemove('');


        },

        searchBarChangeAdd(input) {

            input = input.toLowerCase();

            if (input === '') {
                this.avaliableExercisesShow = this.avaliableExercises;
                return
            }
            this.avaliableExercisesShow = this.avaliableExercises.filter(
                item => item.nosaukums.toLowerCase().indexOf(input) > -1);
        },
        searchBarChangeRemove(input) {

            input = input.toLowerCase();

            if (input === '') {
                this.addedExercisesShow = this.addedExercises;
                return
            }
            this.addedExercisesShow = this.addedExercises.filter(
                item => item.nosaukums.toLowerCase().indexOf(input) > -1);
        },
        submit() {
            this.errors = {};
            this.fields.exercises = this.addedExercises;
            this.fields.apraksts = tinyMCE.activeEditor.getContent();
            ;
            axios.post('/contests/create', this.fields).then(response => {
                //console.log(response);
                window.location.href = "/contests";

            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
        },


    }
}
</script>
