<template>
    <div class="container">
        <form @submit.prevent="submit">

            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="box-body" style="font-size: 20px;">
                        <!-- Ievadlauks start -->
                        <div class="form-group PPS-page-title">
                            <label for="name" style="font-size: 20px;">Nodarbības nosaukums</label>
                            <input class="form-control" type="text"
                                   id="name"
                                   name="name"
                                   maxlength="256"
                                   v-model="fields.name"
                            >
                            <div v-if="errors && errors.name" style="font-size: 20px;">{{ errors.name[0] }}</div>
                        </div>

                        <!-- Ievadlauks start -->
                        <div class="form-group PPS-page-title row">
                            <label for="nr" style="font-size: 20px;">Nodarbības kārtas numurs</label>
                            <input class="form-control" type="number"
                                   id="nr"
                                   name="nr"
                                   v-model="fields.nr"
                            >
                            <div v-if="errors && errors.nr" style="font-size: 20px;">{{ errors.nr[0] }}</div>
                        </div>

                        <!-- Ievadlauks start -->
                        <div class="form-group PPS-page-title">
                            <label for="apraksts" style="font-size: 20px">Nodarbības apraksts</label>


                            <textarea class="form-control" type="text"
                                      id="apraksts"
                                      name="apraksts"

                            ></textarea>


                            <div v-if="errors && errors.apraksts" style="font-size: 20px;">{{
                                    errors.apraksts[0]
                                }}
                            </div>

                        </div>

                        <div class="form-group PPS-page-title p-3">
                            <label style="font-size: 20px;">Pievienot video</label>
                            <input class="form-control" type="file"
                                   id="video"
                                   name="video"
                                   accept="video/*,image/*"
                            >
                            <p v-if="errors && errors.video" style="font-size: 20px;">{{ errors.video[0] }}</p>
                        </div>


                        <h2 style="color: black;">Pievienot nodarbībai uzdevumus</h2>
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
        this.avaliableExercises = Array.prototype.slice.call(this.exercises, 0);
        this.avaliableExercisesShow = this.avaliableExercises;

        tinymce.init({
            selector : "textarea",
            elements: "editor",
            theme : "silver"
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
            this.fields.apraksts = tinyMCE.activeEditor.getContent();;
            axios.post('/courses/' + this.course.id + '/lessons/post', this.fields).then(response => {
                //console.log(response);
                window.location.href = "/courses/show/"+this.course.id;

            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
        },


    }
}
</script>
